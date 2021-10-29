<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\Country;
use App\Http\Requests\ContactUSRequest;
use Illuminate\Support\Facades\Auth;

class CmsController extends Controller
{
    public function contact()
    {
        $record = new Country();
        //dd($record);
        return view('cms.contact')->with('record',$record);
    }

    public function contactUs(ContactUSRequest $request)
    {
       ContactUs::create(
            array(
                'user_id'       =>  (Auth::check())? Auth::user()->id : '',
                'name'          =>   $request['name'],
                'email'         =>   $request['email'],
                'country_code'  =>   $request['country_code'],
                'dial_code'     =>   $request['dial_code'],
                'mobile'        =>   (isset($request['mobile'])) ? $request['mobile'] : '',
                'message'       =>   $request['message'],
            )
        );
            return back();

    }

    public function about()
    {
        return view('cms.about');
    }

    public function cms_page()
    {

        return view('cms.cms_page');
    }

}
