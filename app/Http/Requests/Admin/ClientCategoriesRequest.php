<?php

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;
use Astrotomic\Translatable\Validation\RuleFactory;
class ClientCategoriesRequest extends FormRequest
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
//        dd($this->category_order);
        $rules = [
            'category_order'=>"required|numeric|unique:client_categories,category_order,{$this->id},id",
            '%name%' => "required|string|unique:client_category_translations,name,{$this->id},client_category_id"
        ];
        return RuleFactory::make($rules);
    }
    public function messages()
    {
        $messages = [
            'category_order.unique' => 'This order number is already exist.',
            'category_order.required' => 'This field is required.',
            'category_order.number' => 'Please enter a numeric value',

        ];
        $locale= config('translatable.locales');
        foreach($locale as  $language=>$locale){
            $messages = $messages + [
                    $locale .'.name.required' => 'This Field is required.',
                    $locale .'.name.unique' => 'This name has already been used.',
                ];
        }
        return $messages;
    }
}
