<?php

namespace Database\Seeders;

use App\Models\Gudang;
use App\Models\Mesin;
use Illuminate\Database\Seeder;

class MesinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gudang = Gudang::all();

        Mesin::create([
            'nama_mesin' => 'Mesin Pencukur Kumis',
            'id_gudang' => $gudang->random()?->id,
        ]);

        Mesin::create([
            'nama_mesin' => 'Mesin Penghilang Dosa',
            'id_gudang' => $gudang->random()?->id,
        ]);

        Mesin::create([
            'nama_mesin' => 'Mesin V60',
            'id_gudang' => $gudang->random()?->id,
        ]);

        Mesin::create([
            'nama_mesin' => 'Mesin Mining',
            'id_gudang' => $gudang->random()?->id,
        ]);
    }
}
