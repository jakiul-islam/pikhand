<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class message extends Model
{

    use HasFactory, SoftDeletes;
    
    protected $table = 'message';
  
    protected $fillable = [
        'uuid',
        'gust_uuid',
        'user_id',
        'product_id',
        'current_price',
        'requested_price',
        'Message',
        'status',
        'approved_price',
        'admin_uuid',
        'admin_note',
        'responded_at',
    ];

 

    /**
     * Customer
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Admin
     */
    public function admin()
    {
        return $this->belongsTo(admin::class, 'admin_id');
    }

    
    
    /**
     * Product
     */
    public function productForId()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function product()
      {
          return $this->belongsTo(Product::class);
      }

    /**
     * Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
