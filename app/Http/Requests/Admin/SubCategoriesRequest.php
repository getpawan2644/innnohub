<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Support\Facades\Validator;

class SubCategoriesRequest extends FormRequest
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
        Validator::extend('unique_category', function($attribute,$value,$parameters)
        {
            // pr($attribute);
            // pr($value);
        //    pr($parameters);
            $result = \App\Models\SubCategory::where('name',$value)->first();

            // dd($result);die;
            return !$result;
        });
        $rules = [
            'category_id' => "required",
            'name' => "required|string|unique_category:sub_category,name,{$this->id},{$this->category_id}"
        ];
        // return RuleFactory::make($rules);
        return $rules;
    }

    public function messages()
    {
        $messages = [
            'code.required' => 'Please enter the sub-category code.',
            'code.max' => 'Code should be two digit long.',
            'code.unique' => 'This combination of category and subcategory code has already exist.',
            'code.min' => 'Code should be two digit long.',
            'category_id.required'=> "This Field is required.",
            'name.required' => 'This Field is required.',
            'name.unique_category' => 'This name has already been used.',
        ];

        return $messages;
    }

}
