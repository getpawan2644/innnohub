<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'user_id' => 'nullable',
            'name' => 'required',
            'dial_code' => 'nullable',
            'country_code' => 'nullable',
            'phone_number' => 'required',
            'email' => 'required',
            'message' => 'required',
        ];
    }
    public function messages(){
        return [
            'name.required' => trans('validation.name_required'),
            'phone_number.required' => trans('validation.mobile_required'),
            'email.required' => trans('validation.email_required'),
            'message.required' => trans('validation.message_required'),
        ];
    }
}
