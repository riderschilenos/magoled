<?php

namespace App\Http\Livewire;

use App\Models\Encuesta;
use Livewire\Component;

class Encuestas extends Component
{   
    public $encuesta;

    public function mount($encuesta_id){
        $this->encuesta=Encuesta::find($encuesta_id);
    }
    public function render()
    {
        return view('livewire.encuestas');
    }

    public function updatevotation($id){
        if ($id=='a') {
            $this->encuesta->update(['a'=>$this->encuesta->a+=1]);
        } else if ($id=='b') {
            $this->encuesta->update(['b'=>$this->encuesta->b+=1]);
        } else if ($id=='c') {
            $this->encuesta->update(['c'=>$this->encuesta->c+=1]);
        }
        $this->encuesta->update(['votos'=>$this->encuesta->votos+=1]);
        return redirect()->route('encuesta')->with('info','Voto Recibido!');
    }
}
