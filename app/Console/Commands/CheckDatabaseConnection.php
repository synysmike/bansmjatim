<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CheckDatabaseConnection extends Command
{
    protected $signature = 'db:check';

    protected $description = 'Cek koneksi database (default dan mysql2)';

    public function handle(): int
    {
        $connections = [
            config('database.default') => 'Database utama',
            'mysql2' => 'Database kedua (sinadita)',
        ];

        $allOk = true;

        foreach ($connections as $name => $label) {
            $this->line('');
            $this->info("Cek: {$label} (connection: {$name})");

            try {
                $conn = DB::connection($name);
                $conn->getPdo();
                $dbName = $conn->getDatabaseName();
                $conn->selectOne('SELECT 1');
                $this->info("  → OK. Database: {$dbName}");
            } catch (\Throwable $e) {
                $allOk = false;
                $this->error("  → GAGAL: " . $e->getMessage());
            }
        }

        $this->line('');

        return $allOk ? 0 : 1;
    }
}
