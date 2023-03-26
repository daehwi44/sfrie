<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MCategorySeeder extends Seeder
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
            ['id' => 10, 'category' => 'グラフィックデザイン'],
            ['id' => 11, 'category' => '写真・映像'],
            ['id' => 12, 'category' => '音楽・楽器'],
            ['id' => 13, 'category' => '料理・食べ物'],
            ['id' => 14, 'category' => '健康・美容'],
            ['id' => 15, 'category' => 'スポーツ・フィットネス'],
            ['id' => 16, 'category' => '趣味・アウトドア'],
            ['id' => 17, 'category' => '学問・教養'],
            ['id' => 18, 'category' => 'その他'],
        ];
        DB::table('m_categories')->insert($params);
    }
}
