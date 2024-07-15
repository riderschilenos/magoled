<?php

use App\Http\Controllers\WhatsappController;
use Illuminate\Support\Facades\Route;

Route::post('enviar/invitacion', [WhatsappController::class,'invitacion'])->name('invitacion.store');

Route::post('resend/{ticket}', [WhatsappController::class,'resend_ticket'])->name('resend.ticket');



