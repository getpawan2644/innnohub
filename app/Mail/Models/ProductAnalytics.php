<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAnalytics extends Model
{
    use \Kyslik\ColumnSortable\Sortable;

    public $sortable = ['id'];
    protected $table = 'product_analytics';
    protected $fillable = ['user_id','user_name','product_id','product_title','user_email','user_number','number_of_visits','product_category','product_sub_category'];

    public static function boot()
    {
        parent::boot();

    }
    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

}
