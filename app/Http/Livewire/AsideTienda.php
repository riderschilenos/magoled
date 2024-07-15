<?php

namespace App\Http\Livewire;

use App\Models\Tienda;
use Livewire\Component;

class AsideTienda extends Component
{   public $tienda;

    public function mount($tienda){
        if ($tienda) {
            $this->tienda=Tienda::find($tienda);
        }else{
            $this->tienda=Tienda::find(4);
          
        }
    }

    public function render()
    {   $tiendas=Tienda::all();
        
        return view('livewire.aside-tienda',compact('tiendas'));
    }

}
