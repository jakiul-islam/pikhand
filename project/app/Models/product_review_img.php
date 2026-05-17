<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class product_review_img extends Model
{  
  
      use HasFactory;
    protected $table = 'product_review_img';
  
    protected $fillable = [
        'img',
        'reviews_id',
        'user_id',
        'product_id',
    ];
    
    public function product_reviews()
    {
        return $this->belongsTo(product_reviews::class);
    }
    
}
