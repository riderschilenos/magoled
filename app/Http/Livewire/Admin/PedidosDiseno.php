<?php

namespace App\Http\Livewire\Admin;

use App\Models\Gasto;
use App\Models\Invitado;
use App\Models\Orden;
use App\Models\Pedido;
use App\Models\Socio;
use App\Models\Tienda;
use App\Models\User;
use App\Notifications\UpdateCount;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class PedidosDiseno extends Component
{   public $selected=[];
    use WithPagination;

    public $selectedProduccion, $selectedDescartar,$produccion, $descartar, $tienda ,$search;

    protected $listeners = ['actualizarPedidosCount'];

    public function mount($tienda){
        if ($tienda) {
            $this->tienda=Tienda::find($tienda);
        }else{
            $this->tienda=Tienda::find(4);
          
        }
       
    }

    public function render()
    {   $pedidos=Pedido::where('status',4)
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
                ->paginate(50);

        $users=User::all();

        $invitados= Invitado::all();
        $socios= Socio::all();

        $gastos=Gasto::where('user_id',auth()->user()->id)
                                ->orderby('id','DESC')
                                ->where('gastotype_id',2)
                                ->latest('id')
                                ->paginate(5);

        $gastosfull=Gasto::where('user_id',auth()->user()->id)
                ->orderby('id','DESC')
                ->where('gastotype_id',2)
                ->latest('id')
                ->get();                     

        return view('livewire.admin.pedidos-diseno',compact('pedidos','users','invitados','socios','gastos','gastosfull'));
    }

    public function updateselectedproduccion(){

        $this->produccion= True;

        $this->reset(['descartar']);
    }

    public function updateselecteddescartar(){

        $this->descartar= True;
        $this->reset(['produccion']);
    }

    public function download($orden_id){

        $orden=Orden::find($orden_id);
        $pedido=$orden->pedido;

        if($pedido->pedidoable_type == 'App\Models\Invitado'){
            $cliente=Invitado::find($pedido->pedidoable_id);
        }else{
            $cliente=Socio::find($pedido->pedidoable_id);
        }

        return response()->download(storage_path('app/public/'.$orden->referencia->url),'Recursos '.$cliente->name.'.jpg');
    }

    public function descartar()
    {
        
        foreach ($this->selected as $item){
            $orden = Orden::find($item);
            $orden->status = 2;
            $orden->save();
            foreach($orden->pedido->ordens as $orden){

                if($orden->status==2||$orden->status==3){
                    $orden->pedido->status=5;
                    $orden->pedido->save();
    
                }else{
                    $orden->pedido->status=4;
                    $orden->pedido->save();
                    break;
                }

            } 

        }

        $this->reset(['selected']);
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
}
