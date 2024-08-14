<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                'name'=>'Mas Admin',
                'email'=>'admin@gmail.com',
                'role'=>'Guru',
                'password'=>bcrypt('123456'),
            ],
        ];

        foreach($userData as $key => $val){
            User::create($val);
        }

        for ($i = 1; $i <= 20; $i++) {
            User::create([
                'name' => 'Siswa ' . $i,
                'email' => 'student' . $i . '@gmail.com',
                'role' => 'Siswa',
                'password' => bcrypt('12121212'),
                'id_kelas' => 1,
            ]);
        }
    }
}
