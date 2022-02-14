<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostStoreRequest extends Request
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
            'published_date' => 'required|date|after_or_equal:today',
            'content_id' => 'required',
            'active' => 'required',
            'operator_id'=> 'required'
       ];
    }
}
