<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaintenanceRequest;
use App\Models\Maintenance;
use App\Models\Mesin;
use Illuminate\Database\Eloquent\Model;

class MaintenanceController extends CrudController
{
    protected string $indexView = 'maintenance.index';

    protected string $showView = 'maintenance.show';

    protected string $createView = 'maintenance.create';

    protected string $editView = 'maintenance.create';

    protected string $indexPath = '/maintenances';

    protected string $storeRequest = StoreMaintenanceRequest::class;

    protected string $updateRequest = StoreMaintenanceRequest::class;

    public function model(): Model
    {
        return new Maintenance();
    }

    public function create()
    {
        return view($this->createView, [
            'mesin' => Mesin::with('gudang')->get()
        ]);
    }

    public function edit(string $id)
    {
        return view($this->editView, [
            'data' => $this->model()
                ->newQuery()
                ->findOrFail($id),
            'mesin' => Mesin::with('gudang')->get()
        ]);
    }
}
