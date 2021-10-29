<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Kyslik\ColumnSortable\Sortable;

class ClientCategoryTranslation extends Model
{
    use Sortable;
    public $timestamps = false;

    protected $table = 'client_category_translations';

    protected $fillable = ['locale','name','client_category_id'];
//    public $sortable = ['name'];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
           // $model->slug = Str::slug($model->name);
        });

        static::updating(function ($model) {
            //$model->slug = Str::slug($model->name);
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
