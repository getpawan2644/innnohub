<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Messages extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "messages";
    protected $fillable = [
        'parent_id', 'sender_id','message','status', 'customer_status', 'admin_status'
    ];
    public function sender(){
        return $this->belongsTo('\App\Models\User', 'sender_id');
    }
    public function parent(){
        return $this->belongsTo('\App\Models\ParentMessage', 'parent_id');
    }
    public static function getUnreadMessage(){
        $user_id=Auth::user()->id;
        $result = \App\Models\Messages::with("parent");
            $result->whereHas('parent', function(Builder $query) use($user_id){
                $query->where('customer_id',$user_id);
            })
            ->where(['sender_id'=> '0',"customer_status"=>"Pending"])->first();
        if($result->count()){
            return true;
        }else{
            return false;
        }
    }

}
