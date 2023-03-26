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
        Schema::create('communities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('m_area_id')->constrained('m_areas');
            $table->foreignId('m_category_id')->constrained('m_categories');
            $table->foreignId('m_learning_content_id')->constrained('m_learning_contents');
            $table->string('name');
            $table->string('image');
            $table->text('content');
            $table->text('about');
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
        Schema::dropIfExists('communities');
    }
};
