<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MeetingRequest extends FormRequest
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
            'seller_message' => 'required',
            'title' => 'nullable', 
            'meeting_link' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
           
        ];
    }

    public function messages(){
        return [
            'seller_message.required'=>"please enter",
            'meeting_link.required'=>trans('validation.meeting_link_required')
        ];
    }
}
