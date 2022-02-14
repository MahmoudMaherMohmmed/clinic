<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LanguageUpdateRequest extends Request
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
            "title" => "required|unique:languages,title,".$this->segment(2),
            "short_code" => "required|unique:languages,short_code,".$this->segment(2),
            "rtl" => "required"
       ];
    }
}
