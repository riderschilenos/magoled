<?php

namespace App\Http\Livewire\Admin;

use App\Models\Gasto;
use App\Models\Gastotype;
use App\Models\Pago;
use App\Models\Pedido;
use App\Models\Smartphone;
use App\Models\Suscripcion;
use App\Models\Ticket;
use App\Models\Vendedor;
use Livewire\Component;

class Contabilidad extends Component
{   
    public $selectedperiodo, $tienda_id;

    public function mount($tienda_id){
        $this->tienda_id=$tienda_id;
    }

    public function render()
    {   $pedidos=Pedido::where('status',4)
        ->orwhere('status',5)
        ->orwhere('status',6) 
        ->orwhere('status',7)
        ->orwhere('status',8)
        ->orwhere('status',9)
        ->orderby('status','DESC')
        ->get();


        
        $suscripcion28=Suscripcion::all()->where('created_at', '>=', now()->subDays(28));


        $gastos=Gasto::all();
        $gastos7=Gasto::all()->where('created_at', '>=', now()->subDays(7));
        $gastos30=Gasto::all()->where('created_at', '>=', now()->subDays(29));
        $gastos_anual=Gasto::all()->where('created_at', '>=', now()->subDays(330));
        $gastos_anteanual=Gasto::all()->where('created_at', '>=', now()->subDays(730))->where('created_at', '<', now()->subDays(330));

        
        $pagos=Pago::all();
        $pagos7=Pago::all()->where('created_at', '>=', now()->subDays(7));
        $pagos30=Pago::all()->where('created_at', '>=', now()->subDays(29));
        $pagos_anual=Pago::all()->where('created_at', '>=', now()->subDays(330));
        $pagos_anteanual=Pago::all()->where('created_at', '>=', now()->subDays(730))->where('created_at', '<', now()->subDays(330));

        $suscripcions=Suscripcion::all();
        $suscripcions7=Suscripcion::all()->where('created_at', '>=', now()->subDays(7));
        $suscripcions30=Suscripcion::all()->where('created_at', '>=', now()->subDays(29));
        $suscripcions_anual=Suscripcion::all()->where('created_at', '>=', now()->subDays(330));
        $suscripcions_anteanual=Suscripcion::all()->where('created_at', '>=', now()->subDays(730))->where('created_at', '<', now()->subDays(330));


        $vendedors=Vendedor::all();

        $now=now();

        $gastotypes=Gastotype::all();

        if($this->tienda_id==4){
            $tickets7=Ticket::where('evento_id',13)
                ->where('created_at', '>=', now()->subDays(7))
                ->where('status','>=',3)->get();
            $tickets30=Ticket::where('evento_id',13)
                ->where('created_at', '>=', now()->subDays(29))
                ->where('status','>=',3)->get();
            $tickets_anual=Ticket::where('evento_id',13)
                ->where('created_at', '>=', now()->subDays(330))
                ->where('status','>=',3)->get();
            $tickets_anteanual=Ticket::where('evento_id',13)
                ->where('created_at', '>=', now()->subDays(730))
                ->where('created_at', '<', now()->subDays(330))
                ->where('status','>=',3)->get();

            
            $sortedTickets7 = Ticket::where('evento_id', 23)
                ->where('created_at', '>=', now()->subDays(7))
                ->where('status', '>=', 3)
                ->get();

            $sortedTickets30 = Ticket::where('evento_id', 23)
                ->where('created_at', '>=', now()->subDays(29))
                ->where('status', '>=', 3)
                ->get(); 

            $sortedTickets_anual = Ticket::where('evento_id', 23)
                ->where('created_at', '>=', now()->subDays(330))
                ->where('status', '>=', 3)
                ->get();
            $sortedTickets_anteanual = Ticket::where('evento_id', 23)
                ->where('created_at', '>=', now()->subDays(730))
                ->where('created_at', '<', now()->subDays(330))
                ->where('status', '>=', 3)
                ->get();

            $smartphones=Smartphone::all();

        }else{
            $tickets7=null;
            $tickets30=null;
            $tickets_anual=null;
            $tickets_anteanual=null;

            $sortedTickets7 =null;
            $sortedTickets30 =null;
            $sortedTickets_anual =null;
            $sortedTickets_anteanual =null;
            $smartphones=null;
           
        }

        

        return view('livewire.admin.contabilidad',compact('smartphones','tickets7','tickets30','tickets_anual','tickets_anteanual','sortedTickets7','sortedTickets30','sortedTickets_anual','sortedTickets_anteanual','gastotypes','suscripcions_anteanual','suscripcions_anual','suscripcions30','suscripcions7','pagos_anual','pagos_anteanual','gastos_anual','gastos_anteanual','suscripcion28','now','pedidos','suscripcions','gastos','pagos','gastos7','pagos7','gastos30','pagos30','vendedors'));
    }
}
