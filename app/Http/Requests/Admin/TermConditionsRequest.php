<?php

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;
use Astrotomic\Translatable\Validation\RuleFactory;

class TermConditionsRequest extends FormRequest
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
            '%title%' => "required|string",
            '%description%' => "required|string"
        ];
        return RuleFactory::make($rules);
    }
    public function messages()
    {
        $messages = [];
        $locale= config('translatable.locales');
        foreach($locale as  $language=>$locale){
            $messages = $messages + [
                    $locale .'.title.required' => 'This field is required.',
                    $locale .'.description.required' => 'This field is required.',
                    $locale .'.title.unique' => 'This title has already exist.',
                ];
        }
        return $messages;
    }
}
