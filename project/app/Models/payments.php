<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class payments extends Model
{   
    use HasFactory;

    protected $table = 'payments';
  
    protected $fillable = [
        'user_id',
        'order_id',
        'amount',
        'currency',
        'method',
        'status',
        'transaction_id',
        'payload',
        'captured_at',
    ];
    
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(order::class);
    }
}
