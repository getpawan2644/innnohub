<?php

namespace App\Http\Requests\Admin;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;

class ClientsRequest extends FormRequest
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
        $trans = [];
        $rules = [
            'client_category_id' => 'required',
            'logo' => 'required',
            'logo_thumbnail' => 'nullable',
            'client_img.*'=>'nullable',
            'latitude'=>'nullable',
            'longitude'=>'nullable',
            'video_url'=>'nullable',
            'video_id'=>'nullable',
            'country_code'=>'nullable',
            'dial_code'=>'nullable',
            'status'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'address'=>'required',
            'website' => 'nullable',
            'url_name'=>'required|alpha_dash|unique:vendors,url_name,'.$this->id,
            'country'=>'required',
            '%name%'=>'required',
            '%description%'=>'required',
        ];
        //dd( RuleFactory::make($rules));
        return RuleFactory::make($rules);
    }
    public function messages(){
        $messages = [];
        $other = [
            'client_category_id.required' => 'Select Category from dropdown list',
            'status.required' => 'Select Status from dropdown list',
            'address.required' => 'Client Address is required field.',
            'email.required' => 'This is a required field.',
            'email.email' => 'Please enter a valid email.',
            'url_name.required' => 'URL Name is a required field',
            'url_name.unique' => 'This URL name has already used.',
            'url_name.alpha_dash' => 'URL can contain dash(-), underscore(_), alphabets(A-Z, a-z) and numbers(0-9) only.',
            'phone.required' => 'This is a required field.',
            'country.required' => 'This is a required field.',
            'logo.required' => 'Client logo is an required field',
        ];
		foreach(CommonHelper::getLanguages() as  $language=>$locale){
			$messages = $messages + [
				$locale . '.name.required' => 'Client title is required field',
                $locale . '.description.required' => 'Client detail is required field',
			];
		}
        return $messages+$other;
    }
}
