<?php

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;
use Astrotomic\Translatable\Validation\RuleFactory;

class FaqsRequest extends FormRequest
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
            '%question%' => "required|string|unique:faq_translations,question,{$this->id},faq_id",
            '%answer%' => "required|string"
        ];
        return RuleFactory::make($rules);
    }
    public function messages()
    {
        $messages = [];
        $locale= config('translatable.locales');
        foreach($locale as  $language=>$locale){
            $messages = $messages + [
                    $locale .'.question.required' => 'This field is required.',
                    $locale .'.answer.required' => 'This field is required.',
                    $locale .'.question.unique' => 'This question has already exist.',
                ];
        }
        return $messages;
    }
}
