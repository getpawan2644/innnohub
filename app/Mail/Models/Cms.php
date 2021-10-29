<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Cache;
use CommonHelper;

class Cms extends Model implements TranslatableContract
{

	use Translatable;
	use \Kyslik\ColumnSortable\Sortable;
    const BOTTOM_PAGE_ARRAY=['terms-and-condition','about-us','privacy-policy'];
    const NOT_EDITABLE_PAGE=['terms-and-condition','faq','privacy-policy'];
    const PAGE_GENERAL="General";
    const PAGE_SERVICE="Service";
    const PAGE_NAME_FAQ="faq";
    const PAGE_TERMS_CONDITIONS="terms-and-condition";
    const PAGE_PRIVACY_POLICY="privacy-policy";

	public $table = "cms";

	public $translatedAttributes = ['title','url','meta_keyword', 'meta_desc', 'content'];

	public $sortable = ['id','page_name','status',"page_type"];

    protected $fillable = ['page_name','status','page_type'];

    public static function deleteCache($model){
        Cache::forget('cms-route');
        foreach(CommonHelper::getLanguages() as $language => $locale){
            Cache::forget('cms-general-route-'.$locale);
            Cache::forget('cms-service-route-'.$locale);

        }
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

        self::updating(function($model){
            self::deleteCache($model);
        });

        self::deleted(function($model){
			self::deleteCache($model);
        });
    }



	public static function allCms(){
			$cms = Cms::get()->where("status","Active");
//			$cmsFormated = [];
//			if(!empty($cms)){
//				foreach($cms as $record){
//					$cmsFormated[$record['page_name']] = $record;
//				}
//			}
			return $cms;
	}
    public static function allGeneralCms(){
        return Cache::rememberForever('cms-general-route-'.app()->getLocale(), function () {
            $cms = Cms::get()->Where("page_type",\App\Models\Cms::PAGE_GENERAL)->Where("status","Active");
            return $cms;
        });
    }
    public static function allServiceCms(){
        return Cache::rememberForever('cms-service-route-'.app()->getLocale(), function () {
            $cms = Cms::get()->Where("page_type",\App\Models\Cms::PAGE_SERVICE)->Where("status","Active");
            return $cms;
        });
    }
	public static function allCmsForRoute(){

		self::enableAutoloadTranslations();

		return Cache::rememberForever('cms-route', function () {
			$cms = Cms::get()->toArray();
			$cmsFormated = [];
			if(!empty($cms)){
				foreach($cms as $record){
					$cmsFormated[$record['page_name']] = $record;
				}
			}
			return $cmsFormated;
		});
	}

	public function locale(){
		return app()->getLocale() ?: "en";
	}
}
