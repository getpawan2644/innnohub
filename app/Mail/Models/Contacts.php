<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use CommonHelper;


class Contacts extends Model
{
    use \Kyslik\ColumnSortable\Sortable;

    public $table = "contacts";

    public $sortable = ['name','phone_number','email','status'];

    protected $fillable = [
        'user_id', 'name','dial_code','country_code','phone_number','email','message','status'
    ];

    protected static function boot()
    {
        parent::boot();
    }
}