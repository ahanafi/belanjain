<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=1; $i<=30; $i++) {
            Item::create([
               'name' => $faker->randomLetter(),
                'brand' => $faker->lastName(),
                'purchase_price' => $faker->randomNumber(4),
                'selling_price' => $faker->randomNumber(4)
            ]);
        }
    }
}
