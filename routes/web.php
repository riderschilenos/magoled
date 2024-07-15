<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CategoryproductController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Organizador\TicketController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\Socio\ForoController;
use App\Http\Controllers\Socio\HomeController as SocioHomeController;
use App\Http\Controllers\Socio\PostController;
use App\Http\Controllers\Socio\TemaController;
use App\Http\Controllers\StravaController;
use App\Http\Controllers\SubhomeController;
use App\Http\Controllers\Ticket\EventoController;
use App\Http\Controllers\UsadoController;
use App\Http\Controllers\Vendedor\HomeController as VendedorHomeController;
use App\Http\Controllers\Vendedor\PedidoController;
use App\Http\Controllers\Vendedor\TiendaControllerr;
use App\Http\Controllers\WebhooksController;
use App\Http\Controllers\WhatsappController;
use App\Http\Livewire\EventoView;
use Illuminate\Support\Facades\Auth;


use App\Http\Livewire\SerieStatus;
use App\Models\User;
use App\Models\Vendedor;

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

Route::get('/', HomeController::class)->name('home');

Route::get('/dashboard', [SubhomeController::class,'index'])->name('dashboard');

Route::get('/encuesta', [SubhomeController::class,'encuesta'])->name('encuesta');

Route::resource('foros', ForoController::class)->names('foros');

Route::resource('temas', TemaController::class)->names('temas');

Route::resource('posts', PostController::class)->names('posts');

Route::get('post/{post}/reply', [PostController::class,'reply'])->name('post.reply');

Route::get('tema/{tema}/reply', [TemaController::class,'reply'])->name('tema.reply');

Route::get('content', [SerieController::class,'index'])->name('series.index');

Route::get('vendedores', [VendedorHomeController::class,'index'])->middleware('auth')->name('vendedores.index');

Route::get('/ridersdestacados', [SubhomeController::class,'premiaciones'])->name('premiaciones.index');

Route::get('content/{serie}',[SerieController::class,'show'])->name('series.show');

Route::get('seguimiento/{pedido}',[PedidoController::class,'seguimiento'])->name('pedido.seguimiento');

Route::post('content/{serie}/enrolled', [SerieController::class, 'enrolled'])->middleware('auth')->name('serie.enrolled');

Route::post('evento/{evento}/enrolled', [EventoController::class, 'enrolled'])->middleware('auth')->name('evento.enrolled');

Route::get('serie-status/{serie}',[SerieController::class,'status'])->name('series.status')->middleware('auth');

Route::get('evento-view/{user}', EventoView::class)->name('user.view')->middleware('auth');

Route::get('historial/ticket/{user}', [EventoController::class,'ticket_historial'])->name('ticket.historial.view')->middleware('auth');

Route::post('webhooks', WebhooksController::class);

Route::get('/webhook', [WhatsappController::class,'webhook']);

Route::post('/webhook', [WhatsappController::class,'recibe']);

Route::get('checkout/{evento}', [EventoController::class,'preticket'])->name('checkout.evento');

Route::get('checkout/{evento}/{invitado}', [EventoController::class,'preticketinv'])->name('checkout.evento.invitado');

Route::get('checkout/socio/{evento}/{socio}', [EventoController::class,'preticketsocio'])->name('checkout.evento.socio');

Route::get('addcode/vendedor/{ticket}/{socio}', [EventoController::class,'add_code'])->name('checkout.addcode.vendedor');

Route::get('/catalogocarcasas',[VendedorHomeController::class, 'catalogoscarcasas'])->name('catalogo.carcasas');

Route::post('ticket/{ticket}/enrolled', [TicketController::class, 'enrolled'])->middleware('auth')->name('ticket.enrolled');

Route::post('ticket/{ticket}/semipago', [TicketController::class, 'semipago'])->middleware('auth')->name('ticket.semipago');

Route::get('/pagoqr',[AdminHomeController::class, 'pagoqr'])->name('pagosqr.cliente');

Route::get('/contabilidad',[AdminHomeController::class, 'contabilidad'])->middleware('auth')->name('contabilidad');

Route::get('{pedido}/seguimiento.pdf', [VendedorHomeController::class,'download_seguimiento'])->name('foto_seguimiento');

Route::get('/politica-de-privacidad',[AdminHomeController::class,'privacidad'])->name('politica.privacidad');

Route::get('/terminos-y-condiciones',[AdminHomeController::class,'terminos'])->name('terminos.condiciones');

Route::get('/stravasync',[StravaController::class,'activitie_sync'])->name('strava.sync');

Route::post('/atletasync/{atletaStrava}',[StravaController::class,'atleta_sync'])->name('atleta.sync');

Route::delete('/atletadestroy/{atletaStrava}',[StravaController::class,'destroy'])->name('atleta.destroy');

Route::get('/stravacheck',[StravaController::class,'checkstrava'])->name('strava.check');

Route::get('/login-google', [GoogleController::class,'login']);
 
Route::get('/google-callback', [GoogleController::class,'callback']);

Route::get('/redireccion-strava', [StravaController::class,'handleAuthorization']);

Route::post('user/{user}/updatefoto', [SocioHomeController::class,'updatefoto'])->name('update.foto');

Route::resource('tienda', TiendaControllerr::class)->names('tiendas');

Route::get('desktop/tienda', [TiendaControllerr::class,'index2'])->name('tiendas.index.desktop');

Route::get('vendedores/list', [VendedorHomeController::class,'show_list'])->name('vendedores.index.desktop');

Route::resource('category_product', CategoryproductController::class)->names('category_products');

Route::get('tienda/{tienda}/productos', [TiendaControllerr::class,'productos'])->name('tiendas.productos');

Route::get('tienda/{tienda}/disenos', [TiendaControllerr::class,'disenos'])->name('tiendas.disenos');

Route::get('tienda/{tienda}/productos/intelligence', [TiendaControllerr::class,'inteligente'])->name('tiendas.productos.inteligente');

Route::get('tienda/{tienda}/productos/categorias', [TiendaControllerr::class,'categorias'])->name('tiendas.productos.categorias');

Route::get('tienda/{tienda}/productos/manual', [TiendaControllerr::class,'manual'])->name('tiendas.productos.manual');

Route::get('tienda/{producto}/productos/productoedit', [TiendaControllerr::class,'producto'])->name('tiendas.productos.edit');

Route::get('tienda/{tienda}/pedidos', [TiendaControllerr::class,'pedidos'])->middleware('auth')->name('tiendas.pedidos');

Route::get('tienda/{tienda}/pos', [TiendaControllerr::class,'pos'])->middleware('auth')->name('tiendas.pos');

Route::get('tienda/{tienda}/phonecases', [TiendaControllerr::class,'phonecases'])->middleware('auth')->name('tiendas.carcasas');

Route::get('tienda/{tienda}/printers', [TiendaControllerr::class,'printers'])->middleware('auth')->name('tiendas.printers');

Route::get('tienda/{tienda}/estadistica', [TiendaControllerr::class,'estadistica'])->middleware('auth')->name('tiendas.estadistica');

Route::get('tienda/{tienda}/staff', [TiendaControllerr::class,'staff'])->middleware('auth')->name('tiendas.staff');

Route::post('{producto}/updatingall',[ProductController::class, 'update'])->name('producto.update');

Route::post('{producto}/skugenerate',[ProductController::class, 'skugenerate'])->name('producto.skugenerate');

Route::post('print/{producto}/sku', [ProductController::class,'printsku'])->name('producto.printsku');

Route::get('producto/{producto}', [ProductController::class,'show'])->name('producto.show');

Route::post('upimage/{producto}', [ProductController::class,'upload'])->name('productos.upload');

Route::get('loger/{user}', [UserController::class,'usergetin'])->name('users.loger');

