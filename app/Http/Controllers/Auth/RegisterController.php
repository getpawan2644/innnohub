<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailTemplate;
use App\Mail\UserRegister;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

  	/**
     * Show the Register Form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
	public function registerType(Request $request){

        return view('auth.register');

    }

  	/**
     * Show the Register Form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
	public function register(Request $request){
        $record = new User();
        $user_type = $request['usertype'];
        if($user_type=="buyer"){
            return view('auth.register_buyer',compact('record','user_type'));
        } elseif($user_type=="vendor") {
            return view('auth.register_vendor',compact('record','user_type'));
        } else {
            return view('auth.register');
        }

	}



    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * User Request to store step2 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function postRegister(RegisterRequest $RegisterRequest, User $user){

      //  $RegisterRequest['subcategory_id'] = implode(',',$RegisterRequest['subcategory_id']);

        $user->fill($RegisterRequest->validated());
        if(!empty($RegisterRequest['subcategory_id'])) {
            $user->subcategory_id= implode(',',$RegisterRequest['subcategory_id']);
            $user->country_id = 1;
        }

		try{
            DB::beginTransaction();
            $user->password = Hash::make($user->password);
			$user->save();
			DB::commit();
            //Mail::to($user->email)->send(new UserRegister());
            $this->sendEmailAlertUser('welcome-email',$user);
           // $this->sendEmailAlertUser('welcome-email','ar',$user);
            $this->guard()->login($user);
            return redirect($this->redirectPath())->with(['title'=>__('messages.success'),'success'=>__('messages.register_success')]);
		} catch(\Exception $e){
            echo $e->getMessage(); die;
			DB::rollBack();
			return back()->with(['title'=>__('messages.error'),'error'=>__('messages.check_your_input')]);
		}
    }

    public function sendEmailAlertUser($pageName,$user){
        $allEmailTemp = EmailTemplate::allEmailTemplate($pageName);
        $getSubject = $allEmailTemp->title;
        $getContent = $allEmailTemp->content;
        $separator="<br/>---------------------------------------------------------------------------------------------<br/>";
        $subject = str_replace(["{user}"], [$user->first_name.' '.$user->last_name], $getSubject);
        // $message = $getContent.$separator.$ar_getContent;
        $message = $getContent.$separator;
        Mail::to($user->email)->send(new UserRegister($subject,$message));
    }

    protected function redirectTo()
    {
        return '/';
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $request->session()->flash('title', trans('messages.success',['username' => $user->username]));
        $request->session()->flash('success', trans('messages.register_success'));
    }

}
