<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoryRequest extends Request
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
            'title'     => 'required|array',
            'title.*'   => 'required|string',
            'image'     => 'mimes:png,jpg,jpeg',
            'parent_id' => 'nullable|exists:categories,id',
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
                'title.ar' => 'Title Arabic',
                'title.en' => 'Title English',
            ];
        } else {
            return [
                'title.ar' => 'عنوان بالعربي',
                'title.en' => 'العنوان الإنجليزية',
            ];
        }
    }
}
