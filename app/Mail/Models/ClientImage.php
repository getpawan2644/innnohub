<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use CommonHelper;
class ClientImage extends Model
{
    public $fillable = ['client_id', 'image', 'thumbnail'];
    const CLIENT_TMP_DIR = "files/tmp/clientImg/";
    const CLIENT_DIR = "files/clientImg/";
    protected $appends = ['thumbnail_url', 'image_url'];

    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            if ($model->image && file_exists(public_path() . "/" . self::CLIENT_TMP_DIR . date('Y-m-d') . '/' . $model->image)) {
                $dir = public_path() . "/" . self::CLIENT_DIR . $model->client_id;
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $newImage = $dir . '/' . $model->image;
                $tmpImage = public_path() . "/" . self::CLIENT_TMP_DIR . date('Y-m-d') . '/' . $model->image;
                copy($tmpImage, $newImage);
                @unlink($tmpImage);
                //Move Thumbnail Image
                $newThumbnail = $dir . '/' . $model->thumbnail;
                $tmpThumbnail = public_path() . "/" . self::CLIENT_TMP_DIR . date('Y-m-d') . '/' . $model->thumbnail;
                copy($tmpThumbnail, $newThumbnail);
                @unlink($tmpThumbnail);
            }
            self::deleteCache();
        });
        self::updating(function($model){
			self::deleteCache($model);
        });
        self::updated(function ($model) {
            //dd($model->image);die;
            if ($model->image && file_exists(public_path() . "/" . self::CLIENT_TMP_DIR . date('Y-m-d') . '/' . $model->image)) {
                $dir = public_path() . "/" . self::CLIENT_DIR . $model->client_id;
                // $OldFiles = scandir($dir);
                // dd($OldFiles);
                array_map('unlink', glob("$dir/*.*"));
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $newImage = $dir . '/' . $model->image;
                $tmpImage = public_path() . "/" . self::CLIENT_TMP_DIR . date('Y-m-d') . '/' . $model->image;
                copy($tmpImage, $newImage);
                @unlink($tmpImage);
                //Move Thumbnail Image
                $newThumbnail = $dir . '/' . $model->thumbnail;
                $tmpThumbnail = public_path() . "/" . self::CLIENT_TMP_DIR . date('Y-m-d') . '/' . $model->thumbnail;
                copy($tmpThumbnail, $newThumbnail);
                @unlink($tmpThumbnail);
            }
            self::deleteCache();
        });

        self::deleted(function ($model) {
            if ($model->image) {
                $clientImage = public_path() . "/" . self::CLIENT_DIR . '/' . $model->client_id . '/' . $model->image;
                @unlink($clientImage);
            }
            if ($model->thumbnail) {
                $clientThumbnail = public_path() . "/" . self::CLIENT_DIR . '/' . $model->client_id . '/' . $model->thumbnail;
                @unlink($clientThumbnail);
            }
            //rmdir(public_path()."/". self::CLIENT_DIR . '/' .$model->client_id);
            self::deleteCache();
        });
    }

    public static function deleteCache()
    {
        foreach(CommonHelper::getLanguages() as $language => $locale){
            //Cache::forget('best-offer-'.$locale);
            Cache::forget('active-clients-'.$locale);
		}
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset(self::CLIENT_DIR . "$this->client_id/$this->thumbnail");
        } else {
            return asset('img/default.png');
        }
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset(self::CLIENT_DIR . "$this->client_id/$this->image");
        } else {
            return asset('img/default.png');
        }
    }

}
