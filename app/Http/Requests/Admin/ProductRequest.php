<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;

class ProductRequest extends FormRequest
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
        $other = [
            'category_slug' => 'required',
            'subcategory_id' => 'required',
            "sub_category_code"=>'required',
            "country_code"=>'required',
            "category_code"=>'required',
            "code"=>'required',
            "code_display"=>'nullable',
            "vendor_code"=>'required',
            "vendor_id"=>'required',
            'product_img'=>'required',
            'youtube_url'=>'nullable',
            'price' => 'nullable',
            'discount_percent' => 'nullable|numeric|between:1,99',
            'final_discount_price' => 'nullable',
            'status'=>'required',
            'client_id'=>'nullable',
            'video_id'=>'nullable',
        ];
		foreach(CommonHelper::getLanguages() as  $language=>$locale){
			$trans = $trans + [
				$locale . '.product_title' => 'required',
                $locale . '.product_details' => 'required',
                $locale . '.product_description' => 'required'
			];
		}
		return $trans+$other;
    }
    public function messages(){
        $messages = [];
        $other = [
            'category_slug.required' => 'Select Category from dropdown list',
            'sub_category_code.required' => 'Select Sub-Category from dropdown list',
            'vendor_id.required' => 'Select Vendor from dropdown list',
            'code.required' => 'Please select all the necessary fields to generate product code.',
            'subcategory_id.required' => 'Sub-Category is a required field.',
            'status.required' => 'Select Status from dropdown list',
            'price.required' => 'Product Price is required field',
            'discount_percent.numeric' => 'Please enter a valid discount percentage.',
            'product_img.required' => 'Please upload a product image.',
            'discount_percent.between' => 'Please enter discount between 1 to 99%.',
        ];
		foreach(CommonHelper::getLanguages() as  $language=>$locale){
			$messages = $messages + [
				$locale . '.product_title.required' => 'Product title is required field',
                $locale . '.product_details.required' => 'Product detail is required field',
                $locale . '.product_description.required' => 'Product description is required field',
			];
		}
        return $messages+$other;
    }
}
