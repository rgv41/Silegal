<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminTableSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AdminTableSeeder::class,
            UserSeeder::class
            // Seeder lain jika ada
        ]);
    }
}
