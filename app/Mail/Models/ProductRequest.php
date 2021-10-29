<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use CommonHelper;
class ProductRequest extends Model
{
    use \Kyslik\ColumnSortable\Sortable;

    public $fillable = ['prod_req_number','status','quantity','user_id', 'product_slug','product_id', 'name', 'dial_code', 'country_code', 'phone_number', 'email', 'comments'];
    public $sortable = ['id','prod_req_number','created_at'];

    public function user(){
        return $this->belongsTo('\App\Models\User','user_id','id');
    }
    public function product(){
        return $this->belongsTo('\App\Models\Product','product_id','id');
    }
}
