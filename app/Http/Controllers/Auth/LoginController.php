<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/user/edit-profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function postLogin(UserLoginRequest $request)
    {
        $checkBlock = ['email' => $request->email, 'password' => $request->password, 'status' => 'Inactive'];
        if (!Auth::validate($checkBlock)){
            $credentials = ['email'=> $request->email, 'password' => $request->password];
            if (Auth::attempt($credentials)) {
                //dd(Auth::user());
                // Authentication passed...
                return response()->json([
                    'success'=>true,
                    'title' => __('messages.success'),
                    'email'=>Auth::user()->email,
                    'message'=>__('messages.login_success')
                ], 200);
            }else{
                return response()->json([
                    'success'=>false,
                    'title' => __('messages.error'),
                    'message'=>__('messages.incorrect_user_password')
                ], 400);
            }
        }else{
            return response()->json([
                'success'=>false,
                'title' => __('messages.error'),
                'message'=>__('messages.incorrect_user_block')
            ], 400);
        }
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        //$user = Socialite::driver($provider)->user();
        //dd($user);
        // $user->token;
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect(route('user.login'));
        }

        $authUser = $this->findOrCreateUser($user, $provider);
        //dd($authUser);
        Auth::login($authUser, true);
        //Auth::guard('web')->login($authUser);
        return redirect($this->redirectTo);
    }

    public function findOrCreateUser($providerUser, $provider)
    {

        $account = SocialIdentity::whereProviderName($provider)
                   ->whereProviderId($providerUser->getId())
                   ->first();

        if ($account) {
            return $account->user;
        } else {
            $user = User::whereEmail($providerUser->getEmail())->first();

            if (! $user) {
                $nameArr = explode(' ',$providerUser->getName());
                $userDetails = [
                                    'email' => $providerUser->getEmail(),
                                    'first_name'  => $nameArr[0],
                                    'last_name'  => end($nameArr),
                                    'username' =>$providerUser->getEmail(),
                                    'user_type'=>'Customer',
                                    'password'=> Hash::make('ar123'),
                                    'status'    => 'Inactive'
                                ];
                $user = User::create($userDetails);
            }

            $user->identities()->updateOrCreate([
                'provider_id'   => $providerUser->getId()],
                [
                    'provider_id'   => $providerUser->getId(),
                    'provider_name' => $provider,
                ]);

            return $user;
        }
    }
}
