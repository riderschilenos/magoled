<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gasto;
use App\Models\Lote;
use App\Models\Orden;
use App\Models\User;
use App\Notifications\UpdateCount;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class LoteController extends Controller
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

    public function loteview(Lote $lote)
    {
        $filePath = storage_path('app/public/'.$lote->resource->url);

        if (file_exists($filePath)) {
            return response()->file($filePath, ['Content-Type' => 'application/pdf']);
        } else {
            return response()->json(['message' => 'El archivo PDF no existe.']);
        }
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
        $request->validate([
            'lote'=>'required',
            'user_id'=>'required'
            ]);
        

        $lote=Lote::create([
                'user_id'=> $request->user_id
                ]);

        $url = $request->file('lote')->store('lote');
        $lote->resource()->create([
                    'url'=>$url
                ]);
        $valor=0;
        foreach ($request->selected as $item){
            $valor=$valor+1500;
            $lote->ordens()->attach($item);
            $orden = Orden::find($item);
            $orden->status = 2;
            $orden->save();
        }

        $gasto=Gasto::create([
            'user_id'=> Auth()->user()->id,
            'metodo'=> 'TRANSFERENCIA',
            'estado'=> 1,
            'cantidad'=> $valor,
            'gastotype_id'=> 2 ]);

        


        foreach ($request->selected as $item){
            $orden = Orden::find($item);
            $gasto->ordens()->attach($orden);
            foreach($orden->pedido->ordens as $orden){

                if($orden->status==2 || $orden->status==3){
                    $orden->pedido->status=5;
                    $orden->pedido->save();
                }else{
                    $orden->pedido->status=4;
                    $orden->pedido->save();
                    break;
                }

            } 

        }

        
        $users=[];
        $users[]=User::find(1);
        
        Notification::send($users, new UpdateCount());
        
        return redirect(route('admin.disenos.index').'/#table');
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
