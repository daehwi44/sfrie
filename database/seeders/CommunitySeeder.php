<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CommunitySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ja_JP');
        for ($i = 0; $i < 20; $i++) {
            DB::table('communities')->insert([
                'user_id' => rand(1, 10),
                'm_area_id' => rand(1, 47),
                'm_category_id' => rand(1, 11),
                'name' => $faker->realText(10),
                'image' => '',
                'content' => $faker->realText(10),
                'about' => $faker->realText(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
