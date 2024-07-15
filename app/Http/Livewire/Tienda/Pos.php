<?php

namespace App\Http\Livewire\Tienda;

use App\Events\MyEvent;
use App\Events\PrintPedido;
use App\Models\Invitado;
use App\Models\Orden;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Socio;
use App\Models\Tienda;
use App\Models\User;
use App\Notifications\PrintTicket;
use Livewire\Component;
use Livewire\WithPagination;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;

class Pos extends Component
{   use WithPagination;

    public $search,$tienda,$product,$current;

    protected $listeners =['imprimirTicket'];

    public function mount(Tienda $tienda){
        $this->tienda=$tienda;
        $pedidos = Pedido::where('status', 1)->where('tienda_id',$this->tienda->id)
            ->orderBy('id', 'desc')
            ->paginate(4);

        if($pedidos->count()){
            $this->current=$pedidos->first();
        }
    }
    public function render()
    {   $productos = Producto::where('name', 'LIKE', '%' . $this->search . '%')
            ->where('tienda_id',$this->tienda->id)
            ->orderByRaw("CASE 
                                WHEN personalizable = 'no' THEN 1 
                                WHEN personalizable = 'sí' THEN 2 
                                ELSE 3 
                            END")
            ->orderByDesc('stock') // Orden descendente por la columna 'stock'
            ->paginate(8);

        $pedidos = Pedido::where('status', 1)->where('tienda_id',$this->tienda->id)
            ->orderBy('id', 'desc')
            ->paginate(4);

        

        return view('livewire.tienda.pos',compact('productos','pedidos'));
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
        $printer->text("CABANG KONOHA SELATAN\n\n");

        // Número de recibo y fecha
        $printer->text("No: " .'10'. "\n");
        $printer->text('18-10-2024'. "\n\n");

        // Detalles de los ítems
        $printer->text("-----------------------------------------------\n");
        $printer->text("Item                 Qty             Subtotal\n");
        $printer->text("-----------------------------------------------\n");

        foreach ($pedido['ordens'] as $orden) {
            $printer->text(sprintf(
                "%-15s      %2s             %6s\n",
                substr($orden['producto']['name'], 0, 15), // Truncar el nombre si es demasiado largo
                $orden['cantidad'],
                number_format($orden['cantidad'] * $orden['producto']['precio'], 2) // Calcular el subtotal
            ));
        }

        // Total, cantidad pagada y cambio
        $printer->text("-----------------------------------------------\n");
        $printer->text("TOTAL: " . number_format(1000, 2) . "\n");
        $printer->text("PAY AMOUNT: " . number_format(1000, 2) . "\n");
        $printer->text("CHANGE: " . number_format(10000, 2) . "\n");

        // Corte del papel
        $printer->cut();

        // Cerrar la conexión con la impresora
        $printer->close();   
        
    }

     public function printToThermalPrinter()
    {   
        $users=[];
        $users[]=User::find(1);
        
        Notification::send($users, new PrintTicket($this->current));

        /*
        $options = array(
            'cluster' => 'mt1',
            'useTLS' => true
          );
          $pusher = new Pusher(
            '4d3ca11564f1836a8e92',
            'b215d983fab38ddb0e78',
            '1791533',
            $options
          );
        
          $data['message'] = 'hello world';
          $pusher->trigger('my-channel', 'my-event', $data);
*/
    }

    public function findProduct()
    {   if ($this->search) {
            $this->product = Producto::where('sku', $this->search)->orwhere('name', 'LIKE', '%' . $this->search . '%')->first();
        }
            
        if($this->product){
                //return redirect()->route('tiendas.productos.edit',$this->product);
                //Agregar Producto al carro
                if($this->current){
                    if($this->current->ordens()->where('producto_id', $this->product->id)->exists()){
                        $this->current->ordens()->where('producto_id', $this->product->id)->first()->update(['cantidad'=>$this->current->ordens()->where('producto_id', $this->product->id)->first()->cantidad+1]);
                        $this->current->ordens()->where('producto_id', $this->product->id)->first()->save();
                        $this->current=Pedido::find($this->current->id);
                    }else{
                        $orden= Orden::create([
                            'producto_id'=> $this->product->id,
                            'pedido_id'=>$this->current->id,
                            'cantidad'=>1
                        ]);

                        $this->current=Pedido::find($this->current->id);
                    }
                   
                }else{
                    $pedido = Pedido::create([
                        'transportista_id'=> '3',
                        'pedidoable_id'=> auth()->user()->socio->id,
                        'status'=>1,
                        'tienda_id'=>$this->tienda->id,
                        'pedidoable_type'=> 'App\Models\Socio']);
                    $orden= Orden::create([
                            'producto_id'=> $this->product->id,
                            'pedido_id'=>$pedido->id,
                            'cantidad'=>1
                        ]);
                        
                    $this->current=Pedido::find($pedido->id);
       

                }

            $this->resetSearch(); // Llama a la función para limpiar el campo de búsqueda
        }
        
    }

    public function addProduct(Producto $producto)
    {   
            $this->product = $producto;
            
        if($this->product){
                //return redirect()->route('tiendas.productos.edit',$this->product);
                //Agregar Producto al carro
                if($this->current){
                    if($this->current->ordens()->where('producto_id', $this->product->id)->exists()){
                        $this->current->ordens()->where('producto_id', $this->product->id)->first()->update(['cantidad'=>$this->current->ordens()->where('producto_id', $this->product->id)->first()->cantidad+1]);
                        $this->current->ordens()->where('producto_id', $this->product->id)->first()->save();
                        $this->current=Pedido::find($this->current->id);
                    }else{
                        $orden= Orden::create([
                            'producto_id'=> $this->product->id,
                            'pedido_id'=>$this->current->id,
                            'cantidad'=>1
                        ]);

                        $this->current=Pedido::find($this->current->id);
                    }
                   
                }else{
                    $pedido = Pedido::create([
                        'transportista_id'=> '3',
                        'pedidoable_id'=> auth()->user()->socio->id,
                        'status'=>1,
                        'tienda_id'=>$this->tienda->id,
                        'pedidoable_type'=> 'App\Models\Socio']);
                    $orden= Orden::create([
                            'producto_id'=> $this->product->id,
                            'pedido_id'=>$pedido->id,
                            'cantidad'=>1
                        ]);
                        
                    $this->current=Pedido::find($pedido->id);
       

                }

            $this->resetSearch(); // Llama a la función para limpiar el campo de búsqueda
        }
        
    }

    public function set_current(Pedido $pedido){
        $this->current=$pedido;
    }

    public function new_pedido(){
        $pedido = Pedido::create([
            'transportista_id'=> '3',
            'pedidoable_id'=> auth()->user()->socio->id,
            'status'=>1,
            'tienda_id'=>$this->tienda->id,
            'pedidoable_type'=> 'App\Models\Socio']);
            
        $this->current=Pedido::find($pedido->id);
    }

    public function ordenup(Orden $orden){
        $orden->update(['cantidad'=>$orden->cantidad+1]);
        $this->current=Pedido::find($this->current->id);
    }

    public function ordendown(Orden $orden){
        if ($orden->cantidad==1) {
            $orden->delete();
        } else {
            $orden->update(['cantidad'=>$orden->cantidad-1]);
        }
        
        $this->current=Pedido::find($this->current->id);
    }

    public function destroy_pedido(Pedido $pedido){
        $pedido->delete();  

        $pedidos = Pedido::where('status', 1)->where('tienda_id',$this->tienda->id)
            ->orderBy('id', 'desc')
            ->paginate(4);

        return redirect()->route('tiendas.pos',$this->tienda);
    }

    public function resetSearch()
    {   
        $this->reset('search');
    }
}
