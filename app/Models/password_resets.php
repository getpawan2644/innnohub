<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class password_resets extends Model
{
    use Notifiable;
        protected $table = 'admin_password_resets';
        protected $guard = 'web';

        protected $fillable = [
            'email', 'token', 'created_at'
        ];

}
