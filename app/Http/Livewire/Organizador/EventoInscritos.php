<?php

namespace App\Http\Livewire\Organizador;

use App\Models\Evento;
use App\Models\Inscripcion;
use App\Models\Invitado;
use App\Models\Orden;
use App\Models\Pedido;
use App\Models\Retiro;
use App\Models\Socio;
use App\Models\Ticket;
use App\Models\User;
use App\Models\WhatsappMensaje;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;

class EventoInscritos extends Component
{   
    use WithPagination;

    use AuthorizesRequests;

    public $evento,$search,$ticketpay,$ticketdelete;

    protected $listeners = ['remove','pagomanual2'];

    public function mount(Evento $evento){
        
        $this->evento=$evento;


    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {   
        $tickets = Ticket::select('tickets.*')
            ->where('evento_id', $this->evento->id)
            ->where('status', '>=', 1)
            ->where(function($query) {
                $query->where('tickets.id', $this->search)
                    ->orWhereHas('socio', function($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('fono', 'like', '%' . $this->search . '%')
                            ->orWhere('rut', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('invitado', function($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('fono', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy('tickets.id', 'desc')
            ->distinct()
            ->paginate(20);

        $ticketsall = Ticket::select('tickets.*', 'categorias.name as categoria_name')
            ->where('evento_id', $this->evento->id)
            ->where('status', '>=', 1)
            ->join('inscripcions', 'tickets.id', '=', 'inscripcions.ticket_id')
            ->join('fecha_categorias', 'inscripcions.fecha_categoria_id', '=', 'fecha_categorias.id')
            ->join('categorias', 'fecha_categorias.categoria_id', '=', 'categorias.id')
            ->orderBy('tickets.pedido_id', 'asc')
            ->orderBy('tickets.id', 'desc')
            ->orderBy('categoria_name', 'asc')
            ->distinct()
            ->get();
        
                        
        $socios=Socio::all();
        $invitados=Invitado::all();
        $sponsors = $this->evento->inscritos()->where('name','LIKE','%'. $this->search .'%')->get();

        $inscripciones = Inscripcion::join('tickets', 'inscripcions.ticket_id', '=', 'tickets.id')
            ->select('inscripcions.*', 'tickets.evento_id')
            ->where('evento_id', $this->evento->id)
            ->where('estado', '>=', 1)
            ->orderBy('id', 'DESC');
        
        // Aquí agregamos la condición de búsqueda
        if (!empty($this->search)) {
            $inscripciones->where(function($query) {
                $query->where('inscripcions.id', $this->search) // Buscar por ID de la inscripción
                    ->orWhereHas('ticket', function($q) {
                        $q->where('id', $this->search); // Buscar por ID del ticket
                    })->orWhereHas('ticket.socio', function($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('fono', 'like', '%' . $this->search . '%');
                    })->orWhereHas('ticket.invitado', function($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('fono', 'like', '%' . $this->search . '%');
                    });
            });
        }
        
        $inscripciones = $inscripciones->paginate(20);
    

        return view('livewire.organizador.evento-inscritos',compact('sponsors','inscripciones','tickets','ticketsall','socios','invitados'));
    }

    public function strava_wtsp($ticket_id){
        $ticket=Ticket::find($ticket_id);
        if ($ticket->inscripcions) {
            foreach ($ticket->inscripcions as $inscripcion) {
                    if ($inscripcion->fecha->name=='Etapa 15 km') {
                       
                        
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
                                            'name'=>'desafio_completado',
                                            'language'=>[
                                                'code'=>'es'],
                                            'components'=>[ 
                                                [
                                                    'type'=>'body',
                                                    'parameters'=>[
                                                        [   //nombre
                                                            'type'=>'text',
                                                            'text'=> $ticket->user->name
                                                        ],
                                                        [   //nombre
                                                            'type'=>'text',
                                                            'text'=> $inscripcion->fecha->name
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                        
                                    
                                ];
                                
                                Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();
                            
                            
                            } catch (\Throwable $th) {
                            
                            }
                
                           

                       

                        $fono='569'.mb_substr(str_replace(' ', '', $ticket->user->socio->fono), -8);
                        //TOKEN QUE NOS DA FACEBOOK
                
                        try {
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
                                        'name'=>'desafio15_terminado',
                                        'language'=>[
                                            'code'=>'es'],
                                    
                                    ]
                                
                            ];
                            
                            Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();
                            
                            WhatsappMensaje::create(['numero'=> $fono,
                            'mensaje'=>"¡Felicidades!
                            Haz superado con éxito el desafio de 30Km ft. Strava",
                            'type'=>'enviado']);
                
                
                        } catch (\Throwable $th) {
                            WhatsappMensaje::create(['numero'=> $fono,
                            'mensaje'=>"ERROR al enviar Mentaje => ¡Felicidades!
                            Haz superado con éxito el desafio de 30Km ft. Strava",
                            'type'=>'enviado']);
                        }
                    }
                if ($inscripcion->fecha->name=='Etapa 30 Km') {
                       
                         

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
                                            'name'=>'desafio_completado',
                                            'language'=>[
                                                'code'=>'es'],
                                            'components'=>[ 
                                                [
                                                    'type'=>'body',
                                                    'parameters'=>[
                                                        [   //nombre
                                                            'type'=>'text',
                                                            'text'=> $ticket->user->name
                                                        ],
                                                        [   //nombre
                                                            'type'=>'text',
                                                            'text'=> $inscripcion->fecha->name
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                        
                                    
                                ];
                                
                                Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();
                            
                            
                            } catch (\Throwable $th) {
                            
                            }
                            foreach($ticket->inscripcions as $inscripcion){
                                if($inscripcion->estado==4){
                                    $ticket->status=4;
                                    $ticket->pedido_id=$pedido->id;
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
                        

                        $fono='569'.mb_substr(str_replace(' ', '', $ticket->user->socio->fono), -8);
                        //TOKEN QUE NOS DA FACEBOOK
                
                        try {
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
                                        'name'=>'desafio30_terminado',
                                        'language'=>[
                                            'code'=>'es'],
                                    
                                    ]
                                
                            ];
                            
                            Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();
                            
                            WhatsappMensaje::create(['numero'=> $fono,
                            'mensaje'=>"¡Felicidades!
                            Haz superado con éxito el desafio de 30Km ft. Strava",
                            'type'=>'enviado']);
                
                
                        } catch (\Throwable $th) {
                            WhatsappMensaje::create(['numero'=> $fono,
                            'mensaje'=>"ERROR al enviar Mentaje => ¡Felicidades!
                            Haz superado con éxito el desafio de 30Km ft. Strava",
                            'type'=>'enviado']);
                        }
                }
                    
                
                if ($inscripcion->fecha->name=='Etapa 50Km') {
                    
                          
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
                                            'name'=>'desafio_completado',
                                            'language'=>[
                                                'code'=>'es'],
                                            'components'=>[ 
                                                [
                                                    'type'=>'body',
                                                    'parameters'=>[
                                                        [   //nombre
                                                            'type'=>'text',
                                                            'text'=> $ticket->user->name
                                                        ],
                                                        [   //nombre
                                                            'type'=>'text',
                                                            'text'=> $inscripcion->fecha->name
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                        
                                    
                                ];
                                
                                Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();
                            
                            
                            } catch (\Throwable $th) {
                            
                            }
                            
                        

                        $fono='569'.mb_substr(str_replace(' ', '', $ticket->user->socio->fono), -8);
                        //TOKEN QUE NOS DA FACEBOOK
                
                        try {
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
                                        'name'=>'desafio_terminado',
                                        'language'=>[
                                            'code'=>'es'],
                                        'components'=>[ 
                                            [
                                                'type'=>'body',
                                                'parameters'=>[
                                                    [   //Socio
                                                        'type'=>'text',
                                                        'text'=> '50'
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                    
                                
                            ];
                            
                            Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();
                            
                            WhatsappMensaje::create(['numero'=> $fono,
                            'mensaje'=>"¡Felicidades! Haz superado con éxito el desafio de 50Km ft. Strava",
                            'type'=>'enviado']);
                
                
                        } catch (\Throwable $th) {
                            WhatsappMensaje::create(['numero'=> $fono,
                            'mensaje'=>"ERROR al enviar Mentaje => ¡Felicidades!Haz superado con éxito el desafio de 30Km ft. Strava",
                            'type'=>'enviado']);
                        }
                }

                if ($inscripcion->fecha->name=='Etapa 100KM') {
                   
                        
                           
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
                                            'name'=>'desafio_completado',
                                            'language'=>[
                                                'code'=>'es'],
                                            'components'=>[ 
                                                [
                                                    'type'=>'body',
                                                    'parameters'=>[
                                                        [   //nombre
                                                            'type'=>'text',
                                                            'text'=> $ticket->user->name
                                                        ],
                                                        [   //nombre
                                                            'type'=>'text',
                                                            'text'=> $inscripcion->fecha->name
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                        
                                    
                                ];
                                
                                Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();
                            
                            
                            } catch (\Throwable $th) {
                            
                            }
                          
                        

                        $fono='569'.mb_substr(str_replace(' ', '', $ticket->user->socio->fono), -8);
                        //TOKEN QUE NOS DA FACEBOOK
                
                        try {
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
                                        'name'=>'desafio_terminado',
                                        'language'=>[
                                            'code'=>'es'],
                                        'components'=>[ 
                                            [
                                                'type'=>'body',
                                                'parameters'=>[
                                                    [   //Socio
                                                        'type'=>'text',
                                                        'text'=> '100'
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                    
                                
                            ];
                            
                            Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();
                            
                            WhatsappMensaje::create(['numero'=> $fono,
                            'mensaje'=>"¡Felicidades! Haz superado con éxito el desafio de 100Km ft. Strava",
                            'type'=>'enviado']);
                
                
                        } catch (\Throwable $th) {
                            WhatsappMensaje::create(['numero'=> $fono,
                            'mensaje'=>"ERROR al enviar Mentaje => ¡Felicidades!Haz superado con éxito el desafio de 100Km ft. Strava",
                            'type'=>'enviado']);
                        }
                }
                 
            }
        }

    }
    
    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'User Created Successfully!', 
                'text' => 'It will list on users table soon.'
            ]);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function alertConfirm($ticketdelete)
    {   $this->ticketdelete=$ticketdelete;

        $this->dispatchBrowserEvent('swal:confirm', [
                'type' => 'warning',  
                'message' => 'Deseas Eliminar el Ticket Nro: '.$ticketdelete.'?', 
                'text' => 'No podras revertir esta acción!'
            ]);
    }

    public function alertPayment($ticketpay)
    {   $this->ticketpay=$ticketpay;

        $this->dispatchBrowserEvent('swal:payment', [
                'type' => 'warning',  
                'message' => 'Registrar como Pagado el Ticket Nro: '.$ticketpay.'?', 
                'text' => 'No podras revertir esta acción!'
            ]);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove()
    {   $ticket=Ticket::find($this->ticketdelete);
        $ticket->delete();
        /* Write Delete Logic */
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Ticket Eliminado!', 
                'text' => 'Ya puedes ingresar nuevos tickets'
            ]);

        
    }

    public function pagomanual2(){

      

        $ticket=Ticket::find($this->ticketpay);

        $ticket->status=3;
        $ticket->metodo='TRANSFERENCIA';
        $ticket->save();
        foreach ($ticket->inscripcions as $inscripcion){
            $inscripcion->estado=3;
            $inscripcion->save();
        }  

        $evento=Evento::find($ticket->evento_id);
        $user=Evento::find($ticket->user_id);

        if ($user) {
            $evento->inscritos()->attach($user->id);
        }
        
        
        $tickets=$ticket->evento->tickets()->where('status','>=',3)->get();
        $retiros = Retiro::where('evento_id',$ticket->evento->id)->get();

        $total=0;
        $retiroacumulado=0;

        foreach ($retiros as $retiro){
                $retiroacumulado+=$retiro->cantidad;
        }
            

    

            foreach ($tickets as $item){
                    if($item->status>=3){
                            $total+=$item->inscripcion;
                    }
                
                }

        try {

                //
                    //TOKEN QUE NOS DA FACEBOOK
                    $cell='569'.substr(str_replace(' ', '', $ticket->evento->user->vendedor->fono), -8);
            
                    //TOKEN QUE NOS DA FACEBOOK
                    $token = env('WS_TOKEN');
                    $phoneid= env('WS_PHONEID');
                    $version='v16.0';
                    $url="https://riderschilenos.cl/";
                    $payload=[
                    'messaging_product' => 'whatsapp',
                    "preview_url"=> false,
                    'to'=>$cell,
                    
                    'type'=>'template',
                        'template'=>[
                            'name'=>'entrada_vendida',
                            'language'=>[
                                'code'=>'es'],
                            'components'=>[ 
                                [
                                    'type'=>'body',
                                    'parameters'=>[
                                        [   //cliente
                                            'type'=>'text',
                                            'text'=> $ticket->user->name
                                        ],
                                        [   //Cantidad
                                            'type'=>'text',
                                            'text'=> '$'.number_format($ticket->inscripcion)
                                        ],
                                        [   //saldo
                                            'type'=>'text',
                                            'text'=> '$'.number_format($total*(1-($evento->comision/100))-$retiroacumulado)
                                        ],
                                        
                                    ]
                                ]
                            ]
                        ]
                    
                    ];
        
                    Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();
                //
               
                    if($ticket->ticketable_type == 'App\Models\Invitado'){
                        $fono ='569'.substr(str_replace(' ', '', Invitado::find($ticket->ticketable_id)->fono), -8);
                    }else{
                        $fono ='569'.substr(str_replace(' ', '', Socio::find($ticket->ticketable_id)->fono), -8);
                    }
                    
                    if ($ticket->evento->type=='sorteo') {
                        $name='venta_sorteo';
                    } else {
                        $name='entrada_comprada';
                    }
                    $token = env('WS_TOKEN');
                    $phoneid= env('WS_PHONEID');
                    $version='v16.0';
                    $url="https://riderschilenos.cl/";
                    $wsload=[
                        'messaging_product' => 'whatsapp',
                        "preview_url"=> false,
                        'to'=>$fono,
                        'type'=>'template',
                            'template'=>[
                                'name'=>$name,
                                'language'=>[
                                    'code'=>'es'],
                                'components'=>[ 
                                    [
                                        'type'=>'body',
                                        'parameters'=>[
                                            [   //pista
                                                'type'=>'text',
                                                'text'=> $ticket->evento->titulo
                                            ],
                                            [   //Socio
                                                'type'=>'text',
                                                'text'=> 'https://riderschilenos.cl/ticket/view/'.$ticket->id
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                            
                        
                    ];
                    
                    Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();
                    
                      $this->dispatchBrowserEvent('swal:modal', [
                        'type' => 'success',  
                        'message' => 'Ticket Pagado!', 
                        'text' => 'Ya puedes ingresar nuevos tickets'
                    ]);
            
            
        } catch (\Throwable $th) {

                      $this->dispatchBrowserEvent('swal:modal', [
                        'type' => 'success',  
                        'message' => 'Ticket Pagado!', 
                        'text' => 'Ya puedes ingresar nuevos tickets'
                    ]);
        
        }
        
    }

    public function pagomanual(Ticket $ticket){

        $ticket->status=3;
        $ticket->metodo='TRANSFERENCIA';
        $ticket->save();
        foreach ($ticket->inscripcions as $inscripcion){
            $inscripcion->estado=3;
            $inscripcion->save();
        }  

        $evento=Evento::find($ticket->evento_id);
        $user=Evento::find($ticket->user_id);

        if ($user) {
            $evento->inscritos()->attach($user->id);
        }
        
        
        $tickets=$ticket->evento->tickets()->where('status','>=',3)->get();
        $retiros = Retiro::where('evento_id',$ticket->evento->id)->get();

        $total=0;
        $retiroacumulado=0;

        foreach ($retiros as $retiro){
                $retiroacumulado+=$retiro->cantidad;
        }
            

    

            foreach ($tickets as $item){
                    if($item->status>=3){
                            $total+=$item->inscripcion;
                    }
                
                }

        try {

                //
                    //TOKEN QUE NOS DA FACEBOOK
                    $cell='569'.substr(str_replace(' ', '', $ticket->evento->user->vendedor->fono), -8);
            
                    //TOKEN QUE NOS DA FACEBOOK
                    $token = env('WS_TOKEN');
                    $phoneid= env('WS_PHONEID');
                    $version='v16.0';
                    $url="https://riderschilenos.cl/";
                    $payload=[
                    'messaging_product' => 'whatsapp',
                    "preview_url"=> false,
                    'to'=>$cell,
                    
                    'type'=>'template',
                        'template'=>[
                            'name'=>'entrada_vendida',
                            'language'=>[
                                'code'=>'es'],
                            'components'=>[ 
                                [
                                    'type'=>'body',
                                    'parameters'=>[
                                        [   //cliente
                                            'type'=>'text',
                                            'text'=> $ticket->user->name
                                        ],
                                        [   //Cantidad
                                            'type'=>'text',
                                            'text'=> '$'.number_format($ticket->inscripcion)
                                        ],
                                        [   //saldo
                                            'type'=>'text',
                                            'text'=> '$'.number_format($total*(1-($evento->comision/100))-$retiroacumulado)
                                        ],
                                        
                                    ]
                                ]
                            ]
                        ]
                    
                    ];
        
                    Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();
                //
               
                    if($ticket->ticketable_type == 'App\Models\Invitado'){
                        $fono ='569'.substr(str_replace(' ', '', Invitado::find($ticket->ticketable_id)->fono), -8);
                    }else{
                        $fono ='569'.substr(str_replace(' ', '', Socio::find($ticket->ticketable_id)->fono), -8);
                    }
                    
                    if ($ticket->evento->type=='sorteo') {
                        $name='venta_sorteo';
                    } else {
                        $name='entrada_comprada';
                    }
                    $token = env('WS_TOKEN');
                    $phoneid= env('WS_PHONEID');
                    $version='v16.0';
                    $url="https://riderschilenos.cl/";
                    $wsload=[
                        'messaging_product' => 'whatsapp',
                        "preview_url"=> false,
                        'to'=>$fono,
                        'type'=>'template',
                            'template'=>[
                                'name'=>$name,
                                'language'=>[
                                    'code'=>'es'],
                                'components'=>[ 
                                    [
                                        'type'=>'body',
                                        'parameters'=>[
                                            [   //pista
                                                'type'=>'text',
                                                'text'=> $ticket->evento->titulo
                                            ],
                                            [   //Socio
                                                'type'=>'text',
                                                'text'=> 'https://riderschilenos.cl/ticket/view/'.$ticket->id
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                            
                        
                    ];
                    
                    Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();
                    
                
            
            
        } catch (\Throwable $th) {
            
        
        }
        
    }

    public function realizarpedido(Ticket $ticket){
        if ($ticket->inscripcions) {
            foreach ($ticket->inscripcions as $inscripcion) {
                if ($inscripcion->fecha->name=='Etapa 15 km' && $inscripcion->estado>=4) {
                    $pedido = Pedido::create([
                        'user_id'=> $ticket->user->id,
                        'transportista_id'=> 4,
                        'pedidoable_id'=> $ticket->user->socio->id,
                        'status'=> 4,
                        'pedidoable_type'=> 'App\Models\Socio']);
                    $pedido->status=5;
                    $pedido->save();
                    $orden= Orden::create([
                            'producto_id'=> 54,
                            'name'=>'Etapa 15 km',
                            'pedido_id'=>$pedido->id
                        ]);
                }
                if ($inscripcion->fecha->name=='Etapa 30 Km' && $inscripcion->estado>=4) {
                    $pedido = Pedido::create([
                        'user_id'=> $ticket->user->id,
                        'transportista_id'=> 4,
                        'pedidoable_id'=> $ticket->user->socio->id,
                        'status'=> 4,
                        'pedidoable_type'=> 'App\Models\Socio']);
                    $pedido->status=5;
                    $pedido->save();
                    
                    $orden= Orden::create([
                            'producto_id'=> 55,
                            'name'=>'Etapa 30 km',
                            'pedido_id'=>$pedido->id
                        ]);
                }
                if ($inscripcion->fecha->name=='Etapa 50Km' && $inscripcion->estado>=4) {
                    $pedido = Pedido::create([
                        'user_id'=> $ticket->user->id,
                        'transportista_id'=> 4,
                        'pedidoable_id'=> $ticket->user->socio->id,
                        'status'=> 4,
                        'pedidoable_type'=> 'App\Models\Socio']);
                    $pedido->status=5;
                    $pedido->save();
                    $orden= Orden::create([
                            'producto_id'=> 56,
                            'name'=>'Etapa 50 km',
                            'pedido_id'=>$pedido->id
                        ]);
                }
                if ($inscripcion->fecha->name=='Etapa 100KM' && $inscripcion->estado>=4) {
                    $pedido = Pedido::create([
                        'user_id'=> $ticket->user->id,
                        'transportista_id'=> 4,
                        'pedidoable_id'=> $ticket->user->socio->id,
                        'status'=> 4,
                        'pedidoable_type'=> 'App\Models\Socio']);
                    $pedido->status=5;
                    $pedido->save();
                    $orden= Orden::create([
                            'producto_id'=> 58,
                            'name'=>'Etapa 100 km',
                            'pedido_id'=>$pedido->id
                        ]);
                }
            }
            $ticket->pedido_id=$pedido->id;
            $ticket->save();
        }
    }

    public function limpiar_page(){
        $this->resetPage();
    }

}
