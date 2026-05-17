<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
   /* protected $fillable = [
        'name',
        'email',
        'password',
    ];*/

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];




    protected $table = 'users';

    protected $fillable = [
        'phone_number',
        'uuid',
        'country',
        'country_code',
        'password',
        'name',
        'google_id',
        'email',
        'otp_code',
        'status',
        'is_active',
        'Login_time',
        'Logout_time',
    ];







    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function crats()
    {
      return $this->hasMany(crats::class);
    }
    public function user_address()
    {
      return $this->hasMany(user_address::class);
    }
    public function order_item()
    {
      return $this->hasMany(order_item::class);
    }
    public function user_profile()
    {
      return $this->hasMany(user_profile::class);
    }
    public function product_reviews()
    {
      return $this->hasMany(product_reviews::class);
    }


}
