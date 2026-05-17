<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class about extends Model
{
    protected $table = 'abouts';
    protected $fillable = [
      'page',
    ];
}
