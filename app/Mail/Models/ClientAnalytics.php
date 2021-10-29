<?php
namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use CommonHelper;

class ClientAnalytics extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    use \Kyslik\ColumnSortable\Sortable;

    public $sortable = ['id'];
    protected $table = 'client_analytics';
    protected $fillable = ['user_id','user_name','client_id','client_title','user_email','user_number','number_of_visits','client_category','client_email'];

    //protected $appends = ['flag_url'];


    public static function boot()
    {
        parent::boot();

    }
}
