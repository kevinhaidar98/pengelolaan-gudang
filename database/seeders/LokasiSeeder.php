<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lokasi;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        $nama_lokasi = ['A1','A2','A3','A4','A5','B1','B2','B3','B4','B5','C1','C2','C3','C4','C5','D1','D2','D3','D4','D5','E1','E2','E3','E4','E5',];
        for($i = 0; $i < 25; $i++) {
            Lokasi::create([
                'nama_letak' => $nama_lokasi[$i],
                'kapasitas' => 20 
            ]);
        }
    }
}
