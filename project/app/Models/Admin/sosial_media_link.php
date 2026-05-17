<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class sosial_media_link extends Model
{
    protected $table = 'sosial_media_links';
    
    protected $fillable = [
      'type',
      'url',
      'icon',
      'name',
    ];
}
