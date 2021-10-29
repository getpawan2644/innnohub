<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Cache;

class Multimedia extends Model
{
    use Sortable;
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';
    const PHOTOS_DIR = "multimediay/";
    protected $table = 'multimedia';

   
    protected $fillable = ['id','status','name','image','user_id'];
    public $sortable = ['id','status',"name","image"];
    protected $appends = ['image_url'];

   



   /* public function getThumbnailUrlAttribute()
    {
        if ($this->category_icon_thumbnail) {
            return asset(self::PHOTOS_DIR . "$this->id/$this->category_icon_thumbnail");
        } else {
            return asset('img/default.png');
        }
    }
*/
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset(self::PHOTOS_DIR . "/$this->image");
        } else {
            return asset('img/default.png');
        }
    }
    public function userData() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
