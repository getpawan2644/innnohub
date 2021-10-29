<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicesRequest extends FormRequest
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
    public function rules($confirmed=true)
    {
        // $data = $this;
        //dd($data->toArray());
        $user= [
            'service_name' => 'required',
            'user_id' => 'required',
            'description' => 'required|max:500',
            'logo' => 'required',
            'category_id' => 'nullable',
            'images' => 'nullable',
            'tag' => 'nullable',
            
        ];
        return $user;
    }

    public function messages()
    {
        return [
            'service_name.required'  =>  "Please enter service name.",
            'description.required'  =>  "Please enter description.",
            'description.max'  =>  "Description may not be greater than 500",
            'user_id.required'  =>  "Please select the user.",
            'images.required'  =>  "Please select the images.",
            'tag.required'  =>  "Please enter the tag.",
            'logo.required'  =>  "Please select the logo.",

        ];
    }
}
