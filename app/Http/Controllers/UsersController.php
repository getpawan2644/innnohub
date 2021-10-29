<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserProfileRequest;
use App\Http\Requests\UserProfileUserRequest;
use App\Http\Requests\UserProfileStepTwoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Meeting;
use App\Http\Requests\MeetingRequest;

class UsersController extends Controller
{
    //
    const REGISTER_SESSION_KEY = "updateProfile";
    public function __construct(){
        //$this->middleware('auth');
    }
    public function editProfile(){
        $userid=Auth::user()->id;
        $user = User::find($userid);
        $categories = Category::get();  
        $records = SubCategory::get()->toArray();
//        dd($user);
        return view('users.profile-edit')->with(['user'=>$user,'categories'=>$categories,'records'=>$records]);
    }

    public function updateProfileUser(UserProfileUserRequest $request){
        $user = User::findOrFail(Auth::guard('web')->user()->id);
        $validated = $request->validated();
        $user->fill($validated);
       
        $user->save();
       return redirect()->intended(route('user.edit-profile'))->with(['success'=>__("messages.profile_update_success")]);

    }

    public function updateProfile(UserProfileRequest $request){
        $user = User::findOrFail(Auth::guard('web')->user()->id);
        $validated = $request->validated();
        $user->fill($validated);
        $sub=implode(",",$request->sub_category);
        $user->subcategory_id=$sub;
        $user->save();
        return redirect()->intended(route('user.edit-profile-step-two'));

    }



     public function editProfileStepTwo(){
        $userid=Auth::user()->id;
        $user = User::find($userid);
//        dd($user);
        return view('users.profile-edit-step-two')->with('user',$user);
    }

     public function updateProfileStepTwo(UserProfileStepTwoRequest $request){
        $user = User::findOrFail(Auth::guard('web')->user()->id);
        $validated = $request->validated();
        $user->fill($validated);
       // $user1 = $request->all();
       // $user2 = $request->session()->get(self::REGISTER_SESSION_KEY);
       // $user3 =array_merge($user1,$user2);
       // User::where('id',Auth::guard('web')->user()->id)->update($user3);
       // $request->session()->forget(self::REGISTER_SESSION_KEY);
        $user->save();
       
        return redirect()->intended(route('user.edit-profile'))->with(['success'=>__("messages.profile_update_success")]);

    }

    public function changePassword(){
        $userid=Auth::user()->id;
        $user = User::find($userid);
        return view('users.change_password')->with('user',$user);
    }
    public function updatePassword(Request $request){
        $rules = [
            'old_password' => 'required',
            'newpassword'=> ['required','string','min:6','different:old_password','confirmed'],
            'newpassword_confirmation'=> ['required','same:newpassword'],
        ];

        $customMessages = [
            'old_password.required' => __("validation.field_required"),
            'newpassword.required' => __("validation.field_required"),
            'newpassword_confirmation.required' => __("validation.field_required"),
            'newpassword.different' => __("validation.different_password"),
            'newpassword.min.string' => __("validation.strong_password"),
            'newpassword.confirmed' => __("validation.confirm_password"),
            'newpassword_confirmation.same' => __("validation.confirm_password"),
        ];
        $this->validate($request, $rules, $customMessages);

        $newpassword = bcrypt($request->newpassword);
        $user = User::findOrFail(Auth::guard('web')->user()->id);
        $user->update(['password'=>$newpassword]);
        return redirect()->route('user.change-password')
            ->with(["success"=>__("messages.password_changed")]);
    }

     public function uploadCropImage(Request $request)
    {

        $folderPath = public_path('user/');
        
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
 
        $imageName = uniqid() . '.png';
 
        $imageFullPath = $folderPath.$imageName;
        
        file_put_contents($imageFullPath, $image_base64);
       return response()->json(['success'=>'Crop Image Uploaded Successfully','image'=>asset('user/'.$imageName),'logo'=>$imageName]);
    }

     public function calendar(){
        $usertype=Auth::user()->user_type;
        if($usertype == 'vendor'){
            $data = Meeting::where(['seller_id'=>Auth()->user()->id,'status'=>'Accept'])->with('userData')->get();
             $someArray = json_encode($data);
           
        }else{
            $data = Meeting::where(['buyer_id'=>Auth()->user()->id,'status'=>'Accept'])->with('userData')->get();
             $someArray = json_encode($data);
        }
        
           return view('users.fullcalendar')->with('data',$someArray);
        
       
    }

    public function calendarupdate(Request $request){

                if($request->isMethod('POST')){
                    $Meeting = Meeting::find($request->id);
                    $rules = new MeetingRequest();

                    $validator = Validator::make($request->all(), $rules->rules());
                    if($validator->fails()){
                        $response = array('status'=>0,'errors'=>$validator->errors(),'msg'=>'Please fill all the required fields');
                    }else{

                        $data=$request->post();
                        $date= date_create($request->start_date);
                        $data['start_date']=date_format($date,"Y-m-d");
                        if(!empty($request->meeting_link)){
                            $link1=explode("https://",$request->meeting_link);

                            $link2=explode("http://",$request->meeting_link);
                            if(!empty($link1) && $link1[0] == 'https://'){
                                $data['meeting_link'] = $request->meeting_link;
                            }elseif(!empty($link2) && $link2[0] == 'http://'){
                               $data['meeting_link'] = $request->meeting_link;
                            }else{
                                 $data['meeting_link'] = 'https://'.$request->meeting_link;
                            }
                        }
                       
                       
                        $dateEnd= date_create($request->end_date);
                        $data['end_date'] =date_format($dateEnd,"Y-m-d");

                        $data['start_time']= date("H:i", strtotime($request->start_time));
                        $data['end_time'] = date("H:i", strtotime($request->end_time));

                         //print($data); die;
                        $Meeting->update($data);

                        $notification = [
                            'message' => 'Meeting updated successfully!!!',
                            'alert-type' => 'success'
                        ];
                        $response = array('status'=>1,'errors'=>" ",'msg'=>'Meeting has updated successfully.','alert-type' =>'success');
                    }
                    return response()->json($response);
                //return redirect()->intended(route('admin.sliders'))->with($notification);
                }
            }
    
}
