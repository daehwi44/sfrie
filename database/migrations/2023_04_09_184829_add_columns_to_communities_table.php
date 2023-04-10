<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('communities', function (Blueprint $table) {
            // 判定カラムを追加
            $table->tinyInteger('is_event')->default(0)->after('about');

            // 開催日カラムを追加
            $table->date('event_date')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('communities', function (Blueprint $table) {
            // 判定カラムを削除
            $table->dropColumn('is_event');

            // 開催日カラムを削除
            $table->dropColumn('event_date');
        });
    }
};
