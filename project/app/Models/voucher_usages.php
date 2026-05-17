<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class voucher_usages extends Model
{
  protected $table = 'voucher_usages';
  
    protected $fillable = [
        'user_id',
        'voucher_id',
        'order_id',
        'status',
        'used_at',
        'user_id',
    ];
}
