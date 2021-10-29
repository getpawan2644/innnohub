<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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
            'name' => 'required',
            'user_id' => 'required',
            'comment' => 'required',
            
            
            
        ];
        return $user;
    }

    public function messages()
    {
        return [
            'name.required'  =>  "Please enter name.",
            'user_id.required'  =>  "Please select the user.",
            'description.required'  =>  "Please select the description.",
           

        ];
    }
}
