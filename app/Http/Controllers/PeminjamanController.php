<?php

namespace App\Http\Controllers;

use App\Models\Mesin;
use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = Mesin::with('borrowed');

        $keyword = $request->input('search');

        if ($keyword) {
            $data = $data->where('nama_mesin', 'like', "%$keyword%")
                ->paginate();

            $data->appends(['search' => $keyword]);
        } else {
            $data = $data->paginate();
        }

        return view('peminjaman.select-mesin', [
            'dataMesin' => $data
        ]);
    }

    public function store(Request $request, string $id)
    {
        $mesin = Mesin::whereDoesntHave('borrowed', function (Builder $query) {
            $query->whereNull('tgl_kembali');
        })->findOrFail($id);

        Peminjaman::create([
            'id_mesin' => $mesin->id,
            'id_karyawan' => auth()->user()->id,
            'tgl_pinjam' => now(),
        ]);

        return redirect(route('borrow-history'))->with('status', 'Peminjaman berhasil!');
    }

    public function return(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->tgl_kembali !== null) {
            return redirect()->back()->with('error', 'Mesin sudah dikembalikan!');
        }

        $peminjaman->tgl_kembali = now();
        $peminjaman->save();

        return redirect()->back()->with('status', 'Pengembalian berhasil!');
    }

    public function history(Request $request)
    {
        $data = Peminjaman::with('mesin.gudang')
            ->where('id_karyawan', auth()->user()->id)
            ->orderByRaw('tgl_kembali IS NULL DESC')
            ->orderBy('tgl_pinjam', 'desc');

        return view('peminjaman.history', [
            'data' => $data->paginate()
        ]);
    }

    public function all(Request $request)
    {
        $data = Peminjaman::with(['mesin.gudang', 'peminjam'])
            ->orderByRaw('tgl_kembali IS NULL DESC')
            ->orderBy('tgl_pinjam', 'desc');

        return view('peminjaman.all', [
            'data' => $data->paginate()
        ]);
    }
}
