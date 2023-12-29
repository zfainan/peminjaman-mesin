<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserController extends CrudController
{
    protected string $indexView = 'users.index';

    protected string $showView = 'users.create';

    protected string $createView = 'users.create';

    protected string $editView = 'users.create';

    protected string $indexPath = '/users';

    protected string $storeRequest = StoreUserRequest::class;

    protected string $updateRequest = StoreUserRequest::class;

    public function model(): Model
    {
        return new User();
    }

    public function create()
    {
        return view($this->createView, [
            'jabatan' => Jabatan::all()
        ]);
    }

    public function edit(string $id)
    {
        return view($this->editView, [
            'data' => $this->model()
                ->newQuery()
                ->findOrFail($id),
            'jabatan' => Jabatan::all()
        ]);
    }
}
