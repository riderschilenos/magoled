<?php

namespace App\Http\Livewire\Socio;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class OnlineStatus extends Component
{   public $type;

    //protected $listeners = ['actualizarUsersCount'];

    public function mount($type){
        $this->type=$type;
    }
    
    public function render()
    {   
        $users = User::orderBy('last_seen', 'desc')->get();
        return view('livewire.socio.online-status',compact('users'));
    }


    public function actualizarUsersCount()
    {
        // Forzar la renderización del componente PedidosCount
        $this->render();
    }
}
