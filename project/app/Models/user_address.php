<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class user_address extends Model
{
    protected $table = 'user_address';
  
    protected $fillable = [
        'user_id',
        'phone_number',
        'address',
        'name',
        'propoler_name',
        'home_office',
    ];
    
    
    
    use HasFactory;

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
