<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoshujohoSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('ja_JP');

        for ($i = 0; $i < 20; $i++) {
            DB::table('boshujohos')->insert([
                'user_id' => rand(1, 10),
                'm_area_id' => rand(1, 47),
                'm_category_id' => rand(1, 11),
                'title' => $faker->realText(20),
                'content' => $faker->realText(10),
                'body' => $faker->realText(),
                'image' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
