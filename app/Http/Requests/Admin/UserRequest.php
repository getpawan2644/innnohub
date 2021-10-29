<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;
use Astrotomic\Translatable\Validation\RuleFactory;

class UserRequest extends FormRequest
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
        //dd($this->user);
//        $rules= [
//            'email' => "required|unique:users,email,{$this->email},id",
//            'mobile' => "required|unique:users,mobile,{$this->mobile},id",
//            'name' => ['nullable' , 'max:100'],
//            'address' => 'nullable',
//            'postal_code' => 'nullable',
//            'country_id' => 'required|int',
//            'state_id' => 'required|int',
//        ];
        if($this->id){
            $rules = [
                'first_name' => "required|string",
                'last_name' => "required|string",
                'email' => "required|email|unique:users,id,{$this->id},email",
                'mobile' => "required|unique:users,id,{$this->id},mobile",
                'country_id'=>"required",
                "dial_code"=>"nullable",
                "country_code"=>"nullable",
                "password"=>"nullable|min:8",
                'company_size'=>'required',
                'country_id' => 'required',
                'job_title' => 'required',
                'company_name' => 'required',
                'industry' => 'required',
            ];
        }else{
            $rules = [
                'first_name' => "required|string",
                'last_name' => "required|string",
                'email' => "required|email|unique:users,id,{$this->id},email",
                'mobile' => "required|unique:users,id,{$this->id},mobile",
                'country_id'=>"required",
                "dial_code"=>"nullable",
                "country_code"=>"nullable",
                "password"=>"nullable|min:8",
                'company_size'=>'required',
                'country_id' => 'required',
                'job_title' => 'required',
                'company_name' => 'required',
                'industry' => 'required',
            ];

        }

        // return RuleFactory::make($rules);
        return $rules;
    }
     public function messages()
    {
        return [
            'password.required' => 'This is a required field.',
            'password.min' => 'Password length should not less than 8 character.',
            'first_name.required' => 'This is a required field.',
            'last_name.required' => 'This is a required field.',
            'email.required' => 'This is a required field.',
            'email' => 'Please enter the valid email',
            'email.unique'=>"This email is already used.",
            'country_id.required' =>  'This is a required field.',
            'mobile.required' =>  'This is a required field.',
            'mobile.unique' =>  "This phone number already used",
            'validation.required' =>  "This is a required field.",
            'job_title.required'  =>  "Please enter job title.",
            'industry.required'  =>  "Please enter industry.",
            'company_size.required'  =>  "Please select company size.",
            'company_name.required'  =>  "Please enter company name.",
        ];
    }
}
