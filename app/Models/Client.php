<?php

namespace App\Models;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;
use CommonHelper;
use Kyslik\ColumnSortable\Sortable;

class Client extends Model implements TranslatableContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use Sortable;
    const FLAG_PATH = "img/flag/";
    const CLIENT_LOGO_TMP_DIR = "files/tmp/clientImg/logo/";
    const CLIENT_LOGO_DIR = "files/clientImgs/logo";
    const ACTIVE = "Active";
	const INACTIVE = "Inactive";
    use Translatable;

	use \Kyslik\ColumnSortable\Sortable;

    public $translatedAttributes = ['slug', 'name', 'description'];

	public $sortable = ['id'];

    protected $fillable = ['logo','is_featured','website','url_name','status','logo_thumbnail','email','phone','dial_code','country_code','address','country','client_category_id','latitude','longitude','video_url','video_id'];
    protected $appends = ['logo_image_url','logo_thumbnail_url'];
	//protected $appends = ['flag_url'];


	public static function boot()
    {
        parent::boot();

        self::created(function($model){
//            dd($model);
            if ($model->logo && file_exists(public_path() . "/" . self::CLIENT_LOGO_TMP_DIR . date('Y-m-d') . '/' . $model->logo)) {
                $dir = public_path() . "/" . self::CLIENT_LOGO_DIR . $model->client_id;
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $newImage = $dir . '/' . $model->logo;

                $tmpImage = public_path() . "/" . self::CLIENT_LOGO_TMP_DIR . date('Y-m-d') . '/' . $model->logo;
                copy($tmpImage, $newImage);
                @unlink($tmpImage);
                //Move Thumbnail Image
                $newThumbnail = $dir . '/' . $model->logo_thumbnail;
                $tmpThumbnail = public_path() . "/" . self::CLIENT_LOGO_TMP_DIR . date('Y-m-d') . '/' . $model->logo_thumbnail;
                copy($tmpThumbnail, $newThumbnail);
                @unlink($tmpThumbnail);
            }
            self::deleteCache($model);
        });

        self::updating(function($model){
			self::deleteCache($model);
        });

        self::updated(function($model){
            if ($model->logo && file_exists(public_path() . "/" . self::CLIENT_LOGO_TMP_DIR . date('Y-m-d') . '/' . $model->logo)) {
                $dir = public_path() . "/" . self::CLIENT_LOGO_DIR .'/'. $model->id;
                // $OldFiles = scandir($dir);
//                 dd($dir);
                array_map('unlink', glob("$dir/*.*"));
                if (!file_exists($dir)) {
                   mkdir($dir, 0777, true);
                }
                $newImage = $dir . '/' . $model->logo;
                $tmpImage = public_path() . "/" . self::CLIENT_LOGO_TMP_DIR . date('Y-m-d') . '/' . $model->logo;
//                dd($tmpImage);
                copy($tmpImage, $newImage);
                @unlink($tmpImage);
                //Move Thumbnail Image
                $newThumbnail = $dir . '/' . $model->logo_thumbnail;
                $tmpThumbnail = public_path() . "/" . self::CLIENT_LOGO_TMP_DIR . date('Y-m-d') . '/' . $model->logo_thumbnail;
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
		foreach(CommonHelper::getLanguages() as $language => $locale){
            Cache::forget('best-offer-'.$locale);
            Cache::forget('active-clients-'.$locale);
            Cache::forget('active-products-'.$locale);
            Cache::forget('trending-product-'.$locale);
            Cache::forget('front-client-categories'.$locale);
            Cache::forget('front-featured-client-categories'.$locale);
		}
	}

    public function category(){
        return $this->belongsTo('App\Models\ClientCategory',"client_category_id");
    }

    public function ClientCategory(){
        return $this->belongsTo('App\Models\ClientCategory');
    }
    public function ClientTranslation(){
        return $this->hasMany('\App\Models\ClientTranslation', 'client_id', 'id');
    }
    public function ClientImage()
    {
        return $this->hasMany('\App\Models\ClientImage', 'client_id', 'id');
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
    public function getVideoUrlArrayAttribute()
    {
//        dd($this->video_url);
        if ($this->video_url) {
            return explode("~",$this->video_url);
        } else {
            return false;
        }
    }
    public function getVideoIdArrayAttribute()
    {
//        dd($this->video_id);
        if ($this->video_id) {
            return explode("~",$this->video_id);
        } else {
            return false;
        }
    }
    public function getLogoThumbnailUrlAttribute()
    {
//        dd(self::CLIENT_LOGO_DIR . "$this->id/$this->logo_thumbnail");
        if ($this->logo_thumbnail) {
            return asset(self::CLIENT_LOGO_DIR . "/".$this->id.'/'.$this->logo_thumbnail);
        } else {
            return asset('img/default.png');
        }
    }

    public function getLogoImageUrlAttribute()
    {
        if ($this->logo) {
            return asset(self::CLIENT_LOGO_DIR . "/".$this->id.'/'.$this->logo);
        } else {
            return asset('img/default.png');
        }
    }
    public static function fetchClientsByCategory($category_id)
    {
        $client=\App\Models\Client::where("status","Active")->whereHas("ClientCategory",function(Builder $query) use ($category_id){
            $query->where("id",$category_id);
        })->get();
//        dd($client);
        return $client;
    }
    public static function fetchFeaturedClientsByCategory($category_id)
    {
        $client=\App\Models\Client::where("status","Active")->where("is_featured","Active")->whereHas("ClientCategory",function(Builder $query) use ($category_id){
            $query->where("id",$category_id);
        })->get();
//        dd($client);
        return $client;
    }

}
