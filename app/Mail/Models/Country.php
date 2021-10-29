<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use CommonHelper;

class Country extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

	const FLAG_PATH = "img/flag/";


	use \Kyslik\ColumnSortable\Sortable;


	public $sortable = ['id','code','dial_code', 'status'];

    protected $fillable = [
        'code', 'dial_code','currency_name','currency_symbol','currency_code','status','name'
    ];

	//protected $appends = ['flag_url'];

    private static function deleteCache(){
        // foreach(CommonHelper::getLanguages() as $language => $locale){
            Cache::forget('countries');
            Cache::forget('admin-countries');
        // }
    }

	public static function boot()
    {
        parent::boot();

        self::created(function($model){
            // dd($model);
            self::deleteCache();
        });
        static::updated(function($model) {
            self::deleteCache();
        });
        static::deleting(function($model) {
            self::deleteCache();
            //$model->state()->delete();
        });
    }

    public function states(){
        return $this->hasMany('App\Models\State');
    }

    /* This function is used in user registration and front end */
    public static function allActive(){
        //return Cache::rememberForever('countries', function () {
            $countries = Country::where('status', 'Active')->get()->toArray();
			$countriesFormated = [];
			if(!empty($countries)){
				foreach($countries as $country){
					$countriesFormated[$country['code']] = $country;
				}
			}
			return $countriesFormated;
        //});

    }
    public static function getCountryList(){
        $result = \App\Models\Country::where(['status'=> 'Active'])->get();
        return $result;
    }
    public static function getCountryWithCode(){
        $result = \App\Models\Country::where(['status'=> 'Active'])->get();
        $temp=null;
        foreach($result as $country){
            $temp[$country->id]=$country->code;
        }
        return $temp;
    }
    /* This function is used in remaining admin module */
    public static function allActiveCountries(){
        return Country::get();

    }

    public static function getcountrybycode($country_code = null){
        return Cache::rememberForever('countries-'.$country_code, function () use($country_code){
            return Country::select('id','code')
                //->where('status', self::ACTIVE)
                ->where('code', $country_code)
                ->orderBy('name','asc')
                ->get()->toArray();
        });
    }


}
