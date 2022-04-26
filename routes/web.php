<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Index;
use App\Http\Livewire\Enviar;
use App\Http\Controllers\CarteraController;
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


Route::get('/', Index::class);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/cartera',[CarteraController::class, 'cartera']);
Route::middleware(['auth:sanctum', 'verified'])->post('/cartera/enviar',[CarteraController::class, 'enviar']);
Route::middleware(['auth:sanctum', 'verified'])->get('/cartera/enviar', Enviar::class);
