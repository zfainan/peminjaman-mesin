<?php

use App\Models\Mesin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/machine/{mesin}', function (Mesin $mesin) {
    if (!$mesin?->id) {
        return response()->json([
            'is_available' => false,
        ], 404);
    }

    if (!$mesin->is_available) {
        return response()->json([
            'nama_mesin' => $mesin->nama_mesin,
            'is_available' => false,
            'message' => 'Mesin tidak tersedia.',
        ], 400);
    }

    $mesin->load('gudang:id,nama_gudang');
    $mesin->append('is_available');
    $mesin->makeHidden('borrowed');

    return response()->json($mesin);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
