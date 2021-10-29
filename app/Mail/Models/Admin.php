<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordLink;
use Kyslik\ColumnSortable\Sortable;

class Admin extends Authenticatable
{
    const PROFILE_PIC_PATH = "img/admin/avatar/";
    const ADMIN="Admin";
    const SUBADMIN="Sub-Admin";

    use Notifiable;
    use Sortable;
    //use \Kyslik\ColumnSortable\Sortable;
    protected $guard = 'admin';

    protected $appends = ['profile_pic_url'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $sortable = ['name','email','phone','role'];
    protected $fillable = [
        'name', 'email','role','password','profile_pic','phone','modules'
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

    /**
     * Send a password reset email to the user
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordLink($token));
    }

    public function getProfilePicUrlAttribute(){
        $profilePic = $this->attributes['profile_pic'];
        if($profilePic){
            if(file_exists(public_path(self::PROFILE_PIC_PATH.$profilePic))){
                return asset(self::PROFILE_PIC_PATH.$profilePic);
            }
        }
        return asset('img/admin/default/avatar.png');
    }
    public function subadminpermissions(){
        return $this->hasMany('App\Model\SubAdminPermissions', 'admin_id');
    }
}
