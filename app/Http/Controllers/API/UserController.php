<?php
namespace App\Http\Controllers\API;
use App\Http\Requests\RegisterRequest;
use App\Mail\UserRegister;
use App\Models\EmailTemplate;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use App\Mail\ForgotPassword;
use App\Http\Requests\UserResetPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Models\User;

class UserController extends Controller
{
    use SendsPasswordResetEmails;
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=null;

        $checkBlock = ['email' => request('email'), 'password' => request('password'), 'status' => 'Inactive'];
        if (!Auth::validate($checkBlock)){
            $credentials = ['email'=> request('email'), 'password' => request('password')];
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $response["status"] =1;
                $response["message"] =__('messages.login_success');
                $response["data"]["access-token"] =  $user->createToken(env("APP_NAME"))-> accessToken;
                $response["data"]["User"]["full_name"]=$user->full_name;
                $response["data"]["User"]["first_name"]=$user->first_name;
                $response["data"]["User"]["last_name"]=$user->last_name;
                $response["data"]["User"]["email"]=$user->email;
                $response["data"]["User"]["dial_code"]=$user->dial_code;
                $response["data"]["User"]["country_code"]=$user->country_code;
                $response["data"]["User"]["country_id"]=$user->country_id;
                $response["data"]["User"]["mobile"]=$user->mobile;
                $response["data"]["User"]["status"]=$user->status;
                return response()->json( $response, $this-> successStatus);
            }else{
                $response["message"] =__('messages.incorrect_user_password');
                return response()->json($response, 200);
            }
        }else{
            $response["message"] =__('messages.incorrect_user_block');
            return response()->json($response, 200);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function userSignup(Request $request)
    {
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=null;

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'country_code'=>'nullable',
            'dial_code' => 'nullable',
            'mobile' => 'required|unique:users,mobile',
            'password' => 'required|string|min:8|confirmed',
            'country_id' => 'required',
            'state_id' => 'nullable',
            'city_id' => 'nullable',
            'zip' => 'nullable',
            'address_line_1' => 'nullable',
            'address_line_2' => 'nullable',
            'status'=>'nullable'
        ],[
            'first_name.required'  =>  trans("validation.first_name_required"),
            'last_name.required'  =>  trans("validation.last_name_required"),
            'email.required' =>  trans("validation.email_required"),
            'email.unique' =>  trans("validation.email_unique"),
            'mobile.required' =>  trans("validation.mobile_required"),
            'mobile.unique' =>  trans("validation.mobile_unique"),
            'password.required' =>  trans("validation.password_required"),
            'password.confirmed' =>  trans("validation.password_confirmed"),
            'password.min'  =>  trans("validation.password_min"),
            'country_id.required'  =>  trans("validation.country_id_required"),
        ]);
        if ($validator->fails()) {
            $response["message"]=getFirstError($validator->errors("errors")->toArray());
            return response()->json($response, 200);
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
//        $this->sendEmailAlertUser('welcome-email','en',$user);
        $this->sendEmailAlertUser('welcome-email',$user);
        //$this->sendEmailAlertUser('welcome-email','en',$user);
        //Mail::to($user->email)->send(new UserRegister());
        $response["status"] =1;
        $response["message"] =__('messages.register_success');
        $response["data"]["user_name"] =  $user->first_name;
        $response["data"]["access-token"] =  $user->createToken(env("APP_NAME"))-> accessToken;
        return response()->json( $response, $this-> successStatus);
        //return response()->json(['success'=>$success], $this->successStatus);
    }

    public function sendEmailAlertUser($pageName,$user){
        $allEmailTemp = EmailTemplate::allEmailTemplate($pageName);
        $getSubject = $allEmailTemp->translateOrDefault("en")->title;
        $getContent = $allEmailTemp->translateOrDefault("en")->content;
        $ar_getSubject = $allEmailTemp->translateOrDefault("ar")->title;
        $ar_getContent = $allEmailTemp->translateOrDefault("ar")->content;
        $separator="<br/>---------------------------------------------------------------------------------------------<br/>";
        $subject = str_replace(["{user}"], [$user->first_name.' '.$user->last_name], $getSubject);
        $message = $getContent.$separator.$ar_getContent;
        Mail::to($user->email)->send(new UserRegister($subject,$message));
    }



    /**
     * Geting all the active country list
     *
     * @return \Illuminate\Http\Response
     */
    public function countryList(Request $request)
    {
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $countries = \App\Models\Country::allActive();
        $i=0;
        foreach ($countries as $country){
            //dd($country);
            $c[$i]["id"]=$country['id'];
            $c[$i]["name"]=$country['name'];
            $c[$i]["country_code"]=$country['code'];
            $i++;
        }
        if(!empty($c)){
            $response["status"]=1;
            $response["data"]["countries"]=$c;
        }
        return response()->json( $response, $this-> successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $user = Auth::guard("api")->user();
        if(!empty($user)){
            $response["status"]=1;
            $response["data"]["User"]["full_name"]=$user->full_name;
            $response["data"]["User"]["first_name"]=$user->first_name;
            $response["data"]["User"]["last_name"]=$user->last_name;
            $response["data"]["User"]["email"]=$user->email;
            $response["data"]["User"]["dial_code"]=$user->dial_code;
            $response["data"]["User"]["country_code"]=$user->country_code;
            $response["data"]["User"]["country_id"]=$user->country_id;
            $response["data"]["User"]["mobile"]=$user->mobile;
            $response["data"]["User"]["status"]=$user->status;
        }else{
            $response["message"]=__("messages.something_went_wrong");
        }
        return response()->json($response, $this-> successStatus);
    }
    /**
     * Update details api
     *
     * @return \Illuminate\Http\Response
     */
    public function updateDetails(Request $request)
    {
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::guard("api")->user()->id,
            'country_code'=>'nullable',
            'dial_code' => 'nullable',
            'mobile' => 'required|unique:users,mobile,'.Auth::guard("api")->user()->id,
            'country_id' => 'required',
        ],[
            'first_name.required'  =>  trans("validation.first_name_required"),
            'last_name.required'  =>  trans("validation.last_name_required"),
            'email.required' =>  trans("validation.email_required"),
            'email.unique' =>  trans("validation.email_unique"),
            'mobile.required' =>  trans("validation.mobile_required"),
            'mobile.unique' =>  trans("validation.mobile_unique"),
            'country_id.required'  =>  trans("validation.country_id_required"),
        ]);
        if ($validator->fails()) {
            $response["message"]=getFirstError($validator->errors("errors")->toArray());
            return response()->json($response, 200);
        }
        $user = User::findOrFail(Auth::guard('api')->user()->id);
        $validated = $input = $request->all();
        $user->fill($validated);
        $user->save();
        $response["status"]=1;
        $response["message"]=__("messages.profile_update_success");
        $user = User::findOrFail(Auth::guard("api")->user()->id);
        if(!empty($user)){
            $response["status"]=1;
            $response["data"]["User"]["full_name"]=$user->full_name;
            $response["data"]["User"]["first_name"]=$user->first_name;
            $response["data"]["User"]["last_name"]=$user->last_name;
            $response["data"]["User"]["email"]=$user->email;
            $response["data"]["User"]["dial_code"]=$user->dial_code;
            $response["data"]["User"]["country_code"]=$user->country_code;
            $response["data"]["User"]["country_id"]=$user->country_id;
            $response["data"]["User"]["mobile"]=$user->mobile;
            $response["data"]["User"]["status"]=$user->status;
        }
        return response()->json($response, $this-> successStatus);
    }
    /**
     * Password reset API
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(Request $request)
    {
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $input = $request->all();
        $rules = array(
            'email' => "required|email",
        );
        $messages = array(
            'email.required' =>  __("validation.email_required"),
            'email.email' =>  __("validation.email_valid"),
        );
        $validator = Validator::make($input, $rules,$messages);

        if ($validator->fails()) {
            $response["message"]=getFirstError($validator->errors("errors")->toArray());
        } else {
            try {
                $response_of_email = Password::sendResetLink($request->only('email'), function (Message $message) {
                    $message->subject($this->getEmailSubject());
                });
                switch ($response_of_email) {
                    case Password::RESET_LINK_SENT:
                        $response["status"]=1;
                        $response["message"]=__('messages.reset_email_sent');
                        return response()->json($response, $this-> successStatus);
                    case Password::INVALID_USER:
                        $response["message"]=__('messages.email_not_registered');
                        return response()->json($response, 200);
                }
            } catch (\Swift_TransportException $ex) {
                $response["message"]=$ex->getMessage();
                return response()->json($response, 200);
            } catch (Exception $ex) {
                $response["message"]=$ex->getMessage();
                return response()->json($response, 200);
            }
        }
       return response()->json($response, 200);
    }

    public function updatePassword(Request $request){
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $validator = Validator::make($request->all(),[
            'old_password' => 'required',
            'newpassword'=> ['required','string','min:6','different:old_password','confirmed'],
            'newpassword_confirmation'=> ['required','same:newpassword'],
        ],[
            'old_password.required' => __("validation.field_required"),
            'newpassword.required' => __("validation.field_required"),
            'newpassword_confirmation.required' => __("validation.field_required"),
            'newpassword.different' => __("validation.different_password"),
            'newpassword.min.string' => __("validation.strong_password"),
            'newpassword.confirmed' => __("validation.confirm_password"),
            'newpassword_confirmation.same' => __("validation.confirm_password"),
        ]);
        if ($validator->fails()) {
            $response["message"]=getFirstError($validator->errors("errors")->toArray());
            return response()->json($response, 200);
        }elseif(!Hash::check($request->old_password,  Auth::guard('api')->user()->password)) {
            $response["message"]=__("messages.current_password_error");
            return response()->json($response, 200);
        };
        $newpassword = bcrypt($request->newpassword);
        $user = User::findOrFail(Auth::guard('api')->user()->id);
        $user->update(['password'=>$newpassword]);
        $response["status"]=1;
        $response["message"]=__("messages.password_changed");
        return response()->json($response, $this->successStatus);
    }

}
