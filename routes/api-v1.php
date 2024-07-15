<?php

use App\Http\Controllers\Api\PedidoController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/', function(){
    return 'prueba';
});

Route::post('/register',[RegisterController::class,'store'])->name('api.v1.register');


Route::get('pedidos',[PedidoController::class,'index'])->name('api.v1.pedidos.index');
Route::post('pedidos',[PedidoController::class,'store'])->name('api.v1.pedidos.store');
Route::get('pedidos/{pedido}',[PedidoController::class,'show'])->name('api.v1.pedidos.show');
Route::get('ordens/pedido/{pedido}',[PedidoController::class,'showordens'])->name('api.v1.orden.pedidos.show');
Route::put('pedidos/{pedido}',[PedidoController::class,'update'])->name('api.v1.pedidos.update');
Route::delete('pedidos/{pedido}',[PedidoController::class,'destroy'])->name('api.v1.pedidos.destroy');
