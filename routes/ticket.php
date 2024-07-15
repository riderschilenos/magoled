<?php

use App\Http\Controllers\Ticket\EventoController;
use App\Http\Controllers\Ticket\FechacategoriaController;
use App\Http\Controllers\Ticket\InscripcionController;
use App\Http\Controllers\Ticket\InvitadoController;
use Illuminate\Support\Facades\Route;

Route::get('eventos', [EventoController::class,'index'])->name('evento.index');

Route::get('desktop/eventos', [EventoController::class,'index2'])->name('evento.index.desktop');

Route::get('eventos/{evento}',[EventoController::class,'show'])->name('evento.show');

Route::get('desktop/eventos/{evento}',[EventoController::class,'show2'])->name('evento.show.desktop');

Route::get('eventos/{socio}/{evento}',[EventoController::class,'showsocio'])->name('evento.show.socio');

Route::get('pista/{evento}',[EventoController::class, 'show'])->name('pista.show');

Route::get('pistas',[EventoController::class,'pistas'])->name('pistas.index');

Route::get('academias',[EventoController::class,'academias'])->name('academias.index');

Route::get('ticket/create/{evento}',[EventoController::class,'preticket'])->name('evento.preticket')->middleware('auth');

Route::resource('inscripcion', InscripcionController::class)->names('inscripcions');

Route::delete('{ticket}/clean', [InscripcionController::class,'destroyall'])->name('inscripcions.clean');

Route::get('pistas/create',[EventoController::class, 'pista_create'])->name('pistas.create');

Route::post('invitado/store', [InvitadoController::class,'store'])->name('notlog.store');

Route::post('invitado/store/ticketsell', [InvitadoController::class,'storeticket'])->name('vendedores.store');

Route::post('socioregistred/store/tickets', [InvitadoController::class,'storeticketregistred'])->name('vendedores.store.registred');

Route::post('destroyticket/{ticket}/pedidos/create', [InvitadoController::class,'ticketdestroy'])->name('vendedores.destroy');

Route::get('ticket/view/{ticket}',[EventoController::class, 'ticket_view'])->name('view');

