<?php

namespace App\Http\Livewire\Admin;

use App\Models\Gasto;
use App\Models\Image as ModelsImage;
use App\Models\Invitado;
use App\Models\Lote;
use App\Models\Orden;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Socio;
use App\Models\Tienda;
use App\Models\User;
use App\Models\WhatsappMensaje;
use App\Notifications\UpdateCount;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\support\Str;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;
use PDF;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Livewire\WithPagination;

class PedidosProduccion extends Component
{   public $selected=[];

    public $selectedetiquetas=[];

    public $paginate=4,$search,$search2,$ordenedit,$products;

    protected $listeners = ['actualizarPedidosCount'];

    use WithFileUploads;

    use WithPagination;

    public $selectedProduccion, $selectedDescartar,$produccion, $descartar, $file, $etiquetas, $type,$selectedproduct,$tienda;

    public function mount($type,$tienda){
        $this->type=$type;
        if ($tienda) {
            $this->tienda=Tienda::find($tienda);
        }else{
            $this->tienda=Tienda::find(4);
          
        }
    }
   

    public function render()
    {   if($this->type=='produccion'){
            $pedidos=Pedido::where('status',5)
            ->whereHas('ordens.producto', function ($queryProducto) {
                $queryProducto->where('tienda_id', $this->tienda->id);
            })
            ->where(function ($query) {
                $query->whereHasMorph('socio', [Socio::class], function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('fono', 'like', '%' . $this->search . '%');
                })->orWhereHasMorph('invitado', [Invitado::class], function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('fono', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(100);
        }
        if($this->type=='despacho'){
            $pedidos=Pedido::where('status',6)
            ->whereHas('ordens.producto', function ($queryProducto) {
                $queryProducto->where('tienda_id', $this->tienda->id);
            })
            ->where(function ($query) {
                $query->whereHasMorph('socio', [Socio::class], function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('fono', 'like', '%' . $this->search . '%');
                })->orWhereHasMorph('invitado', [Invitado::class], function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('fono', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(100);
            
        }
       
            

        $users=User::all();

        $invitados= Invitado::all();
        $socios= Socio::all();
        $lotes=Lote::where('estado',1)->latest('id')->paginate($this->paginate);
        $alllotes=Lote::where('estado',2)->latest('id')->paginate($this->paginate);
        $ordens=Orden::all();

        $gastos=Gasto::where('user_id',auth()->user()->id)
                        ->where('gastotype_id',3)
                        ->orderby('id','DESC')
                        ->latest('id')
                        ->paginate(5);

        $gastosfull=Gasto::where('user_id',auth()->user()->id)
                        ->where('gastotype_id',3)
                        ->orderby('id','DESC')
                        ->latest('id')
                        ->get();
        

        return view('livewire.admin.pedidos-produccion',compact('gastosfull','ordens','pedidos','users','invitados','socios','lotes','alllotes','gastos'));
    }
    public function updateselectedproduccion(){

        $this->produccion= True;

        $this->reset(['descartar','etiquetas']);
    }

    public function orderedit(Orden $orden){
        $this->ordenedit=$orden;
        $this->products = Producto::all();
        $this->selectedproduct=$orden->producto_id;
        
    }

    public function saveorden(){
        $this->ordenedit->update(['producto_id'=>$this->selectedproduct]);
        $this->reset(['ordenedit','selectedproduct']);
    }
    


    public function updateselecteddescartar(){

        $this->descartar= True;
        $this->reset(['produccion','etiquetas']);
    }

    public function updateselectedetiquetas(){

        $this->etiquetas= True;
        $this->reset(['produccion','descartar']);
    }

    public function updatepaginate(){

        if ($this->paginate==4){
            $this->paginate=250;
        }else{
            $this->paginate=4;
     }
    }



    public function encaja()
    {   
        if($this->file){
                
            $foto = Str::random(10).$this->file->getClientOriginalName();
            $rutafoto = public_path().'/storage/ordens/'.$foto;
            $img=Image::make($this->file)->orientate()
                ->resize(600, null , function($constraint){
                $constraint->aspectRatio();
                })
                ->save($rutafoto);
            $img->orientate();

        }else{
            $foto='nn';
        }

        foreach ($this->selected as $item){
            $orden = Orden::find($item);
            $orden->status = 3;
            $orden->save();
            if($foto!='nn'){
                $orden->images()->create([
                    'url'=>'ordens/'.$foto
                ]);
            }

            foreach($orden->pedido->ordens as $orden){

                if($orden->status==3){
                    $orden->pedido->status=6;
                    $orden->pedido->save();
    
                }else{
                    $orden->pedido->status=5;
                    $orden->pedido->save();
                    break;
                }

            } 
        }

        $this->reset(['selected','file']);
        $this->emit('actualizarPedidosCount');
        
        $users=[];
        $users[]=User::find(1);
        
        Notification::send($users, new UpdateCount());
        
    }

    public function actualizarPedidosCount()
    {
        // Forzar la renderización del componente PedidosCount
        $this->render();
    }

    public function encaja2($orden)
    {   

        $orden=Orden::find($orden);

        $foto=$orden->producto->image;


   
            $orden->status = 3;
            $orden->save();
            
            if($orden->producto->stock>0){
                $orden->producto->stock=$orden->producto->stock-1;
                $orden->producto->save();
            }

 
                $orden->images()->create([
                    'url'=>$foto
                ]);
         

            foreach($orden->pedido->ordens as $orden){

                if($orden->status==3){
                    $orden->pedido->status=6;
                    $orden->pedido->save();
    
                }else{
                    $orden->pedido->status=5;
                    $orden->pedido->save();
                    break;
                }

            } 
        

        $this->reset(['search2']);
        $this->emit('actualizarPedidosCount');
        
    }

    public function rediseñar()
    {

        foreach ($this->selected as $item){
            $orden = Orden::find($item);
            $orden->status = 1;
            $orden->save();
            
            
                    $orden->pedido->status=4;
                    $orden->pedido->save();
        }

        $this->reset(['selected']);
        $this->emit('actualizarPedidosCount');
        
    }

    public function enviarblue(Pedido $pedido)
    {   $this->validate([
            'search'=>'required'
        ]);

        $nro = substr($this->search, 5);

        // Seleccionar los próximos 10 dígitos
        $nextDigits = substr($nro, 0, 10);
        
            $pedido->update([
                'seguimiento'=>$nextDigits
            ]);

        $this->search="";
            

        $pedido->status=7;
        $pedido->save();

        $valor=0;

        foreach ($pedido->ordens as $orden){
            $valor=$valor+1500;
        }

        $gasto=Gasto::create([
            'user_id'=> Auth()->user()->id,
            'metodo'=> 'TRANSFERENCIA',
            'estado'=> 1,
            'cantidad'=> $valor,
            'gastotype_id'=> 3 ]);
    
        foreach ($pedido->ordens as $orden){
            $gasto->ordens()->attach($orden);
            }

        if($pedido->pedidoable_type == 'App\Models\Invitado'){
            $cliente=Invitado::find($pedido->pedidoable_id);
        }else{
            $cliente=Socio::find($pedido->pedidoable_id);
        }

        $pedidos= Pedido::where('user_id',$pedido->user_id)
                    ->where('status',7)
                    ->orderby('status','DESC')
                    ->latest('id')
                    ->get();

        $comisiones=0;
        foreach($pedidos as $item){
            foreach ($item->ordens as $orden){
                     
                if($item->pedidoable_type=="App\Models\Socio"){
                        $comisiones+=$orden->producto->comision_socio;
                    }
                if($item->pedidoable_type=="App\Models\Invitado"){
                        $comisiones+=$orden->producto->comision_invitado;
                }
            }
        }


        try {
            $fono='569'.substr(str_replace(' ', '', $cliente->fono), -8);
       
            //TOKEN QUE NOS DA FACEBOOK
            $token = env('WS_TOKEN');
            $phoneid= env('WS_PHONEID');
            //$link= 'https://riderschilenos.cl/seguimiento/'.$pedido->id;
            $version='v16.0';
            $url="https://riderschilenos.cl/";
            $payload=[
                'messaging_product' => 'whatsapp',
                "preview_url"=> false,
                'to'=>$fono,
                
                'type'=>'template',
                    'template'=>[
                        'name'=>'nro_seguimiento',
                        'language'=>[
                            'code'=>'es'],
                        'components'=>[ 
                            [
                                'type'=>'body',
                                'parameters'=>[
                                    [   //Link
                                        'type'=>'text',
                                        'text'=> 'https://riderschilenos.cl/seguimiento/'.$pedido->id
                                    ]
                                ]
                            ]
                        ]
                    ]
                    
                
            ];
            
            Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();
            WhatsappMensaje::create(['numero'=> $fono,
            'mensaje'=>"¡Hola! Muchas gracias por confiar en nuestro trabajo. Queremos informarte que tu pedido ya ha sido enviado y que en el siguiente link puedes descargar la boleta de envío donde encontraras el número de seguimiento. https://riderschilenos.cl/seguimiento/".$pedido->id."
            Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos al +56963176726. ¡Que tengas un buen día!",
            'type'=>'enviado']);

            if ($pedido->user_id) {
                $vendedor=Socio::find($pedido->user_id);
            }else{
                $vendedor=null;
            }
               
            if($vendedor){
                $fvend='569'.substr(str_replace(' ', '', $vendedor->fono), -8);
                //TOKEN QUE NOS DA FACEBOOK
                $token = env('WS_TOKEN');
                $phoneid= env('WS_PHONEID');
                $version='v16.0';
                $url="https://riderschilenos.cl/";
                $wsload=[
                    'messaging_product' => 'whatsapp',
                    "preview_url"=> false,
                    'to'=>$fvend,
                    
                    'type'=>'template',
                        'template'=>[
                            'name'=>'nueva_comision',
                            'language'=>[
                                'code'=>'es'],
                            'components'=>[ 
                                [
                                    'type'=>'body',
                                    'parameters'=>[
                                        [   //Link
                                            'type'=>'text',
                                            'text'=> number_format($comisiones)
                                        ]
                                    ]
                                ]
                            ]
                        ]
                        
                    
                ];
                
                Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();
                WhatsappMensaje::create(['numero'=> $fvend,
                'mensaje'=>"¡Felicidades! Tienes $ ".number_format($comisiones)."en comisiones para retirar.Visita el siguiente link para hacer el retiro deseado",
                'type'=>'enviado']);
            }
         
            $this->reset(['file']);
        } catch (\Throwable $th) {
           
            $this->reset(['file']);

        }

        $this->emit('actualizarPedidosCount');
    }

    public function resetSearch()
    {   
        $this->reset('search');
    }

    public function despachado(Pedido $pedido)
    {   
            
        if($this->file){
                
            $foto = Str::random(10).$this->file->getClientOriginalName();
            $rutafoto = public_path().'/storage/pedidos/'.$foto;
            $img=Image::make($this->file)->orientate()
                ->resize(600, null , function($constraint){
                $constraint->aspectRatio();
                })
                ->save($rutafoto);
            $img->orientate();
            $pedido->image()->create([
                'url'=>'pedidos/'.$foto
            ]);

        }else{
            $foto='nn';
        }

        

        $pedido->status=7;
        $pedido->save();

        $valor=0;

        foreach ($pedido->ordens as $orden){
            $valor=$valor+1500;
        }

        $gasto=Gasto::create([
            'user_id'=> Auth()->user()->id,
            'metodo'=> 'TRANSFERENCIA',
            'estado'=> 1,
            'cantidad'=> $valor,
            'gastotype_id'=> 3 ]);
    
        foreach ($pedido->ordens as $orden){
            $gasto->ordens()->attach($orden);
            }

        if($pedido->pedidoable_type == 'App\Models\Invitado'){
            $cliente=Invitado::find($pedido->pedidoable_id);
        }else{
            $cliente=Socio::find($pedido->pedidoable_id);
        }

        $pedidos= Pedido::where('user_id',$pedido->user_id)
                    ->where('status',7)
                    ->orderby('status','DESC')
                    ->latest('id')
                    ->get();

        $comisiones=0;
        foreach($pedidos as $item){
            foreach ($item->ordens as $orden){
                     
                if($item->pedidoable_type=="App\Models\Socio"){
                        $comisiones+=$orden->producto->comision_socio;
                    }
                if($item->pedidoable_type=="App\Models\Invitado"){
                        $comisiones+=$orden->producto->comision_invitado;
                }
            }
        }


        try {
            $fono='569'.mb_substr(str_replace(' ', '', $cliente->fono), -8);
       
            //TOKEN QUE NOS DA FACEBOOK
            $token = env('WS_TOKEN');
            $phoneid= env('WS_PHONEID');
            //$link= 'https://riderschilenos.cl/seguimiento/'.$pedido->id;
            $version='v16.0';
            $url="https://riderschilenos.cl/";
            $payload=[
                'messaging_product' => 'whatsapp',
                "preview_url"=> false,
                'to'=>$fono,
                
                'type'=>'template',
                    'template'=>[
                        'name'=>'nro_seguimiento',
                        'language'=>[
                            'code'=>'es'],
                        'components'=>[ 
                            [
                                'type'=>'body',
                                'parameters'=>[
                                    [   //Link
                                        'type'=>'text',
                                        'text'=> 'https://riderschilenos.cl/seguimiento/'.$pedido->id
                                    ]
                                ]
                            ]
                        ]
                    ]
                    
                
            ];
            
            Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();
            WhatsappMensaje::create(['numero'=> $fono,
            'mensaje'=>"¡Hola! Muchas gracias por confiar en nuestro trabajo. Queremos informarte que tu pedido ya ha sido enviado y que en el siguiente link puedes descargar la boleta de envío donde encontraras el número de seguimiento. https://riderschilenos.cl/seguimiento/".$pedido->id."
            Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos al +56963176726. ¡Que tengas un buen día!",
            'type'=>'enviado']);

            if ($pedido->user_id) {
                $vendedor=Socio::find($pedido->user_id);
            }else{
                $vendedor=null;
            }
               
            if($vendedor){
            $fvend='569'.substr(str_replace(' ', '', $vendedor->fono), -8);
             //TOKEN QUE NOS DA FACEBOOK
             $token = env('WS_TOKEN');
             $phoneid= env('WS_PHONEID');
             $version='v16.0';
             $url="https://riderschilenos.cl/";
             $wsload=[
                 'messaging_product' => 'whatsapp',
                 "preview_url"=> false,
                 'to'=>$fvend,
                 
                 'type'=>'template',
                     'template'=>[
                         'name'=>'nueva_comision',
                         'language'=>[
                             'code'=>'es'],
                         'components'=>[ 
                            [
                                'type'=>'body',
                                'parameters'=>[
                                    [   //Link
                                        'type'=>'text',
                                        'text'=> number_format($comisiones)
                                    ]
                                ]
                            ]
                         ]
                     ]
                     
                 
             ];
             
             Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();
             WhatsappMensaje::create(['numero'=> $fvend,
            'mensaje'=>"¡Felicidades! Tienes $ ".number_format($comisiones)."en comisiones",
            'type'=>'enviado']);
            }
            $this->reset(['file']);
        } catch (\Throwable $th) {
           
            $this->reset(['file']);

        }

        $this->emit('actualizarPedidosCount');
        
    }

    public function retirado(Pedido $pedido)
    {   
            
        

        $pedido->status=7;
        $pedido->save();

        $valor=0;

        foreach ($pedido->ordens as $orden){
            $valor=$valor+1500;
        }

        $gasto=Gasto::create([
            'user_id'=> Auth()->user()->id,
            'metodo'=> 'TRANSFERENCIA',
            'estado'=> 1,
            'cantidad'=> $valor,
            'gastotype_id'=> 3 ]);

            $pedidos= Pedido::where('user_id',$pedido->user_id)
            ->where('status',7)
            ->orderby('status','DESC')
            ->latest('id')
            ->get();

            $comisiones=0;
            foreach($pedidos as $item){
                foreach ($item->ordens as $orden){
                        
                    if($item->pedidoable_type=="App\Models\Socio"){
                            $comisiones+=$orden->producto->comision_socio;
                        }
                    if($item->pedidoable_type=="App\Models\Invitado"){
                            $comisiones+=$orden->producto->comision_invitado;
                    }
                }
            }

    
        foreach ($pedido->ordens as $orden){
            $gasto->ordens()->attach($orden);
            }

        if($pedido->pedidoable_type == 'App\Models\Invitado'){
            $cliente=Invitado::find($pedido->pedidoable_id);
        }else{
            $cliente=Socio::find($pedido->pedidoable_id);
        }

        try {
            //TOKEN QUE NOS DA FACEBOOK
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
                     'name'=>'nro_seguimiento',
                     'language'=>[
                         'code'=>'es'],
                     'components'=>[ 
                        [
                            'type'=>'body',
                            'parameters'=>[
                                [   //Link
                                    'type'=>'text',
                                    'text'=> 'https://riderschilenos.cl/seguimiento/'.$pedido->id
                                ]
                            ]
                        ]
                     ]
                 ]
                 
             
         ];
         
         Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();
        

         if ($pedido->user_id) {
            $vendedor=Socio::find($pedido->user_id);
        }else{
            $vendedor=null;
        }
           
        if($vendedor){
        $fvend='569'.substr(str_replace(' ', '', $vendedor->fono), -8);
         //TOKEN QUE NOS DA FACEBOOK
         $token = env('WS_TOKEN');
         $phoneid= env('WS_PHONEID');
         $version='v16.0';
         $url="https://riderschilenos.cl/";
         $wsload=[
             'messaging_product' => 'whatsapp',
             "preview_url"=> false,
             'to'=>$fvend,
             
             'type'=>'template',
                 'template'=>[
                     'name'=>'nueva_comision',
                     'language'=>[
                         'code'=>'es'],
                     'components'=>[ 
                        [
                            'type'=>'body',
                            'parameters'=>[
                                [   //Link
                                    'type'=>'text',
                                    'text'=> number_format($comisiones)
                                ]
                            ]
                        ]
                     ]
                 ]
                 
             
         ];
         
         Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();
         WhatsappMensaje::create(['numero'=> $fvend,
        'mensaje'=>"¡Felicidades! Tienes $ ".number_format($comisiones)."en comisiones",
        'type'=>'enviado']);
        }
        
        $this->reset(['file']);
        } catch (\Throwable $th) {
            $this->reset(['file']);
        }
        
        $this->emit('actualizarPedidosCount');
    }

    public function download(Lote $lote){
        $pedido=$lote->ordens->first()->pedido;
        if($pedido->pedidoable_type == 'App\Models\Invitado'){
            $cliente=Invitado::find($pedido->pedidoable_id);
        }else{
            $cliente=Socio::find($pedido->pedidoable_id);
        }
        return response()->download(storage_path('app/public/'.$lote->resource->url),'Diseño '.$cliente->name.'.pdf');

    }

    public function close(Lote $lote){

        $lote->estado=2;
        $lote->save();
 
    }

    public function imagedestroy(ModelsImage $image){

        Storage::delete($image->url);
        $image->delete();
       
    }

}
