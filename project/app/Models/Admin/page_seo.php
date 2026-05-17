<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class page_seo extends Model
{
    protected $table = 'page_seo';
    
    
     protected $fillable = [
        'page_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
        'canonical_url',
        'robots_meta',
    ];
    
    
}
