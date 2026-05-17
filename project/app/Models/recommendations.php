<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class recommendations extends Model
{
    protected $table = 'recommendations';
    
    protected $fillable = [
        'user_id',
        'product_id',
        'recommended_product_id',
        'priority',
        'type',
    ];
}
