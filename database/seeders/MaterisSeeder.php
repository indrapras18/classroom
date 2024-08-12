<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materisData = [];

        for ($i = 1; $i <= 20; $i++) {
            $materisData[] = [
                'nama_materi' => 'Materi ' . $i,
                'content' => 'PHP (Hypertext Preprocessor) adalah bahasa skrip yang berjalan di sisi server dan dirancang khusus untuk pengembangan web. PHP digunakan untuk membuat halaman web yang dinamis dan interaktif. PHP dapat disisipkan ke dalam HTML, yang memungkinkan pengembang web untuk menulis kode PHP di antara tag HTML.' . $i,
                'link' => 'https://youtu.be/l1W2OwV5rgY?si=zUl4N9emwV3pEigN' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('materis')->insert($materisData);
    }
}
