<?php

namespace Database\Seeders;

use App\Enums\JabatanEnum;
use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jabatan::firstOrCreate([
            'nama_jabatan' => JabatanEnum::ADMIN->value
        ]);

        Jabatan::firstOrCreate([
            'nama_jabatan' => JabatanEnum::PETUGAS_GUDANG->value
        ]);

        Jabatan::firstOrCreate([
            'nama_jabatan' => JabatanEnum::KEPALA_LANE->value
        ]);
    }
}
