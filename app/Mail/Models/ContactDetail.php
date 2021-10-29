<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Cache;

class ContactDetail extends Model
{
    use Sortable;
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';

    protected $attributes = [
        'status' => self::ACTIVE,
    ];
    protected $fillable = ['id','phone_number', 'email','address','fax','latitude','longitude'];
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

        static::deleting(function($model) {
        });
        self::deleted(function($model){
			self::deleteCache($model);
        });
    }

    private static function deleteCache($model){
		Cache::forget('contact-details');
    }

    public static function getContactDetail(){
        return Cache::rememberForever('contact-details', function () {
            $result = \App\Models\ContactDetail::get()->first();
            return $result;
        });
    }
}
