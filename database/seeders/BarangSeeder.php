<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nama_barang = ['Batik Jogja Coklat Muda','Batik Jogja Biru','Batik Jogja Kuning','Batik Jogja Merah','Batik Jogja Ungu','Batik Jogja Putih','Kain Abu-Abu','Kain Putih','Kain Biru Muda','Kain Hitam','Kain Songket Kuning','Kain Songket Coklat','Kain Merah','Kain Cotton Combed 30S Putih','Kain Cotton Combed 30S Hitam'];
        for($i = 0; $i < count($nama_barang); $i++) {
            Barang::create([
                'nama_barang' => $nama_barang[$i]
            ]);
        }
    }
}
