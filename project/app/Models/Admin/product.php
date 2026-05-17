<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\product_reviews;
use App\Models\crats;
use App\Models\order_item;

use Database\Factories\Admin\ProductFactory;


class product extends Model
{
    use HasFactory;

    protected $table = 'products';
  
    protected $fillable = [
      'name',
      'slug',
      'mata_title',
      'category_id',
      'brand_id',
      'mata_description',
      'short_description',
      'long_description',
      'price',
      'discount',
      'stock',
      'total_sales',
      'image',
      'product_code',
      'sku',
      'weight',
      'dimensions',
      'color',
      'size',
      'material',
      'warranty',
      'return_policy',
      'rating',
      'status',
    ];
    
    public function order_item()
    {
      return $this->hasMany(order_item::class);
    }
    
    public function crats()
    {
      return $this->hasMany(crats::class);
    }
    
    public function product_img()
    {
      return $this->hasMany(table_product_imgs::class);
    }
    
    public function product_reviews()
    {
      return $this->hasMany(product_reviews::class);
    }
    
    public function category_product()
    {
      return $this->hasMany(category_product::class);
    }
    
}
