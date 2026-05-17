<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class policie extends Model
{
    protected $table = 'policies';
    
    protected $fillable = [
       'page'
    ];
}
