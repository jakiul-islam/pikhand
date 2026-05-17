<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class newsletter_containt extends Model
{
    protected $table = 'newsletter_containt';
    
    protected $fillable = [
        'title',
        'subtitle',
        'subtitle_2',
    ];
}
