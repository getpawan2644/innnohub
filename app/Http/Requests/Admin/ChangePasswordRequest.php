<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Hash;
use Auth;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => 'required',
            'password'=> ['required','string','min:6','different:current_password','confirmed'],
            'password_confirmation'=> ['required','same:password'],
        ];
    }
    public function messages()
     {
         $messages = [
             'password.required' => 'This field is required.',
             'current_password.required' => 'This field is required.',
             'password_confirmation.required' => 'This field is required.',
             'password.confirmed' => 'Conform password did not matched.',
            //  'current_password.min' => 'This field min length 6 required.',
             'password.min' => 'This field min length 6 required.',
             'password.string' => 'This field is required including string.',

        ];

         return $messages;
     }
	/**
	 * Configure the validator instance.
	 *
	 * @param  \Illuminate\Validation\Validator  $validator
	 * @return void
	 */
	public function withValidator($validator)
	{
		// checks user current password
		// before making changes
		$validator->after(function ($validator) {
			if ( !Hash::check($this->current_password,  Auth::guard('admin')->user()->password) ) {
				$validator->errors()->add('current_password', 'Your current password is incorrect.');
			}
		});
		return;
     }

}
