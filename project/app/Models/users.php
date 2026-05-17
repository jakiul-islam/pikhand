<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $table = 'users';
  
    protected $fillable = [
        'Phonenumber',
        'country',
        'countryCode',
        'password',
        'name',
        'email',
        'otp',
        'status',
        'active',
        'Logintime',
        'Logouttime',
    ];
}
