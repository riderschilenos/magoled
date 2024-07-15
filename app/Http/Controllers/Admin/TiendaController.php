<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Suscripcion;
use App\Models\Ticket;
use App\Models\Tienda;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $tiendas=Tienda::all();
        
            $tickets30=Ticket::where('evento_id',13)
                ->where('created_at', '>=', now()->subDays(29))
                ->where('status','>=',3)->get();

            $suscripcions30=Suscripcion::where('suscripcionable_type','App\Models\Socio')
            ->where('created_at', '>=', now()->subDays(29))
            ->get();
            
            $sortedTickets30 = Ticket::where('evento_id', 23)
                ->where('created_at', '>=', now()->subDays(29))
                ->where('status', '>=', 3)
                ->get();


        return view('admin.tiendas.index',compact('tiendas','tickets30','suscripcions30','sortedTickets30'));
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
        //
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
}
