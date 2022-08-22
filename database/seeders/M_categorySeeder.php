<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class M_categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            ['id' => 1, 'category' => '語学'],
            ['id' => 2, 'category' => 'ビジネススキル'],
            ['id' => 3, 'category' => 'マネジメント'],
            ['id' => 4, 'category' => '経済・政治・社会'],
            ['id' => 5, 'category' => 'お金・FP'],
            ['id' => 6, 'category' => '会計'],
            ['id' => 7, 'category' => 'OAスキル'],
            ['id' => 8, 'category' => 'プログラミング'],
            ['id' => 9, 'category' => 'WEBデザイン'],
            ['id' => 10, 'category' => 'デザイン・アート'],
            ['id' => 11, 'category' => 'その他'],
        ];
        DB::table('m_categories')->insert($params);
    }
}
