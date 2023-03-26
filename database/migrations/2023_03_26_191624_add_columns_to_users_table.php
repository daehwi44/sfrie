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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('m_area_id')->after('id');
            $table->string('avatar')->nullable()->after('name');
            $table->string('gender')->nullable()->after('avatar');
            $table->integer('age')->nullable()->after('gender');
            $table->text('intro')->nullable()->after('age');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['m_area_id', 'avatar', 'gender', 'age', 'intro']);
        });
    }
};
