<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use CommonHelper;

class SaveFavorite extends Model
{
	
	const ACTIVE = "Active";
	const INACTIVE = "Inactive";
	const PRELIMINARY = 'Preliminary';

	use \Kyslik\ColumnSortable\Sortable;
	public $table = "save_favorites";
	public $sortable = ['id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id','user_id','status'];

	
	public static function boot()
    {
        parent::boot();
		
        self::created(function($model){
            
        });

        self::updating(function($model){
            $status = $model->getOriginal('status');
            $model->status  = !$status;
        });

        self::saving(function($model){
           $model->status  = !($model->status);
        });

        self::updated(function($model){
			
        });

        self::deleted(function($model){
			
        });
    }
    
	public function product() {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
	
}