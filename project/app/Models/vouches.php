<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vouches extends Model
{
    protected $table = 'vouches';
  
    protected $fillable = [
        'code',
        'type',
        'amount',
        'min_order_amount',
        'usage_limit',
        'used_count',
        'is_active',
        'starts_at',
        'created_by',
        'softDeletes',
    ];
}
