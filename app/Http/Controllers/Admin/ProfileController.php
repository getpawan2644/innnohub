<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Http\Requests\Admin\ChangePasswordRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Auth;
use Hash;
use Validator;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function showProfileForm()
    {
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);
        return view('admin.profile.index',compact('admin'));
    }

    public function updateProfile(ProfileUpdateRequest $request)
    {
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return redirect()->route('admin.showProfileForm')
			->with(["success"=>"Your profile is successfully updated."]);
    }

    public function updateProfilePic(Request $request)
    {

        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);
        $oldImage = $admin->profile_pic;

        if (!file_exists(public_path(Admin::PROFILE_PIC_PATH))) {
            mkdir( public_path(Admin::PROFILE_PIC_PATH) , 0777, true);
        }

        $image = $request->profile_pic;
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name= time().'.png';

        $admin->profile_pic = $image_name;
        $path = public_path(Admin::PROFILE_PIC_PATH.$image_name);
        @file_put_contents($path, $image);

        $admin->save();
        if($oldImage && file_exists(public_path(Admin::PROFILE_PIC_PATH.$oldImage))){
            @unlink(public_path(Admin::PROFILE_PIC_PATH.$oldImage));
        }

        return response()->json(['status' => 1, 'message' => asset(Admin::PROFILE_PIC_PATH.$image_name)]);
    }

    public function showPasswordForm()
    {
        return view('admin.profile.change_password');
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        $password = bcrypt($request->password);
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);
        $admin->update(['password'=>$password]);

		return redirect()->route('admin.showPasswordForm')
			->with(["success"=>"Password changed successfully."]);
    }


}
