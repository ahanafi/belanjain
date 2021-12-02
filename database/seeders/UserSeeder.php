<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UserSeeder extends Seeder{

    public function run(){
        $faker = Faker::create('id_ID');
        $users = [
            [
                'nama' => 'Admin',
                'email' => 'admin@demo.com',
                'level' => 'admin',
                'email_verified_at' => now(),
                'password' => bcrypt('123456'), // password
                'remember_token' => Str::random(10),
            ],
            [
                'nama' => 'Staff',
                'email' => 'staff@demo.com',
                'level' => 'staff',
                'email_verified_at' => now(),
                'password' => bcrypt('123456'), // password
                'remember_token' => Str::random(10),
            ],
            [
                'nama' => 'Kepala Desa',
                'email' => 'kades@demo.com',
                'level' => 'kades',
                'email_verified_at' => now(),
                'password' => bcrypt('123456'), // password
                'remember_token' => Str::random(10),
            ],
        ];

        foreach($users as $user){
            User::updateOrCreate(['email' => $user['email']], $user);
        }

    }
}
