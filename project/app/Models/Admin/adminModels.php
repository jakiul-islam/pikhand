<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;


class adminModels extends Model
{
    protected $table = 'admins';
  
    protected $fillable = [
        'name',
        'uuid',
        'email',
        'password',
        'role',
        'remember_token',
        'phone',
        'last_seen',
        'Profile',
        'otp',
        'last_login_at',
        'last_login_ip',
        'status',
        'created_at',
        'updated_at',
    ];
    

}

