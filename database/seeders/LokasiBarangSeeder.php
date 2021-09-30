<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use App\Models\Lokasi;
use Database\Factories\LokasiBarangFactory;

class LokasiBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barang = Barang::firstWhere('id', 1);
        $lokasi = Lokasi::firstWhere('id', 1);
        $maks = Lokasi::firstWhere('id', 1);
        $barang->lokasi()->attach($lokasi, ['jumlah' => rand(1,20)]);
    }
}
