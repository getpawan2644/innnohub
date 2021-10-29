<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use CommonHelper;
use Illuminate\Support\Facades\Cache;


class Advertisement extends Model
{

	use \Astrotomic\Translatable\Translatable;
	use \Kyslik\ColumnSortable\Sortable;
    const IMAGE_PATH = '/images/advertisement/';
    const IMAGE_TMP_DIR = "files/tmp/advertisementImg/logo/";
	public $table = "advertisements";

	public $translatedAttributes = ['title'];
    protected $appends = ['image_url'];
	protected $fillable = ['image','url','status','image_thumbnail'];

	public static function boot()
    {
        parent::boot();

        self::created(function($model){
            //dd($dir);
            if ($model->image && file_exists(public_path() . "/" . self::IMAGE_TMP_DIR . date('Y-m-d') . '/' . $model->image)) {
                $dir = public_path() . "/" . self::IMAGE_PATH . $model->client_id;

                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $newImage = $dir . '/' . $model->image;

                $tmpImage = public_path() . "/" . self::IMAGE_TMP_DIR . date('Y-m-d') . '/' . $model->image;
                copy($tmpImage, $newImage);
                @unlink($tmpImage);
                //Move Thumbnail Image
                $newThumbnail = $dir . '/' . $model->image_thumbnail;
                $tmpThumbnail = public_path() . "/" . self::IMAGE_TMP_DIR . date('Y-m-d') . '/' . $model->image_thumbnail;
                copy($tmpThumbnail, $newThumbnail);
                @unlink($tmpThumbnail);
            }
            self::deleteCache();
        });

        self::updated(function($model){
            if ($model->image && file_exists(public_path() . "/" . self::IMAGE_TMP_DIR . date('Y-m-d') . '/' . $model->image)) {
                $dir = public_path() . "/" . self::IMAGE_PATH . $model->client_id;
                // $OldFiles = scandir($dir);
                // dd($OldFiles);
                array_map('unlink', glob("$dir/*.*"));
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $newImage = $dir . '/' . $model->image;
                $tmpImage = public_path() . "/" . self::IMAGE_TMP_DIR . date('Y-m-d') . '/' . $model->image;
                copy($tmpImage, $newImage);
                @unlink($tmpImage);
                //Move Thumbnail Image
                $newThumbnail = $dir . '/' . $model->image_thumbnail;
                $tmpThumbnail = public_path() . "/" . self::IMAGE_TMP_DIR . date('Y-m-d') . '/' . $model->image_thumbnail;
                copy($tmpThumbnail, $newThumbnail);
                @unlink($tmpThumbnail);
            }
			self::deleteCache();
        });

        self::deleted(function($model){
			self::deleteCache();
        });

    }

    private static function deleteCache(){
		foreach(CommonHelper::getLanguages() as $language => $locale){
			Cache::forget('advertisement-'.$locale);
		}
	}
    public function getImageThumbnailUrlAttribute()
    {
        //dd($this->image_thumbnail);
        if ($this->image_thumbnail) {
            return asset(self::IMAGE_PATH . "$this->client_id/$this->image_thumbnail");
        } else {
            return asset('img/card2.png');
        }
    }


    public function getImageUrlAttribute()
    {
        if(isset($this->image) && !empty($this->image)){
            return asset("/images/advertisement/".$this->image);
        }else{
            return asset("/images/advertisement/card2.png");
            return false;
        }
    }
    public static function getAdvertisements(){
        return Cache::rememberForever('advertisement-'.app()->getLocale(), function () {
            return Advertisement::where(['status'=>'Active'])->withTranslation()->get();
        });
    }
}
