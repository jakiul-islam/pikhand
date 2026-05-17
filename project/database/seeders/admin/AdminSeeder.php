<?php

namespace Database\Seeders\admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\adminModels;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      adminModels::create([
        'name' => 'Admin',  //write your name 
        'uuid' => Str::uuid(),
        'email' => 'jakiuli21624@gmail.com', //write your email
        'password' => bcrypt('123456789'), //write a storng password 
        'role' => 'super_admin',
        'remember_token' => 'Null',
        'phone' => '01605583872',   //write your phone number 
        'last_seen' => Carbon::now(),
        'Profile' => 'Null',
        'otp' => 'Null',
        'last_login_ip' => 'Null',
        'status' => 1,
        'created_at' => Carbon::now(),
      ]);
    }
}
