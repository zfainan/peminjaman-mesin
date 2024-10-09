<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Peminjaman::with('mesin.gudang')
            ->where('id_karyawan', auth()->user()->id)
            ->orderByRaw('tgl_kembali IS NULL DESC')
            ->orderBy('tgl_pinjam', 'desc');

        return view('peminjaman.history', [
            'data' => $data->paginate()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_peminjaman' => 'required|exists:meminjam,id',
        ]);

        $peminjaman = Peminjaman::findOrFail($request->id_peminjaman);

        if ($peminjaman->tgl_kembali !== null) {
            return redirect()->back()->with('error', 'Mesin sudah dikembalikan!');
        }

        $peminjaman->tgl_kembali = now();
        $peminjaman->save();

        return redirect()->back()->with('status', 'Pengembalian berhasil!');
    }
}
