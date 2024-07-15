<?php

namespace App\Http\Livewire\Admin;

use App\Models\Invitado;
use App\Models\Pedido;
use App\Models\Socio;
use App\Models\Tienda;
use App\Models\WhatsappMensaje;
use Livewire\Component;

class PedidosCount extends Component
{   public $cliente, $tienda;

    protected $listeners = ['actualizarPedidosCount'];

    public function mount($tienda){
        if ($tienda) {
            $this->tienda=Tienda::find($tienda);
        }else{
            $this->tienda=Tienda::find(4);
          
        }
       
    }

    public function render()
    {   $diseños=Pedido::where('status',4)
                ->whereHas('ordens.producto', function ($queryProducto) {
                    $queryProducto->where('tienda_id', $this->tienda->id);
                })
                ->orderBy('id', 'desc')
                ->get();
        $produccion=Pedido::where('status',5)
                ->whereHas('ordens.producto', function ($queryProducto) {
                    $queryProducto->where('tienda_id', $this->tienda->id);
                })
                ->orderBy('id', 'desc')
                ->get();
        $despacho=Pedido::where('status',6)
                ->whereHas('ordens.producto', function ($queryProducto) {
                    $queryProducto->where('tienda_id', $this->tienda->id);
                })
                ->orderBy('id', 'desc')
                ->get();
        

        $socios=Socio::all();
        $invitados=Invitado::all();
        $mensajes=WhatsappMensaje::where('id','>',1)->orderby('id')->get();

        return view('livewire.admin.pedidos-count',compact('mensajes','socios','invitados','diseños','produccion','despacho'));
    }

    public function set_cliente(Pedido $pedido){
        if($pedido->pedidoable_type == 'App\Models\Invitado'){
            $this->cliente=Invitado::find($pedido->pedidoable_id);
        }else{
            $this->cliente=Socio::find($pedido->pedidoable_id);
        }
    }

    public function cliente_clean(){
        $this->reset(['cliente']);
    }

    public function actualizarPedidosCount()
    {
        // Forzar la renderización del componente PedidosCount
        $this->render();
    }
}
