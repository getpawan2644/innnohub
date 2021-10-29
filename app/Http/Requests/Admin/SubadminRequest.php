<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;

class SubadminRequest extends FormRequest
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
        if($this->id){
             $admin = [
                'name' => 'required|string|max:120',
                'email' => 'required|email|max:191|unique:admins,email,'.$this->id.',id',
                'password' => 'nullable|confirmed',
                'password_confirmation'=> 'nullable|same:password',
                'phone' => 'required|unique:admins,phone,'.$this->id.',id',
                'modules' =>'required'
            ];
        } else {
             $admin = [
                'name' => 'required|string|max:120',
                'email' => 'required|email|max:191|unique:admins,email,'.$this->id.',id',
                'password' => 'required|confirmed',
                'password_confirmation'=> 'required|same:password',
                'phone' => 'required|unique:admins,phone,'.$this->id.',id',
                'modules' =>'required'

            ];
        }
        return $admin;

    }
    public function messages(){
        return [
            'name.required'=>'This is a required field.',
            'email.required'=>'This is a required field.',
            'email.email'=>'Please enter a valid email.',
            'password.required'=>'This is a required field.',
            'phone.required'=>'This is a required field.',
            'modules.required'=>'Please choose atleast one module.',
            'password_confirmation.required'=>'This is a required field.',
            'phone.unique'=>'You already added this phone number.',
            'email.unique'=>'You already added this email.',
        ];
    }
}
