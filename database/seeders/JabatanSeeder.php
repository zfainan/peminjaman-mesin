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
        Jabatan::create([
            'nama_jabatan' => JabatanEnum::ADMIN->value
        ]);

        Jabatan::create([
            'nama_jabatan' => JabatanEnum::PETUGAS_GUDANG->value
        ]);

        Jabatan::create([
            'nama_jabatan' => JabatanEnum::KEPALA_LANE->value
        ]);
    }
}
