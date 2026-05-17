<?php

namespace Database\Seeders\admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\password_policie;

class Password_policieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      password_policie::create([
        'policy_name' =>'defolt',
        'min_length'  => 6 ,
        'max_length'  => 16 ,
        'require_uppercase'=>true,
        'require_numbers'=>true,
        'require_special_chars'=>true,
        'password_expiration_days'=>30,
        'password_history'=>5,
        
      ]);
    }
}
