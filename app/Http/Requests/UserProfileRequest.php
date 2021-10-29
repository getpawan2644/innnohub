<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserProfileRequest extends FormRequest
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
            'country_id' => 'required',
            'image' => 'required',
            'fundind_type' => 'required',
             'number_of_acquisitions' => 'required',
             'number_of_investments' => 'required',
             'number_of_exits' => 'required',
             'funding_amount' => 'required',
             'number_of_team_members' => 'required',
             'number_of_investors' => 'required',
             'link' => 'required',
             'address' => 'required',
             'sub_category' => 'required',
              'description' => 'required',
             /*'headquarter' => 'required',
             'founded_date' => 'required',
             'founders' => 'required',
             'opreating_status' => 'required',
             'lang' => 'required',
             'legal_name' => 'required',
             'hub' => 'required',
             'stock_symbol' => 'required',
             'company_type' => 'required',
             'contact_email' => 'required',*/
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
