<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Models\SubCategory;

class Service extends Model
{
	 use Sortable;
    
    const IMAGE_PATH = '/service/';
	public $sortable = ['service_name']; 

    protected $fillable = [
        'service_name','description','user_id','logo','category','images','tag',
    ];

    public function userData() {
		  return $this->belongsTo('App\Models\User', 'user_id');
		}

		 public function category() {
		  return $this->belongsTo('App\Models\Category', 'category');
		}

		public function serviceCat() {
		  return $this->hasMany('App\Models\ServiceCategory', 'service');
		}

	


}
