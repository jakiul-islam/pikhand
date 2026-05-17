<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class categories extends Model
{
    
     use HasFactory;
    
    protected $table = 'categories';
  
    protected $fillable = [
        'name',
        'slug',
        'meta_title',
        'meta_description',
        'short_description',
        'description',
        'image',
        'icon',
        'banner',
        'order',
        'meta_keywords',
        'featured',
        'status',
    ];
    
    public function subcategory()
    {
        return $this->hasMany(product_subcategories::class,'category_id');
    }
    
}
