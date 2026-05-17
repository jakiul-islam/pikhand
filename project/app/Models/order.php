<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class order extends Model
{
    
    use HasFactory;
    
    protected $table = 'orders';
  
    protected $fillable = [
        'order_number',
        'user_id',
        'subtotal',
        'discount',
        'shipping_cost',
        'total',
        'status',
        'order_address_id',
        'delivery_address_id',
        'payment_method',
        'payment_status',
        'tracking_number',
    ];
    
    
    
    public function order_item()
    {
      return $this->hasMany(order_item::class);
    }
    public function payments()
    {
      return $this->hasMany(payments::class);
    }
    
    
    
    
    

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function order_address()
    {
        return $this->belongsTo(user_address::class);
    }
    
    public function delivery_address()
    {
        return $this->belongsTo(user_address::class);
    }
    
    
}
