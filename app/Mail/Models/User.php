<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Kyslik\ColumnSortable\Sortable;
use App\Notifications\UserResetPassword;
use App\Notifications\UserResetPasswordByAdmin;
use Laravel\Passport\HasApiTokens;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
    use Notifiable;
    use Sortable;
    use HasApiTokens;
    //use \Kyslik\ColumnSortable\Sortable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $sortable = ['id','status','first_name','email',"mobile"];
    protected $appends = ['full_name'];
    protected $fillable = [
        'first_name', 'last_name', 'email','dial_code', 'mobile','password','gender', 'status','country_code','country_id','company_size','job_title','company_name','industry','category_id','subcategory_id','user_type','image','fundind_type','number_of_acquisitions','number_of_investments','number_of_exits','funding_amount','number_of_team_members','number_of_investors','headquarter','founded_date','founders','opreating_status','lang','legal_name','hub','stock_symbol','company_type','contact_email','link','address','description'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token,$admin=null)
    {
        if($admin){
            $this->notify(new UserResetPasswordByAdmin($token));
        }else{
            $this->notify(new UserResetPassword($token));
        }

    }

//    public function sendPasswordResetNotificationByAdmin($token)
//    {
//        $this->notify(new UserResetPasswordByAdmin($token));
//    }


    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function country(){
        return $this->belongsTo('\App\Models\Country','country_id','id');
    }

    public function servicesData() {
          return $this->belongsTo('App\Models\Service');
        }

}
