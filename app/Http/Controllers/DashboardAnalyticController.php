<?php

namespace App\Http\Controllers;

use App\Models\Mesin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DashboardAnalyticController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $total = Mesin::all()->count();
        $available = Mesin::whereDoesntHave('borrowed', function (Builder $query) {
            $query->whereNull('tgl_kembali');
        })->count();
        $unavailable = Mesin::whereHas('borrowed', function (Builder $query) {
            $query->whereNull('tgl_kembali');
        })->count();

        return view('dashboard.dashboard', [
            'total' => $total,
            'available' => $available,
            'unavailable' => $unavailable,
        ]);
    }
}
