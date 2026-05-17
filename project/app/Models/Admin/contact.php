<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    protected $table = 'contacts'
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'replied_at',
        'replied_by',
    ]
}
