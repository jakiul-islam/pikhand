<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminActivity extends Model
{
    protected $table = 'admin_activities';
  
    protected $fillable = [
        'admin_uuid',
        'activity_type',
        'activity_details',
        'activity_time',
        'ip_address',
        'browser',
        'attachment',
    ];
}
