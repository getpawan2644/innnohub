<?php

namespace App\Models;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

use CommonHelper;

class Appointment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use \Kyslik\ColumnSortable\Sortable;
    public $sortable = ['id', 'date', 'status'];

    protected $fillable = [
        'date','status'
    ];
    public function AppointmentSlot(){
        return $this->hasMany('\App\Models\AppointmentSlot','appointment_id','id');
    }
}
