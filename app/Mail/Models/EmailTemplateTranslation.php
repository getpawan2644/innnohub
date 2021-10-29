<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use CommonHelper;

class EmailTemplateTranslation extends Model
{
	use \Kyslik\ColumnSortable\Sortable;

    public $timestamps = false;

    public $table = "email_template_translations";

	public $sortable = ['title',  'content'];

    protected $fillable = ['title', 'content'];


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
