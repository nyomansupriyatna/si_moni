<?php

use App\Http\Livewire\User;
use App\Http\Livewire\Profile;
use App\Http\Livewire\WorkOrder;
use App\Http\Livewire\MappingRegu;
use App\Http\Livewire\LaporanProgres;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ProgresWorkOrder;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/profile', Profile::class)->name('profile');

Route::group(['middleware'=>[ 'verified','CheckRole:Admin']], function() {
    Route::get('/user', User::class)->name('user');
});

Route::group(['middleware'=>['auth:sanctum', 'verified','CheckRole:Admin,Operator']], function() {
    Route::get('/mapping-regu', MappingRegu::class)->name('mapping.regu');
    Route::get('/work-order', WorkOrder::class)->name('work.order');
    Route::get('/laporan-progres/semua', LaporanProgres::class)->name('laporan.progres.semua');
    Route::get('/laporan-progres/ok', LaporanProgres::class)->name('laporan.progres.ok');
    Route::get('/laporan-progres/kendala', LaporanProgres::class)->name('laporan.progres.kendala');
});

Route::group(['middleware'=>['auth:sanctum', 'verified','CheckRole:Teknisi']], function() {
    Route::get('/update-order', ProgresWorkOrder::class)->name('update.order');
});
