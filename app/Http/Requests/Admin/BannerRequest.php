<?php

namespace App\Http\Requests\Admin;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;


class BannerRequest extends FormRequest
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
            'banner_position' => "required|string",
            'have_button' => "nullable|string",
            'button_url' => "nullable|string|url",
            '%image%' => "mimes:jpeg,jpg,png,gif|required",
            '%button_label%' => "nullable|string",
            '%title%' => "nullable|string",
            '%heading%' => "nullable|string",
            '%description%' => "nullable|string",
            '%banner_link%' => "nullable|string|url",
        ];
        if($this->have_button && $this->banner_position==\App\Models\Banner::TOP_BANNER){
            $rules['button_url']="required|string|url";
            $rules['%button_label%']="required|string";
        }
//        dd($this->banner_position);
        if(!empty($this->id)){
            $rules['%image%']="nullable|mimes:jpeg,jpg,png,gif";
        }
//        dd($this->banner_position);
//        if($this->banner_position==\App\Models\Banner::TOP_BANNER){
//            $rules['%title%'] = "nullable|string";
//            $rules['%heading%'] =  "nullable|string";
//            $rules['%description%'] =  "nullable|string";
//        }
        return RuleFactory::make($rules);
    }
    public function messages()
    {
        $messages = [];
        $locale= config('translatable.locales');
        foreach($locale as  $language=>$locale){
            $messages = $messages + [
                    $locale .'.button_label.required' => 'This Field is required.',
                    $locale .'.image.mimes' => 'Please select a valid image.',
                    $locale .'.image.required' => 'This Field is required.',
                    $locale .'.banner_link.required' => 'This Field is required.',
                    $locale .'.banner_link.url' => 'Please enter a valid URL.',
                ];
        }
        $messages["button_url.required"]="This Field is required.";
        $messages["banner_position.required"]="This Field is required.";
        $messages["button_url"]="Please enter a valid URL.";
        return $messages;
    }
}
