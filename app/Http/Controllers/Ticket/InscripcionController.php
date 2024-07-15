<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use App\Models\Inscripcion;
use App\Models\Ticket;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ticket=Ticket::where('id',$request->ticket_id)->first();

        if($ticket->evento->type=='pista' || $ticket->evento->type=='sorteo'){
            foreach(range(1,$request->nro) as $item){
                    if($ticket->evento->type=='sorteo'){
                        $inscripcion = Inscripcion::create([
                            'ticket_id'=>$request->ticket_id,
                            'categoria_id'=>$request->categoria_id,
                            'fecha_categoria_id'=>$request->fecha_categoria_id,
                            'cantidad'=>2000,
                            'fecha_id'=>$request->fecha_id
                                    ]);
                    }else{
                        $inscripcion = Inscripcion::create([
                            'ticket_id'=>$request->ticket_id,
                            'categoria_id'=>$request->categoria_id,
                            'fecha_categoria_id'=>$request->fecha_categoria_id,
                            'cantidad'=>$request->cantidad,
                            'fecha_id'=>$request->fecha_id
                                    ]);
                    }
            }
        }else{
            $inscripcion = Inscripcion::create([
                'ticket_id'=>$request->ticket_id,
                'categoria_id'=>$request->categoria_id,
                'fecha_categoria_id'=>$request->fecha_categoria_id,
                'cantidad'=>$request->cantidad,
                'fecha_id'=>$request->fecha_id,
                'nro'=>$request->nro
                        ]);
        }
                                
        $ticket= Ticket::find($request->ticket_id);

            $alfa=0;     


                foreach($ticket->inscripcions as $inscripcion){
                
                        $alfa+=$inscripcion->cantidad;

                    }
              
        
            $ticket->inscripcion=$alfa;
           
            $ticket->save();

        if(IS_NULL($ticket->vendedor_id)){
            return redirect(route('payment.checkout.ticket',$ticket).'/#pagando');
        }else{
            return redirect(route('organizador.tickets.create'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, Inscripcion $inscripcion)
    {   $ticket=Ticket::find($inscripcion->ticket_id);

        if($inscripcion->estado==2){
            $inscripcion->estado=1;
            $inscripcion->save();

            foreach($ticket->inscripcions as $inscripcion){
                if($inscripcion->estado==1){
                    $ticket->status=2;
                    $ticket->save();
                    $evento=Evento::find($ticket->evento_id);
                    if ($ticket->user) {
                        $evento->inscritos()->detach($ticket->user->id);
                    }
                  

                }else{
                    $ticket->status=1;
                    $ticket->save();
                    $evento=Evento::find($ticket->evento_id);
                    $evento->inscritos()->attach($ticket->user->id);
                    break;
                }
            }
        }else{
            $inscripcion->estado=4;
            $inscripcion->save();

            foreach($ticket->inscripcions as $inscripcion){
                if($inscripcion->estado==4){
                    $ticket->status=4;
                    $ticket->save();
                    $evento=Evento::find($ticket->evento_id);
                    if ($ticket->user) {
                        $evento->inscritos()->detach($ticket->user->id);
                    }

                }else{
                    $ticket->status=3;
                    $ticket->save();

                    $evento=Evento::find($ticket->evento_id);
                    $evento->inscritos()->attach($ticket->user->id);
                   
                    break;
                }
            }
        }

        
        if($ticket->status==2 || $ticket->status==4){
            return redirect()->route('ticket.historial.view',$inscripcion->ticket->user);
        }else{
            return redirect()->route('ticket.view',$inscripcion->ticket);
        }
        
       
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inscripcion $inscripcion,Request $request)
    {
        $inscripcion->delete();
        $ticket= Ticket::find($request->ticket_id);

        $alfa=0;     


                foreach($ticket->inscripcions as $inscripcion){
                
                        $alfa+=$inscripcion->cantidad;

                    }
              
        
            $ticket->inscripcion=$alfa;


            $ticket->save();

            if(IS_NULL($ticket->vendedor_id)){
                return redirect(route('payment.checkout.ticket',$ticket).'/#pagando');
            }else{
                return redirect(route('organizador.tickets.create'));
            }
    
        
      
     
    }
    public function destroyall(Ticket $ticket,Request $request)
    {
        foreach($ticket->inscripcions as $inscripcion){
            $inscripcion->delete();
        }
      
        
            $ticket->inscripcion=0;


            $ticket->save();

       
            if(IS_NULL($ticket->vendedor_id)){
                return redirect(route('payment.checkout.ticket',$ticket).'/#pagando');
            }else{
                return redirect(route('organizador.tickets.create'));
            }
     
    }
}
