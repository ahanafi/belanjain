<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=1; $i <= 50; $i++) {
            Customer::create([
                'name' => $faker->name,
                'phone' => $faker->phoneNumber
            ]);
        }
    }
}
