<?php
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(User::class, function (Faker $faker){
    return [
        'id_role' => '1',
        'username' => $faker->unique(),
        'password' => bcrypt('12345678'),
        'nama' => $faker->name(),
        'telepon' => $faker->phoneNumber(),
        'alamat' => $faker->address,
        //'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
