<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
    protected $table = 'feedbacks';
  
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'ratingNumber',
        'massage',
    ];
}
