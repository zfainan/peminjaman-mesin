<?php

namespace Database\Seeders;

use App\Enums\JabatanEnum;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(JabatanSeeder::class);

        User::create([
            'nama' => fake()->name,
            'username' => 'admin',
            'password' => 'password',
            'id_jabatan' => Jabatan::firstWhere('nama_jabatan',  JabatanEnum::ADMIN->value)?->id_,
        ]);

        User::create([
            'nama' => fake()->name,
            'username' => 'petugas.gudang',
            'password' => 'password',
            'id_jabatan' => Jabatan::firstWhere('nama_jabatan',  JabatanEnum::PETUGAS_GUDANG->value)?->id_,
        ]);

        User::create([
            'nama' => fake()->name,
            'username' => 'kepala.lane',
            'password' => 'password',
            'id_jabatan' => Jabatan::firstWhere('nama_jabatan',  JabatanEnum::KEPALA_LANE->value)?->id_,
            'lane' => 'Lane 001',
        ]);

        User::create([
            'nama' => fake()->name,
            'username' => 'kepala.lane1',
            'password' => 'password',
            'id_jabatan' => Jabatan::firstWhere('nama_jabatan', JabatanEnum::KEPALA_LANE->value)?->id_,
            'lane' => 'Lane 002',
        ]);

        User::create([
            'nama' => fake()->name,
            'username' => 'kepala.lane2',
            'password' => 'password',
            'id_jabatan' => Jabatan::firstWhere('nama_jabatan', JabatanEnum::KEPALA_LANE->value)?->id_,
            'lane' => 'Lane 003',
        ]);
    }
}
