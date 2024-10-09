<?php

namespace App\Http\Controllers;

use App\Models\Mesin;
use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Peminjaman::with(['mesin.gudang', 'peminjam'])
            ->orderByRaw('tgl_kembali IS NULL DESC')
            ->orderBy('tgl_pinjam', 'desc');

        return view('peminjaman.all', [
            'data' => $data->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $keyword = $request->input('search');

        $query = Mesin::with('borrowed');

        if ($keyword) {
            $query->where('nama_mesin', 'like', "%$keyword%");
        }

        $engines = $query->paginate()->withQueryString();

        return view('peminjaman.select-mesin', [
            'dataMesin' => $engines
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_mesin' => 'required|exists:mesin,id',
        ]);

        $mesin = Mesin::whereDoesntHave('borrowed', function (Builder $query) {
            $query->whereNull('tgl_kembali');
        })->findOrFail($request->id_mesin);

        Peminjaman::create([
            'id_mesin' => $mesin->id,
            'id_karyawan' => auth()->user()->id,
            'tgl_pinjam' => now(),
        ]);

        return redirect(route('returns.index'))->with('status', 'Peminjaman berhasil!');
    }
}
