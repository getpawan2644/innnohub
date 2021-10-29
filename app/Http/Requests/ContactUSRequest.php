<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUSRequest extends FormRequest
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
        //dd('hello');
        return [
            'name'=>'required|string',
            'email'=>'required|email',
//            'country_id'=>'required|integer',
            'country_code'=>'nullable',
            'dial_code'=>'nullable',
            'mobile'=>'required',
            'message'=>'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => trans('validation.name_required'),
            'email.required' => trans('validation.email_required'),
            'mobile.required' => trans('validation.mobile_required'),
            'message.required' => trans('validation.message_required'),
            'country_id.required'=>trans('validation.country_id_required'),
        ];
    }
}
