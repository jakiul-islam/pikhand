<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use App\Models\Admin\product;

class order_item extends Model
{
    use HasFactory;

    protected $table = 'order_item';
  
    protected $fillable = [
        'user_id',
        'product_id',
        'order_id',
        'quantity',
        'method',
        'unit_price',
        'total_price',
        'discount',
    ];
    
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }
    public function order()
    {
        return $this->belongsTo(order::class);
    }
}
