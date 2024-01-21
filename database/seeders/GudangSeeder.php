<?php

namespace Database\Seeders;

use App\Models\Gudang;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Database\Seeder;

class GudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatan = Jabatan::firstWhere('nama_jabatan', 'Petugas Gudang');
        $petugas = User::where('id_jabatan', $jabatan?->id_)->get();

        Gudang::create([
            'nama_gudang' => 'Gudang ' . fake()->company,
            'lokasi_gudang' => fake()->address,
            'id_petugas_gudang' => $petugas->random()?->id,
        ]);

        Gudang::create([
            'nama_gudang' => 'Gudang ' . fake()->company,
            'lokasi_gudang' => fake()->address,
            'id_petugas_gudang' => $petugas->random()?->id,
        ]);
    }
}
