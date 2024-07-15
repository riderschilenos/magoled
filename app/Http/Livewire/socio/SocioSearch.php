<?php

namespace App\Http\Livewire\Socio;

use App\Models\Disciplina;
use App\Models\Socio;
use Livewire\Component;
use Livewire\WithPagination;

class SocioSearch extends Component
{   
    use WithPagination;

    protected $listeners = ['loadMore2'];

    public $search, $type;
    
    public $perPagesoc = 10;
    public $loadedCount = 5;

    public function loadMore($loadedCount)
    {
        $this->perPagesoc += $loadedCount;
    }

    public function loadMore2()
    {
        $this->perPagesoc += 5;
    }
    public function mount($type){
        $this->type=$type;
    }
    public function render()
    {   
        $disciplinas = Disciplina::all();

        $sociosfull = Socio::all();

        $socios = Socio::join('users', 'socios.user_id', '=', 'users.id')
                            ->select('socios.*', 'users.name', 'users.email', 'users.updated_at')
                            ->where(function($query) {
                                $search = $this->search;
                                $query->where('rut', 'LIKE', '%' . $search . '%')
                                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                                    ->orWhere('socios.name', 'LIKE', '%' . $search . '%')
                                    ->orWhere('users.name', 'LIKE', '%' . $search . '%')
                                    ->orWhere('socios.slug', 'LIKE', '%' . $search . '%');
                            })
                            ->orderByRaw("CASE WHEN users.profile_photo_path IS NOT NULL THEN 0 ELSE 1 END, 
                            CASE WHEN socios.created_at >= CURDATE() THEN 0 ELSE 1 END, 
                            CASE WHEN socios.updated_at >= CURDATE() THEN 0 ELSE 1 END, 
                            id DESC")
                            ->paginate($this->perPagesoc);
        $sociosmoto=Socio::join('users', 'socios.user_id', '=', 'users.id')
                        ->select('socios.*', 'users.name', 'users.email', 'users.updated_at')
                        ->where(function($query) {
                            $search = $this->search;
                            $query->where('rut', 'LIKE', '%' . $search . '%')
                                ->orWhere('email', 'LIKE', '%' . $search . '%')
                                ->orWhere('socios.name', 'LIKE', '%' . $search . '%')
                                ->orWhere('users.name', 'LIKE', '%' . $search . '%')
                                ->orWhere('socios.slug', 'LIKE', '%' . $search . '%');
                        })
                        ->whereNotIn('socios.disciplina_id', [2, 4, 5, 8, 11, 13, 14, 15]) // Agregar esta línea para excluir disciplina_id
                        ->orderByRaw("CASE WHEN users.profile_photo_path IS NOT NULL THEN 0 ELSE 1 END, 
                        CASE WHEN socios.created_at >= CURDATE() THEN 0 ELSE 1 END, 
                        CASE WHEN socios.updated_at >= CURDATE() THEN 0 ELSE 1 END, 
                        id DESC")
                        ->paginate($this->perPagesoc);
        
        $sociosbici=Socio::join('users', 'socios.user_id', '=', 'users.id')
                        ->select('socios.*', 'users.name', 'users.email', 'users.updated_at')
                        ->where(function($query) {
                            $search = $this->search;
                            $query->where('rut', 'LIKE', '%' . $search . '%')
                                ->orWhere('email', 'LIKE', '%' . $search . '%')
                                ->orWhere('socios.name', 'LIKE', '%' . $search . '%')
                                ->orWhere('users.name', 'LIKE', '%' . $search . '%')
                                ->orWhere('socios.slug', 'LIKE', '%' . $search . '%');
                        })
                        ->whereIn('socios.disciplina_id', [2, 4, 5, 8, 14, 15,10]) // Agregar esta línea para excluir disciplina_id
                        ->orderByRaw("CASE WHEN users.profile_photo_path IS NOT NULL THEN 0 ELSE 1 END, 
                        CASE WHEN socios.created_at >= CURDATE() THEN 0 ELSE 1 END, 
                        CASE WHEN socios.updated_at >= CURDATE() THEN 0 ELSE 1 END, 
                        id DESC")
                        ->paginate($this->perPagesoc);
    

        
        return view('livewire.socio.socio-search',compact('socios','sociosmoto','sociosbici','disciplinas','sociosfull'));
    }

    

    public function limpiar_page(){
        $this->perPagesoc = 6;
        $this->resetPage();
    }
}
