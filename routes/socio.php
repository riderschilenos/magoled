<?php

use App\Http\Controllers\Socio\AuspiciadorController;
use App\Http\Controllers\Socio\HomeController;
use App\Http\Controllers\Socio\ResultadoController;
use Illuminate\Support\Facades\Route;

Route::get('magos', [HomeController::class,'index'])->name('index');

Route::get('desktop/magos', [HomeController::class,'index2'])->name('index.desktop');

Route::get('magos/online', [HomeController::class,'online'])->name('index.online');

Route::get('desktop/magos/online', [HomeController::class,'online2'])->name('index.online.desktop');

Route::get('ranking/strava', [HomeController::class,'ranking_strava'])->name('ranking.strava');

Route::get('{socio}', [HomeController::class,'show'])->name('show');

Route::get('desktop/{socio}', [HomeController::class,'show2'])->name('show.desktop');

Route::get('mago/suscripcion', [HomeController::class,'create'])->middleware('auth')->name('create');

Route::post('mago/store', [HomeController::class,'store'])->name('store');

Route::post('{socio}/fotos', [HomeController::class,'fotos'])->name('fotos');

Route::get('{socio}/entrenamiento', [HomeController::class,'entrenamiento'])->name('entrenamiento');

Route::get('{socio}/tienda',[Homecontroller::class, 'showstore'])->name('store.show');

Route::get('{socio}/points',[Homecontroller::class, 'points'])->name('points');

Route::get('mago/{socio}/edit', [HomeController::class,'edit'])->name('edit');

Route::put('mago/{socio}/update', [HomeController::class,'update'])->name('update');

Route::resource('auspiciador', AuspiciadorController::class)->names('auspiciadors');

Route::resource('resultado', ResultadoController::class)->middleware('auth')->names('resultados');


