<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class notification extends Model
{
    use HasFactory;
    protected $table = 'Notifications_for_user';
    protected $fillable = [
       'title',
        'message',
        'type',
        'url',
        'icon',
        'user_id',
        'created_by',
        'read_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
