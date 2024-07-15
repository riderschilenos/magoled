<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Disciplina;
use App\Models\Evento;
use App\Models\Fecha;
use App\Models\Invitado;
use App\Models\Precio;
use App\Models\Serie;
use App\Models\Socio;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Vehiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;
use MercadoPago\Invoice;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    if(Cache::has('autos')){
            $autos = Cache::get('autos');
        }else{
            $autos = Vehiculo::where('status',6)
                            ->latest('id')->get()->take(3);
            Cache::put('autos',$autos);
        }

        if(Cache::has('series')){
            $series = Cache::get('series');
        }else{
            $series = Serie::where('status',3)->where('content','serie')->latest('id')->get()->take(4);
            Cache::put('series',$series);
        }


        if(Cache::has('riders')){
            $riders = Cache::get('riders');
        }else{
           $riders = Socio::join('users','socios.user_id','=','users.id')
            ->select('socios.*','users.name','users.email','users.updated_at')->where('status',1)
            ->orwhere('status',2)
            ->orderByRaw("CASE WHEN users.profile_photo_path IS NOT NULL THEN 0 ELSE 1 END, 
            CASE WHEN socios.created_at >= CURDATE() THEN 0 ELSE 1 END, 
            CASE WHEN socios.updated_at >= CURDATE() THEN 0 ELSE 1 END, 
            id DESC")->get()->take(4);
            Cache::put('riders',$riders);
        }

        if(auth()->user())
        {
        if(auth()->user()->socio)
        {
        $socio2 = Socio::where('user_id',auth()->user()->id)->first();
        }else{
        $socio2=null;
        }

        }
        else{
        $socio2=null;
        }

        $disciplinas= Disciplina::pluck('name','id');

        return view('Evento.index',compact('series','riders','autos','socio2','disciplinas'));
    }

    public function index2()
    {   
        return view('Evento.index2');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pista_create()
    {
        $disciplinas= Disciplina::pluck('name','id');

        return view('pistas.create',compact('disciplinas'));
    }

    public function ticket_view(Ticket $ticket)
    {   

        if(Cache::has('autos')){
            $autos = Cache::get('autos');
        }else{
            $autos = Vehiculo::where('status',6)
                            ->latest('id')->get()->take(3);
            Cache::put('autos',$autos);
         }

        
        if(Cache::has('series')){
            $series = Cache::get('series');
        }else{
            $series = Serie::where('status',3)->where('content','serie')->latest('id')->get()->take(4);
            Cache::put('series',$series);
         }


        if(Cache::has('riders')){
            $riders = Cache::get('riders');
        }else{
           $riders = Socio::join('users','socios.user_id','=','users.id')
            ->select('socios.*','users.name','users.email','users.updated_at')->where('status',1)
            ->orwhere('status',2)
            ->orderByRaw("CASE WHEN users.profile_photo_path IS NOT NULL THEN 0 ELSE 1 END, 
            CASE WHEN socios.created_at >= CURDATE() THEN 0 ELSE 1 END, 
            CASE WHEN socios.updated_at >= CURDATE() THEN 0 ELSE 1 END, 
            id DESC")->get()->take(4);
            Cache::put('riders',$riders);
         }

        if(auth()->user())
        {
        if(auth()->user()->socio)
        {
        $socio2 = Socio::where('user_id',auth()->user()->id)->first();
        }else{
        $socio2=null;
        }

        }
        else{
        $socio2=null;
        }

        $disciplinas= Disciplina::pluck('name','id');

        $evento=Evento::find($ticket->evento_id);

        $ticketCreatedAt = Carbon::parse($ticket->created_at);
        $endTime = $ticketCreatedAt->addHours(48);
        $currentTime = Carbon::now();
        
        $hoursRemaining = $endTime->diffInHours($currentTime);
        $minutesRemaining = $endTime->diffInMinutes($currentTime) % 60;
        $invitados=Invitado::all();

        return view('payment.ticketview',compact('invitados','evento','socio2','disciplinas','riders','series','autos','ticket', 'hoursRemaining', 'minutesRemaining'));
    }

    public function ticket_historial(User $user)
    {   
        if(Cache::has('autos')){
            $autos = Cache::get('autos');
        }else{
            $autos = Vehiculo::where('status',6)
                            ->latest('id')->get()->take(3);
            Cache::put('autos',$autos);
         }

        
        if(Cache::has('series')){
            $series = Cache::get('series');
        }else{
            $series = Serie::where('status',3)->where('content','serie')->latest('id')->get()->take(4);
            Cache::put('series',$series);
         }


        if(Cache::has('riders')){
            $riders = Cache::get('riders');
        }else{
           $riders = Socio::join('users','socios.user_id','=','users.id')
            ->select('socios.*','users.name','users.email','users.updated_at')->where('status',1)
            ->orwhere('status',2)
            ->orderByRaw("CASE WHEN users.profile_photo_path IS NOT NULL THEN 0 ELSE 1 END, 
            CASE WHEN socios.created_at >= CURDATE() THEN 0 ELSE 1 END, 
            CASE WHEN socios.updated_at >= CURDATE() THEN 0 ELSE 1 END, 
            id DESC")->get()->take(4);
            Cache::put('riders',$riders);
         }

        if(auth()->user())
        {
        if(auth()->user()->socio)
        {
        $socio2 = Socio::where('user_id',auth()->user()->id)->first();
        }else{
        $socio2=null;
        }

        }
        else{
        $socio2=null;
        }

        $disciplinas= Disciplina::pluck('name','id');

        return view('payment.tickethistorial',compact('socio2','disciplinas','riders','series','autos', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {   if(Cache::has('autos')){
            $autos = Cache::get('autos');
        }else{
            $autos = Vehiculo::where('status',4)
                            ->orwhere('status',5)
                            ->orwhere('status',7)
                            ->latest('id')->get()->take(3);
            Cache::put('autos',$autos);
        }

        if(Cache::has('series')){
            $series = Cache::get('series');
        }else{
            $series = Serie::where('status',3)->where('content','serie')->latest('id')->get()->take(4);
            Cache::put('series',$series);
        }


        if(Cache::has('riders')){
            $riders = Cache::get('riders');
        }else{
        $riders = Socio::join('users','socios.user_id','=','users.id')
                ->select('socios.*','users.name','users.email','users.updated_at')->where('status',1)
                ->orwhere('status',2)
                ->orderByRaw("CASE WHEN users.profile_photo_path IS NOT NULL THEN 0 ELSE 1 END, 
                CASE WHEN socios.created_at >= CURDATE() THEN 0 ELSE 1 END, 
                CASE WHEN socios.updated_at >= CURDATE() THEN 0 ELSE 1 END, 
                id DESC")->get()->take(4);
            Cache::put('riders',$riders);
        }

        if(auth()->user())
        {
        if(auth()->user()->socio)
        {
        $socio2 = Socio::where('user_id',auth()->user()->id)->first();
        }else{
        $socio2=null;
        }

        }
        else{
        $socio2=null;
        }

        $disciplinas= Disciplina::pluck('name','id');
        
        $fechas= Fecha::where('evento_id',$evento->id)->get();
        
        $similares = Evento::where('disciplina_id',$evento->disciplina_id)
                            ->where('id','!=',$evento->id)
                            ->where('status',1)
                            ->latest('id')
                            ->take(5)
                            ->get();

        if(auth()->user())
        {   
            if(Ticket::where('evento_id',$evento->id)->where('user_id',auth()->user()->id)){    
                    $ticket = Ticket::where('evento_id',$evento->id)->where('status',1)->where('user_id',auth()->user()->id)->first();
                }else{
                    $ticket =null;
                }             
        }
        else{
            $ticket =null;
        }        
          
        $fech = Fecha::where('evento_id',$evento->id)->first();
        if ($evento->type=='sorteo') {
            $tickets =  Ticket::where('status', '>=', 3)
                        ->where('evento_id',$evento->id)
                        ->orderBy('tickets.id', 'desc')
                        ->distinct()
                        ->paginate(500);
        } else {
            $tickets =   $evento->tickets()
            ->select('tickets.*', 'categorias.name as categoria_name') // Agrega la columna necesaria para el ORDER BY
            ->where('status', '>=', 3)
            ->join('inscripcions', 'tickets.id', '=', 'inscripcions.ticket_id')
            ->join('fecha_categorias', 'inscripcions.fecha_categoria_id', '=', 'fecha_categorias.id')
            ->join('categorias', 'fecha_categorias.categoria_id', '=', 'categorias.id')
            ->orderBy('tickets.ticketable_type', 'desc')
            ->orderBy('tickets.id', 'desc')
            ->orderBy('categoria_name', 'asc') // Ordena por la columna agregada en SELECT
            ->distinct()
            ->paginate(500);
        }
        
       

       


        $invitados=Invitado::all();

        return view('Evento.show',compact('invitados','tickets','evento','fechas','similares','ticket','fech','series','riders','autos','socio2','disciplinas'));
    }

    public function show2(Evento $evento)
    {   if(auth()->user())
        {   
            if(Ticket::where('evento_id',$evento->id)->where('user_id',auth()->user()->id)){    
                    $ticket = Ticket::where('evento_id',$evento->id)->where('status',1)->where('user_id',auth()->user()->id)->first();
                }else{
                    $ticket =null;
                }             
        }
        else{
            $ticket =null;
        }       

        $fech = Fecha::where('evento_id',$evento->id)->first();
        if ($evento->type=='sorteo') {
            $tickets =  Ticket::where('status', '>=', 3)
                        ->where('evento_id',$evento->id)
                        ->orderBy('tickets.id', 'desc')
                        ->distinct()
                        ->paginate(500);
        } else {
            $tickets =   $evento->tickets()
            ->select('tickets.*', 'categorias.name as categoria_name') // Agrega la columna necesaria para el ORDER BY
            ->where('status', '>=', 3)
            ->join('inscripcions', 'tickets.id', '=', 'inscripcions.ticket_id')
            ->join('fecha_categorias', 'inscripcions.fecha_categoria_id', '=', 'fecha_categorias.id')
            ->join('categorias', 'fecha_categorias.categoria_id', '=', 'categorias.id')
            ->orderBy('tickets.ticketable_type', 'desc')
            ->orderBy('tickets.id', 'desc')
            ->orderBy('categoria_name', 'asc') // Ordena por la columna agregada en SELECT
            ->distinct()
            ->paginate(500);
        }
        $invitados=Invitado::all();

        $fechas= Fecha::where('evento_id',$evento->id)->get();
        
        $similares = Evento::where('disciplina_id',$evento->disciplina_id)
                            ->where('id','!=',$evento->id)
                            ->where('status',1)
                            ->latest('id')
                            ->take(5)
                            ->get();

        return view('Evento.show2',compact('evento','invitados','fech','tickets','ticket','fechas','similares'));
    }

    public function showsocio(Evento $evento,Socio $socio)
    {   if(Cache::has('autos')){
            $autos = Cache::get('autos');
        }else{
            $autos = Vehiculo::where('status',4)
                            ->orwhere('status',5)
                            ->orwhere('status',7)
                            ->latest('id')->get()->take(3);
            Cache::put('autos',$autos);
        }

        if(Cache::has('series')){
            $series = Cache::get('series');
        }else{
            $series = Serie::where('status',3)->where('content','serie')->latest('id')->get()->take(4);
            Cache::put('series',$series);
        }


        if(Cache::has('riders')){
            $riders = Cache::get('riders');
        }else{
        $riders = Socio::join('users','socios.user_id','=','users.id')
                ->select('socios.*','users.name','users.email','users.updated_at')->where('status',1)
                ->orwhere('status',2)
                ->orderByRaw("CASE WHEN users.profile_photo_path IS NOT NULL THEN 0 ELSE 1 END, 
                CASE WHEN socios.created_at >= CURDATE() THEN 0 ELSE 1 END, 
                CASE WHEN socios.updated_at >= CURDATE() THEN 0 ELSE 1 END, 
                id DESC")->get()->take(4);
            Cache::put('riders',$riders);
        }

        if(auth()->user())
        {
        if(auth()->user()->socio)
        {
        $socio2 = Socio::where('user_id',auth()->user()->id)->first();
        }else{
        $socio2=null;
        }

        }
        else{
        $socio2=null;
        }

        $disciplinas= Disciplina::pluck('name','id');
        
        $fechas= Fecha::where('evento_id',$evento->id)->get();
        
        $similares = Evento::where('disciplina_id',$evento->disciplina_id)
                            ->where('id','!=',$evento->id)
                            ->where('status',1)
                            ->latest('id')
                            ->take(5)
                            ->get();

        if(auth()->user())
        {   
            if(Ticket::where('evento_id',$evento->id)->where('user_id',auth()->user()->id)){    
                    $ticket = Ticket::where('evento_id',$evento->id)->where('status',1)->where('user_id',auth()->user()->id)->first();
                }else{
                    $ticket =null;
                }             
        }
        else{
            $ticket =null;
        }        
          
        $fech = Fecha::where('evento_id',$evento->id)->first();

        $tickets =   $evento->tickets()
                        ->select('tickets.*', 'categorias.name as categoria_name') // Agrega la columna necesaria para el ORDER BY
                        ->where('status', '>=', 3)
                        ->join('inscripcions', 'tickets.id', '=', 'inscripcions.ticket_id')
                        ->join('fecha_categorias', 'inscripcions.fecha_categoria_id', '=', 'fecha_categorias.id')
                        ->join('categorias', 'fecha_categorias.categoria_id', '=', 'categorias.id')
                        ->orderBy('tickets.ticketable_type', 'desc')
                        ->orderBy('tickets.id', 'desc')
                        ->orderBy('categoria_name', 'asc') // Ordena por la columna agregada en SELECT
                        ->distinct()
                        ->paginate(250);

        $invitados=Invitado::all();

        $coach=$socio;

        return view('Evento.show',compact('coach','invitados','tickets','evento','fechas','similares','ticket','fech','series','riders','autos','socio2','disciplinas'));
    }

    public function pistas()
    {       
        return view('pistas.index');

    }

    public function academias()
    {       
        return view('academias.index');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function enrolled(Evento $evento){
        $evento->inscritos()->attach(auth()->user()->id);
        
        return redirect()->route('ticket.evento.show',$evento);
    }

    public function preticket(Evento $evento)
    {   
        if (auth()->user()) {
           
            $invitado=null;
                $ticket1=Ticket::where('user_id', auth()->user()->id)->where('status',3)->where('evento_id',$evento->id)->first();
                if($ticket1){
                    if($evento->type=='sorteo'){                        
                        $id=null;
                        $type=null;
                        return view('Evento.preticket',compact('evento','invitado','id','type'));
                    }else{
                        return redirect()->route('ticket.view',$ticket1);
                    }
                }

            $ticket=Ticket::where('user_id', auth()->user()->id)->where('status',1)->where('evento_id',$evento->id)->first();
            if ($ticket){
                if ($ticket->status==1) {
                    return redirect(route('payment.checkout.ticket',$ticket).'/#pago');
                }else{
                    if($ticket->evento->inscritos->contains(auth()->user()->id)){
                        return redirect()->route('ticket.view',$ticket);
                    }else{
                        $id=null;
                        $type=null;
                        return view('Evento.preticket',compact('evento','invitado','id','type'));
                    }
                }
            

            }else{
                $id=null;
                $type=null;
                return view('Evento.preticket',compact('evento','invitado','id','type'));
            }  
        }else{
            $invitado=null;
            $id=null;
            $type=null;
            return view('Evento.preticket',compact('evento','invitado','id','type'));
        } 
        
        
    }
    
    public function preticketinv(Evento $evento, Invitado $invitado)
    {   

           
           
                $ticket1=Ticket::where('ticketable_id', $invitado->id)->where('ticketable_type','App\Models\Invitado')->where('status',3)->where('evento_id',$evento->id)->first();
                
                if($ticket1){
                    return redirect()->route('ticket.view',$ticket1);
                }

            $ticket=Ticket::where('ticketable_id', $invitado->id)->where('ticketable_type','App\Models\Invitado')->where('status',1)->where('evento_id',$evento->id)->first();
            
            if ($ticket){
                if ($ticket->status==1) {
                    return redirect(route('payment.checkout.ticket',$ticket).'/#pago');
                }else{
                    if($ticket->evento->inscritos->contains(auth()->user()->id)){
                        return redirect()->route('ticket.view',$ticket);
                    }else{

                        return view('Evento.preticket',compact('evento','invitado'));

                    }
                }
            

            }else{
                $type='Invitado';
                $id=$invitado->id;
                return view('Evento.preticket',compact('evento','invitado','type','id'));
            }  
       
        
    }
    public function preticketsocio(Evento $evento, Socio $socio)
    {   

           
           
                $ticket1=Ticket::where('ticketable_id', $socio->id)->where('ticketable_type','App\Models\Socio')->where('status',3)->where('evento_id',$evento->id)->first();
                
                if($ticket1){
                    if ($ticket1->evento->type=='sorteo') {
                        $type='Socio';
                        $id=$socio->id;
                        return view('Evento.preticket',compact('evento','id','type'));
                    } else {
                        return redirect()->route('ticket.view',$ticket1);
                    }
                    
                       
                }

            $ticket=Ticket::where('ticketable_id', $socio->id)->where('ticketable_type','App\Models\Socio')->where('status',1)->where('evento_id',$evento->id)->first();
            
            if ($ticket){
                if ($ticket->status==1) {
                    return redirect(route('payment.checkout.ticket',$ticket).'/#pago');
                }else{
                    if($ticket->evento->inscritos->contains(auth()->user()->id)){
                        return redirect()->route('ticket.view',$ticket);
                    }else{
                        $type='Socio';
                        $id=$socio->id;
                        return view('Evento.preticket',compact('evento','id','type'));

                    }
                }
            

            }else{
                $type='Socio';
                $id=$socio->id;
                return view('Evento.preticket',compact('evento','type','id'));
            }  
       
        
    }

    public function add_code(Ticket $ticket, Socio $socio)
    {
        $ticket->code_id=$socio->user->id;
        $ticket->save();

        return redirect(route('payment.checkout.ticket',$ticket).'/#pagando');
       
    }
}
