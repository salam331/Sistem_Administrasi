<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Pembayaran;
use App\Models\Presensi;
use App\Models\Siswa;
use App\Models\SuratKeluar;
use App\Models\Tagihan;
use App\Models\User;

class ClearDatabaseExceptRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-database-except-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all data from database tables except the roles table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->confirm('Are you sure you want to clear all data except roles? This action cannot be undone.')) {
            $this->info('Operation cancelled.');
            return;
        }

        $this->info('Clearing database data...');

        // List of models to clear (excluding Role)
        $models = [
            Guru::class,
            Jadwal::class,
            Kelas::class,
            Mapel::class,
            Nilai::class,
            Pembayaran::class,
            Presensi::class,
            Siswa::class,
            SuratKeluar::class,
            Tagihan::class,
            User::class,
        ];

        foreach ($models as $model) {
            $table = (new $model)->getTable();
            $this->info("Clearing table: {$table}");
            DB::table($table)->truncate();
        }

        $this->info('All data cleared except roles.');
    }
}
