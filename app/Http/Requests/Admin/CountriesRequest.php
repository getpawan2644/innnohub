<?php

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;


class CountriesRequest extends FormRequest
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
        // dd($this->id);
        $rules = [
            'code' => 'required',
            'dial_code' => 'required',
            'currency_name' => 'required',
            'currency_symbol' => 'required',
            'currency_code' => 'required',
            'status' => 'required',
            'name' => "required|string|unique:countries,name,{$this->id},id"
        ];
        // return RuleFactory::make($rules);
        return $rules;

    }
    public function messages()
    {
        $messages = [];
        $messages['name.required'] = 'Country name is a required field';
        $messages['name.unique'] = 'This name has already been taken';
        $messages["code.required"]="This Field is required.";
        $messages["dial_code.required"]="This Field is required.";
        $messages["currency_name.required"]="This Field is required.";
        $messages["currency_symbol.required"]="This Field is required.";
        $messages["currency_code.required"]="This Field is required.";
        $messages["status.required"]="This Field is required.";
        return $messages;
    }
}
