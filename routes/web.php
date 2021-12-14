<?php

use App\Http\Livewire\User;
use App\Http\Livewire\WorkOrder;
use App\Http\Livewire\MappingRegu;
use Illuminate\Support\Facades\Route;
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
// Route::post('logged_in', [LoginController::class, 'authenticate'])->name('logged_in');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware'=>['auth:sanctum', 'verified','CheckRole:Admin']], function() {
    Route::get('/user', User::class)->name('user');
    Route::get('/mapping-regu', MappingRegu::class)->name('mapping.regu');
    Route::get('/work-order', WorkOrder::class)->name('work.order');
});
