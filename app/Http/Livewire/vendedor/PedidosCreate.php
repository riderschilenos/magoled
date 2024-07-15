<?php

namespace App\Http\Livewire\Vendedor;

use App\Models\Evento;
use App\Models\Gasto;
use App\Models\Invitado;
use App\Models\Retiro;
use App\Models\Socio;
use App\Models\Ticket;
use App\Models\Transportista;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Clipboard;
use Illuminate\Support\Facades\Http;

class PedidosCreate extends Component
{   
    public $ticketpay, $ticketdelete, $dni, $type, $eventoid, $eventoselected, $invitados, $selectedSocios, $selectedInvitado, $selecteddespacho, $search, $socio_id, $invitado_id, $transportista_id, $transportistas;
    public $nombre = '';
    public $apellidos = '';
    public $rut = '';
    public $telefono = '';
    public $email = '';
    public $textoPortapapeles = '';

    use WithPagination;

    protected $listeners = ['actualizarTextoPortapapeles','remove','pagomanual'];
    

    public function mount($type){
        $this->type=$type;
    }

    public function actualizarTextoPortapapeles($text)
    {
        $this->textoPortapapeles = $text;
    }

    public function completarDesdePortapapeles()
    {
        // Expresiones regulares para extraer información del primer conjunto de datos
        $patternNombres = '/NOMBRES: ([A-Z][A-ZA-ZA-Za-zÉéÍíÑñÓóÚúÁáÜü-]+(?: [A-Z][A-ZA-ZA-Za-zÉéÍíÑñÓóÚúÁáÜü-]+)?)\\s/';
        $patternApellidos = '/APELLIDOS: ?([A-Za-zÉéÍíÑñÓóÚúÁáÜü-]+(?: [A-Za-zÉéÍíÑñÓóÚúÁáÜü-]+)*)(?:\s|$)/';
        $patternRut = '/RUT: (\d{1,2}\.\d{3}\.\d{3}-[\dKk]|\d{7,8}-[\dKk])/'; // Modificamos la expresión regular del RUT
        $patternTelefono = '/FONO: (\+?569\d{8}|569\d{8}|9\s\d{8}|9\d{8})(?![\d-])/';
        $patternEmail = '/MAIL: ([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})/';

        if (preg_match($patternNombres, $this->textoPortapapeles, $matchesNombres)) {
            $this->nombre = $matchesNombres[1];
        } else {
            # code...
        }
        if (preg_match($patternApellidos, $this->textoPortapapeles, $matchesApellidos)) {
            $this->apellidos = $matchesApellidos[1];
        } else {
            # code...
        }
        if (preg_match($patternRut, $this->textoPortapapeles, $matchesRut)) {
            $this->rut = $matchesRut[1];
        } else {
            # code...
        }
        if (preg_match($patternTelefono, $this->textoPortapapeles, $matchesTelefono)) {
            $this->telefono = $matchesTelefono[1];
        } else {
            # code...
        }
        if (preg_match($patternEmail, $this->textoPortapapeles, $matchesEmail)) {
            $this->email = $matchesEmail[1];
        } else {
            # code...
        }
        
            // Expresiones regulares para extraer información del segundo conjunto de datos
            $patternNombre2 = '/([A-Z][a-z]+ [A-Z][a-z]+)/';
            $patternApellidos2 = '/\n([A-Z][a-z]+ [A-Z][a-z ]+)\n/'; // Expresión regular para capturar apellidos de dos palabras
            $patternRut2 = '/\b(\d{1,2}\.\d{3}\.\d{3}-[\dKk]|\d{7,8}-[\dKk])\b/'; // Modificamos la expresión regular del RUT
            $patternTelefono2 = '/\b(\+?569\d{8}|569\d{8}|9\s\d{8}|9\d{8})(?![\d-])\b/';   // Expresión regular para números de teléfono en ambas estructuras
            $patternEmail2 = '/\b([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})\b/';
            
            $matchesNombre2 = [];
            $matchesApellidos2 = [];
            $matchesTelefono2 = [];
            
            if (preg_match($patternNombre2, $this->textoPortapapeles, $matchesNombre2)) {
                $this->nombre = $matchesNombre2[0];
            } else {
                $nombreTemporal = '';
            }
            
            if (preg_match($patternApellidos2, $this->textoPortapapeles, $matchesApellidos2)) {
                $this->apellidos = $matchesApellidos2[1];
            } else {
                //$apellidosTemporal = '';
            }
            
            if (preg_match($patternTelefono2, $this->textoPortapapeles, $matchesTelefono2)) {
                $telefonoTemporal = $matchesTelefono2[0];
                $this->telefono = empty($this->telefono) ? $telefonoTemporal : $this->telefono;
            } else {
               // $telefonoTemporal = '';
            }

            //$this->apellidos = empty($this->apellidos) ? $apellidosTemporal : $this->apellidos;
            //$this->nombre = empty($this->nombre) ? $nombreTemporal.' '.$this->apellidos : $this->nombre.' '.$this->apellidos;
           
            
            if (preg_match($patternRut2, $this->textoPortapapeles, $matchesRut2)) {
                $this->rut = $matchesRut2[0];
            }
            
            if (preg_match($patternEmail2, $this->textoPortapapeles, $matchesEmail2)) {
                $this->email = $matchesEmail2[0];
            }
            if ($this->nombre) {
                $this->search = $this->nombre.' '.$this->apellidos;
                $this->nombre = $this->nombre.' '.$this->apellidos;
                
            }else{
                $this->search = 'Estructura de Texto no Coincide';
            }
           
    }

  
    /**
     * Write code on Method
     *
     * @return response()
     */

  
    /**
     * Write code on Method
     *
     * @return response()
     */
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

    public function pagomanual(){

      

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



    public function render()
    {   
        
        $socios = Socio::join('users', 'socios.user_id', '=', 'users.id')
        ->select('socios.*', 'users.name', 'users.email', 'users.updated_at')
        ->where(function($query) {
            $search = $this->search;
            $query->where('rut', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('socios.name', 'LIKE', '%' . $search . '%')
                ->orWhere('users.name', 'LIKE', '%' . $search . '%')
                ->orWhere('socios.slug', 'LIKE', '%' . $search . '%');
                })
                ->orderByRaw("CASE WHEN users.profile_photo_path IS NOT NULL THEN 0 ELSE 1 END, 
                CASE WHEN socios.created_at >= CURDATE() THEN 0 ELSE 1 END, 
                CASE WHEN socios.updated_at >= CURDATE() THEN 0 ELSE 1 END, 
                id DESC")
                ->paginate(200);
        
        $guess = Invitado::where('rut','LIKE','%'. $this->search .'%')
                    ->orwhere('email','LIKE','%'. $this->search .'%')
                    ->orwhere('name','LIKE','%'. $this->search .'%')
                    ->orwhere('fono','LIKE','%'. $this->search .'%')
                    ->latest('id')
                    ->paginate(3);

        $eventos= Evento::where('status', 2)
                ->where(function($query) {
                    $query->where('type', 'carrera')
                        ->orWhere('type', 'campeonato')
                        ->orWhere('type', 'desafio')
                        ->orWhere('type', 'sorteo');
                })
                ->latest('id')
                ->get();
        
        $tickets = Ticket::where(function ($query) {
                    $query->where('vendedor_id', auth()->user()->id)
                          ->orWhere('code_id', auth()->user()->id);
                })->where('status', 1)->get();

        $paytickets = Ticket::where(function ($query) {
                    $userId = auth()->user()->id;
                    $query->where('vendedor_id', auth()->user()->id)
                          ->orWhere('code_id', auth()->user()->id);
                })->where('status','>=',3)->get();

        
        $gastos=Gasto::where('user_id',auth()->user()->id)->where('gastotype_id',14)->get();

        $gastospend=Gasto::where('user_id',auth()->user()->id)->where('estado',1)->where('gastotype_id',14)->get();
        

        return view('livewire.vendedor.pedidos-create',compact('socios','guess','eventos','tickets','paytickets','gastospend','gastos'));
    }

    
    
    public function getSociosProperty(){
        return  Socio::where('rut','LIKE','%'. $this->dni .'%')
        ->orwhere('name','LIKE','%'. $this->dni .'%')
        ->orwhere('fono','LIKE','%'. $this->dni .'%')
        ->latest('id')
        ->paginate(3);
    }

    public function updateselectedSocios(Socio $socio){

        $this->selectedSocios= Socio::all();
        
        $this->reset(['invitados']);
    }

    public function set_eventoid($id){

        $this->eventoid= $id;
        $this->eventoselected=Evento::find($id);
      
    }

   // En tu componente de Livewire
    public function deleteticket($ticketId)
    {
        $ticket = Ticket::find($ticketId);
        if ($ticket) {
            $ticket->delete();
            session()->flash('delete', 'Ticket eliminado exitosamente');
        } else {
            session()->flash('error', 'No se pudo encontrar el ticket para eliminar');
        }

    }

    public function ticketdestroy(Ticket $ticket){
        
        $ticket->delete();
        
    }

    public function updateselectedInvitado(Socio $socio){

        $this->invitados= Invitado::all();
        
        $this->reset(['selectedSocios']);
    }

    public function updatedselecteddespacho($selecteddespacho){
        
        if($selecteddespacho==1){
            $this->transportistas = Transportista::where('id',1)->orwhere('id',4)->pluck('name','id');
        }

        if($selecteddespacho==2){
            $this->transportistas = Transportista::where('id',1)
                                            ->orwhere('id',2)
                                            ->pluck('name','id');
        }
        if($selecteddespacho==3){
            $this->transportistas = Transportista::where('id',3)->pluck('name','id');
        }
        


    
    }

    public function updatesocio_id($socio_id){

        $this->reset(['invitados']);

        $this->selectedSocios= Socio::join('users','socios.user_id','=','users.id')
                            ->select('socios.*','users.name','users.email')
                            ->get();

        $this->socio_id = $socio_id;
        $this->resetPage();
         $this->reset(['invitados','invitado_id']);
    }

    public function updateinvitado_id($invitado_id){


        $this->invitado_id = $invitado_id;
        $this->resetPage();
         $this->reset(['selectedSocios','socio_id']);
    }



    public function cancel(){
        $this->reset(['selectedSocios','invitados','socio_id','invitado_id','search']);
    }

    public function resetsocio(){
        $this->reset(['socio_id','invitado_id']);
    }

    public function limpiar_page(){
        $this->resetPage();
        $this->reset(['selectedSocios','invitados','socio_id','invitado_id']);
    }

}
