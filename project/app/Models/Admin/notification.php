<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{   
  
    protected $table = 'Notifications_for_user';
  
    protected $fillable = [
        'title',
        'message', 
        'type',
        'icon',
        'url',
        'user_id',
        'created_by',
        'read_at'
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
    }
}
