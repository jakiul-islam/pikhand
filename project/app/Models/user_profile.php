<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class user_profile extends Model
{    
    
    use HasFactory;
    
    protected $table = 'user_profile';
  
    protected $fillable = [
        'phone',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'date_of_birth',
        'gender',
        'profile_picture',
        'bio',
        'social_links',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
}
