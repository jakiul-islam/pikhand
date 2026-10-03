<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class message extends Model
{

    use HasFactory, SoftDeletes;
    
    protected $table = 'messages';
  
    protected $fillable = [
        'uuid',
        'user_id',
        'product_id',
        'current_price',
        'requested_price',
        '1aa',
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
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function product()
      {
          return $this->belongsTo(Product::class, 'product_id');
      }

    /**
     * Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Check if message is from customer
     */
    public function isFromUser(): bool
    {
        return $this->sender_type === 'user';
    }

    /**
     * Check if message is from admin
     */
    public function isFromAdmin(): bool
    {
        return $this->sender_type === 'admin';
    }

    /**
     * Check if message is from bot
     */
    public function isFromBot(): bool
    {
        return $this->sender_type === 'bot';
    }
}
