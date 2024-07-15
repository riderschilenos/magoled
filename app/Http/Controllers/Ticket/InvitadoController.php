<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use App\Models\Invitado;
use App\Models\Socio;
use App\Models\Ticket;
use App\Models\User;
use App\Models\WhatsappMensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InvitadoController extends Controller
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
        if($request->pedidoable_type=='App\Models\Invitado'){
                $request->validate([
                    'name'=>'required',
                    'rut'=>'required',
                    'fono'=>'required',
                    'email'=>'required'
                    ]);
        }
        if($request->pedidoable_type=='Pendiente'){
                $request->validate([
                    'name'=>'required',
                    'last_name'=>'required',
                    'born_date'=>'required',
                    'rut'=>'required',
                    'disciplina_id'=>'required',
                    'email'=>'required'
                    ]);
        }

        $evento=Evento::find($request->evento_id);

            if($request->pedidoable_type == 'App\Models\Invitado'){
                
            
                $invitado =  Invitado::create([
                                'name'=> $request->name,
                                'rut'=> $request->rut,
                                'fono'=> $request->fono,
                                'email'=>$request->email]);
                            
              

                return redirect()->route('checkout.evento.invitado',compact('evento','invitado'));
                
        
            }
            if($request->pedidoable_type == 'Pendiente'){

                $sociosall=Socio::all();

                $fecha_nacimiento = $request->born_date; // Asumiendo que $request->born_date contiene la fecha en algún formato reconocido por PHP

                // Obtener el año de la fecha
                $ano = date('Y', strtotime($fecha_nacimiento));

                $checkuser=User::where('email',$request->email)->first();
                
                if($checkuser){
                    
                    if($checkuser->socio){
                        $socio=Socio::find($checkuser->socio->id);
                        Auth::login($checkuser);
                        return redirect()->route('checkout.evento.socio',compact('evento','socio'));
                    }else{
                        Auth::login($checkuser);

                        $socio=Socio::create([
                            'name'=> $request->name,
                            'second_name'=> $request->second_name,
                            'last_name'=> $request->last_name,
                            'slug'=> 'rider'.$sociosall->count(),
                            'born_date'=> $request->born_date,
                            'fono'=> $request->fono,
                            'rut'=> $request->rut,
                            'disciplina_id'=> $request->disciplina_id,
                            'user_id'=> $checkuser->id]);

                            Cache::flush();

                            $fono='569'.substr(str_replace(' ', '', $socio->fono), -8);
                            //TOKEN QUE NOS DA FACEBOOK
                                    
                            try {
                                $token = env('WS_TOKEN');
                                $phoneid= env('WS_PHONEID');
                                $version='v16.0';
                                $url="https://riderschilenos.cl/";
                                $wsload=[
                                    'messaging_product' => 'whatsapp',
                                    "preview_url"=> false,
                                    'to'=>'56963176726',
                                    
                                    'type'=>'template',
                                        'template'=>[
                                            'name'=>'nuevo_rider',
                                            'language'=>[
                                                'code'=>'es'],
                                            'components'=>[ 
                                                [
                                                    'type'=>'body',
                                                    'parameters'=>[
                                                        [   //Socio
                                                            'type'=>'text',
                                                            'text'=> $socio->user->name.' ('.$evento->titulo.')'
                                                        ],
                                                        [   //Socio
                                                            'type'=>'text',
                                                            'text'=> '+'.$fono
                                                        ],
                                                        [   //Socio
                                                            'type'=>'text',
                                                            'text'=> $socio->disciplina->name
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                        
                                    
                                ];
                                
                                Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();
                                
                                //TOKEN QUE NOS DA FACEBOOK
                                $token = env('WS_TOKEN');
                                $phoneid= env('WS_PHONEID');
                                $version='v16.0';
                                $url="https://riderschilenos.cl/";
                                $payload=[
                                    'messaging_product' => 'whatsapp',
                                    "preview_url"=> false,
                                    'to'=>$fono,
                                    
                                    'type'=>'template',
                                        'template'=>[
                                            'name'=>'bienvenida_credenciales',
                                            'language'=>[
                                                'code'=>'es'],
                                            'components'=>[ 
                                                [
                                                    'type'=>'body',
                                                    'parameters'=>[
                                                        [   //Socio
                                                            'type'=>'text',
                                                            'text'=> $socio->name
                                                        ],
                                                        [   //Socio
                                                            'type'=>'text',
                                                            'text'=> $request->email
                                                        ],
                                                        [   //Socio
                                                            'type'=>'text',
                                                            'text'=> $ano
                                                        ],
                                                    ]
                                                ]
                                            ]
                                        ]
                                        
                                    
                                ];
                                
                                Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();
        
                                WhatsappMensaje::create(['numero'=> $fono,
                                'mensaje'=>"Credenciales Enviadas",
                                'type'=>'enviado']);
                        
                    
                                return redirect()->route('checkout.evento.socio',compact('evento','socio'));
        
                            } catch (\Throwable $th) {
                    
                                WhatsappMensaje::create(['numero'=> $fono,
                                'mensaje'=>"Error al enviar Credenciales",
                                'type'=>'enviado']);
                                return redirect()->route('checkout.evento.socio',compact('evento','socio'));
                                
                            }
                    }
                }

                $user=User::create([
                    'name'=> $request->name.' '.$request->second_name.' '.$request->last_name,
                    'email'=> $request->email,
                    'password' => Hash::make($ano),
                ]);
                Cache::flush();

                Auth::login($user);

                $socio=Socio::create([
                    'name'=> $request->name,
                    'second_name'=> $request->second_name,
                    'last_name'=> $request->last_name,
                    'slug'=> 'rider'.$sociosall->count(),
                    'born_date'=> $request->born_date,
                    'fono'=> $request->fono,
                    'rut'=> $request->rut,
                    'disciplina_id'=> $request->disciplina_id,
                    'user_id'=> $user->id]);

                    Cache::flush();

                    $fono='569'.substr(str_replace(' ', '', $socio->fono), -8);
                    //TOKEN QUE NOS DA FACEBOOK
                            
                    try {
                        $token = env('WS_TOKEN');
                        $phoneid= env('WS_PHONEID');
                        $version='v16.0';
                        $url="https://riderschilenos.cl/";
                        $wsload=[
                            'messaging_product' => 'whatsapp',
                            "preview_url"=> false,
                            'to'=>'56963176726',
                            
                            'type'=>'template',
                                'template'=>[
                                    'name'=>'nuevo_rider',
                                    'language'=>[
                                        'code'=>'es'],
                                    'components'=>[ 
                                        [
                                            'type'=>'body',
                                            'parameters'=>[
                                                [   //Socio
                                                    'type'=>'text',
                                                    'text'=> $socio->user->name.' ('.$evento->titulo.')'
                                                ],
                                                [   //Socio
                                                    'type'=>'text',
                                                    'text'=> '+'.$fono
                                                ],
                                                [   //Socio
                                                    'type'=>'text',
                                                    'text'=> $socio->disciplina->name
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                                
                            
                        ];
                        
                        Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();
                        
                        //TOKEN QUE NOS DA FACEBOOK
                        $token = env('WS_TOKEN');
                        $phoneid= env('WS_PHONEID');
                        $version='v16.0';
                        $url="https://riderschilenos.cl/";
                        $payload=[
                            'messaging_product' => 'whatsapp',
                            "preview_url"=> false,
                            'to'=>$fono,
                            
                            'type'=>'template',
                                'template'=>[
                                    'name'=>'bienvenida_credenciales',
                                    'language'=>[
                                        'code'=>'es'],
                                    'components'=>[ 
                                        [
                                            'type'=>'body',
                                            'parameters'=>[
                                                [   //Socio
                                                    'type'=>'text',
                                                    'text'=> $socio->name
                                                ],
                                                [   //Socio
                                                    'type'=>'text',
                                                    'text'=> $request->email
                                                ],
                                                [   //Socio
                                                    'type'=>'text',
                                                    'text'=> $ano
                                                ],
                                            ]
                                        ]
                                    ]
                                ]
                                
                            
                        ];
                        
                        Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();

                        WhatsappMensaje::create(['numero'=> $fono,
                        'mensaje'=>"Credenciales Enviadas",
                        'type'=>'enviado']);
                
            
                        return redirect()->route('checkout.evento.socio',compact('evento','socio'));

                    } catch (\Throwable $th) {
            
                        WhatsappMensaje::create(['numero'=> $fono,
                        'mensaje'=>"Error al enviar Credenciales",
                        'type'=>'enviado']);
                        return redirect()->route('checkout.evento.socio',compact('evento','socio'));
                        
                    }
              

              
                
        
            }

    }

    public function ticketdestroy(Ticket $ticket)
    {   $evento=$ticket->evento;
        $ticket->delete();
        
        
            return redirect(route('organizador.tickets.create'));
        
    }

    public function storeticket(Request $request)
    {   
        
                $request->validate([
                    'name'=>'required',
                    'born_date'=>'required',
                    'rut'=>'required',
                    'email'=>'required'
                    ]);
      

        $evento=Evento::find($request->evento_id);

            
          

                $sociosall=Socio::all();

                $fecha_nacimiento = $request->born_date; // Asumiendo que $request->born_date contiene la fecha en algún formato reconocido por PHP

                // Obtener el año de la fecha
                $ano = date('Y', strtotime($fecha_nacimiento));

                $checkuser=User::where('email',$request->email)->first();
                
                if($checkuser){
                    
                    if($checkuser->socio){
                        $socio=Socio::find($checkuser->socio->id);
                        
                        $ticket = Ticket::create([
                            'user_id'=> $checkuser->id,
                            'evento_id'=> $evento->id,
                            'ticketable_id'=> $socio->id,
                            'ticketable_type'=> 'App\Models\Socio',
                            'vendedor_id'=> Auth()->user()->id,]);
                        
                        
                        QrCode::format('svg')->size('300')->generate('https://riderschilenos.cl/ticket/view/'.$ticket->id, '../public/storage/qrcodes/cod'.$ticket->id.'.svg');
                        
                        $ticket->update(['qr'=>'qrcodes/cod'.$ticket->id.'.svg']);
                        $ticket->save();
                        
                        $evento=Evento::find($request->evento_id);
        
                        return redirect(route('organizador.tickets.create'));


                    }else{
                       

                        $socio=Socio::create([
                            'name'=> $request->name,
                            'second_name'=> $request->second_name,
                            'last_name'=> $request->last_name,
                            'slug'=> 'rider'.$sociosall->count(),
                            'born_date'=> $request->born_date,
                            'fono'=> $request->fono,
                            'rut'=> $request->rut,
                            'disciplina_id'=> $evento->disciplina_id,
                            'user_id'=> $checkuser->id]);

                            Cache::flush();

                            $fono='569'.substr(str_replace(' ', '', $socio->fono), -8);
                            //TOKEN QUE NOS DA FACEBOOK
                                    
                            try {
                                $token = env('WS_TOKEN');
                                $phoneid= env('WS_PHONEID');
                                $version='v16.0';
                                $url="https://riderschilenos.cl/";
                                $wsload=[
                                    'messaging_product' => 'whatsapp',
                                    "preview_url"=> false,
                                    'to'=>'56963176726',
                                    
                                    'type'=>'template',
                                        'template'=>[
                                            'name'=>'nuevo_rider',
                                            'language'=>[
                                                'code'=>'es'],
                                            'components'=>[ 
                                                [
                                                    'type'=>'body',
                                                    'parameters'=>[
                                                        [   //Socio
                                                            'type'=>'text',
                                                            'text'=> $socio->user->name.' ('.$evento->titulo.')'
                                                        ],
                                                        [   //Socio
                                                            'type'=>'text',
                                                            'text'=> '+'.$fono
                                                        ],
                                                        [   //Socio
                                                            'type'=>'text',
                                                            'text'=> $socio->disciplina->name
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                        
                                    
                                ];
                                
                                Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();
                                
                                //TOKEN QUE NOS DA FACEBOOK
                                $token = env('WS_TOKEN');
                                $phoneid= env('WS_PHONEID');
                                $version='v16.0';
                                $url="https://riderschilenos.cl/";
                                $payload=[
                                    'messaging_product' => 'whatsapp',
                                    "preview_url"=> false,
                                    'to'=>$fono,
                                    
                                    'type'=>'template',
                                        'template'=>[
                                            'name'=>'bienvenida_credenciales',
                                            'language'=>[
                                                'code'=>'es'],
                                            'components'=>[ 
                                                [
                                                    'type'=>'body',
                                                    'parameters'=>[
                                                        [   //Socio
                                                            'type'=>'text',
                                                            'text'=> $socio->name
                                                        ],
                                                        [   //Socio
                                                            'type'=>'text',
                                                            'text'=> $request->email
                                                        ],
                                                        [   //Socio
                                                            'type'=>'text',
                                                            'text'=> $ano
                                                        ],
                                                    ]
                                                ]
                                            ]
                                        ]
                                        
                                    
                                ];
                                
                                Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();
        
                                WhatsappMensaje::create(['numero'=> $fono,
                                'mensaje'=>"Credenciales Enviadas",
                                'type'=>'enviado']);
                        
                    
                                $ticket = Ticket::create([
                                    'user_id'=> $checkuser->id,
                                    'evento_id'=> $evento->id,
                                    'ticketable_id'=> $socio->id,
                                    'ticketable_type'=> 'App\Models\Socio',
                                    'vendedor_id'=> Auth()->user()->id,]);
                                
                                
                                QrCode::format('svg')->size('300')->generate('https://riderschilenos.cl/ticket/view/'.$ticket->id, '../public/storage/qrcodes/cod'.$ticket->id.'.svg');
                                
                                $ticket->update(['qr'=>'qrcodes/cod'.$ticket->id.'.svg']);
                                $ticket->save();
                                
                
                                $ticket = Ticket::create([
                                    'user_id'=> $checkuser->id,
                                    'evento_id'=> $evento->id,
                                    'ticketable_id'=> $socio->id,
                                    'ticketable_type'=> 'App\Models\Socio',
                                    'vendedor_id'=> Auth()->user()->id,]);
                                
                                
                                        QrCode::format('svg')->size('300')->generate('https://riderschilenos.cl/ticket/view/'.$ticket->id, '../public/storage/qrcodes/cod'.$ticket->id.'.svg');
                                        
                                        $ticket->update(['qr'=>'qrcodes/cod'.$ticket->id.'.svg']);
                                        $ticket->save();
                                        
                                        $evento=Evento::find($request->evento_id);
                        
                                        return redirect(route('organizador.tickets.create'));
        
                            } catch (\Throwable $th) {
                    
                                WhatsappMensaje::create(['numero'=> $fono,
                                'mensaje'=>"Error al enviar Credenciales",
                                'type'=>'enviado']);

                               $ticket = Ticket::create([
                                'user_id'=> $checkuser->id,
                                'evento_id'=> $evento->id,
                                'ticketable_id'=> $socio->id,
                                'ticketable_type'=> 'App\Models\Socio',
                                'vendedor_id'=> Auth()->user()->id,]);
                            
                            
                                    QrCode::format('svg')->size('300')->generate('https://riderschilenos.cl/ticket/view/'.$ticket->id, '../public/storage/qrcodes/cod'.$ticket->id.'.svg');
                                    
                                    $ticket->update(['qr'=>'qrcodes/cod'.$ticket->id.'.svg']);
                                    $ticket->save();
                                    
                    
                                    return redirect(route('organizador.tickets.create'));
                                
                            }
                    }
                }

                $user=User::create([
                    'name'=> $request->name.' '.$request->second_name.' '.$request->last_name,
                    'email'=> $request->email,
                    'password' => Hash::make($ano),
                ]);

                Cache::flush();

                $evento=Evento::find($request->evento_id);

                $socio=Socio::create([
                    'name'=> $request->name,
                    'second_name'=> $request->second_name,
                    'last_name'=> $request->last_name,
                    'slug'=> 'rider'.$sociosall->count(),
                    'born_date'=> $request->born_date,
                    'fono'=> $request->fono,
                    'rut'=> $request->rut,
                    'disciplina_id'=> $evento->disciplina->id,
                    'user_id'=> $user->id]);
                
                    Cache::flush();

                    $fono='569'.substr(str_replace(' ', '', $socio->fono), -8);
                    //TOKEN QUE NOS DA FACEBOOK
                            
                    try {
                        $token = env('WS_TOKEN');
                        $phoneid= env('WS_PHONEID');
                        $version='v16.0';
                        $url="https://riderschilenos.cl/";
                        $wsload=[
                            'messaging_product' => 'whatsapp',
                            "preview_url"=> false,
                            'to'=>'56963176726',
                            
                            'type'=>'template',
                                'template'=>[
                                    'name'=>'nuevo_rider',
                                    'language'=>[
                                        'code'=>'es'],
                                    'components'=>[ 
                                        [
                                            'type'=>'body',
                                            'parameters'=>[
                                                [   //Socio
                                                    'type'=>'text',
                                                    'text'=> $socio->user->name.' ('.$evento->titulo.')'
                                                ],
                                                [   //Socio
                                                    'type'=>'text',
                                                    'text'=> '+'.$fono
                                                ],
                                                [   //Socio
                                                    'type'=>'text',
                                                    'text'=> $socio->disciplina->name
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                                
                            
                        ];
                        
                        Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();
                        
                        //TOKEN QUE NOS DA FACEBOOK
                        $token = env('WS_TOKEN');
                        $phoneid= env('WS_PHONEID');
                        $version='v16.0';
                        $url="https://riderschilenos.cl/";
                        $payload=[
                            'messaging_product' => 'whatsapp',
                            "preview_url"=> false,
                            'to'=>$fono,
                            
                            'type'=>'template',
                                'template'=>[
                                    'name'=>'bienvenida_credenciales',
                                    'language'=>[
                                        'code'=>'es'],
                                    'components'=>[ 
                                        [
                                            'type'=>'body',
                                            'parameters'=>[
                                                [   //Socio
                                                    'type'=>'text',
                                                    'text'=> $socio->name
                                                ],
                                                [   //Socio
                                                    'type'=>'text',
                                                    'text'=> $request->email
                                                ],
                                                [   //Socio
                                                    'type'=>'text',
                                                    'text'=> $ano
                                                ],
                                            ]
                                        ]
                                    ]
                                ]
                                
                            
                        ];
                        
                        Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();

                        WhatsappMensaje::create(['numero'=> $fono,
                        'mensaje'=>"Credenciales Enviadas",
                        'type'=>'enviado']);
                
            
                        $ticket = Ticket::create([
                        'user_id'=> $user->id,
                        'evento_id'=> $evento->id,
                        'ticketable_id'=> $socio->id,
                        'ticketable_type'=> 'App\Models\Socio',
                        'vendedor_id'=> Auth()->user()->id,]);
                    
                        
                        QrCode::format('svg')->size('300')->generate('https://riderschilenos.cl/ticket/view/'.$ticket->id, '../public/storage/qrcodes/cod'.$ticket->id.'.svg');
                        
                        $ticket->update(['qr'=>'qrcodes/cod'.$ticket->id.'.svg']);
                        $ticket->save();
                        
                       
        
                        return redirect(route('organizador.tickets.create'));

                    } catch (\Throwable $th) {
            
                        WhatsappMensaje::create(['numero'=> $fono,
                        'mensaje'=>"Error al enviar Credenciales",
                        'type'=>'enviado']);

                        $ticket = Ticket::create([
                        'user_id'=> $user->id,
                        'evento_id'=> $evento->id,
                        'ticketable_id'=> $socio->id,
                        'ticketable_type'=> 'App\Models\Socio',
                        'vendedor_id'=> Auth()->user()->id,]);
                    
                        
                        QrCode::format('svg')->size('300')->generate('https://riderschilenos.cl/ticket/view/'.$ticket->id, '../public/storage/qrcodes/cod'.$ticket->id.'.svg');
                        
                        $ticket->update(['qr'=>'qrcodes/cod'.$ticket->id.'.svg']);
                        $ticket->save();
                        
                     
                        return redirect(route('organizador.tickets.create'));
                        
                    }
              

              
                
        

    }

    public function storeticketregistred(Request $request)
    {   
        
                $request->validate([
                    'evento_id'=>'required',
                    'socio_id'=>'required'
                    ]);
      

            $evento=Evento::find($request->evento_id);
          

            $socio=Socio::find($request->socio_id);

                
                $user=User::find($socio->user->id);

                       
            
                        $ticket = Ticket::create([
                        'user_id'=> $user->id,
                        'evento_id'=> $evento->id,
                        'ticketable_id'=> $socio->id,
                        'ticketable_type'=> 'App\Models\Socio',
                        'vendedor_id'=> Auth()->user()->id,]);
                    
                        
                        QrCode::format('svg')->size('300')->generate('https://riderschilenos.cl/ticket/view/'.$ticket->id, '../public/storage/qrcodes/cod'.$ticket->id.'.svg');
                        
                        $ticket->update(['qr'=>'qrcodes/cod'.$ticket->id.'.svg']);
                        $ticket->save();
                        
                       
        
                        return redirect(route('organizador.tickets.create'));

                   
              
        

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
