<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserProfileStepTwoRequest extends FormRequest
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
          
             'headquarter' => 'required',
             'founded_date' => 'required',
             'founders' => 'required',
             //'opreating_status' => 'required',
             //'lang' => 'required',
             'legal_name' => 'required',
             'hub' => 'required',
             'stock_symbol' => 'required',
             'company_type' => 'required',
             'contact_email' => 'required',
        ];
    }
   /* public function messages()
    {
        return [
            'headquarter.required'  =>  trans("validation.first_name_required"),
            'founded_date.required'  =>  trans("validation.last_name_required"),
            'founders.required' =>  trans("validation.mobile_required"),
            'opreating_status.unique' =>  trans("validation.mobile_unique"),
            'lang.required'  =>  trans("validation.country_id_required"),
            'legal_name.required'  =>  trans("validation.country_id_required"),
            'hub.required'  =>  trans("validation.country_id_required"),
            'stock_symbol.required'  =>  trans("validation.country_id_required"),
            'company_type.required'  =>  trans("validation.country_id_required"),
            'contact_email.required'  =>  trans("validation.country_id_required"),
        ];
    }*/
}
