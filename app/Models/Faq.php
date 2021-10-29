<?php

namespace App\Models;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Cache;

class Faq extends Model implements TranslatableContract
{
    use Sortable;
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';
    protected $table = 'faqs';
    use Translatable;
    protected $attributes = [
        'status' => self::ACTIVE,
    ];
    public $translatedAttributes = ['question',"answer"];
    protected $fillable = ['id','status'];
    public $sortable = ['id','status'];

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

        static::deleting(function($category) {
           // $category->sub_categories()->delete();
        });
        self::deleted(function($model){
			self::deleteCache($model);
        });
    }

    private static function deleteCache($model){
		Cache::forget('active-faqs');
    }
    public static function getFaqList(){
            $result = \App\Models\Faq::where(['status'=> 'Active'])->get();
            return $result;
    }
    public function locale(){
        return app()->getLocale() ?: "en";
    }
}
