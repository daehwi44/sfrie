<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // 20件のデータを作成する
        for ($i = 0; $i < 20; $i++) {
            DB::table('users')->insert([
                'name' => $this->generateJapaneseName(),
                'm_area_id' => rand(1, 47),
                'm_category_id' => rand(1, 11),
                'avatar' => '',
                'email' => 'test' . $i . '@test.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    private function generateJapaneseName()
    {
        $first_names = ['太郎', '花子', '次郎', '三郎', '美咲', '雅子', '健太', '拓海', 'かおり', '裕子', '健司', '優子', '聡太', 'みさき', '桃子', '遥', '静香', '直人', '亜紀', '春香'];
        $last_names = ['佐藤', '鈴木', '高橋', '田中', '渡辺', '伊藤', '山本', '中村', '小林', '加藤', '吉田', '山田', '斎藤', '松本', '井上', '木村', '林', '清水', '山口', '阿部'];
        return $last_names[rand(0, 19)] . ' ' . $first_names[rand(0, 19)];
    }
}
