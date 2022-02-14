<?php

namespace App\Http\Requests;

use App\Constants\ContentTypes;
use App\Http\Requests\Request;

class ContentStoreRequest extends Request
{
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

        if (request()->get('content_type_id') == ContentTypes::IMAGE && $this->method() == 'POST') {
            $rules['path'] = 'required|mimes:png,jpeg,jpg';
        }

        if (request()->get('content_type_id') == ContentTypes::VIDEO && $this->method() == 'POST') {
            $rules['path'] = 'required|mimes:mp4,flv,3gp,m4v,mov,wmv,avi';
        }

        if (request()->get('content_type_id') == ContentTypes::AUDIO && $this->method() == 'POST') {
            $rules['path'] = 'required|mimes:mp3,webm,wav';
        }

        if (request()->get('content_type_id') == ContentTypes::YOUTUBVIDEO && $this->method() == 'POST') {
            $rules['path'] = 'required|url';
        }

        if ((request()->get('content_type_id') == ContentTypes::ADVANCED_TEXT || request()->get('content_type_id') == ContentTypes::NORMAL_TEXT) && $this->method() == 'POST') {
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
        if ((request()->get('content_type_id') == ContentTypes::ADVANCED_TEXT || request()->get('content_type_id') == ContentTypes::NORMAL_TEXT) && $this->method() == 'POST') {
            if (\App::getLocale() == "en") {
                $rules['path.ar'] = 'TEXT Arabic';
                $rules['path.en'] = 'TEXT English';
            } else {
                $rules['path.ar'] = 'نص عربي';
                $rules['path.en'] = 'نص الإنجليزية';
            }
        }

        if (request()->get('content_type_id') == ContentTypes::IMAGE && $this->method() == 'POST') {
            if (\App::getLocale() == "en") {
                $rules['path'] = 'Image';
            } else {
                $rules['path'] = 'صوره';
            }
        }
        if (request()->get('content_type_id') == ContentTypes::VIDEO && $this->method() == 'POST') {
            if (\App::getLocale() == "en") {
                $rules['path'] = 'Video';
            } else {
                $rules['path'] = 'فيديو';
            }
        }

        if (request()->get('content_type_id') == ContentTypes::AUDIO && $this->method() == 'POST') {
            if (\App::getLocale() == "en") {
                $rules['path'] = 'Audio';
            } else {
                $rules['path'] = 'صوتي';
            }
        }

        if (request()->get('content_type_id') == ContentTypes::YOUTUBVIDEO && $this->method() == 'POST') {
            if (\App::getLocale() == "en") {
                $rules['path'] = 'Link Youtub';
            } else {
                $rules['path'] = 'ربط يوتيوب';
            }
        }
        return $rules;
    }
}
