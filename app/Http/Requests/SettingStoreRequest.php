<?php

namespace App\Http\Requests;

use App\Constants\SettingTypes;
use App\Http\Repository\SettingRepository;
use App\Http\Requests\Request;

class SettingStoreRequest extends Request
{
    /**
     * settingRepository
     *
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * __construct
     * inject needed data in constructor
     * @param  SettingRepository $settingRepository
     * @return void
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository    = $settingRepository;
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
        $rules['key'] = 'required|unique:settings';

        $rules['type_id'] = 'required';

        if (request()->get('type_id') == SettingTypes::ADVANCED_TEXT) {
            $rules['advanced_text'] = 'required';
        }
        if (request()->get('type_id') == SettingTypes::NORMAL_TEXT) {
            $rules['normal_text'] = 'required';
        }
        if (request()->get('type_id') == SettingTypes::IMAGE) {
            $rules['image'] = 'required|mimes:png,jpeg,jpg';
        }
        if (request()->get('type_id') == SettingTypes::VIDEO) {
            $rules['video'] = 'required|mimes:mp4,flv,3gp,m4v';
        }
        if (request()->get('type_id') == SettingTypes::AUDIO) {
            $rules['audio'] = 'required|mimes:mp3,webm,wav';
        }
        if (request()->get('type_id') == SettingTypes::SELECTOR) {
            $rules['selector'] = 'required';
        }
        if (request()->get('type_id') == SettingTypes::EXSTENTION) {
            $rules['extensions'] = 'required';
        }

        return $rules;
    }

    /**
     * Method attributes
     *
     * @return array
     */
    public function attributes()
    {
        if (\App::getLocale() == "en") {
            $rules = [
                'key' => 'key'
            ];
        } else {
            $rules = [
                'key' => 'نص'
            ];
        }
        // dd(request()->all());
        if ((request()->get('type_id') == SettingTypes::ADVANCED_TEXT || request()->get('type_id') == SettingTypes::NORMAL_TEXT) && $this->method() == 'POST') {
            if (\App::getLocale() == "en") {
                $rules['advanced_text'] = 'TEXT Arabic';
                $rules['normal_text'] = 'TEXT Arabic';
            } else {
                $rules['advanced_text'] = 'نص عربي';
                $rules['normal_text'] = 'نص عربي';
            }
        }

        if (request()->get('type_id') == SettingTypes::IMAGE && $this->method() == 'POST') {
            if (\App::getLocale() == "en") {
                $rules['image'] = 'Image';
            } else {
                $rules['image'] = 'صوره';
            }
        }
        if (request()->get('type_id') == SettingTypes::VIDEO && $this->method() == 'POST') {
            if (\App::getLocale() == "en") {
                $rules['video'] = 'Video';
            } else {
                $rules['video'] = 'فيديو';
            }
        }

        if (request()->get('type_id') == SettingTypes::AUDIO && $this->method() == 'POST') {
            if (\App::getLocale() == "en") {
                $rules['audio'] = 'Audio';
            } else {
                $rules['audio'] = 'صوتي';
            }
        }

        if (request()->get('type_id') == SettingTypes::SELECTOR && $this->method() == 'POST') {
            if (\App::getLocale() == "en") {
                $rules['selector'] = 'selector';
            } else {
                $rules['selector'] = 'اختيار';
            }
        }
        return $rules;
    }
}
