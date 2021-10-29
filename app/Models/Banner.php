<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use CommonHelper;
use Illuminate\Support\Facades\Cache;


class Banner extends Model
{

	use \Astrotomic\Translatable\Translatable;
	use \Kyslik\ColumnSortable\Sortable;
    const IMAGE_PATH = '/images/banner_images/';
    const TOP_BANNER = 'Top';
    const MIDDLE_BANNER = 'Middle';
    const BOTTOM_BANNER = 'Bottom';

	public $table = "banners";

	public $translatedAttributes = ['title','heading','description','button_label','banner_link'];
    protected $appends = ['full_image_url'];
	protected $fillable = ['banner_position','status','button_url','have_button'];

	public static function boot()
    {
        parent::boot();

        self::created(function($model){
            self::deleteCache();
        });

        self::updated(function($model){
			self::deleteCache();
        });

        self::deleted(function($model){
			self::deleteCache();
        });

    }

    private static function deleteCache(){
		foreach(CommonHelper::getLanguages() as $language => $locale){
			Cache::forget('banners-'.$locale);
			Cache::forget('banners-top-'.$locale);
			Cache::forget('banners-middle-'.$locale);
			Cache::forget('banners-bottom-'.$locale);
		}
	}
	/* This function is used in user registration and front end */
    public static function allActive(){
        return Cache::rememberForever('banners-'.app()->getLocale(), function () {
            return Banner::where('status', 'Active')->withTranslation()->get()->toArray();
        });
    }
    public function getFullImageUrlAttribute()
    {
        if(isset($this->translation->image) && !empty($this->translation->image)){
            return asset("/images/banner_images/".$this->translation->image);
        }else{
            if($this->banner_position==\App\Models\Banner::TOP_BANNER){
                return asset("/images/banner_images/home-bg.png");
            }elseif($this->banner_position==\App\Models\Banner::MIDDLE_BANNER){
                return asset("/images/banner_images/best-furniture.png");
            }else{
                return asset("/images/banner_images/furniture-decoration.png");
            }
            return false;
        }
    }
    public static function getTopBanners(){
        return Cache::rememberForever('banners-top-'.app()->getLocale(), function () {
            return Banner::where(['status'=>'Active',"banner_position"=>self::TOP_BANNER])->withTranslation()->get();
        });
    }
    public static function getMiddleBanner(){
        return Cache::rememberForever('banners-middle-'.app()->getLocale(), function () {
            return Banner::where(['status'=>'Active',"banner_position"=>self::MIDDLE_BANNER])->orderBy("id","DESC")->withTranslation()->get();
        });
    }
    public static function getBottomBanner(){
        return Cache::rememberForever('banners-bottom-'.app()->getLocale(), function () {
            return Banner::where(['status'=>'Active',"banner_position"=>self::BOTTOM_BANNER])->withTranslation()->orderBy("id","DESC")->get();
        });
    }
}
