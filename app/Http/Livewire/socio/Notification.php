<?php

namespace App\Http\Livewire\Socio;

use Livewire\Component;

class Notification extends Component
{   public $type;

    //protected $listeners = ['actualizarUsersCount'];

    public function mount($type){
        $this->type=$type;
    }

    public function render()
    {
        return view('livewire.socio.notification');
    }

    public function actualizarUsersCount()
    {
        // Forzar la renderización del componente PedidosCount
        $this->render();
    }

}
