<?php

namespace App\Models;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use \Kyslik\ColumnSortable\Sortable;
use CommonHelper;

class AppointmentSlot extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use sortable;
    public $sortable = ['id',"from_time","to_time"];

    protected $fillable = [
        'appointment_id','from_time','to_time','status'
    ];

    public function Appointment(){
        return $this->belongsTo('\App\Models\Appointment','appointment_id','id');
    }
    public function user(){
        return $this->belongsTo('\App\Models\User','booked_by', 'id');
    }
}
