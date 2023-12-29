<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestContract;
use App\Http\Requests\UpdateRequestContract;
use App\Models\CrudModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

abstract class CrudController extends Controller
{
    protected string $indexView;

    protected string $showView;

    protected string $createView;

    protected string $editView;

    protected string $indexPath;

    protected string $storeRequest = FormRequest::class;

    protected string $updateRequest = FormRequest::class;

    public function __construct()
    {
        app()->bind(StoreRequestContract::class, $this->storeRequest);
        app()->bind(UpdateRequestContract::class, $this->updateRequest);
    }

    abstract public function model(): Model;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view($this->indexView, [
            'data' => $this->model()->latest()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->createView);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequestContract $request)
    {
        DB::beginTransaction();

        try {

            $this->model()->newQuery()->create($request->validated());

            DB::commit();

            return redirect($this->indexPath)->with('status', 'Input data berhasil!');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e);
            report($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view($this->showView, [
            'data' => $this->model()
            ->newQuery()
            ->findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view($this->editView, [
            'data' => $this->model()
                ->newQuery()
                ->findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequestContract $request, string $id)
    {
        DB::beginTransaction();

        try {

            $model = $this->model()
                ->newQuery()
                ->findOrFail($id);

            $model->update($request->validated());
            $model->save();

            DB::commit();

            return redirect($this->indexPath)->with('status', 'Ubah data berhasil!');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e);
            report($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {

            $model = $this->model()
                ->newQuery()
                ->findOrFail($id);

            $model->delete();

            DB::commit();

            return redirect($this->indexPath)->with('status', 'Hapus data berhasil!');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e);
            report($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
