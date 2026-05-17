<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class used_affiliate extends Model
{
    protected $table = 'used_affiliate';
  
    protected $fillable = [
        'affiliate_id',
        'refaret_user_id',
        'order_id',
        'total_order',
        'total_commission',
    ];
}
