<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Cache;

class CaseStudy extends Model
{
    use Sortable;
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';
   // const PHOTOS_DIR = "files/categoryImg/";

    
   // protected $appends = ['image_url'];
    protected $fillable = ['id','status','name','description','user_id'];
    public $sortable = ['id','status',"name"];

   

   /* public function getImageUrlAttribute()
    {
        if ($this->category_icon) {
            return asset(self::PHOTOS_DIR . "$this->id/$this->category_icon");
        } else {
            return asset('img/default.png');
        }
    }*/

    public function userData() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
