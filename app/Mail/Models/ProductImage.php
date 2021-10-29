<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use CommonHelper;
class ProductImage extends Model
{
    public $fillable = ['product_id', 'image', 'thumbnail'];
    const PRODUCT_TMP_DIR = "files/tmp/productImg/";
    const PRODUCT_DIR = "files/productImg/";
    protected $appends = ['thumbnail_url', 'image_url'];

    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            if ($model->image && file_exists(public_path() . "/" . self::PRODUCT_TMP_DIR . date('Y-m-d') . '/' . $model->image)) {
                $dir = public_path() . "/" . self::PRODUCT_DIR . $model->product_id;
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $newImage = $dir . '/' . $model->image;
                $tmpImage = public_path() . "/" . self::PRODUCT_TMP_DIR . date('Y-m-d') . '/' . $model->image;
                copy($tmpImage, $newImage);
                @unlink($tmpImage);
                //Move Thumbnail Image
                $newThumbnail = $dir . '/' . $model->thumbnail;
                $tmpThumbnail = public_path() . "/" . self::PRODUCT_TMP_DIR . date('Y-m-d') . '/' . $model->thumbnail;
                copy($tmpThumbnail, $newThumbnail);
                @unlink($tmpThumbnail);
            }
            self::deleteCache();
        });
        self::updating(function($model){
			self::deleteCache($model);
        });
        self::updated(function ($model) {
            if ($model->image && file_exists(public_path() . "/" . self::PRODUCT_TMP_DIR . date('Y-m-d') . '/' . $model->image)) {
                $dir = public_path() . "/" . self::PRODUCT_DIR . $model->product_id;
                // $OldFiles = scandir($dir);
                // dd($OldFiles);
                array_map('unlink', glob("$dir/*.*"));
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $newImage = $dir . '/' . $model->image;
                $tmpImage = public_path() . "/" . self::PRODUCT_TMP_DIR . date('Y-m-d') . '/' . $model->image;
                copy($tmpImage, $newImage);
                @unlink($tmpImage);
                //Move Thumbnail Image
                $newThumbnail = $dir . '/' . $model->thumbnail;
                $tmpThumbnail = public_path() . "/" . self::PRODUCT_TMP_DIR . date('Y-m-d') . '/' . $model->thumbnail;
                copy($tmpThumbnail, $newThumbnail);
                @unlink($tmpThumbnail);
            }
            self::deleteCache();
        });

        self::deleted(function ($model) {
            if ($model->image) {
                $productImage = public_path() . "/" . self::PRODUCT_DIR . '/' . $model->product_id . '/' . $model->image;
                @unlink($productImage);
            }
            if ($model->thumbnail) {
                $productThumbnail = public_path() . "/" . self::PRODUCT_DIR . '/' . $model->product_id . '/' . $model->thumbnail;
                @unlink($productThumbnail);
            }
            //rmdir(public_path()."/". self::PRODUCT_DIR . '/' .$model->product_id);
            self::deleteCache();
        });
    }

    public static function deleteCache()
    {
        foreach(CommonHelper::getLanguages() as $language => $locale){
            Cache::forget('best-offer-'.$locale);
            Cache::forget('active-products-'.$locale);
		}
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset(self::PRODUCT_DIR . "$this->product_id/$this->thumbnail");
        } else {
            return asset('img/default.png');
        }
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset(self::PRODUCT_DIR . "$this->product_id/$this->thumbnail");
        } else {
            return asset('img/default.png');
        }
    }
    public function getLargeImageUrlAttribute()
    {
        if ($this->image) {
            return asset(self::PRODUCT_DIR . "$this->product_id/$this->image");
        } else {
            return asset('img/default.png');
        }
    }

}
