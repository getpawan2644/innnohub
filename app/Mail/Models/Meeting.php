<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kyslik\ColumnSortable\Sortable;

class Meeting extends Model
{
	 use Sortable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //public $table = "messages";
    public $sortable = ['seller_id']; 

    protected $fillable = [
        'seller_id', 'buyer_id','message','status', 'service_id','seller_message'
    ];

    public function userData() {
		  return $this->belongsTo('App\Models\User', 'buyer_id');
	}

	public function sellerData() {
		  return $this->belongsTo('App\Models\User', 'seller_id');
	}

	public function serviceData() {
		  return $this->belongsTo('App\Models\Service', 'service_id');
	}
 

}
