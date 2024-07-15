<?php

namespace App\Http\Livewire\Ticket;

use App\Models\Invitado;
use App\Models\Socio;
use App\Models\Ticket;
use Livewire\Component;

class TicketCode extends Component
{   public $ticket, $code ,$sociocode;

    public function mount(Ticket $ticket){
        $this->ticket=$ticket;
        if($ticket->code_id){
            $this->sociocode=Socio::where('user_id',$ticket->code_id)->first();
        //    $this->code=$this->sociocode->slug;
        }
    }
    public function render()
    {
        return view('livewire.ticket.ticket-code');
    }

    public function getSociosProperty(){
        return  Socio::where('slug','LIKE','%'. $this->code .'%')
        ->orwhere('name','LIKE','%'. $this->code .'%')
        ->orwhere('fono','LIKE','%'. $this->code .'%')
        ->latest('id')
        ->paginate(3);
    }

}
