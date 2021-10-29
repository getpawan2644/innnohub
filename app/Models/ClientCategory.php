<?php

namespace App\Models;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Cache;
use App\Helpers\CommonHelper;
class ClientCategory extends Model implements TranslatableContract
{
    use Sortable;
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';

    use Translatable;
    protected $attributes = [
        'status' => self::ACTIVE,
    ];
    public $translatedAttributes = ['name'];
    protected $fillable = ['id','status',"category_order"];
    public $sortable = ['id','status',"category_order"];

    protected static function boot(){
        parent::boot();

        self::created(function($model){
            self::deleteCache($model);
        });

        self::updating(function($model){
			self::deleteCache($model);
        });

        self::updated(function($model){
			self::deleteCache($model);
        });

        static::deleting(function($model) {
            self::deleteCache($model);
            $model->clients()->delete();
        });
        self::deleted(function($model){
			self::deleteCache($model);
        });
    }
    private static function deleteCache($model){
        foreach(CommonHelper::getLanguages() as $language => $locale) {
            Cache::forget('active-client-categories'.$locale);
            Cache::forget('front-client-categories'.$locale);
            Cache::forget('front-featured-client-categories'.$locale);
        }
    }
    public function clients(){
        return $this->hasMany('App\Models\Client');
    }
    public static function getClientCategoryList(){
        return Cache::rememberForever('active-client-categories'.app()->getLocale(), function () {
            $result = \App\Models\ClientCategory::where(['status'=> 'Active'])->get();
            return $result;
        });
    }
    public static function getActiveClientCategoryList(){
        return Cache::rememberForever('front-client-categories'.app()->getLocale(), function () {
            $get_front_categories = \App\Models\ClientCategory::where([
                ['status', '=', 'Active'],
            ])->whereHas("clients",function($q){
                $q->where("status","Active");
            })->orderBy("category_order","DESC")->get();
            return $get_front_categories;
        });
    }
    public static function getActiveFeaturedClientCategoryList(){
        return Cache::rememberForever('front-featured-client-categories'.app()->getLocale(), function () {
            $get_front_categories = \App\Models\ClientCategory::where([
                ['status', '=', 'Active'],
            ])->whereHas("clients",function($q){
                $q->where("status","Active");
                $q->where("is_featured","Active");
            })->orderBy("category_order","DESC")->get();
            return $get_front_categories;
        });
    }
}
