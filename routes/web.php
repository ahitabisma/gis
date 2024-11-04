<?php

use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::get('/dashboard', [MapController::class, 'index'])->name('dashboard');
Route::post('/dashboard', [MapController::class, 'store'])->name('map.store');
Route::get('/dashboard/create', [MapController::class, 'create'])->name('map.create');
Route::get('/dashboard/{map:id}/show', [MapController::class, 'show'])->name('map.show');
Route::get('/dashboard/{map:id}', [MapController::class, 'edit'])->name('map.edit');
Route::post('/dashboard/{map:id}/update', [MapController::class, 'update'])->name('map.update');
Route::delete('/dashboard/{map:id}/destroy', [MapController::class, 'destroy'])->name('map.destroy');

Route::get('/place', [MapController::class, 'place'])->name('place');

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
