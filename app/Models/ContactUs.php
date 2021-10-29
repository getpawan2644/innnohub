<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use App\Helpers\CommonHelper;
use \Kyslik\ColumnSortable\Sortable;

class ContactUs extends Model
{


    protected $table = "contacts";

    protected $fillable = ['user_id','name','email','country_code','dial_code','mobile', 'message','status'];

//    protected $fillable = [
//        'user_id', 'name', 'dial_code', 'country_code', 'phone_number', 'email', 'message', 'status'
//    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    protected static function boot()
    {
        parent::boot();
    }
}



