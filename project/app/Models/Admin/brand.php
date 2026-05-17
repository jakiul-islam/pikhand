<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    protected $table = 'brands';
    
    protected $fillable = [
      'name',
      'slug',
      'meta_title',
      'meta_keyword',
      'meta_description',
      'description',
      'logo',
      'status',
    ];
}
