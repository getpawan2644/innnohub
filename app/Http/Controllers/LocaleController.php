<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

	}
	public function changeLocale(Request $request, $locale=null)
	{
        //dd($locale);
        Session::put('locale', $locale);
        return back();
    }
}
