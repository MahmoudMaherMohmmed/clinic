<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\App;

class StaticTranslationRequest extends Request
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
        return [
            "key_word" => "required|unique:static_translations,key_word," . $this->id,
            'translations' => 'required|array',
            'translations.*' => 'required|string',
        ];
    }


     /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        if (App::getLocale() == "en") {
            return [
                'key_word' => 'Key',
                'translations.1' => 'Title Arabic',
                'translations.2' => 'Title English',
            ];
        }else{
            return [
                'key_word' => 'النص',
                'translations.1' => 'عنوان بالعربي',
                'translations.2' => 'العنوان الإنجليزية',
            ];
        }
    }

}
