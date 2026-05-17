<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class password_policie extends Model
{
    protected $table = 'password_policies';
    
    protected $fillable = [
        'policy_name',
        'min_length',
        'require_uppercase',
        'require_numbers',
        'require_special_chars',
        'password_expiration_days',
        'password_history',
    ];
}
