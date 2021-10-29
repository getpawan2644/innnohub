<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Kyslik\ColumnSortable\Sortable;

class ClientTranslation extends Model
{
    use Sortable;
    public $timestamps = false;

    protected $table = 'client_translations';

    protected $fillable = ['slug','locale','client_id','name', 'description'];
//    public $sortable = ['name'];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->slug = Str::slug($model->client_title).time();
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
