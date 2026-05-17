<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class category_product extends Model
{  
    use HasFactory;
      
    protected $table = 'category_product';
  
    protected $fillable = [
        'product_id',
        'subcategory_id',
    ];
    
    public function product_subcategories()
    {
        return $this->belongsTo(product_subcategories::class , 'subcategory_id','id');
    }
    public function product()
    {
        return $this->belongsTo(product::class );
    }
    
}
