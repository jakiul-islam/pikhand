<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class affiliate extends Model
{
    protected $table = 'affiliate';
  
    protected $fillable = [
        'user_id',
        'affiliate_code',
        'total_commission',
        'total_commission',
        'panding',
        'pad',
    ];
}
