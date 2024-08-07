<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'Guru',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'Siswa 1',
            'email' => 'student1@gmail.com',
            'role' => 'Siswa',
            'password' => bcrypt('password'),
        ]);
    }
}
