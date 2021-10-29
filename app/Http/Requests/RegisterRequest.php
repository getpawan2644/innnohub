<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
    public function rules($confirmed=true)
    {
        //$user = !empty($user)?$user:Auth::user();
        $data = $this;
        //dd($data->toArray());
		$id = !empty($this->user)?$this->user:null;
        $user= [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'country_code'=>'nullable',
            'dial_code' => 'nullable',
            'mobile' => 'required|unique:users,mobile',
            'password' => 'required|string|min:8|confirmed',
            'company_size'=>'nullable',
            'country_id' => 'nullable',
            'job_title' => 'nullable',
            'company_name' => 'nullable',
            'industry' => 'nullable',
            'password_confirmation'=>'sometimes|required_with:password',
            'status'=>'nullable',
            'category_id'=>'nullable',
            'subcategory_id'=>'nullable',
        ];
        return $user;
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'job_title.required'  =>  "Please enter job title.",
            'industry.required'  =>  "Please enter industry.",
            'company_size.required'  =>  "Please select company size.",
            'company_name.required'  =>  "Please enter company name.",
            'first_name.required'  =>  trans("validation.first_name_required"),
            'last_name.required'  =>  trans("validation.last_name_required"),
            'email.required' =>  trans("validation.email_required"),
            'email.unique' =>  trans("validation.email_unique"),
			'mobile.required' =>  trans("validation.mobile_required"),
            'mobile.unique' =>  trans("validation.mobile_unique"),
            'password.required' =>  trans("validation.password_required"),
            'password.confirmed' =>  trans("validation.password_confirmed"),
            'password.min'  =>  trans("validation.password_min"),
            'country_id.required'  =>  trans("validation.country_id_required"),

        ];
    }
}
