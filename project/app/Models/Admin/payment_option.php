<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class payment_option extends Model
{
    protected $table = 'payment_options';
  
    protected $fillable = [
        'key',
        'name',
        'is_active',
    ];
}
