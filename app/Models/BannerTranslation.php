<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use CommonHelper;
use Illuminate\Support\Facades\Cache;

class BannerTranslation extends Model
{
	use \Kyslik\ColumnSortable\Sortable;

    public $timestamps = false;

	protected $table = 'banners_translations';

	public $sortable = [];

    protected $fillable = ['image','banner_id','locale','title','heading','description','button_label','banner_link'];

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
		foreach(CommonHelper::getLanguages() as $language => $locale){
			Cache::forget('banners-'.$locale);
		}
	}
}
