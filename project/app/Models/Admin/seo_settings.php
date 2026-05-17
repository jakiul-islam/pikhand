<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class seo_settings extends Model
{
    protected $table = 'seo_settings';
  
    protected $fillable = [
        'site_name',
        'site_tagline',
        'default_meta_title',
        'default_meta_description',
        'default_og_image',
        'favicon',
        'google_analytics_id',
        'google_search_console',
        'bing_webmaster',
        'schema_organization',
    ];
}
