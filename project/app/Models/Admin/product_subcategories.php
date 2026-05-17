<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product_subcategories extends Model
{
    use HasFactory;
    
    protected $table = 'product_subcategories';
  
    protected $fillable = [
        'name',
        'slug',
        'meta_title',
        'meta_description',
        'short_description',
        'long_description',
        'category_id',
        'image',
        'icon',
        'banner',
        'meta_keyword',
        'featured',
        'ordered',
        'status',
    ];
    
    
    public function category()
    {
        return $this->belongsTo(categories::class);
    }
    
    public function category_product()
    {
      return $this->hasMany(category_product::class);
    }
    
    
}
