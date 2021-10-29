<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;

class EmailTemplateRequest extends FormRequest
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
        $rules = [
            'status' => 'nullable',
            'page_name' => 'required|alpha_dash|unique:email_templates,page_name,'.$this->id,
            'title' => 'required',
            'content' => 'required',
        ];
        return $rules;
    }


	public function messages()
    {
		$messages = [];
        $messages1 = ['page_name.alpha_dash' => 'Only underscore and dash allow in this field.'];
        $messages1 = ['title.required' => 'Url is a required field'];
        $messages1 = ['content.required' => 'This is a required field'];

        return $messages+$messages1;
    }
}
