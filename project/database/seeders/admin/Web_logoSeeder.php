<?php

namespace Database\Seeders\admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Admin\web_logo;

class Web_logoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        web_logo::create([
          'name' => 'picklet',
          'logo' => 'logo/62UoAUQReL92HdncJYI72dyfKhfo0DwXGcbg9ONp.png',
        ]);
    }
}
