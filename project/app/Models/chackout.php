<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class chackout extends Model
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
        'last_login_at',
        'last_login_ip',
        'status',
        'created_at',
        'updated_at',
    ];
}
