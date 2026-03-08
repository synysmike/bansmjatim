<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('form_v2_config', function (Blueprint $table) {
            $table->boolean('signature_enabled')->default(true)->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('form_v2_config', function (Blueprint $table) {
            $table->dropColumn('signature_enabled');
        });
    }
};
