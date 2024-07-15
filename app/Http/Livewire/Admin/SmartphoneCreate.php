<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category_product;
use App\Models\Disciplina;
use App\Models\Marca;
use App\Models\Marcasmartphone;
use App\Models\Smartphone;
use App\Models\Stock;
use Livewire\Component;

class SmartphoneCreate extends Component
{   public $selectedcategory;

    public function mount(){
       
    }

    public $selectedmarca, $search, $obj, $stock, $editable,$detalle="Ingreso";

    protected $rules = [
        'editable.stock'=>'required',
         ];
    

    public function render()
    {   $disciplinas=Disciplina::all();

        $marcas = Marcasmartphone::all();

        $category_products=Category_product::all();

        $smartphones = Smartphone::Where('modelo', 'LIKE', '%' . $this->search . '%')->withCount('ordenes')->orderByDesc('stock')->get();

        $smartphonesall = Smartphone::withCount('ordenes')->orderByDesc('stock')->get();

        $marcasmartphones=Marcasmartphone::all();

       
        foreach($smartphones as $smartphone){
            $compratotal=0;
            $merma=0;
            $ventas=0;
            foreach ($smartphone->stocks as $stock) {
                if ($stock->detalle=="Ingreso") {
                    $compratotal+=$stock->cantidad;
                } elseif($stock->detalle=="Merma") {
                    $merma+=$stock->cantidad;
                }
            }
            foreach ($smartphone->ordenes as $orden){
                if ($orden->pedido->status>3) {
                        if ($orden->cantidad) {
                            $ventas+=$orden->cantidad;
                        } else {
                            $ventas+=1;
                        }
                }
            }
            $smartphone->stock=$compratotal-$merma-$ventas;
            $smartphone->save();
        }

        return view('livewire.admin.smartphone-create',compact('smartphonesall','disciplinas','category_products','marcas','smartphones','marcasmartphones'));
    }

    public function toggleNotification($smartphoneId)
    {
        // Busca el smartphone por ID
        $smartphone = Smartphone::findOrFail($smartphoneId);

        // Cambia el estado de la notificación
        if($smartphone->notification == 'checked'){
            $smartphone->notification = NULL;
        }else{
            $smartphone->notification = 'checked';
        }
        $smartphone->save();
    }

    public function updatedselectedmarca($marca){
        
        $this->selectedmarca=$marca;
    
    }

    public function edit($value){
        $this->obj = $value;
        $this->editable = Smartphone::find($value);
        $this->stock=-$this->editable->stock;
    }

    public function editadd1($value){
        $this->obj = $value;
        $this->editable = Smartphone::find($value);
        $this->stock=1;
    }
    public function editadd2($value){
        $this->obj = $value;
        $this->editable = Smartphone::find($value);
        $this->stock=2;
    }
    public function editadd3($value){
        $this->obj = $value;
        $this->editable = Smartphone::find($value);
        $this->stock=3;
    }

    public function update(Smartphone $editable){
         
         $this->editable->save();
         $this->reset(['obj','editable']);
     }
    
    public function stockcreate(Smartphone $editable){
         
        Stock::create([
            'cantidad'=>$this->stock,
            'stockable_id'=> $this->editable->id,
            'detalle'=>$this->detalle,
            'stockable_type'=> 'App\Models\Smartphone',
        ]);

        $smartphones = Smartphone::withCount('ordenes')->orderByDesc('stock')->get();
       
        foreach($smartphones as $smartphone){
            $compratotal=0;
            $merma=0;
            $ventas=0;
            foreach ($smartphone->stocks as $stock) {
                if ($stock->detalle=="Ingreso") {
                    $compratotal+=$stock->cantidad;
                } elseif($stock->detalle=="Merma") {
                    $merma+=$stock->cantidad;
                }
            }
            $smartphone->stock=$compratotal-$merma-$ventas;
            $smartphone->save();
        }

        

        $this->reset(['obj','editable']);
        $this->render();
    }

    public function refresh(){
        $smartphones=Smartphone::where('stock','<',0)->get();
        foreach($smartphones as $smartphone){
            Stock::create([
                'cantidad'=>-$smartphone->stock,
                'stockable_id'=> $smartphone->id,
                'detalle'=>'Ingreso',
                'stockable_type'=> 'App\Models\Smartphone',
            ]);
        }
        
        $this->render();
    }

    public function destroystock(Stock $stock){
        $stock->delete();
    }

     public function cancel(){
         
        $this->reset(['obj','editable']);
    }


    public function limpiar_page(){
        $this->resetPage();
    }

}
