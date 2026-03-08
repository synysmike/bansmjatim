<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_v2_config', function (Blueprint $table) {
            $table->id();
            $table->string('link', 255)->unique()->comment('URL slug e.g. url_form');
            $table->string('judul');
            $table->string('kategori')->nullable();
            $table->json('field_names')->comment('Ordered array of nama_field from form_field_definitions');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_v2_config');
    }
};
