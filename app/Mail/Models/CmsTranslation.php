<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use CommonHelper;

class CmsTranslation extends Model
{
	use \Kyslik\ColumnSortable\Sortable;

    public $timestamps = false;

    public $table = "cms_translations";

	public $sortable = ['title', 'url' ,'meta_keyword', 'meta_desc', 'content'];

    protected $fillable = ['title', 'url' ,'meta_keyword', 'meta_desc', 'content'];


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

	private static function deleteCache($model){
		Cache::forget('cms-route');
		foreach(CommonHelper::getLanguages() as $language => $locale){
			Cache::forget('cms-'.$locale);
		}
	}
}
