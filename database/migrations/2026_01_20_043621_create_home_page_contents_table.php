<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomePageContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique(); // hero_title, hero_description, welcome_title, welcome_message, etc.
            $table->string('section_name'); // Display name for admin
            $table->text('content')->nullable(); // Main content
            $table->string('image_path')->nullable(); // For images like mekanisme, hak_kewajiban
            $table->string('youtube_api_key')->nullable(); // YouTube API key
            $table->string('youtube_channel_id')->nullable(); // YouTube Channel ID
            $table->integer('max_youtube_results')->default(6); // Number of videos to show
            $table->integer('sort_order')->default(0); // For ordering sections
            $table->boolean('is_active')->default(true); // To enable/disable sections
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
        Schema::dropIfExists('home_page_contents');
    }
}
