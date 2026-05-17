<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\admin\product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Seeders\admin\AboutSeeder;
use Database\Seeders\admin\Web_logoSeeder;
use Database\Seeders\admin\Password_policieSeeder;
use Database\Seeders\admin\AdminSeeder;
use Database\Seeders\admin\PolicieSeeder;
use Database\Seeders\admin\HelpSeeder;
use Database\Seeders\Admin\seo_setting;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

      $this->call([
            AboutSeeder::class,    // ৩. About Page
            AdminSeeder::class, // ১. ক্যাটাগরি আগে
            Web_logoSeeder::class,    // ২. ব্র্যান্ড আগে
            PolicieSeeder::class,    // ২. ব্র্যান্ড আগে
            Password_policieSeeder::class,    // ২. ব্র্যান্ড আগে
            HelpSeeder::class,    // ২. ব্র্যান্ড\আগে
            seo_setting::class
        ]);


      User::factory(50)->create();
      product::factory(50)->create();
      User::factory()->create([
          'name' => 'Test User',
          'email' => 'test@example.com',
      ]);
    }
}
