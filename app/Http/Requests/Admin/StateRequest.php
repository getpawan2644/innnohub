<?php

namespace App\Http\Requests\Admin;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;

class StateRequest extends FormRequest
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
        $rules = [
            'country_id' => 'required',
            '%name%' => "required|string|unique:state_translations,name,{$this->id},state_id"
        ];

        return RuleFactory::make($rules);
    }

	public function messages()
    {
        $messages = [
			'country_id.required' => "Please select country",
		];
        foreach(CommonHelper::getLanguages() as  $language=>$locale){
            $messages = $messages + [
                $locale . '.name.required' => 'State is a required field',
                $locale . '.name.unique' => 'This name has already been taken',
            ];
        }

        return $messages;
    }
}
