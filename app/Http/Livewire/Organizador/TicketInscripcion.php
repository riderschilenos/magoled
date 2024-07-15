<?php

namespace App\Http\Livewire\Organizador;

use App\Models\Disciplina;
use App\Models\Evento;
use App\Models\Fecha;
use App\Models\Fecha_categoria;
use App\Models\Invitado;
use App\Models\Socio;
use App\Models\Ticket;
use Livewire\Component;

class TicketInscripcion extends Component
{   
    public $evento, $selectedcategoria, $categoria_id, $ticket, $nro=1,$fechacategoria;

    public function mount(Ticket $ticket){
        
        $this->evento =Evento::find($ticket->evento_id);
        $this->ticket = $ticket;
            

        }

        public function render()
        {   
            $fechas= Fecha::where('evento_id',$this->evento->id)->paginate();
    
            $fecha = Fecha::where('evento_id',$this->evento->id)->first();
    
            
    
            $disciplinas= Disciplina::pluck('name','id');
    
            
            if($this->ticket->ticketable_type == 'App\Models\Invitado'){
                $socio = Invitado::find($this->ticket->ticketable_id);
            
            }else{
                $socio = Socio::find($this->ticket->ticketable_id);
            }
            
    
            return view('livewire.organizador.ticket-inscripcion',compact('fechas','disciplinas','socio','fecha'));
        }

    public function updatedselectedcategoria($category_product){
        $this->fechacategoria=Fecha_categoria::find($category_product);

        $this->categoria_id = $this->fechacategoria->categoria_id;
        
    }

    public function set_categoria($id){
        $this->fechacategoria=Fecha_categoria::find($id);
        if($this->fechacategoria->categoria->name=='20 Números x $40.000'){
            $this->nro=20;
        }
        if($this->fechacategoria->categoria->name=='15 Números x $30.000'){
            $this->nro=15;
        }
        if($this->fechacategoria->categoria->name=='10 Números x $20.000'){
            $this->nro=10;
        }
        if($this->fechacategoria->categoria->name=='5 Números x $10.000'){
            $this->nro=5;
        }
        if($this->fechacategoria->categoria->name=='2 Números x $4.000'){
            $this->nro=2;
        }
        if($this->fechacategoria->categoria->name=='1 Número x $2.000'){
            $this->nro=1;
        }


        $this->categoria_id = $this->fechacategoria->categoria_id;
    }

    public function categoria_clean(){

        $this->reset(['categoria_id']);
        
    }


}
