<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Admin\product;


class crats extends Model
{
    
        use HasFactory;

    
    
    
    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'ipAddress',
        'product_id',
        'product_price',
        'quantity',
        'coupon_code',
        'status',
    ];
    
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }
    
}
