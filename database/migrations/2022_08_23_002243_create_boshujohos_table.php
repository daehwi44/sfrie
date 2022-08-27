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
        Schema::create('boshujohos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('m_area_id');
            $table->foreignId('m_category_id');
            $table->string('content');
            $table->text('body');
            $table->text('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boshujohos');
    }
};
