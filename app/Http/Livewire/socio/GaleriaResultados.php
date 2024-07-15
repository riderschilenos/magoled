<?php

namespace App\Http\Livewire\Socio;

use App\Models\Resultado;
use Livewire\Component;
use Livewire\WithPagination;

class GaleriaResultados extends Component
{   use WithPagination;

    public $search,$resultadoid;
    
    public $perPagesoc = 10;
    public $loadedCount = 5;

    protected $listeners = ['loadMore'];

    public function loadMore()
    {
        $this->perPagesoc += $this->loadedCount;
    }

    public function render()
    {  $resultados = Resultado::join('users', 'resultados.user_id', '=', 'users.id')
        ->select('resultados.*', 'users.name', 'users.email', 'users.updated_at')
        ->where(function($query) {
            $search = $this->search;
            $query->where('status', 2)
                ->where(function($query) use ($search) {
                    $query->where('titulo', 'LIKE', '%' . $search . '%')
                        ->orWhere('descripcion', 'LIKE', '%' . $search . '%')
                        ->orWhere('users.name', 'LIKE', '%' . $search . '%')
                        ->orWhere('users.email', 'LIKE', '%' . $search . '%');
                });
        })
        ->orderByDesc('resultados.created_at') // Ordenar por la columna 'fecha' de forma descendente
        ->paginate($this->perPagesoc);
    
    

        return view('livewire.socio.galeria-resultados',compact('resultados'));
    }

    public function setresultado(Resultado $resultado){
        $this->resultadoid = $resultado->id;
    }

    public function resetresultado(){
        $this->resultadoid = null;
    }
    
    public function limpiar_page(){
        $this->resetPage();
    }

}
