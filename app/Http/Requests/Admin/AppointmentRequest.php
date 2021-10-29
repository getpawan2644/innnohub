<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AppointmentRequest extends FormRequest
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
        $data=$this;
        //dd($this->appointment);
        return [
            'date'=>['required',Rule::unique('appointments')->ignore($this->appointment)],
            'from_time.*'=>'nullable|distinct',
            'to_time.*'=>'nullable|distinct',
        ];
    }
    public function messages(){
        return [
            'date.required'=>'Please select date from dropdown list',
            'date.unique'=>'You already added this date for appointment',
            'from_time.*.distinct' => 'From time should be unique',
            'to_time.*.distinct' => 'To time should be unique', 
        ];
    }
}
