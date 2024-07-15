<?php

namespace App\Http\Livewire\Tienda;

use App\Models\Pago;
use App\Models\Pedido;
use App\Models\Suscripcion;
use App\Models\Ticket;
use App\Models\Tienda;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class TiendaDashboard extends Component
{   public $tienda;

    protected $listeners =['imprimirTicket'];

    public function mount($tienda){
        $this->tienda=Tienda::find($tienda);
    }

    public function render()
    {   $pedidostotal = Pedido::whereHas('ordens', function ($query) {
                $query->whereHas('producto', function ($queryProducto) {
                    $queryProducto->where('tienda_id', $this->tienda->id);
                });
            })->where('status', '>=', 4)->get();

        $pedidos = Pedido::whereHas('ordens.producto', function ($queryProducto) {
                $queryProducto->where('tienda_id', $this->tienda->id);
            })->where('status', '>=', 4)
            ->where('created_at', '>=', now()->subDays(30))
            ->get();

        $pagos = Pago::whereHas('pedidos', function ($query) {
                $query->whereHas('ordens.producto', function ($queryProducto) {
                    $queryProducto->where('tienda_id', $this->tienda->id);
                })->where('status', '>=', 4);
            })
            ->get(); 
            
        $pagos30=Pago::whereHas('pedidos', function ($query) {
                $query->whereHas('ordens.producto', function ($queryProducto) {
                    $queryProducto->where('tienda_id', $this->tienda->id);
                })->where('status', '>=', 4);
            })
            ->where('created_at', '>=', now()->subDays(29))
            ->get();

        if($this->tienda->id==4){
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

            $mergedResults = collect()
                            ->merge($tickets30->map(function ($ticket) {
                                $ticket['type'] = 'Desafio';
                                return $ticket;
                            }))
                            ->merge($suscripcions30->map(function ($suscripcion) {
                                $suscripcion['type'] = 'Suscripcion';
                                return $suscripcion;
                            }))
                            ->merge($pagos30->map(function ($pago) {
                                $pago['type'] = 'Pago';
                                return $pago;
                            }))
                            ->merge($sortedTickets30->map(function ($ticket) {
                                $ticket['type'] = 'Sorteo';
                                return $ticket;
                            }))
                            ->sortBy('created_at');

            $latest7 = $mergedResults->take(-7)->sortByDesc('created_at');

        }else{
            $tickets30=null;
            $sortedTickets30 =null;
            $suscripcions30=null;
            $latest7 =null;
        }
        

       
        $pagos7=Pago::whereHas('pedidos', function ($query) {
                $query->whereHas('ordens.producto', function ($queryProducto) {
                    $queryProducto->where('tienda_id', $this->tienda->id);
                })->where('status', '>=', 4);
            })
            ->where('created_at', '>=', now()->subDays(7))
            ->get();

        $pagos_anual=Pago::whereHas('pedidos', function ($query) {
                $query->whereHas('ordens.producto', function ($queryProducto) {
                    $queryProducto->where('tienda_id', $this->tienda->id);
                })->where('status', '>=', 4);
            })
            ->where('created_at', '>=', now()->subDays(330))
            ->get();
        $pagos_anteanual=Pago::whereHas('pedidos', function ($query) {
                $query->whereHas('ordens.producto', function ($queryProducto) {
                    $queryProducto->where('tienda_id', $this->tienda->id);
                })->where('status', '>=', 4);
            })
            ->where('created_at', '>=', now()->subDays(730))
            ->where('created_at', '<', now()->subDays(330))
            ->get();

        $now=now();

        return view('livewire.tienda.tienda-dashboard',compact('sortedTickets30','latest7','now','tickets30','suscripcions30','pedidostotal','pedidos','pagos','pagos7','pagos30','pagos_anual','pagos_anteanual'));
    }

    public function imprimirTicket($data)
    {   

        //$this->search='recibido';
        $id=$data['message']['id'];
        
        $pedido=Http::get('https://riderschilenos.cl/api/v1/pedidos/'.$id);
        $pedido = $pedido->json();

        //dd($pedido);

        //$pedido=Pedido::find($id);
       

        $connector = new WindowsPrintConnector("smb://yo:123@desktop-75ae87n/blueprint");
        $printer = new Printer($connector);

        // Logo y nombre de la tienda
        $printer->text($pedido['tienda']['nombre']."\n");
        //$printer->text("CABANG KONOHA SELATAN\n\n");

        // Número de recibo y fecha
        $printer->text("Pedido No: " .$id. "\n");
        $printer->text(substr($pedido['created_at'],0,10). "\n\n");

        // Detalles de los ítems
        $printer->text("-----------------------------------------------\n");
        $printer->text("Item                 Qty             Subtotal\n");
        $printer->text("-----------------------------------------------\n");
        $total=0;
        foreach ($pedido['ordens'] as $orden) {
            $printer->text(sprintf(
                "%-15s      %2s             %6s\n",
                substr($orden['producto']['name'], 0, 15), // Truncar el nombre si es demasiado largo
                $orden['cantidad'],
                number_format($orden['cantidad'] * $orden['producto']['precio'], 2) // Calcular el subtotal
            ));
            $total+=$orden['cantidad'] * $orden['producto']['precio'];
        }

        // Total, cantidad pagada y cambio
        $printer->text("-----------------------------------------------\n");
        $printer->text("TOTAL:                              " . number_format($total, 2) . "\n");
        $printer->text("PAY AMOUNT: " . number_format(1000, 2) . "\n");
        $printer->text("CHANGE: " . number_format(10000, 2) . "\n");

        $printer->text("\n");
        // Corte del papel
        $printer->cut();

        // Cerrar la conexión con la impresora
        $printer->close();   
        
        
    }
}
