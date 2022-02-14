<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LanguageRequest extends Request
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
            "title" => "required|unique:languages,title," . $this->id,
            "short_code" => "required|unique:languages,short_code," . $this->id,
            "rtl" => "required|in:0,1"
        ];
    }


     /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        if (\App::getLocale() == "en") {
            return [
                'short_code' => 'Short Code',
            ];
        }else{
            return [
                'short_code' => 'رمز قصير',
            ];
        }
    }


}
