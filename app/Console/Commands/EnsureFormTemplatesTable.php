<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EnsureFormTemplatesTable extends Command
{
    protected $signature = 'form-templates:ensure-table';

    protected $description = 'Create form_templates table if it does not exist (e.g. when created by SQL on wrong database)';

    public function handle(): int
    {
        $db = config('database.default');
        $database = config("database.connections.{$db}.database");

        $this->info("Using database: {$database}");

        if (Schema::hasTable('form_templates')) {
            $this->info('Table form_templates already exists. Nothing to do.');
            return 0;
        }

        $this->warn('Table form_templates not found. Creating it now...');

        Schema::create('form_templates', function ($table) {
            $table->id();
            $table->string('name')->unique()->comment('Form name / identifier');
            $table->string('slug')->nullable()->unique()->comment('URL-friendly slug');
            $table->json('form_data')->nullable()->comment('formBuilder JSON definition');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $this->info('Table form_templates created.');

        // Register migration so "php artisan migrate" won't try to create it again
        $batch = (int) DB::table('migrations')->max('batch') + 1;
        DB::table('migrations')->insert([
            'migration' => '2026_01_30_000001_create_form_templates_table',
            'batch' => $batch,
        ]);
        $this->info('Migration recorded. Done.');

        return 0;
    }
}
