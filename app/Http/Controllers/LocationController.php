<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;
use App\Models\Country;

class LocationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
	
	}
	public function array_columns(array $arr, array $keysSelect)
	{    
		$keys = array_flip($keysSelect);
		$filteredArray = array_map(function($a) use($keys){
			return array_intersect_key($a,$keys);
		}, $arr);

		return $filteredArray;
	}
	public function getCountry(){
		$countryData = Country::allActive();
		$data=[];
		foreach($countryData as $key=>$value){
			$data[] = $value;
		}
		return response()->json($data);
	}
    public function getStates(Request $request)
    {
		//dd(State::allActive($request->country_id));
		if($request->country_id){
			foreach(State::allActive($request->country_id) as $key=>$value){
				$data[$key]['id'] = $value->id;
				$data[$key]['name'] = $value->translateOrDefault(\App::getLocale())->name;
			}
			return response()->json($data); 
		}
        return response()->json([]);
    }
	
	public function getMunicipalities(Request $request)
	{
		if(is_array($request->state_id)){
			return response()->json(Municipality::multipleMuncipality($request->state_id));
		}
		if($request->state_id){
			foreach(Municipality::allActive($request->state_id) as $key=>$value){
				$data[$key]['id'] = $value->id;
				$data[$key]['name'] = $value->translateOrDefault(\App::getLocale())->name;
			}
			return response()->json($data);
		}
		return response()->json([]);
    }
	
	public function getCities(Request $request)
	{
		if(is_array($request->municipality_id)){
			return response()->json(City::multipleCiites($request->municipality_id));	
		}
		if($request->municipality_id){
			foreach(City::allActive($request->municipality_id) as $key=>$value){
				$data[$key]['id'] = $value->id;
				$data[$key]['name'] = $value->translateOrDefault(\App::getLocale())->name;
			}
			return response()->json($data);
		}
		return response()->json([]);
    }	
    public function getcurrentlocationads(Request $request)
	{
		if($request->country_code){
			return response()->json(Country::getcountrybycode($request->country_code));
		}
        return response()->json([]);
    }
}
