<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_v2_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('link', 255)->index();
            $table->string('kategori')->nullable();
            $table->string('tanggal', 50)->nullable();
            $table->json('payload')->comment('Submitted form data key-value');
            $table->string('signature_path')->nullable()->comment('TTD file path in storage');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_v2_submissions');
    }
};
