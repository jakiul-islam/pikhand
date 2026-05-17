<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class table_product_imgs extends Model
{
      use HasFactory;

    protected $table = 'table_product_imgs';
  
    protected $fillable = [
        'product_id',
        'images',
    ];
    
    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
