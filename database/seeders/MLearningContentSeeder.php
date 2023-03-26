<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MLearningContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 語学
        $languages = [
            ['category_id' => 1, 'content' => '英語'],
            ['category_id' => 1, 'content' => 'フランス語'],
            ['category_id' => 1, 'content' => 'ドイツ語'],
            ['category_id' => 1, 'content' => 'スペイン語'],
            ['category_id' => 1, 'content' => 'ポルトガル語'],
            ['category_id' => 1, 'content' => 'イタリア語'],
            ['category_id' => 1, 'content' => '中国語'],
            ['category_id' => 1, 'content' => '韓国語'],
            ['category_id' => 1, 'content' => '日本語'],
        ];
        DB::table('m_learning_contents')->insert($languages);

        // ビジネススキル
        $businessSkills = [
            ['category_id' => 2, 'content' => 'プレゼンテーションスキル'],
            ['category_id' => 2, 'content' => 'コミュニケーションスキル'],
            ['category_id' => 2, 'content' => 'プロジェクトマネジメント'],
            ['category_id' => 2, 'content' => 'ビジネスマナー'],
            ['category_id' => 2, 'content' => 'コンサルティングスキル'],
            ['category_id' => 2, 'content' => 'リーダーシップ'],
            ['category_id' => 2, 'content' => 'マーケティング'],
            ['category_id' => 2, 'content' => '営業スキル'],
        ];
        DB::table('m_learning_contents')->insert($businessSkills);

        // マネジメント
        $managements = [
            ['category_id' => 3, 'content' => 'リーダーシップ'],
            ['category_id' => 3, 'content' => 'プロジェクトマネジメント'],
            ['category_id' => 3, 'content' => 'タイムマネジメント'],
            ['category_id' => 3, 'content' => 'コミュニケーションスキル'],
            ['category_id' => 3, 'content' => 'チームビルディング'],
            ['category_id' => 3, 'content' => '人事マネジメント'],
            ['category_id' => 3, 'content' => 'リスクマネジメント'],
            ['category_id' => 3, 'content' => '品質マネジメント'],
        ];
        DB::table('m_learning_contents')->insert($managements);

        // 経済・政治・社会
        $economics = [
            ['category_id' => 4, 'content' => '経済学'],
            ['category_id' => 4, 'content' => '政治学'],
            ['category_id' => 4, 'content' => '社会学'],
            ['category_id' => 4, 'content' => '法学'],
            ['category_id' => 4, 'content' => '国際関係'],
            ['category_id' => 4, 'content' => '政治哲学'],
            ['category_id' => 4, 'content' => 'エネルギー政策'],
            ['category_id' => 4, 'content' => '環境政策'],
        ];
        DB::table('m_learning_contents')->insert($economics);

        // お金・FP
        $fp = [
            ['category_id' => 5, 'content' => '貯蓄・投資'],
            ['category_id' => 5, 'content' => '確定拠出年金'],
            ['category_id' => 5, 'content' => '生命保険・医療保険'],
            ['category_id' => 5, 'content' => '相続・贈与'],
            ['category_id' => 5, 'content' => '税金・節税'],
            ['category_id' => 5, 'content' => '不動産投資'],
            ['category_id' => 5, 'content' => '資産運用'],
            ['category_id' => 5, 'content' => 'ファイナンシャルプランニング'],
        ];
        DB::table('m_learning_contents')->insert($fp);

        // 会計
        $accountings = [
            ['category_id' => 6, 'content' => '簿記'],
            ['category_id' => 6, 'content' => '会計基礎'],
            ['category_id' => 6, 'content' => '会計情報の分析'],
            ['category_id' => 6, 'content' => '管理会計'],
            ['category_id' => 6, 'content' => '監査'],
            ['category_id' => 6, 'content' => '税務'],
            ['category_id' => 6, 'content' => '会計システム'],
            ['category_id' => 6, 'content' => '会計法'],
        ];
        DB::table('m_learning_contents')->insert($accountings);

        // OAスキル
        $oaSkills = [
            ['category_id' => 7, 'content' => 'Excel'],
            ['category_id' => 7, 'content' => 'Word'],
            ['category_id' => 7, 'content' => 'PowerPoint'],
            ['category_id' => 7, 'content' => 'Access'],
            ['category_id' => 7, 'content' => 'Visio'],
            ['category_id' => 7, 'content' => 'Project'],
            ['category_id' => 7, 'content' => 'Outlook'],
            ['category_id' => 7, 'content' => 'OneNote'],
        ];
        DB::table('m_learning_contents')->insert($oaSkills);

        // プログラミング
        $programmings = [
            ['category_id' => 8, 'content' => 'Java'],
            ['category_id' => 8, 'content' => 'Python'],
            ['category_id' => 8, 'content' => 'Ruby'],
            ['category_id' => 8, 'content' => 'C++'],
            ['category_id' => 8, 'content' => 'PHP'],
            ['category_id' => 8, 'content' => 'JavaScript'],
            ['category_id' => 8, 'content' => 'Swift'],
            ['category_id' => 8, 'content' => 'Objective-C'],
        ];
        DB::table('m_learning_contents')->insert($programmings);

        // WEBデザイン
        $webDesigns = [
            ['category_id' => 9, 'content' => 'HTML'],
            ['category_id' => 9, 'content' => 'CSS'],
            ['category_id' => 9, 'content' => 'JavaScript'],
            ['category_id' => 9, 'content' => 'jQuery'],
            ['category_id' => 9, 'content' => 'Vue.js'],
            ['category_id' => 9, 'content' => 'AngularJS'],
            ['category_id' => 9, 'content' => 'React'],
            ['category_id' => 9, 'content' => 'Adobe XD'],
        ];
        DB::table('m_learning_contents')->insert($webDesigns);

        // グラフィックデザイン
        $graphicDesigns = [
            ['category_id' => 10, 'content' => 'Photoshop'],
            ['category_id' => 10, 'content' => 'Illustrator'],
            ['category_id' => 10, 'content' => 'InDesign'],
            ['category_id' => 10, 'content' => 'Premiere Pro'],
            ['category_id' => 10, 'content' => 'After Effects'],
            ['category_id' => 10, 'content' => 'Lightroom'],
            ['category_id' => 10, 'content' => 'CorelDRAW'],
            ['category_id' => 10, 'content' => 'GIMP'],
        ];
        DB::table('m_learning_contents')->insert($graphicDesigns);

        // 写真・映像
        $photography = [
            ['category_id' => 11, 'content' => 'ポートレート写真'],
            ['category_id' => 11, 'content' => '風景写真'],
            ['category_id' => 11, 'content' => 'ストリート写真'],
            ['category_id' => 11, 'content' => 'イベント撮影'],
            ['category_id' => 11, 'content' => '商品撮影'],
            ['category_id' => 11, 'content' => 'ドローン映像'],
            ['category_id' => 11, 'content' => '映画制作'],
            ['category_id' => 11, 'content' => 'アニメーション制作'],
        ];
        DB::table('m_learning_contents')->insert($photography);

        // 音楽・楽器
        $music = [
            ['category_id' => 12, 'content' => 'ピアノ'],
            ['category_id' => 12, 'content' => 'ギター'],
            ['category_id' => 12, 'content' => 'ベース'],
            ['category_id' => 12, 'content' => 'ドラム'],
            ['category_id' => 12, 'content' => 'ヴォーカル'],
            ['category_id' => 12, 'content' => '楽曲制作'],
            ['category_id' => 12, 'content' => 'DTM'],
            ['category_id' => 12, 'content' => 'DJ'],
        ];
        DB::table('m_learning_contents')->insert($music);

        // 料理・食べ物
        $cooking = [
            ['category_id' => 13, 'content' => '料理の基本'],
            ['category_id' => 13, 'content' => '調理器具の使い方'],
            ['category_id' => 13, 'content' => '料理の技術'],
            ['category_id' => 13, 'content' => 'スイーツ作り'],
            ['category_id' => 13, 'content' => '給食・栄養学'],
            ['category_id' => 13, 'content' => '食材の選び方'],
            ['category_id' => 13, 'content' => 'ワインの選び方'],
            ['category_id' => 13, 'content' => '地産地消'],
        ];
        DB::table('m_learning_contents')->insert($cooking);

        // 健康・美容
        $health = [
            ['category_id' => 14, 'content' => 'ピラティス'],
            ['category_id' => 14, 'content' => 'ダンスエクササイズ'],
            ['category_id' => 14, 'content' => 'ストレッチ'],
            ['category_id' => 14, 'content' => 'メンタルヘルス'],
            ['category_id' => 14, 'content' => 'スキンケア'],
            ['category_id' => 14, 'content' => 'ヘアアレンジ'],
        ];
        DB::table('m_learning_contents')->insert($health);

        // スポーツ・フィットネス
        $sports = [
            ['category_id' => 15, 'content' => 'フットサル'],
            ['category_id' => 15, 'content' => 'バスケットボール'],
            ['category_id' => 15, 'content' => 'バレーボール'],
            ['category_id' => 15, 'content' => 'テニス'],
            ['category_id' => 15, 'content' => '野球'],
            ['category_id' => 15, 'content' => 'ランニング'],
            ['category_id' => 15, 'content' => 'ヨガ'],
            ['category_id' => 15, 'content' => '筋トレ'],
        ];
        DB::table('m_learning_contents')->insert($sports);


        // 趣味・アウトドア
        $hobbies = [
            ['category_id' => 16, 'content' => '料理'],
            ['category_id' => 16, 'content' => '園芸'],
            ['category_id' => 16, 'content' => 'DIY'],
            ['category_id' => 16, 'content' => '旅行'],
            ['category_id' => 16, 'content' => 'ペット'],
            ['category_id' => 16, 'content' => 'アウトドア'],
            ['category_id' => 16, 'content' => '絵画'],
            ['category_id' => 16, 'content' => '文具'],
        ];
        DB::table('m_learning_contents')->insert($hobbies);



        // 学問・教養
        $education = [
            ['category_id' => 17, 'content' => '歴史'],
            ['category_id' => 17, 'content' => '文学'],
            ['category_id' => 17, 'content' => '数学'],
            ['category_id' => 17, 'content' => '物理学'],
            ['category_id' => 17, 'content' => '化学'],
            ['category_id' => 17, 'content' => '生物学'],
            ['category_id' => 17, 'content' => '地理学'],
            ['category_id' => 17, 'content' => '心理学'],
        ];
        DB::table('m_learning_contents')->insert($education);

        // その他
        $others = [
            ['category_id' => 18, 'content' => '芸術'],
            ['category_id' => 18, 'content' => 'ゲーム制作'],
            ['category_id' => 18, 'content' => '読書'],
            ['category_id' => 18, 'content' => '写真館経営'],
            ['category_id' => 18, 'content' => '異文化理解'],
            ['category_id' => 18, 'content' => '外交'],
            ['category_id' => 18, 'content' => '語学翻訳'],
            ['category_id' => 18, 'content' => '翻訳'],
        ];
        DB::table('m_learning_contents')->insert($others);
    }
}
