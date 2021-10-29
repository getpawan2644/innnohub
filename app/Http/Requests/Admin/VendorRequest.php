<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
//        dd($this->id);
        return [
                'country_id' => 'required',
                'name' => 'required',
                'logo' => 'required',
                'logo_thumbnail' => 'required',
                'country_code'=>'nullable',
                'dial_code'=>'nullable',
                'email'=>'nullable|email',
                'url_name'=>'required|alpha_dash|unique:vendors,url_name,'.$this->id,
                'phone'=>'nullable',
                'website' => 'nullable',
                'code' => "required|max:3|min:3|string|unique:vendors,code,{$this->id},id,country_id,{$this->country_id}",
                'comment' => 'nullable',
                'status' => 'nullable',
        ];

}
    public function messages(){
        return [
            'country_id.required' => 'Select Country from dropdown list',
            'email.required' => 'This is a required field.',
            'email.email' => 'Please enter a valid email.',
            'logo_thumbnail.required' => 'This is a required field.',
            'name.required' => 'This is a required field.',
            'logo.required' => 'Vendor logo is a required field',
            'code.required' => 'Vendor Code is a required field',
            'url_name.required' => 'URL Name is a required field',
            'url_name.unique' => 'This URL name has already used.',
            'url_name.alpha_dash' => 'URL can contain dash(-), underscore(_), alphabets(A-Z, a-z) and numbers(0-9) only.',
            'code.max' => 'Vendor Code should be 3 digit.',
            'code.min' => 'Vendor Code should be 3 digit.',
            'code.unique' => 'This code has already been used.',
        ];
    }
}

