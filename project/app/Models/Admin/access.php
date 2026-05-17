<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class access extends Model
{
    protected $table = 'access';
  
    protected $fillable = [
        'pagename',
        'access',
        'admin_uuid',
    ];
}
