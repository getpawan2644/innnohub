<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use CommonHelper;


class Settings extends Model
{
    use \Kyslik\ColumnSortable\Sortable;

    public $table = "settings";

    public $sortable = ['id','key','value','group'];

    protected $fillable = [
        'key', 'value','group',
    ];

    protected static function boot()
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

    private static function deleteCache($model){
        Cache::forget('social_link');
        Cache::forget('site_setting');
    }

    public static function social_links(){
//        return Cache::rememberForever('social_link', function () {
            $social_links = Settings::where('group', 'like','Social_Link')->where("status","Active")->pluck('value', 'key')->toArray();
            return $social_links;
//        });
    }

    public static function site_settings(){
//        return Cache::rememberForever('site_setting', function () {
            $site_settings = Settings::where('group', 'like','Site_Settings')->pluck('value', 'key')->toArray();
            return $site_settings;
//        });
    }



}
