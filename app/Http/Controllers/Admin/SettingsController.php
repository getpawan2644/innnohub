<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingsRequest;

class SettingsController extends Controller
{
    public function index(Request $request, Settings $settings)
    {
        $records = $settings->sortable(['id' => 'desc']);

        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->Where('key', 'like', '%'.$request->query('search').'%');
                $q->orWhere('value', 'like', '%'.$request->query('search').'%');
                $q->orWhere('group', 'like', '%'.$request->query('search').'%');
            });
        }

        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        return view('admin.settings.index',['records'=>$records]);
    }

    public function siteSettings()
    {
    	$records = Settings::where('group','like','site_settings')->get();
        return view('admin.settings.site_settings', ['records' => $records->toArray()]);
    }

    public function updateSiteSettings(Request $request, Settings $settings)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'phone' => 'required|min:11|numeric',
            'address' => 'required|string|max:255',
            'Android_Link' => 'required|string|max:255',
            'IOS_Link' => 'required|string|max:255',
            //'footer_text' => 'required|string',
        ]);
        Settings::where('key', 'email')->update(['value' => $request->email]);
        Settings::where('key', 'phone')->update(['value' => $request->phone]);
        Settings::where('key', 'address')->update(['value' => $request->address]);
        Settings::where('key', 'Android_Link')->update(['value' => $request->Android_Link]);
        Settings::where('key', 'IOS_Link')->update(['value' => $request->IOS_Link]);
        //Settings::where('key', 'footer_text')->update(['value' => $request->footer_text]);

        return redirect()->route('admin.settings.siteSettings')->with(['success'=>'Site Settings updated successfully.']);
    }

    public function socialLinks()
    {
        $records = Settings::where('group','like','Social_Link')->get();
        return view('admin.settings.social_links', ['records' => $records->toArray()]);
    }

    public function updateSocialLinks(Request $request, Settings $settings)
    {
        //dd($request->all());
        $request->validate([
            'facebook_link' => 'required',
            'twitter_link' => 'required',
            'whatsApp_link' => 'required',
            'youTube_link' => 'required',
            'instagram_link' => 'required',
            'linkedin_link' => 'required',
        ]);
        Settings::where('key', 'facebook_link')->update(['value' => $request->facebook_link,'status' => $request->facebook_link_status]);
        Settings::where('key', 'twitter_link')->update(['value' => $request->twitter_link,'status' => $request->twitter_link_status]);
        Settings::where('key', 'whatsApp_link')->update(['value' => $request->whatsApp_link,'status' => $request->whatsApp_link_status]);
        Settings::where('key', 'youTube_link')->update(['value' => $request->youTube_link,'status' => $request->youTube_link_status]);
        Settings::where('key', 'instagram_link')->update(['value' => $request->instagram_link,'status' => $request->instagram_link_status]);
        Settings::where('key', 'linkedin_link')->update(['value' => $request->linkedin_link,'status' => $request->linkedin_link_status]);
        return redirect()->route('admin.settings.socialLinks')->with(['success'=>'Information updated successfully.']);
    }




}
