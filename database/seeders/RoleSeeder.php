<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = ['Super Admin','Admin Masuk','Admin Keluar','Pemilik'];
        for ($i=0; $i < 4; $i++) {
	    	Role::create([
	            'role' => $role[$i],
	            'created_at'=>date("Y-m-d H:i:s")
	        ]);
    	}
             $this->command->info("Insert Role Berhasil");
    }
}
