<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMediaFieldsToHomePageContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_page_contents', function (Blueprint $table) {
            $table->string('media_type')->nullable()->after('image_path'); // 'video', 'youtube', 'image'
            $table->string('media_url')->nullable()->after('media_type'); // YouTube URL or video URL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_page_contents', function (Blueprint $table) {
            $table->dropColumn(['media_type', 'media_url']);
        });
    }
}
