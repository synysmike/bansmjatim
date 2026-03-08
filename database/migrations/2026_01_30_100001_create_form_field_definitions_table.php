<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_field_definitions', function (Blueprint $table) {
            $table->id();
            $table->string('nama_field', 100)->unique()->comment('Unique field key e.g. npsn, nama_lembaga');
            $table->string('tipe', 50)->comment('text, select, date, textarea, number, email');
            $table->string('label');
            $table->boolean('required')->default(false);
            $table->json('options')->nullable()->comment('For select: [{value, label}]');
            $table->string('placeholder')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_field_definitions');
    }
};
