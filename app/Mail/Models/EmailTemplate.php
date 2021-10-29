<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use CommonHelper;

class EmailTemplate extends Model
{

	use \Kyslik\ColumnSortable\Sortable;

	public $table = "email_templates";


	public $sortable = ['id','page_name','status'];

    protected $fillable = ['page_name','status','title', 'content'];

    public static function deleteCache($model){
        // foreach(CommonHelper::getLanguages() as $language => $locale){
            // Cache::forget('cms-general-route-'.$locale);
            // Cache::forget('cms-service-route-'.$locale);

        // }
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



	public static function allEmailTemplate($pagename=null){
			$emailTemplate = EmailTemplate::where('page_name',$pagename)->first();
            return $emailTemplate;

	}


}
