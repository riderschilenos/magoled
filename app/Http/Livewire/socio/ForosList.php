<?php

namespace App\Http\Livewire\Socio;

use App\Models\Foro;
use Livewire\Component;

class ForosList extends Component
{
    public function render()
    {   $foros=Foro::all();
        return view('livewire.socio.foros-list',compact('foros'));
    }
}
