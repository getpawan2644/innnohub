<?php

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;
use Astrotomic\Translatable\Validation\RuleFactory;
class ContactDetailsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'fax' => "required",
            'phone_number' => "required",
            'email' => "required",
            'address' => "required",
            'longitude' => "nullable",
            'latitude' => "nullable",
        ];
        return $rules;
    }
//    public function messages()
//    {
//        $messages = [];
//        $locale= config('translatable.locales');
//        foreach($locale as  $language=>$locale){
//            $messages = $messages + [
//                    $locale .'.name.required' => 'This Field is required.',
//                    $locale .'.name.unique' => 'This name has already been used.',
//                ];
//        }
//        return $messages;
//    }
}
