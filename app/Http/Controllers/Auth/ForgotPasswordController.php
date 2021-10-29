<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword;
use App\Http\Requests\UserResetPassword;
use App\Model\User;
use Hash;
use Carbon\Carbon;
use Auth;
use DB;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showForm(){
      return view('auth.passwords.email');
    }
    public function sendResetLinkEmail(Request $request)
    {

        $this->validate($request, ['email' => 'required|email']);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        if ($response === Password::RESET_LINK_SENT) {
            return response()->json(['status'=>1 , 'success' => __("messages.reset_password")]);
        }elseif($response === Password::INVALID_USER){
            return response()->json(['status'=>0 , 'error' => __("messages.email_not_registered")]);
        }

        // If an error was returned by the password broker, we will get this message
        // translated so we can notify a user of the problem. We'll redirect back
        // to where the users came from so they can attempt this process again.
        return response()->json(['status'=>0 , 'error' => $response]);
    }
    public function sendPasswordResetToken(Request $request)
    {

        $user = User::where ('email', $request->email)->first();
        //dd($user);
        if ( !$user ) return redirect()->back()->with(['title'=>'Incorrect Email','error'=>__('Please check your email and try again')]);

        //create a new token to be sent to the user.
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => str_random(60), //change 60 to any length you want
            'created_at' => Carbon::now()]
        );

        $tokenData = DB::table('password_resets')
        ->where('email', $request->email)->first();

        $token = $tokenData->token;
        $email = $request->email; // or $email = $tokenData->email;
        $url = route('user.reset-password', ['token'=>$token]);
        Mail::to($user->email)->send(new ForgotPassword($url));
        return redirect(route('user.login'))->with(['title'=>'Reset Mail','success'=>__('messages.reset_email_sent')]);
      /**
        * Send email to the email above with a link to your password reset
        * something like url('password-reset/' . $token)
        * Sending email varies according to your Laravel version. Very easy to implement
        */
    }

    /**
     * Assuming the URL looks like this
     * http://localhost/password-reset/random-string-here
     * You check if the user and the token exist and display a page
    */
    public function showPasswordResetForm($token)
    {
        $tokenData = DB::table('password_resets')
        ->where('token', $token)->first();

        if ( !$tokenData ) return redirect()->to(route('home'))->with(['title'=>'Token Invalid','error'=>'Token invalid or expires']); //redirect them anywhere you want if the token does not exist.
        //echo $token; die;
        return view('auth.passwords.reset', compact('token'));
    }

    public function resetPassword(UserResetPassword $request, $token)
    {
        //some validation
        $password = $request->password;
        $tokenData = DB::table('password_resets')->where('token', $token)->first();

        $user = User::where('email', $tokenData->email)->first();
		if ( !$user ) return redirect()->back()->with(['title'=>'Incorrect Email','error'=>'Please check your email and try again']);

        $user->password = Hash::make($password);
        $user->update();  //or $user->save();

        //do we log the user directly or let them login and try their password for the first time ? if yes
        //Auth::login($user);

        // If the user shouldn't reuse the token later, delete the token
         DB::table('password_resets')->where('email', $tokenData->email)->delete();

       //redirect where we want according to whether they are logged in or not.
       return redirect()->to(route('user.login'))->with(['title'=>'Success','success'=>'Password change successfully.']);
    }




}

