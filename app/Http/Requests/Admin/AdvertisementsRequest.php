<?php

namespace App\Http\Requests\Admin;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;


class AdvertisementsRequest extends FormRequest
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
            'url' => "nullable|string|url",
            'image' => "required",
            'image_thumbnail' => "required",
            '%title%' => "required|string",
        ];
        return RuleFactory::make($rules);
    }
    public function messages()
    {
        $messages = [];
        $locale= config('translatable.locales');
        foreach($locale as  $language=>$locale){
            $messages = $messages + [
                    $locale .'.title.required' => 'This Field is required.',
                ];
        }
//        $messages["url.required"]="This Field is required.";
        $messages["url"]="Please enter a valid URL.";
        return $messages;
    }
}
