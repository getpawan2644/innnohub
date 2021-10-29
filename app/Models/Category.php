<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use Sortable;
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';
    const PHOTOS_TMP_DIR = "files/tmp/categoryImg/";
    const PHOTOS_DIR = "files/categoryImg/";

    protected $attributes = [
        'status' => self::ACTIVE,
    ];
    protected $appends = ['thumbnail_url', 'image_url'];
    protected $fillable = ['id','status', 'slug','category_icon', 'category_icon_thumbnail',"category_order",'name','category_id'];
    public $sortable = ['id','status',"category_order"];

    protected static function boot(){
        parent::boot();

        self::created(function($model){
            if ($model->category_icon && file_exists(public_path() . "/" . self::PHOTOS_TMP_DIR . date('Y-m-d') . '/' . $model->category_icon)) {
                $dir = public_path() . "/" . self::PHOTOS_DIR . $model->id;
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $newImage = $dir . '/' . $model->category_icon;
                $tmpImage = public_path() . "/" . self::PHOTOS_TMP_DIR . date('Y-m-d') . '/' . $model->category_icon;
                copy($tmpImage, $newImage);
                @unlink($tmpImage);
                //Move Thumbnail Image
                $newThumbnail = $dir . '/' . $model->category_icon_thumbnail;
                $tmpThumbnail = public_path() . "/" . self::PHOTOS_TMP_DIR . date('Y-m-d') . '/' . $model->category_icon_thumbnail;
                copy($tmpThumbnail, $newThumbnail);
                @unlink($tmpThumbnail);
            }
            self::deleteCache($model);
        });
        static::saving(function ($model) {
            $model->slug = Str::slug($model->name);
        });
        self::updating(function($model){
            $model->slug = Str::slug($model->name);
			self::deleteCache($model);
        });

        self::updated(function($model){
            if ($model->category_icon && file_exists(public_path() . "/" . self::PHOTOS_TMP_DIR . date('Y-m-d') . '/' . $model->category_icon)) {
                $dir = public_path() . "/" . self::PHOTOS_DIR . $model->id;
                // $OldFiles = scandir($dir);
                // dd($OldFiles);
                array_map('unlink', glob("$dir/*.*"));
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $newImage = $dir . '/' . $model->category_icon;
                $tmpImage = public_path() . "/" . self::PHOTOS_TMP_DIR . date('Y-m-d') . '/' . $model->category_icon;
                copy($tmpImage, $newImage);
                @unlink($tmpImage);
                //Move Thumbnail Image
                $newThumbnail = $dir . '/' . $model->category_icon_thumbnail;
                $tmpThumbnail = public_path() . "/" . self::PHOTOS_TMP_DIR . date('Y-m-d') . '/' . $model->category_icon_thumbnail;
                copy($tmpThumbnail, $newThumbnail);
                @unlink($tmpThumbnail);
            }
			self::deleteCache($model);
        });

        static::deleting(function($model) {
            self::deleteCache($model);
            $model->sub_categories()->delete();
            // $model->products()->delete();
        });
        self::deleted(function($model){
            if ($model->category_icon) {
                $categoryIcon = public_path() . "/" . self::PHOTOS_DIR . '/' . $model->id . '/' . $model->category_icon;
                @unlink($categoryIcon);
            }
            if ($model->category_icon_thumbnail) {
                $categoryThumbnail = public_path() . "/" . self::PHOTOS_DIR . '/' . $model->id . '/' . $model->category_icon_thumbnail;
                @unlink($categoryThumbnail);
            }
			self::deleteCache($model);
        });
    }

    private static function deleteCache($model){
		Cache::forget('active-categories');

    }

    public function sub_categories(){
        return $this->hasMany('App\Models\SubCategory','category_id','id')->orderBy("name","asc");
    }


    public static function getCategoryList(){
        return Cache::rememberForever('active-categories', function () {
            $result = \App\Models\Category::with(['sub_categories'])->where(['status'=> 'Active'])->get();
            return $result;
        });
    }



    public function getThumbnailUrlAttribute()
    {
        if ($this->category_icon_thumbnail) {
            return asset(self::PHOTOS_DIR . "$this->id/$this->category_icon_thumbnail");
        } else {
            return asset('img/default.png');
        }
    }

    public function getImageUrlAttribute()
    {
        if ($this->category_icon) {
            return asset(self::PHOTOS_DIR . "$this->id/$this->category_icon");
        } else {
            return asset('img/default.png');
        }
    }
}
