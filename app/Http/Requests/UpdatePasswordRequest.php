<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            "current-password" => [
                "required",
                function ($attribute, $value, $fail) {
                    if (!\Hash::check($value, auth()->user()->password)) {
                        $fail("Error in your old password");
                    }
                }
            ],
            'password' => ['required', 'min:6', 'confirmed'],
        ];
    }
}
