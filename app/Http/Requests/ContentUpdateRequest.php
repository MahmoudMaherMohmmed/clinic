<?php

namespace App\Http\Requests;

use App\Constants\ContentTypes;
use App\Http\Requests\Request;
use App\Models\Content;
use App\Http\Repository\ContentRepository;

class ContentUpdateRequest extends Request
{


    /**
     * Method __construct
     *
     * @param ContentRepository $contentRepository
     *
     * @return void
     */
    public function __construct(ContentRepository $contentRepository) {
        $this->contentRepository = $contentRepository;
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'title' => 'required|array',
            'title.*' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'content_type_id' => 'required|exists:content_types,id',
            'image_preview' => '',
            'patch_number' => '',
            'path' => ''
        ];
        // request()->route();

        // $content = Content::find(request()->route('id'));
        $content = $this->contentRepository->findOrfail(request()->route('id'));

        // dd($content);
        if (request()->get('content_type_id') == ContentTypes::IMAGE && $content->content_type_id != ContentTypes::IMAGE) {
            $rules['path'] = 'required|mimes:png,jpeg,jpg';
        }

        if (request()->get('content_type_id') == ContentTypes::VIDEO && $content->content_type_id != ContentTypes::VIDEO) {
            $rules['path'] = 'required|mimes:mp4,flv,3gp';
        }

        if (request()->get('content_type_id') == ContentTypes::AUDIO && $content->content_type_id != ContentTypes::AUDIO) {
            $rules['path'] = 'required|mimes:mp3,webm,wav';
        }

        if (request()->get('content_type_id') == ContentTypes::YOUTUBVIDEO) {
            $rules['path'] = 'required|url';
        }

        if ((request()->get('content_type_id') == ContentTypes::ADVANCED_TEXT || request()->get('content_type_id') == ContentTypes::NORMAL_TEXT)) {
            $rules['path.*'] = 'required';
        }

        return $rules;
    }


    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        if (\App::getLocale() == "en") {
            $rules = [
                'title.ar' => 'Title Arabic',
                'title.en' => 'Title English',
            ];
        } else {
            $rules = [
                'title.ar' => 'عنوان بالعربي',
                'title.en' => 'العنوان الإنجليزية',
            ];
        }
        // dd(request()->all());
        if ((request()->get('content_type_id') == ContentTypes::ADVANCED_TEXT || request()->get('content_type_id') == ContentTypes::NORMAL_TEXT)) {
            if (\App::getLocale() == "en") {
                $rules['path.ar'] = 'TEXT Arabic';
                $rules['path.en'] = 'TEXT English';
            } else {
                $rules['path.ar'] = 'نص عربي';
                $rules['path.en'] = 'نص الإنجليزية';
            }
        }

        if (request()->get('content_type_id') == ContentTypes::IMAGE) {
            if (\App::getLocale() == "en") {
                $rules['path'] = 'Image';
            } else {
                $rules['path'] = 'صوره';
            }
        }
        if (request()->get('content_type_id') == ContentTypes::VIDEO ) {
            if (\App::getLocale() == "en") {
                $rules['path'] = 'Video';
            } else {
                $rules['path'] = 'فيديو';
            }
        }

        if (request()->get('content_type_id') == ContentTypes::AUDIO ) {
            if (\App::getLocale() == "en") {
                $rules['path'] = 'Audio';
            } else {
                $rules['path'] = 'صوتي';
            }
        }

        if (request()->get('content_type_id') == ContentTypes::YOUTUBVIDEO ) {
            if (\App::getLocale() == "en") {
                $rules['path'] = 'Link Youtub';
            } else {
                $rules['path'] = 'ربط يوتيوب';
            }
        }
        return $rules;
    }
}
