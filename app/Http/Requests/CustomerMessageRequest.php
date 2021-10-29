<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerMessageRequest extends FormRequest
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
        return [
            'message' => 'required',
            'subject' => 'required', 
            'customer_id' => 'nullable',
            'parent_id' => 'nullable',
            'sender_id' => 'nullable',
            'status' => 'nullable',
            'customer_status' => 'nullable',
            'admin_status' => 'nullable',
        ];
    }

    public function messages(){
        return [
            'message.required'=>trans('validation.message_required'),
            'subject.required'=>trans('validation.subject_required')
        ];
    }
}
