<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class feature_switche extends Model
{
    protected $table = 'feature_switches';
  
    protected $fillable = [
        'key',
        'name',
        'is_active',
        'description',
    ];
}
