<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMesinRequest;
use App\Models\Gudang;
use App\Models\Mesin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class MesinController extends CrudController
{
    protected string $indexView = 'mesin.index';

    protected string $showView = 'mesin.create';

    protected string $createView = 'mesin.create';

    protected string $editView = 'mesin.create';

    protected string $indexPath = '/engines';

    protected string $storeRequest = StoreMesinRequest::class;

    protected string $updateRequest = StoreMesinRequest::class;

    public function model(): Model
    {
        return new Mesin();
    }

    public function create()
    {
        return view($this->createView, [
            'gudang' => Gudang::all()
        ]);
    }

    public function edit(string $id)
    {
        return view($this->editView, [
            'data' => $this->model()
                ->newQuery()
                ->findOrFail($id),
            'gudang' => Gudang::all()
        ]);
    }
}
