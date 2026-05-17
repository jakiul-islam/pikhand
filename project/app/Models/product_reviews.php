<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Admin\product;

class product_reviews extends Model
{
  
    use HasFactory;

    protected $table = 'product_reviews';
  
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'title',
        'review',
        'verified_purchase',
        'status',
    ];
    
    
    
    public function product()
    {
        return $this->belongsTo(product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function product_review_img()
    {
      return $this->hasMany(product_review_img::class , 'id','reviews_id');
    }
}
