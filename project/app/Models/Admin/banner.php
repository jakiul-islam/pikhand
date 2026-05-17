<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    protected $table = 'banners';
    
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'link',
        'status',
    ];
    
}
