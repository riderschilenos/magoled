<?php

namespace App\Http\Livewire\Tienda;

use App\Models\Producto;
use App\Models\Stock;
use Livewire\Component;

class ProductoStock extends Component
{   public $producto,$stock, $detalle='Ingreso',$wstock, $wdetalle,$stockedit,$stockedit_id;

    public function mount($producto_id){
        $this->producto=Producto::find($producto_id);
    }
    public function render()
    {
        return view('livewire.tienda.producto-stock');
    }

    public function stockcreate(){
        $rules = [
            'stock'=>'required',
        ];
        $this->validate ($rules);
        
        Stock::create([
            'cantidad' => $this->stock,
            'stockable_id' => $this->producto->id,
            'detalle' => $this->detalle,
            'stockable_type' => 'App\Models\Producto',
        ]);
        
        $ingresos=0;
        $mermas=0;
        $producto=Producto::find($this->producto->id);
        foreach($producto->stocks as $stock){
            if($stock->detalle=='Ingreso'){
                $ingresos+=$stock->cantidad;
            }
            if($stock->detalle=='Merma'){
                $mermas+=$stock->cantidad;
            }
        }
        $ordenescount=0;
        foreach($producto->ordenes as $orden){
            if ($orden->pedido->status>3) {
                if ($orden->cantidad) {
                    $ordenescount+=$orden->cantidad;
                } else {
                    $ordenescount+=1;
                }
            }
        }

        $producto->update(['stock'=>($ingresos-$ordenescount-$mermas)]);

        return redirect()->route('tiendas.productos.edit',$producto)->with('info','Ingreso Exitoso! Stock Actual: '.($ingresos-$ordenescount-$mermas));
    }

    public function set_editstock($stock_id){
        $this->stockedit_id=$stock_id;
        $this->stockedit=Stock::find($stock_id);
        $this->wstock=$this->stockedit->cantidad;
        $this->wdetalle=$this->stockedit->detalle;

    }
    public function save_stock(){
        
        $this->stockedit->update(['cantidad'=>$this->wstock,
                                'detalle'=>$this->wdetalle]);
        $ingresos=0;
        $mermas=0;
        $producto=Producto::find($this->producto->id);
        foreach($producto->stocks as $stock){
            if($stock->detalle=='Ingreso'){
                $ingresos+=$stock->cantidad;
            }
            if($stock->detalle=='Merma'){
                $mermas+=$stock->cantidad;
            }
        }
        $ordenescount=0;
        foreach($producto->ordenes as $orden){
            if ($orden->pedido->status>3) {
                if ($orden->cantidad) {
                    $ordenescount+=$orden->cantidad;
                } else {
                    $ordenescount+=1;
                }
            }
        }

        return redirect()->route('tiendas.productos.edit',$producto)->with('info','Ingreso Exitoso! Stock Actual: '.($ingresos-$ordenescount-$mermas));

    }
    

    public function destroystock(Stock $stock){
        $stock->delete();
        return redirect()->route('tiendas.productos.edit',$this->producto);
    }
}
