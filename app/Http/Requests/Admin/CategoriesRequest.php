<?php

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;
class CategoriesRequest extends FormRequest
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
            'category_icon'=>"required",
            'category_icon_url'=>"nullable",
            'category_icon_thumbnail'=>"nullable",
            'category_icon_thumbnail_url'=>"nullable",
            'category_order'=>"required|numeric|unique:categories,category_order,{$this->id},id",
            'name' => "required|string|unique:categories,name,{$this->id},id"
        ];
        return $rules;
    }
    public function messages()
    {
        $messages = [
            'category_order.unique' => 'This order number is already exist.',
            'category_order.required' => 'This field is required.',
            'category_order.number' => 'Please enter a numeric value.',
            'name.required' => 'This Field is required.',
            'name.unique' => 'This name has already been used.',
            'category_icon.required' => 'This Field is required.',
       ];

        return $messages;
    }
}
