<?php

namespace App\Http\Livewire\Vendedor;

use App\Models\Producto;
use App\Models\Tienda;
use Livewire\Component;
use Livewire\WithPagination;

class PublicShow extends Component
{   use WithPagination;

    
    public $search, $product, $store;

    public $filters=[
         'personalizable'=>'',
        'stock'=>'',
        'tiendaid'=>''
    ];

    public function mount($tienda_id){
           $this->store=Tienda::find($tienda_id);
    }

    public function render()
    {   if ($this->store) {
            $productos = Producto::where('name', 'LIKE', '%' . $this->search . '%')
            ->where(function ($query) {
                $query->where('tienda_id', $this->store->id);
            })
            ->where('rch_view', 'SI')
            ->where('image', '!=', 'NULL')
            ->latest('id')
            ->paginate(50);
        } else {
            $productos = Producto::filter($this->filters)->where('name', 'LIKE', '%' . $this->search . '%')
            ->where(function ($query) {
                $query->where('tienda_id', 4)
                    ->orWhere('tienda_id', 10);
            })
            ->where('rch_view', 'SI')
            ->where('image', '!=', 'NULL')
            ->latest('id')
            ->paginate(50);
        }
    
       
        return view('livewire.vendedor.public-show',compact('productos'));
    }

    

    public function set_product($producto_id){
        $this->product=Producto::find($producto_id);
    }
    
    public function limpiar_page(){
        $this->resetPage();
    }
}
