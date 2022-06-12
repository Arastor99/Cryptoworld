<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Index;
use App\Http\Livewire\Enviar;
use App\Http\Livewire\Recibir;
use App\Http\Livewire\Vender;
use App\Http\Livewire\Convertir;
use App\Http\Controllers\CarteraController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\StripeController;
use App\Http\Livewire\Comprar;
use Illuminate\Support\Facades\URL;

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
//URL::forceScheme('https');

Route::get('/', Index::class);
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
});


Route::resource('usuarios', UsuarioController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/cartera',[CarteraController::class, 'visualizar']);
Route::middleware(['auth:sanctum', 'verified'])->post('/cartera/enviar',[CarteraController::class, 'enviar']);
Route::middleware(['auth:sanctum', 'verified'])->get('/cartera/enviar', Enviar::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/cartera/recibir', Recibir::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/cartera/convertir', Convertir::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/cartera/vender', Vender::class);
Route::middleware(['auth:sanctum', 'verified'])->post('/cartera/convertir', [CarteraController::class,'convertir']);
Route::middleware(['auth:sanctum', 'verified'])->post('/cartera/vender', [CarteraController::class,'vender']);
Route::middleware(['auth:sanctum', 'verified'])->get('/mercado',[CarteraController::class, 'mercado']);

Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');
Route::middleware(['auth:sanctum', 'verified'])->get('comprar', Comprar::class);
Route::middleware(['auth:sanctum', 'verified'])->post('checkout', [CarteraController::class, 'checkout']);

Route::get('retirar', [CarteraController::class, 'retirar']);
Route::middleware(['auth:sanctum', 'verified'])->post('retirada', [CarteraController::class, 'retirada']);



