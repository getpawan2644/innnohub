<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PrivacyPolicyTranslation extends Model
{
    use \Kyslik\ColumnSortable\Sortable;
    public $timestamps = false;

    protected $table = 'privacy_policy_translations';

    protected $fillable = ['title','description'];
//    public $sortable = ['name'];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
        });

        static::updating(function ($model) {
        });

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
    }
}
