<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Cache;
use CommonHelper;
class State extends Model implements TranslatableContract
{

	const ACTIVE = "Active";
	const INACTIVE = "Inactive";

	use Translatable;
    use Sortable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['id','status','country_id'];
    public $sortable = ['id','status'];

    public function country(){
        return $this->belongsTo('App\Models\Country');
    }
	public static function boot()
    {
        parent::boot();
        self::created(function($model){
            self::deleteCache($model);
        });

        self::updated(function($model){
			self::deleteCache($model);
        });

        self::deleted(function($model){
			self::deleteCache($model);
        });
    }

    public static function getStateList(){
        $result = \App\Models\State::where(['status'=> 'Active'])->get();
        return $result;
    }

	private static function deleteCache($model){
		foreach(CommonHelper::getLanguages() as $language => $locale){
			Cache::forget('states-'.$model->country_id.'-'.$locale);
		}
	}
    public static function allActive($country_id = null){
		$country_id = $country_id ? $country_id :0;
		self::enableAutoloadTranslations();
		return Cache::rememberForever('states-'.$country_id.'-'.app()->getLocale(), function () use($country_id){
			return State::withTranslation()->select('id','country_id')
				->where('status', self::ACTIVE)
				->where('country_id', $country_id)
				->withTranslation()
				->orderByTranslation('name','asc')
				->get();
		});
	}
}
