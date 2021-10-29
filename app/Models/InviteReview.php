<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InviteReview extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "invite_reviews";
    protected $fillable = [
        'prod_req_id','user_id','name','email','product_slug', 'rating', 'comment','token'
    ];
    
    public function product(){
        return $this->belongsTo('\App\Models\Product','product_slug','slug');
    }
    
}
