<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeatureRequest extends FormRequest
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
            'title' => 'required',
            'user_id' => 'required',
            'description' => 'required|max:500',
            
            
        ];
        return $user;
    }

    public function messages()
    {
        return [
            'name.required'  =>  "Please enter name.",
            'description.required'  =>  "Please enter description.",
            'description.max'  =>  "Description may not be greater than 500",
            'user_id.required'  =>  "Please select the user.",
            
        ];
    }
}
