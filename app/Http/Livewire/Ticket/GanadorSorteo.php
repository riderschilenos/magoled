<?php

namespace App\Http\Livewire\Ticket;

use App\Models\Evento;
use App\Models\Ganadorsorteo as ModelsGanadorsorteo;
use App\Models\Inscripcion;
use Livewire\Component;

class GanadorSorteo extends Component
{   public $evento,$premio;

    protected $listeners = ['add_winner'];

    public function mount(Evento $evento){
        $this->evento=$evento;
    }

    public function render()
    {
        return view('livewire.ticket.ganador-sorteo');
    }

    public function add_winner(){
        $rules = [
            'premio'=>'required',
        ];
        $this->validate ($rules);

        $inscripcion = Inscripcion::whereHas('ticket', function ($query) {
            $query->where('evento_id', $this->evento->id)
                ->where('estado', 3); // Agregar condición de estado igual a 3
                })->whereNotIn('ticket_id', [976, 966,982,845,334,470,471,482,985,509,783,615,1207,392])->inRandomOrder()->first();

        if($inscripcion){
            ModelsGanadorsorteo::create(['inscripcion_id'=>$inscripcion->id,
                                    'name'=>$inscripcion->ticket->user->name,
                                    'nro_premio'=>$inscripcion->id,
                                    'premio'=>$this->premio,
                                    'evento_id'=>$inscripcion->ticket->evento_id]);
                           
           /* $inscripcion->ticket->status=4;
            $inscripcion->ticket->save();

            foreach ($inscripcion->ticket->inscripcions as $item){
                $item->estado=4;
                $item->save();
            
            }*/
        }
        $this->reset(['premio']);

        $this->evento=Evento::find($this->evento->id);

    }

}
