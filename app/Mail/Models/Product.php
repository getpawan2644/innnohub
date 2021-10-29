<?php

namespace App\Models;
use App\Models\InviteReview;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
//use App\Models\InviteReview;

use CommonHelper;

class Product extends Model implements TranslatableContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    const FLAG_PATH = "img/flag/";
    const PRODUCT_TMP_DIR = "files/tmp/productImg/";
    const PRODUCT_DIR = "files/productImg/";
    const ACTIVE = "Active";
	const INACTIVE = "Inactive";
    use Translatable;

	use \Kyslik\ColumnSortable\Sortable;

    public $translatedAttributes = ['product_title', 'product_details', 'product_description'];

	public $sortable = ['id',"status",'trending_sale','best_offer'];

    protected $fillable = [
        'client_id','show_price','slug','price','category_slug','subcategory_id','status','youtube_url', 'best_offer','trending_sale','discount_percent','vendor_id','country_code','vendor_code','category_code','sub_category_code',"code","video_id","final_discount_price","display_discount"
    ];

	//protected $appends = ['flag_url'];


	public static function boot()
    {
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
        static::deleting(function($model) {
            self::deleteCache($model);
        });
        self::deleted(function($model){
			self::deleteCache($model);
        });
    }

    private static function deleteCache($model){
		foreach(CommonHelper::getLanguages() as $language => $locale){
            Cache::forget('best-offer-'.$locale);
            Cache::forget('active-products-'.$locale);
            Cache::forget('trending-product-'.$locale);
		}
	}

    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_slug', 'slug');
    }
    public function vendor(){
        return $this->belongsTo('App\Models\Vendor', 'vendor_id', 'id');
    }

    public function subcategory(){
        return $this->belongsTo('App\Models\SubCategory', 'subcategory_id', 'id');
    }
    public function ProductTranslation(){
        return $this->hasMany('\App\Models\ProductTranslation', 'product_id', 'id');
    }
    public function ProductImage()
    {
        return $this->hasMany('\App\Models\ProductImage', 'product_id', 'id')->orderBy("image_order")->orderBy("id");
    }

    public function latestImage()
    {
        return $this->hasOne('\App\Models\ProductImage', 'product_id', 'id')->orderBy("featured","DESC")->orderBy("id");;
    }
    public function getProductCodeAttribute()
    {
        return $this->country_code.$this->vendor_code.$this->category_code.$this->sub_category_code.$this->code;
    }
    public function getImageAttribute()
    {
        return $this->ProductImage()->first();
    }
    public static function fetchBestOffer(){
        return Cache::rememberForever('best-offer-'.app()->getLocale(), function () {
            $products = Product::select([
                'products.*',
                'rating' => InviteReview::selectRaw('IFNULL(CEIL(AVG(rating)),0)')
                        ->whereColumn('product_slug', 'products.slug')->whereNotNull('rating')
            ])->with(['category', 'latestImage', 'favorite'])
                ->whereHas('category', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })->whereHas('subcategory', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })->where(function($query){
                    $query->orWhereHas('client', function (Builder $query) {
                        $query->where('clients.status', '=', 'Active');
                    });
                    $query->orWhereNull('products.client_id');
                })
                ->whereHas('vendor', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })->whereHas('vendor.country', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })
                ->where('status', 'Active')->where('best_offer','Active')->orderBy('view_count', 'DESC')->limit(1000)->get();
            return $products;
        });
    }
    public static function allActiveProducts(){
        return Cache::rememberForever('active-products-'.app()->getLocale(), function () {
            $products = Product::select([
                'products.*',
                'rating' => InviteReview::selectRaw('IFNULL(CEIL(AVG(rating)),0)')
                        ->whereColumn('product_slug', 'products.slug')->whereNotNull('rating')
            ])->with(['category', 'latestImage', 'favorite'])->where('status', 'Active')->orderBy('view_count', 'DESC')->limit(1000)->get();
            return $products;
        });
    }
    public static function fetchTrendingProducts(){

        return Cache::rememberForever('trending-product-'.app()->getLocale(), function () {
            $products = Product::select([
                'products.*',
                'rating' => InviteReview::selectRaw('IFNULL(CEIL(AVG(rating)),0)')
                        ->whereColumn('product_slug', 'products.slug')->whereNotNull('rating')
            ])->with(['category', 'latestImage', 'favorite'])
                ->whereHas('category', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })->whereHas('subcategory', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })->where(function($query){
                    $query->orWhereHas('client', function (Builder $query) {
                        $query->where('clients.status', '=', 'Active');
                    });
                    $query->orWhereNull('products.client_id');
                })
                ->whereHas('vendor', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })->whereHas('vendor.country', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })
                ->where('status', 'Active')->where('trending_sale','Active')->orderBy('view_count', 'DESC')->limit(8)->get();
            return $products;
        });
    }
    public static function fetchProductsByCategory($slug=null,$trending_offer="trending_sale"){
            if($slug){
            $products = Product::select([
                'products.*',
                'rating' => InviteReview::selectRaw('IFNULL(CEIL(AVG(rating)),0)')
                    ->whereColumn('product_slug', 'products.slug')->whereNotNull('rating')
            ])->with(['category', 'latestImage', 'favorite'])
                ->whereHas('category', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })->whereHas('subcategory', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })->where(function($query){
                    $query->orWhereHas('client', function (Builder $query) {
                        $query->where('clients.status', '=', 'Active');
                    });
                    $query->orWhereNull('products.client_id');
                })
                ->whereHas('vendor', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })->whereHas('vendor.country', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })
                ->where('status', 'Active')->where($trending_offer,'Active')->where('category_slug',$slug)->orderBy('view_count', 'DESC')->limit(8)->get();
                return $products;
            }else{
                return null;
            }

    }

    public function favorite(){
        $authId = !empty(Auth::guard("api")->id())?Auth::guard("api")->id():Auth::id();
        //$authId = Auth::id();
        return $this->hasOne(SaveFavorite::class,'product_id','id')->where('user_id', $authId)->where('status',1);
    }
    public function client(){
        return $this->belongsTo('\App\Models\Client', 'client_id','id');
    }
    public function getDiscountPriceAttribute(){
        $discount_price=null;
        if(!empty($this->discount_percent) && !empty($this->price)){
            $discount_price=number_format(($this->price*(100-number_format($this->discount_percent,0)))/100,0);
        }
        return $discount_price;
    }

}
