<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        $roleId = Role::all()->pluck('id')->toArray();
        $username=['superadmin','adminmasuk1','adminkeluar1','pemilik'];
        for ($i = 0; $i < 4; $i++) {
            User::create([ 
                'id_role' => $roleId[$i],
                'username' => $username[$i],
                'password' => Hash::make('password'),    // password
                'nama' => $faker->name,
                'telepon' => $faker->phoneNumber,
                'alamat' => $faker->address,
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
