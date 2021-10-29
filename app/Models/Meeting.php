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
        'seller_id', 'buyer_id','message','status', 'service_id','seller_message','start_date','start_time','end_date','end_time','meeting_link'
    ];
     protected $appends = [
        'title','start','end','url'
    ];
    
    public function getTitleAttribute() {
       $user = Auth::user()->user_type;
       if($user == 'vendor'){
          $data = $this->belongsTo('App\Models\User', 'buyer_id')->first('first_name','last_name');
          if(!empty($data)){ 
           return $data['first_name'].' '.$data['last_name'];
                
           }else{
            return null;
           }

        }else{
            $data = $this->belongsTo('App\Models\User', 'seller_id')->first('first_name','last_name');
          if(!empty($data)){ 
           return $data['first_name'].' '.$data['last_name'];
                
           }else{
            return null;
           } 
        }
           
    }

     public function getUrlAttribute() {
        $user = Auth::user()->user_type;
       if($user != 'vendor'){
          return $this->meeting_link;
      }
           
    }

     public function getStartAttribute() {
          return $this->start_date.'T'.$this->start_time;
           
    }
     public function getEndAttribute() {
           return $this->end_date.'T'.$this->end_time;
    }
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
