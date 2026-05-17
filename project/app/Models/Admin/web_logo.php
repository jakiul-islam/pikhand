<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class web_logo extends Model
{
   protected $table = 'web_logos';
   
   
    protected $fillable  = [
      'name',
      'logo'
    ];
   
}
