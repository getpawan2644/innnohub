<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Kyslik\ColumnSortable\Sortable;
use App\Helpers\CommonHelper;

class Vendor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use Sortable;
    const FLAG_PATH = "img/flag/";
    const VENDOR_LOGO_TMP_DIR = "files/tmp/vendorImg/logo/";
    const VENDOR_LOGO_DIR = "files/vendorImg/logo";
    const ACTIVE = "Active";
    const INACTIVE = "Inactive";
    use Translatable;
    public $translatedAttributes = [];
    use \Kyslik\ColumnSortable\Sortable;
    public $sortable = ['id',"name","code","country_code","status"];
    protected $fillable = ['id','logo','logo_thumbnail','name','website','status','comment','email','phone','dial_code','country_code','code','country_id',"url_name"];
    protected $appends = ['logo_image_url','logo_thumbnail_url'];
    //protected $appends = ['flag_url'];


    public static function boot()
    {
        parent::boot();

        self::created(function($model){
            //dd($model);
            if ($model->logo && file_exists(public_path() . "/" . self::VENDOR_LOGO_TMP_DIR . date('Y-m-d') . '/' . $model->logo)) {
                $dir = public_path() . "/" . self::VENDOR_LOGO_DIR . $model->id;
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $newImage = $dir . '/' . $model->logo;

                $tmpImage = public_path() . "/" . self::VENDOR_LOGO_TMP_DIR . date('Y-m-d') . '/' . $model->logo;
                copy($tmpImage, $newImage);
                @unlink($tmpImage);
                //Move Thumbnail Image
                $newThumbnail = $dir . '/' . $model->logo_thumbnail;
                $tmpThumbnail = public_path() . "/" . self::VENDOR_LOGO_TMP_DIR . date('Y-m-d') . '/' . $model->logo_thumbnail;
                copy($tmpThumbnail, $newThumbnail);
                @unlink($tmpThumbnail);
            }
            self::deleteCache($model);
        });

        self::updating(function($model){
            self::deleteCache($model);
        });

        self::updated(function($model){
            if ($model->logo && file_exists(public_path() . "/" . self::VENDOR_LOGO_TMP_DIR . date('Y-m-d') . '/' . $model->logo)) {
                $dir = public_path() . "/" . self::VENDOR_LOGO_DIR . $model->id;
                // $OldFiles = scandir($dir);
                // dd($OldFiles);
                array_map('unlink', glob("$dir/*.*"));
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $newImage = $dir . '/' . $model->logo;
                $tmpImage = public_path() . "/" . self::VENDOR_LOGO_TMP_DIR . date('Y-m-d') . '/' . $model->logo;
                copy($tmpImage, $newImage);
                @unlink($tmpImage);
                //Move Thumbnail Image
                $newThumbnail = $dir . '/' . $model->logo_thumbnail;
                $tmpThumbnail = public_path() . "/" . self::VENDOR_LOGO_TMP_DIR . date('Y-m-d') . '/' . $model->logo_thumbnail;
                copy($tmpThumbnail, $newThumbnail);
                @unlink($tmpThumbnail);
            }
            self::deleteCache($model);
        });
        static::deleting(function($model) {
            self::deleteCache($model);
        });
        self::deleted(function($model){
            self::deleteCache($model);
        });
    }

    public static function clients(){
        $clients = Client::where('status','Active')->get();
        return $clients;
    }
    private static function deleteCache($model){
        Cache::forget('active-vendors-with-code');
    }

    public function country(){
        return $this->belongsTo('App\Models\Country');
    }

    public function getImageAttribute()
    {
        return $this->ClientImage()->first();
    }
    public static function latestActiveClients(){
        return Cache::rememberForever('active-clients-'.app()->getLocale(), function () {
            $clients = Client::where('status', \App\Models\Client::ACTIVE)->orderBy('id', 'DESC')->limit(20)->get();
            //dd($clients->toArray());
            return $clients;
        });
    }
    public function getVendorCodeAttribute()
    {
        //dd($this->logo_thumbnail);
        if ($this->country_code && $this->code) {
            return strtoupper($this->country_code."-".$this->code);
        } else {
            return "N/A";
        }
    }
    public function getLogoThumbnailUrlAttribute()
    {
        //dd($this->logo_thumbnail);
        if ($this->logo_thumbnail) {
            return asset(self::VENDOR_LOGO_DIR . "$this->id/$this->logo_thumbnail");
        } else {
            return asset('img/default.png');
        }
    }
    public function getLogoImageUrlAttribute()
    {
        if ($this->logo) {
            return asset(self::VENDOR_LOGO_DIR . "$this->id/$this->logo");
        } else {
            return asset('img/default.png');
        }
    }
    public static function getVendorList(){
            $result = \App\Models\Vendor::where(['status'=> 'Active'])->get();
            return $result;
    }
}
