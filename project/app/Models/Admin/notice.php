<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class notice extends Model
{
    protected $table = 'notices';
  
    protected $fillable = [
        'title',
        'description',
        'created_by',
        'is_active',
    ];
}
