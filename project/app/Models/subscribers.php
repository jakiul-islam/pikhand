<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class subscribers extends Model
{
    protected $table = 'subscribers';
  
    protected $fillable = [
        'email',
        'ip',
        'user_agent',
        'subscribed_at',
    ];
}
