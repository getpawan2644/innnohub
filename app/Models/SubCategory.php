<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Kyslik\ColumnSortable\Sortable;

class SubCategory extends Model
{
    use Sortable;
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';

    protected $attributes = [
        'status' => self::ACTIVE,
    ];
    protected $fillable = ['id','status','slug','category_id','name'];
    public $sortable = ['id','status'];
    protected static function boot(){
        parent::boot();
        static::saving(function ($model) {
            $model->slug = Str::slug($model->name);
        });
        self::updating(function($model){
            $model->slug = Str::slug($model->name);
			// self::deleteCache($model);
        });
        static::deleting(function($model) {
            // $model->products()->delete();
        });
    }
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    public static function getSubCategory($category_slug=null){
        $result = \App\Models\SubCategory::whereHas('Category', function(Builder $query) use($category_slug){
            $query->where('slug',$category_slug);
        })->where(['status'=> 'Active'])->get();
        return $result;
    }
}
