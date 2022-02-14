<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OperatorRequest extends Request
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
        'name'          => 'required|string|unique:operators,name,' . $this->id,
        'country_id'    => 'required|exists:countries,id',
        'image'         => 'nullable|mimes:jbg,png,jpeg' ,
        'rbt_ussd_code' => 'nullable|numeric ' ,
        'rbt_sms_code'  => 'nullable|numeric'
       ];
    }
}
