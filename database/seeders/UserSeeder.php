<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => fake()->name,
            'username' => 'admin',
            'password' => 'password',
            'id_jabatan' => Jabatan::firstWhere('nama_jabatan', 'Admin')?->id,
        ]);

        User::create([
            'nama' => fake()->name,
            'username' => 'petugas.gudang',
            'password' => 'password',
            'id_jabatan' => Jabatan::firstWhere('nama_jabatan', 'Petugas Gudang')?->id,
        ]);

        User::create([
            'nama' => fake()->name,
            'username' => 'kepala.lane',
            'password' => 'password',
            'id_jabatan' => Jabatan::firstWhere('nama_jabatan', 'Kepala Lane')?->id,
            'lane' => 'Lane 001',
        ]);

        User::create([
            'nama' => fake()->name,
            'username' => 'kepala.lane1',
            'password' => 'password',
            'id_jabatan' => Jabatan::firstWhere('nama_jabatan', 'Kepala Lane')?->id,
            'lane' => 'Lane 002',
        ]);

        User::create([
            'nama' => fake()->name,
            'username' => 'kepala.lane2',
            'password' => 'password',
            'id_jabatan' => Jabatan::firstWhere('nama_jabatan', 'Kepala Lane')?->id,
            'lane' => 'Lane 003',
        ]);
    }
}
