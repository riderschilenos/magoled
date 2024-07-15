<?php

namespace App\Http\Livewire\Admin;

use App\Models\Activitie;
use App\Models\Ticket;
use Livewire\Component;

class StravaCount extends Component
{   public $ticket;
    public function mount(Ticket $ticket){
        $this->ticket=$ticket;
    }

    public function render()
    {   $activities=Activitie::where('user_id',$this->ticket->user_id)->get();

        return view('livewire.admin.strava-count',compact('activities'));
    }
}
