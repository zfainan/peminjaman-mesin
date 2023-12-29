<?php

namespace App\Http\Controllers;

use App\Enums\JabatanEnum;
use App\Http\Requests\StoreGudangRequest;
use App\Models\Gudang;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class GudangController extends CrudController
{
    protected string $indexView = 'gudang.index';

    protected string $showView = 'gudang.create';

    protected string $createView = 'gudang.create';

    protected string $editView = 'gudang.create';

    protected string $indexPath = '/warehouses';

    protected string $storeRequest = StoreGudangRequest::class;

    protected string $updateRequest = StoreGudangRequest::class;

    public function model(): Model
    {
        return new Gudang();
    }

    public function create()
    {
        $idJabatanPetugas = Jabatan::firstWhere('nama_jabatan', JabatanEnum::PETUGAS_GUDANG->value)?->id;

        return view($this->createView, [
            'petugas' => User::where('id_jabatan', $idJabatanPetugas)->get()
        ]);
    }

    public function edit(string $id)
    {
        $idJabatanPetugas = Jabatan::firstWhere('nama_jabatan', JabatanEnum::PETUGAS_GUDANG->value)?->id;

        return view($this->editView, [
            'data' => $this->model()
                ->newQuery()
                ->findOrFail($id),
            'petugas' => User::where('id_jabatan', $idJabatanPetugas)->get()
        ]);
    }
}
