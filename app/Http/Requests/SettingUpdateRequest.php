<?php

namespace App\Http\Requests;

use App\Constants\SettingTypes;
use App\Http\Repository\SettingRepository;
use App\Http\Requests\Request;

class SettingUpdateRequest extends Request
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
        $rules['key'] = 'required|unique:settings,key,'.$this->segment(2);

        $rules['type_id'] = 'required';

        if(request()->get('type_id') == SettingTypes::ADVANCED_TEXT) {
            $rules['value'] = 'required';
        }
        if(request()->get('type_id') == SettingTypes::NORMAL_TEXT) {
            $rules['value'] = 'required';
        }
        if(request()->get('type_id') == SettingTypes::IMAGE) {
            $rules['value'] = 'mimes:png,jpeg,jpg';
        }
        if(request()->get('type_id') == SettingTypes::VIDEO) {
            $rules['video'] = 'mimes:mp4,flv,3gp,m4v';
        }
        if(request()->get('type_id') == SettingTypes::AUDIO) {
            $rules['value'] = 'mimes:mp3,webm,wav';
        }
        if(request()->get('type_id') == SettingTypes::SELECTOR) {
            $rules['value'] = 'required';
        }
        if(request()->get('type_id') == SettingTypes::EXSTENTION) {
            $rules['value'] = 'required';
        }

      return $rules;
    }
}
