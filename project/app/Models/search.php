<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class search extends Model
{
    protected $table = 'search';
  
    protected $fillable = [
        'user_id',
        'keyword',
        'filters',
        'ip_address',
        'user_agent',
    ];
}
