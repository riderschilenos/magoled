<div class="mb-6 pb-6">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    @php
        $pendientesdepago=0;
        $mpendientesdepago=0;
        $pagados=0;
        $mpagados=0;

        $mppagados=0;
        $mpmpagados=0;

        $trpagados=0;
        $trmpagados=0;
        
    @endphp
   
   @foreach ($ticketsall as $tick)
        @if ($tick->status==1)
            @php
                $pendientesdepago+=1;
                $mpendientesdepago+=$tick->inscripcion;
            @endphp
        @endif
        @if ($tick->status>=3)
            @php
                $pagados+=1;
                $mpagados+=$tick->inscripcion;
            @endphp
        @endif
        @if ($tick->status>=3)
            @if ($tick->metodo=='TRANSFERENCIA')
                @php
                    $trpagados+=1;
                    $trmpagados+=$tick->inscripcion;
                @endphp
            @else
                @php
                    $mppagados+=1;
                    $mpmpagados+=$tick->inscripcion;
                @endphp
                
            @endif
               
        @endif
       
   @endforeach
        <div class="mb-12 grid grid-cols-2 gap-y-10 gap-x-6 md:grid-cols-2 xl:grid-cols-4 mx-2">
          <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
          
            <div class="p-4 text-right">
              <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600"> {{number_format($pendientesdepago,0)}} Pendientes de Pago</p>
              <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">$ {{number_format($mpendientesdepago,0)}} </h4>
             
            </div>
          </div>
          <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
          
            <div class="p-4 text-right">
              <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">{{number_format($pagados,0)}} Tickets Pagados</p>
              <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">$ {{number_format($mpagados,0)}}</h4>
              <h4 class="block antialiased tracking-normal font-sans text-sm font-semibold leading-snug text-blue-gray-900">MP -$ {{number_format($mpmpagados*0.038,0)}} </h4>
            </div>
          </div>
          <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
          
            <div class="p-4 text-right">
              <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">{{number_format($mppagados,0)}} MercadoPago</p>
              <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">$ {{number_format($mpmpagados,0)}}</h4>
              <h4 class="block antialiased tracking-normal font-sans text-sm font-semibold leading-snug text-blue-gray-900">MP -$ {{number_format($mpmpagados*0.038,0)}} </h4>
            </div>
          </div>
          <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
         
            <div class="p-4 text-right">
              <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">{{number_format($trpagados,0)}} Transferencia / Efectivo</p>
              <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">$ {{number_format($trmpagados,0)}}</h4>
            </div>
          </div>
        </div>
      

    <div x-data="setup()" >
        <ul class="flex justify-center items-center my-4" wire:ignore>
            <template x-for="(tab, index) in tabs" :key="index">
                <li class="cursor-pointer py-3 px-4 rounded transition"
                    :class="activeTab===index ? 'bg-green-500 text-white' : ' text-gray-500'" @click="activeTab = index"
                    x-text="tab"></li>
            </template>
        </ul>
    @php
        $gananciatotal=0;
    @endphp
    <div x-show="activeTab===0">
        
        <x-table-responsive>
            <div class="px-6 py-4">
                <input wire:keydown="limpiar_page" wire:model="search"  class="flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg" placeholder="Buscar Rider...">
            </div>

            @if ($tickets->count())

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Rut
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Ticket Nro:
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Categoria / Nro
                        </th>
                    
                    
                        <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($tickets as $tick)

                            @if ($tick->ticketable_type=='App\Models\Socio')
                                        @foreach ($socios as $item)
                                            
                                    
                                            @php
                                                if($tick->ticketable_id==$item->id){
                                                    $sponsor=$item;
                                                }else{
                                                    $sponsor=null;
                                                }
                                            @endphp    
                                            @if ($sponsor)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                        @if ($sponsor->user->profile_photo_url)
                                                            <img class="h-11 w-11 object-cover object-center rounded-full" src="{{$sponsor->user->profile_photo_url}}" alt="">
                                                        @endif
                                                            </div>
                                                            <div class="ml-4">
                                                            <a href="{{route('ticket.historial.view',$sponsor->user)}}" target="_blank">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    {{$sponsor->name.' '.$sponsor->last_name}}<br>
                                                                    {{$sponsor->user->email}}<br>
                                                                
                                                                        @if ($sponsor->fono)
                                                                            {{$sponsor->fono}}
                                                                        @endif
                                                                
                                                                
                                                                
                                                                </div>
                                                            </a>
                                                            </div>
                                                            @can('Super admin')
                                                                @if ($tick->status>=3)
                                                                    
                                                                
                                                                    @php
                                                                        if($tick->metodo=='TRANSFERENCIA'){
                                                                            $ganancia=($tick->inscripcion*$tick->evento->comision/100);
                                                                        }elseif(IS_NULL($tick->metodo) || $tick->metodo=='MERCADOPAGO'){
                                                                            $ganancia=($tick->inscripcion*$tick->evento->comision/100)-($tick->inscripcion*0.037961);
                                                                        }
                                                                        $gananciatotal+=$ganancia;
                                                                    @endphp
                                                                <span class="text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-base/none text-success bg-success-light rounded-lg">
                                                                    +${{number_format($ganancia,0)}} <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-1">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                                                    </svg></span>  
                                                                    
                                                                @endcan
                                                            @endif
                                                        </div>
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if ($sponsor->rut)
                                                            <div class="text-sm text-gray-900 text">{{$sponsor->rut}}</div>
                                                        @endif
                                                    
                                                        
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                                        <div class="text-sm text-gray-900 text-center">
                                                            
                                                            @foreach ($sponsor->tickets->reverse() as $ticket)
                                                                @if ($ticket->id==$tick->id)

                                                                    @if ($ticket->status<=2)
                                                                        @if ($ticket->status==2)

                                                                            <a href="{{route('ticket.view',$ticket)}}" target="_blank" class="btn btn-danger h-10 my-auto">Nro: {{$ticket->id}} (CERRADO)</a>
                                                                            @break
                                                                        @else
                                                                            <a href="{{route('payment.checkout.ticket',$ticket)}}" class="btn bg-gray-200 h-10 my-auto">Nro: {{$ticket->id}} (SIN PAGAR)</a>
                                                                            @break
                                                                        @endif
                                                                    @else
                                                                        @if ($ticket->status==3)

                                                                            <a href="{{route('ticket.view',$ticket)}}" target="_blank" class="btn btn-success h-10 my-auto">Nro: {{$ticket->id}} PAGADO</a>
                                                                            
                                                                            {{$ticket->inscripcion}}
                                                                           
                                                                            
                                                                            @break
                                                                        @else
                                                                     
                                                                            <a href="{{route('ticket.view',$ticket)}}" target="_blank" class="btn btn-danger h-10 my-auto">Nro: {{$ticket->id}} COBRADO</a>

                                                                            @if ($ticket->evento->type=='desafio')
                                                                                <button wire:click="strava_wtsp({{$ticket->id}})" class="btn bg-green-200 my-auto text-xs">REENVIAR WHATSAP</button>
                                                                                @if ($ticket->pedido)
                                                                                    <a href="{{route('vendedor.pedidos.edit',$ticket->pedido)}}" target="_blank" class="btn btn-success h-10 my-auto mt-2">Pedido Nro: {{$ticket->pedido->id}}</a>
                                                                                @else
                                                                                    <a wire:click="realizarpedido({{$ticket->id}})" target="_blank" class="btn bg-gray-200 hover:bg-gray-100 h-10 my-auto cursor-pointer">Realizar Pedido</a>
                                                                                @endif
                                                                            @endif
                                                                          

                                                                            @break
                                                                        @endif

                                                                        @break
                                                                    @endif
                                                                
                                                                    @break
                                                                    
                                                                @endif
                                                                
                                                            @endforeach
                                                            
                                                        
                                                        </div>
                                                        
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                                        <div class="text-sm text-gray-900 text-center">
                                                        
                                                                    @isset($ticket->inscripcions)
                                                                        @foreach ($ticket->inscripcions as $inscripcion)
                                                                                        
                                                                                            <div class="flex">
                                                                                                
                                                                                                        <div class="px-6 py-4 whitespace-nowrap">
                                                                                                    
                                                                                                        {{-- comment   {{$fecha->name}} --}} {{$inscripcion->fecha_categoria->categoria->name}}
                                                                                                                                        <br>
                                                                                                                                        {{$inscripcion->fecha->name}}
                                                                                                        </div>
                                                                                            
                                                                                                
                                                                    
                                                                                                        <div class="px-6 py-4 whitespace-nowrap">
                                                                                                            <div class="items-center">
                                                                                                            @if ($ticket->evento->type=='desafio')
                                                                                                                @php
                                                                                                                    $total=0;
                                                                                                                @endphp
                                                                                                                    @if ($ticket->user->activities)
                                                                                                                        @foreach ($ticket->user->activities as $activitie)
                                                                                                                            @php
                                                                                                                                $date1=date($activitie->start_date_local);
                                                                                                                                if ($ticket->status>=4) {
                                                                                                                                    $date2=date($ticket->created_at);
                                                                                                                                } else {
                                                                                                                                    $date2=date($ticket->updated_at);
                                                                                                                                }
                                                                                                                                
                                                                                                                               
                                                                                                                            @endphp
                                                                                                                            {{-- comment
                                                                                                                            {{$date1}}<br>
                                                                                                                            {{$date2}} <br> --}}
                                                                                                                        
                                                                                                                            @if ($date1>$date2 && ($activitie->type=='Ride' or $activitie->type=='VirtualRide'))
                                                                                                                                @php
                                                                                                                                        $total+=floatval($activitie->distance);
                                                                                                                                @endphp
                                                                                                                            @endif
                                                                                                                        
                                                                                                                        @endforeach
                                                                                                                    @endif
                                                                                                                <p class="mx-4 text-center"> {{$total}} Kms</p>

                                                                                                               
                                                                                                        @endif
                                                                                                               
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    
                                                                                                </div> 
                                                                                                    
                                                                
                                                    
                        
                                                                        @endforeach
                                                                    @endif
                                                            
                                                        
                                                        </div>

                                                       
                                                    
                                                       
                                                    </td>

                                                    
                                                    

                                                    
                                                    <td class="text-center text-sm font-medium">

                                           
                                                        @can('Super admin')
                                                            @if ($ticket->status==1)
                                                                <div>
                                                                    <button type="button" wire:click="alertPayment({{$ticket->id}})" class="btn btn-success cursor-pointer h-10 my-auto">PAGO MANUAL</button>
                                                                    <button type="button" wire:click="alertConfirm({{$ticket->id}})" class="btn btn-danger p-2 w-full mt-2">Eliminar Ticket</button>
                                                                </div>
                                                            @endif
                                                            @if (!IS_NULL($ticket->metodo) && $ticket->status>=3)
                                                                @if ($ticket->metodo=='TRANSFERENCIA')
                                                                   <a  class="font-bold py-2 px-4 rounded bg-red-500 text-white cursor-pointer h-10 my-auto">TRANSFERENCIA</a>
                                                                @endif
                                                                @if ($ticket->metodo=='MERCADOPAGO')
                                                                    <a  class="font-bold py-2 px-4 rounded bg-blue-500 text-white cursor-pointer h-10 my-auto">MERCADOPAGO</a>
                                                                @endif
                                                            @elseif($ticket->status>=3)
                                                                <a  class="font-bold py-2 px-4 rounded bg-blue-500 text-white cursor-pointer h-10 my-auto">MERCADOPAGO</a>
                                                            @endif
                                                        @endcan   
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                            @else
                                    @foreach ($invitados as $item)
                                            
                                    
                                        @php
                                            if($tick->ticketable_id==$item->id){
                                                $sponsor=$item;
                                            }else{
                                                $sponsor=null;
                                            }
                                        @endphp  

                                        @if ($sponsor)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                         
                                                                <img class="h-11 w-11 object-cover object-center rounded-full" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="">
                                                         
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{$sponsor->name}} (Invitado)<br>
                                                                {{$sponsor->email}}<br>
                                                            
                                                                    @if ($sponsor->fono)
                                                                        {{$sponsor->fono}}
                                                                    @endif
                                                            
                                                            
                                                            
                                                            </div>
                                                     
                                                        </div>
                                                        <div class="ml-auto">
                                                            @can('Super admin')
                                                                @if ($tick->status>=3)
                                                                    
                                                                
                                                                    @php
                                                                        if($tick->metodo=='TRANSFERENCIA'){
                                                                            $ganancia=($tick->inscripcion*$tick->evento->comision/100);
                                                                        }elseif(IS_NULL($tick->metodo) || $tick->metodo=='MERCADOPAGO'){
                                                                            $ganancia=($tick->inscripcion*$tick->evento->comision/100)-($tick->inscripcion*0.037961);
                                                                        }
                                                                        $gananciatotal+=$ganancia;
                                                                    @endphp
                                                                    <span class="text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-base/none text-success bg-success-light rounded-lg">
                                                                    +${{number_format($ganancia,0)}} <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-1">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                                                    </svg></span>  
                                                                @endif
                                                            @endcan
                                                           
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if ($sponsor->rut)
                                                        <div class="text-sm text-gray-900 text">{{$sponsor->rut}}</div>
                                                    @endif
                                                
                                                    
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                                    <div class="text-sm text-gray-900 text-center">
                                                        <div>
                                                                    @if ($tick->status<=2)
                                                                        @if ($tick->status==2)

                                                                            <a href="{{route('ticket.view',$tick)}}" target="_blank" class="btn btn-danger h-10 my-auto">Nro: {{$tick->id}} (CERRADO)</a>
                                                                    
                                                                        @else
                                                                            <a href="{{route('payment.checkout.ticket',$tick)}}" target="_blank" class="btn bg-gray-200 h-10 my-auto">Nro: {{$tick->id}} (SIN PAGAR)</a>
                                                                        
                                                                        @endif
                                                                    @else
                                                                        @if ($tick->status==3)

                                                                            <a href="{{route('ticket.view',$tick)}}" target="_blank" class="btn btn-success h-10 my-auto">Nro: {{$tick->id}} PAGADO</a>
                                                                           
                                                                        
                                                                        @else
                                                                            <a href="{{route('ticket.view',$tick)}}" target="_blank" class="btn btn-danger h-10 my-auto">Nro: {{$tick->id}} COBRADO</a>
                                                                          
                                                                        @endif

                                                                    @endif
                                                                
                                                                
                                                                    
                                                                
                                                    
                                                    </div>
                                                    
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                                    <div class="text-sm text-gray-900 text-center">
                                                    
                                                                @isset($tick->inscripcions)
                                                                    @foreach ($tick->inscripcions as $inscripcion)
                                                                                    
                                                                                        <div class="flex">
                                                                                            
                                                                                                    <div class="px-6 py-4 whitespace-nowrap">
                                                                                                
                                                                                                    {{-- comment   {{$fecha->name}} --}} {{$inscripcion->fecha_categoria->categoria->name}}
                                                                                                    <br>
                                                                                                    {{$inscripcion->fecha->name}}
                                                                                                    
                                                                                                    </div>
                                                                                        
                                                                                            
                                                                
                                                                                                    <div class="px-6 py-4 whitespace-nowrap">
                                                                                                        <div class="items-center">
                                                                                                            <p class="mx-4 text-center">{{$inscripcion->nro}}</p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                
                                                                                        </div> 
                                                                                     
                                                                    @endforeach
                                                               
                                                                @endif
                                                        
                                                    
                                                    </div>
                                                    
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                    @can('Super admin')
                                                        @if ($tick->status==1)
                                                            <div>
                                                                <button type="button" wire:click="alertPayment({{$tick->id}})" class="btn btn-success cursor-pointer h-10 my-auto">PAGO MANUAL</button>
                                                                <button type="button" wire:click="alertConfirm({{$tick->id}})" class="btn btn-danger p-2 w-full mt-2">Eliminar Ticket</button>
                                                            </div>
                                                        @endif
                                                        @if (!IS_NULL($tick->metodo) && $tick->status>=3)
                                                            @if ($tick->metodo=='TRANSFERENCIA')
                                                            <a  class="font-bold py-2 px-4 rounded bg-red-500 text-white cursor-pointer h-10 my-auto">TRANSFERENCIA</a>
                                                            @endif
                                                            @if ($tick->metodo=='MERCADOPAGO')
                                                                <a  class="font-bold py-2 px-4 rounded bg-blue-500 text-white cursor-pointer h-10 my-auto">MERCADOPAGO</a>
                                                            @endif
                                                        @elseif($tick->status>=3)
                                                            <a  class="font-bold py-2 px-4 rounded bg-blue-500 text-white cursor-pointer h-10 my-auto">MERCADOPAGO</a>
                                                        @endif
                                                    @endcan   
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                            @endif

                        @endforeach
                    <!-- More people... -->
                    </tbody>
                </table>
            @else
                <div class="px-6 py-4">
                    No hay ningun registro
                </div>
            @endif 
       
        </x-table-responsive>
        @can('Super admin')
            <div class="flex justify-center mt-6">
                <a class="btn bg-gray-200 h-10 my-auto">Ganancia= ${{number_format($gananciatotal,0)}}</a>
                
            </div>
        @endcan
       
    </div>
    <div x-show="activeTab===1" wire:ignore>
        <x-table-responsive>
            <div class="px-6 py-4">
                <input wire:model="search" class=" flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg " placeholder="Buscar Rider...">
            </div>

            @if ($inscripciones->count())

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Categoria / Nro
                        </th>
                    
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Rut
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Ticket Nro:
                        </th>
                    
                    
                        <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($inscripciones->reverse() as $inscripcion)
                            @if ($inscripcion->ticket->ticketable_type=='App\Models\Socio')

                               
                                        <tr>
                                        
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($inscripcion->categoria)
                                                        <div class="text-sm text-gray-900 text-center">{{$inscripcion->categoria->name}}<br>
                                                            {{$inscripcion->fecha->name}} 
                                                        </div>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="hidden flex-shrink-0 h-10 w-10">
                                                
                                                    
                                                            <img class="h-11 w-11 object-cover object-center rounded-full" src="" alt="">
                                                    
                                                    </div>
                                                    <div class="ml-4">
                                                        @if ($inscripcion->ticket->user)
                                                            <a href="{{route('ticket.historial.view',$inscripcion->ticket->user)}}">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                
                                                                        
                                                                
                                                                        {{$inscripcion->ticket->user->name}} (Rider)<br>
                                                                        {{$inscripcion->ticket->user->email}}<br>
                                                                        @if ($inscripcion->ticket->user->socio)
                                                                            @if ($inscripcion->ticket->user->socio->fono)
                                                                                {{$inscripcion->ticket->user->socio->fono}}
                                                                            @endif
                                                                        @endif
                                                                
                                                                
                                                                </div>
                                                            </a>
                                                        @else
                                                            REVISAR ERROR   
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($inscripcion->ticket->user)
                                                    @if ($inscripcion->ticket->user->socio)
                                                        <div class="text-sm text-gray-900 text">{{$inscripcion->ticket->user->socio->rut}}</div>
                                                    @endif
                                                @endif
                                            
                                                
                                            </td>
                                        
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="text-sm text-gray-900 text-center">
                                                    
                                                    
                                                            @if ($inscripcion->ticket->status<=2)
                                                                @if ($inscripcion->ticket->status==1)
                                                                    
                                                                    <a href="{{route('payment.checkout.ticket',$inscripcion->ticket)}}" target="_blank" class="btn bg-gray-200 h-10 my-auto">Nro: {{$inscripcion->ticket->id}} (SIN PAGAR)</a>
                                                                    
                                                                @else
                                                                
                                                                    <a href="{{route('payment.checkout.ticket',$inscripcion->ticket)}}" target="_blank" class="btn bg-gray-200 h-10 my-auto">Nro: {{$inscripcion->ticket->id}} (SIN PAGAR)</a>
                                                                    
                                                                @endif
                                                            @else
                                                                @if ($inscripcion->ticket->status==3)
                                                                    @if ($inscripcion->estado==4)
                                                                        <a href="{{route('ticket.view',$inscripcion->ticket)}}" target="_blank" class="btn btn-danger h-10 my-auto">Nro: {{$inscripcion->ticket->id}} PAGADO</a>
                                                                    
                                                                    @else
                                                                        <a href="{{route('ticket.view',$inscripcion->ticket)}}" target="_blank" class="btn btn-success h-10 my-auto">Nro: {{$inscripcion->ticket->id}} PAGADO</a>
                                                                    
                                                                    @endif

                                                                    
                                                                @else
                                                         
                                                                    <a href="{{route('ticket.view',$inscripcion->ticket)}}" target="_blank" class="btn btn-danger h-10 my-auto">Nro: {{$inscripcion->ticket->id}}</a>
                                                                    
                                                                @endif

                                                            

                                                            @endif
                                                            
                                                            
                                                                
                                                    
                                                    
                                                
                                                </div>
                                                
                                            </td>

                                            
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                            
                                            </td>
                                        </tr>
                                  
                                
                            @else
                                    <tr>
                                    
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($inscripcion->categoria)
                                                    <div class="text-sm text-gray-900 text-center">
                                                        {{$inscripcion->categoria->name}}<br>
                                                        {{$inscripcion->fecha->name}}

                                                    </div>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="hidden flex-shrink-0 h-10 w-10">
                                            
                                                
                                                        <img class="h-11 w-11 object-cover object-center rounded-full" src="" alt="">
                                                
                                                </div>
                                                <div class="ml-4">
                                                  
                                                        <div class="text-sm font-medium text-gray-900">
                                                        @foreach ($invitados as $item)
                                            
                                    
                                                            @php
                                                                if($inscripcion->ticket->ticketable_id==$item->id){
                                                                    $invitado=$item;
                                                                }else{
                                                                    $invitado=null;
                                                                }
                                                            @endphp    
                                                                @if ($invitado)
                                                                    
                                                            
                                                                    {{$invitado->name}} (Invitado)<br>
                                                                    {{$invitado->email}}<br>
                                                                   
                                                                        @if ($invitado->fono)
                                                                            {{$invitado->fono}}
                                                                        @endif
                                                                   @break
                                                                @endif
                                                        @endforeach
                                                        </div>
                                                   
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($invitado)
                                                <div class="text-sm text-gray-900 text">{{$invitado->rut}}</div>
                                            @endif
                                             
                                         
                                        
                                            
                                        </td>
                                    
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="text-sm text-gray-900 text-center">
                                                
                                                
                                                        @if ($inscripcion->ticket->status<=2)
                                                            @if ($inscripcion->ticket->status==1)
                                                                
                                                                <a href="{{route('payment.checkout.ticket',$inscripcion->ticket)}}" class="btn bg-gray-200 h-10 my-auto">Nro: {{$inscripcion->ticket->id}} (SIN PAGAR)</a>
                                                                
                                                            @else
                                                                
                                                                <a href="{{route('payment.checkout.ticket',$inscripcion->ticket)}}" class="btn bg-gray-200 h-10 my-auto">Nro: {{$inscripcion->ticket->id}} (SIN PAGAR)</a>
                                                                
                                                            @endif
                                                        @else
                                                            @if ($inscripcion->ticket->status==3)
                                                                @if ($inscripcion->estado==4)
                                                                    <a href="{{route('ticket.view',$inscripcion->ticket)}}" class="btn btn-danger h-10 my-auto">Nro: {{$inscripcion->ticket->id}}</a>
                                                                
                                                                @else
                                                                    <a href="{{route('ticket.view',$inscripcion->ticket)}}" class="btn btn-success h-10 my-auto">Nro: {{$inscripcion->ticket->id}} PAGADO</a>
                                                                
                                                                @endif

                                                                
                                                            @else
                                                           
                                                                <a href="{{route('ticket.view',$inscripcion->ticket)}}" class="btn btn-danger h-10 my-auto">Nro: {{$inscripcion->ticket->id}}</a>
                                                                
                                                            @endif

                                                        

                                                        @endif
                                                        
                                                        
                                                            
                                                
                                                
                                            
                                            </div>
                                            
                                        </td>

                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                        
                                        </td>
                                    </tr>
                              
                            @endif
                        @endforeach
                
                    </tbody>
                </table>
            @else
                <div class="px-6 py-4">
                    No hay ningun registro
                </div>
            @endif 
         
        </x-table-responsive>
    </div>
</div>
    @if ($evento->type=='pista')
        <script>
            function setup() {
            return {
            activeTab: 0,
            tabs: [
                "Por Usuario",
                "Por Entrada"
            ]
            };
        };
        </script>
    @else
        <script>
            function setup() {
            return {
            activeTab: 0,
            tabs: [
                "Por Usuario",
                "Por Categoria"
            ]
            };
        };
        </script>
    @endif
    <script>
  
        window.addEventListener('swal:modal', event => { 
            swal({
              title: event.detail.message,
              text: event.detail.text,
              icon: event.detail.type,
            });
        });
          
        window.addEventListener('swal:confirm', event => { 
            swal({
              title: event.detail.message,
              text: event.detail.text,
              icon: event.detail.type,
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                window.livewire.emit('remove');
              }
            });
        });

        window.addEventListener('swal:payment', event => { 
            swal({
              title: event.detail.message,
              text: event.detail.text,
              icon: event.detail.type,
              buttons: true,
              dangerMode: true,
            })
            .then((willPayment) => {
              if (willPayment) {
                window.livewire.emit('pagomanual2');
              }
            });
        });
        
         </script>

</div>