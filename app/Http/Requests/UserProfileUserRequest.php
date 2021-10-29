<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserProfileUserRequest extends FormRequest
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
        $user_id=Auth::user()->id;
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'country_code'=>'nullable',
            'mobile' => "required|unique:users,id,{$user_id},mobile",
           
        ];
    }
    public function messages()
    {
        return [
            'first_name.required'  =>  trans("validation.first_name_required"),
            'last_name.required'  =>  trans("validation.last_name_required"),
            'mobile.required' =>  trans("validation.mobile_required"),
            'mobile.unique' =>  trans("validation.mobile_unique"),
            'country_id.required'  =>  trans("validation.country_id_required"),
        ];
    }
}
