<x-app-layout>  
    <x-slot name="tl">
            
        <title>Checkout {{$evento->titulo}}</title>
        
        
    </x-slot>
    @php

        // SDK de Mercado Pago
        require base_path('/vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

      
        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        // Crea un ítem en la preferencia
        
            $item = new MercadoPago\Item();
            $item->title = 'Ticket Nro:'.$ticket->id.' '.$ticket->evento->titulo;
            $item->quantity = 1;
            if ($ticket->code_id && $evento->type=='desafio') {
                $item->unit_price =$ticket->inscripcion-1000;
            } else {
                $item->unit_price =$ticket->inscripcion;
            }
            
        

        $preference = new MercadoPago\Preference();
    
    
        $preference->back_urls = array(
                "success" => route('payment.ticketaprov',$ticket),
                "failure" => route('payment.checkout.ticket',$ticket),
                "pending" => route('payment.checkout.ticket',$ticket)
            );

            $preference->auto_return = "approved";

            $preference->items = array($item);
            $preference->save();

    @endphp

<style>
    
    scroll-container {
      display: block;
      width: 100%;
      height: 200px;
      overflow-y: scroll;
      scroll-behavior: smooth;
      background: #ffffff;
      padding-left: 0.5rem;
    }
    scroll-page {
      display: flex;
      align-items: center;
      justify-content: center;
      background: #ffffff;
      height: 100%;
      font-size: 5em;
    }
        </style>

<div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-12">
    @if ($evento->type=='pista')
        <h1 class="text-gray-500 text-3xl font-bold mx-2 text-center mb-4">Compra Tus Entradas</h1>
    @else
        <h1 class="text-gray-500 text-3xl font-bold mx-2 text-center mb-4">Proceso de Inscripción</h1>
    @endif
    <div class="mx-2 card text-gray-600">
        <div class="card-body">
            <article class="grid grid-cols-1 md:grid-cols-2 items-center">
                <div class="flex">
                    <img class="h-28 w-24 object-contain" src="{{Storage::url($ticket->evento->image->url)}}" alt="">
                    <div class="ml-2 mt-5">
                        <h1 class="text-lg ml-2">{{$ticket->evento->titulo}}</h1>
                        <h2 class="text-md ml-2 mb-3">{{$ticket->evento->subtitulo}}</h2>
                    </div>
                </div>
                <div class="">
                    @php
                    $min=0;
                    $max=0;
                @endphp
                @foreach ($fechas as $fecha)
                    @foreach($fecha->categorias as $categoria)
                        @php
                            if ($min==0) {
                                $min=$categoria->inscripcion;
                                $max=$categoria->inscripcion;
                            }else{
                                if ($categoria->inscripcion<$min) {
                                    $min=$categoria->inscripcion;
                                }elseif($categoria->inscripcion>$max){
                                    $max=$categoria->inscripcion;
                                }
                            }
                        
                        @endphp    
                    @endforeach
                @endforeach
                    <div class="hidden mx-24 grid grid-cols-1 md:grid-cols-1 w-full">
                        @if ($evento->type=='pista')
                            <p class="text-center text-gray-500 text-sm mb-1 mt-2">Entrada a Pista</p>
                        @else
                            <p class="text-center text-gray-500 text-sm mb-1 mt-2">Inscripción</p>
                        @endif
                        <div class="grid grid-cols-3 gap-2 mx-auto mb-4 w-full  px-24">
                            @foreach ($fech->categorias as $item)
                                <div class="bg-gray-100 p-1 rounded-3xl w-full mx-2">
                                    @if ($item->inscripcion==0)
                                        <p class="mt-2 text-gray-500 font-bold text-center">Gratis</p>
                                    @else
                                        <p class="mt-2 text-gray-500 font-bold text-center">${{number_format($item->inscripcion)}}</p>
                                    @endif
                                    <p class="text-gray-500 text-sm text-center">{{$item->categoria->name}}</p> 
                                </div>
                            @endforeach

                            <div class="hidden bg-gray-100 p-1 rounded-3xl w-full mx-1">
                                @if ($max==0)
                                    <p class="mt-2 text-gray-500 font-bold text-center">Gratis</p>
                                @else
                                    <p class="mt-2 text-gray-500 font-bold text-center">${{number_format($max)}}</p>
                                @endif
                               
                                <p class="text-gray-500 text-sm text-center">Adultos</p> 
                            </div>
                            
                        </div>
                        @if ($evento->entrada || $evento->entrada_niño)
                            <p class="text-center text-gray-500 text-sm mb-1 mt-2">Entradas</p>
                        
                            <div class="flex mx-auto mb-4 w-72   px-24">
                                <div class="bg-gray-100 p-1 rounded-3xl w-full">
                                    @if ($ticket->evento->entrada_niño==0)
                                        <p class="mt-2 text-gray-500 font-bold text-center">Gratis</p>
                                    @else
                                        <p class="mt-2 text-gray-500 font-bold text-center">${{number_format($ticket->evento->entrada_niño)}}</p>
                                    @endif
                                    <p class="text-gray-500 text-sm text-center">Niños</p> 
                                </div>
                                <div class="bg-gray-100 p-1 rounded-3xl w-full mx-1">
                                        @if ($evento->entrada==0)
                                            <p class="mt-2 text-gray-500 font-bold text-center">Gratis</p>
                                        @else
                                            <p class="mt-2 text-gray-500 font-bold text-center">${{number_format($evento->entrada)}}</p>
                                        @endif
                                    <p class="text-gray-500 text-sm text-center">Adultos</p> 
                                </div>
                                
                            </div>
                        @endif
                    </div>
                    <div class="flex justify-end">
                        <div class="items-center">
                            <h2 class="text-lg font-medium text-gray-900 sm:text-2xl ">
                                @if ($evento->limite>0)
                                    
                                    @if ($evento->type=='sorteo')
                                        @php
                                            $cantidinsc=0;
                                        @endphp
                                        @foreach ($evento->tickets as $itemtic)
                                            @foreach ($itemtic->inscripcions as $inscripcion)
                                                @php
                                                    if ($inscripcion->estado==3) {
                                                        $cantidinsc+=1;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endforeach

                                        {{$evento->limite-$cantidinsc}} Cupos  

                                    @else
                                        {{$evento->limite-$evento->tickets()->where('status', '>=', 1)->count()}} Cupos 
                                    @endif
                                        

                                @endif
                            </h2>
                            
                        </div>
                    </div>
                </div>
            </article>
        
            <hr>
{{-- comment 
            <p class="text-sm mt-4 hidden">{!!$ticket->evento->descripcion!!}</p>--}}
        </div>
    </div>

    

<div class="mx-2 mt-6 grid grid-cols-1 gap-y-4 xl:mt-12" x-data="condiciones:false">
    <section id="datos">   
        <div class="w-full bg-white items-center px-8 py-4 mx-auto border  cursor-pointer rounded-xl">
            <div class="flex justify-between">
                    <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 @if (IS_NULL($socio)) text-blue-600 @else text-green-600 @endif sm:h-9 sm:w-9" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>

                    <div class="flex flex-col items-center mx-5 space-y-1">
                        <h2 class="px-2 text-lg font-medium text-gray-900 sm:text-2xl ">1) Datos del Rider</h2>
                        
                    </div>

                
                </div>
                <h2 class="text-2xl font-semibold text-gray-500 sm:text-4xl"><span class="text-base font-medium">Editar</span></h2>
    
            
            </div>


                
                @if (!IS_NULL($socio))
                    <div class="flex justify-between items-center mx-auto my-4 bg-gray-100 rounded-lg pb-6 max-w-2xl">
                        <p class="mx-auto items-center mt-6 text font-bold flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-4 w-9 h-9 text-blue-600 my-auto mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg> Sus datos estan Registrados</p>
                        <div style="line-height: 1.3rem;" class="mx-auto mt-6 pr-8">
                            <h1 style="font-size: 1.5rem;" class="text-center font-bold">{{$socio->name}} </h1>
                            <h1 style="font-size: 1rem;white-space: nowrap;" class="text-center font-bold inline w-full" >{{$socio->rut}} </h1>
                          
                        </div>
                    </div>

                @else
                    
                        
                            <div class="flex items-center pb-6 lg:pt-5 pt-2 px-8">
                                <div class="w-full">

                                    

                                

                                    <p class="text-xl leading-normal text-gray-800">Bienvenido {{auth()->user()->name}}, a continuacion ingresaras los datos para tu primera inscripción en RidersChilenos, con esta Información ademas de proporcionarte la inscripción para este evento te entregaremos un perfil donde podras llevar todo el historial de tu carrera deportiva</p>
                                
                                </div>
                            </div>

                            <hr class="mt-2 mb-4">

                      
                        
                        {!! Form::open(['route'=>'socio.store','files'=>true , 'autocomplete'=>'off', 'method'=> 'POST' ]) !!}
                                            
                            @csrf
                                
                            <div class="max-w-full items-center">
                                @include('socio.partials.form')
                            </div>
                            
                            {!! Form::hidden('user_id',auth()->user()->id) !!}

                            {!! Form::hidden('evento_id', $evento->id ) !!}

                

                            @error('user_id')
                                    <strong class="text-xs text-red-600">{{$message}}</strong>
                            @enderror
                            
                            <div class="flex justify-center">
                                {!! Form::submit('Siguiente paso', ['class'=>'font-bold py-2 px-4 rounded bg-blue-500 text-white cursor-pointer']) !!}
                            </div>
            
                        {!! Form::close() !!}
                  
                @endif

                    
        </div>
    </section>
    
                  
                    
                    

   
         

      
         
      

    

        <div class="w-full bg-white items-center px-8 py-4 mx-auto border  cursor-pointer rounded-xl">
            <div class="flex justify-between">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 @if (IS_NULL($ticket)) text-blue-600 @else text-green-600 @endif sm:h-9 sm:w-9" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>

                    <div class="flex flex-col items-center mx-5 space-y-1">
                        <h2 class="text-lg font-medium text-gray-900 sm:text-2xl ">2) Terminos y Condiciones</h2>
                    
                    </div>

                    
                </div>
                @if (!IS_NULL($ticket))
                        <div class="flex flex-col items-center mx-5 my-auto">
                            <h2 class="text-xs font-medium text-gray-900 sm:text-xs ">Ha aceptado los terminos {{$ticket->evento->created_at->format('d-m-Y')}}</h2>
                        
                        </div>

                @endif
                
             
            </div>
            @if (IS_NULL($ticket))
                    <p class="text-sm mt-4">A continuacion encontrara los terminos y condiciones que la organizacion a estipulado para el evento:</a></p>
                

                        <div class="max-w-4xl mt-2 py-2 px-3  bg-gray-100">

                            <scroll-container>
                                <p class="text-sm my-2 mx-2 px-2">{!!$ticket->evento->terminos!!}</p>
                            </scroll-container>
            
                        
                        </div>

                        <hr>
                    {!! Form::open(['route' => 'organizador.tickets.store', 'method'=> 'POST']) !!}
                        @csrf

                        <p class="text-sm mt-4 text-center">  <input type="checkbox" name="seleccionable" value="TRUE"> Acepto los terminos y condiciones</p>
                    
                        @error('seleccionable')
                            <p class="text-xs text-red-600 text-center font-bold">{{$message}}</p>
                        @enderror
                        {!! Form::hidden('user_id',auth()->user()->id) !!}

                        {!! Form::hidden('evento_id',$evento->id) !!}

                        {!! Form::hidden('pedidoable_type','App\Models\Socio') !!}
                        
                        @if (!IS_NULL($socio))
                            {!! Form::hidden('pedidoable_id',$socio->id) !!}
                        @endif
            
                        @if (!IS_NULL($socio))
                            <div class="flex justify-center my-4">
                            
                                {!! Form::submit('Siguiente', ['class'=>'font-semibold rounded-lg bg-green-600 hover:bg-green-500 text-white py-2 px-4 justify-center my-4 cursor-pointer']) !!}
                            </div>
                        @endif

                {!! Form::close() !!}
            @endif
            
        </div>
     <section id="pago">   
        <div class="w-full bg-white items-center px-8 py-4 mx-auto border  cursor-pointer rounded-xl">
            <div class="flex justify-between">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600 sm:h-9 sm:w-9" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>

                    <div class="flex flex-col items-center mx-5 space-y-1">
                        <h2 class="text-lg font-medium text-gray-900 sm:text-2xl ">
                            @if ($evento->type=='pista')
                                3) Entradas por Entrenamiento
                            @elseif ($evento->type=='sorteo')
                                3) Compra de Números
                            @else
                                3) Inscripciones por Fecha
                            @endif
                        </h2>
                    
                    </div>
                    
                </div>
                <div class="items-center">
                    <h2 class="text-lg font-medium text-gray-900 sm:text-2xl ">
                        @if ($ticket->evento->limite>0)

                                    @if ($evento->type=='sorteo')
                                        @php
                                            $cantidinsc=0;
                                        @endphp
                                        @foreach ($evento->tickets as $itemtick)
                                            @foreach ($itemtick->inscripcions as $inscripcion)
                                                @php
                                                    if ($inscripcion->estado==3) {
                                                        $cantidinsc+=1;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endforeach

                                        {{$evento->limite-$cantidinsc}} Cupos  

                                    @else
                                        {{$evento->limite-$evento->tickets()->where('status', '>=', 1)->count()}} Cupos 
                                    @endif

                           
                        @endif
                    </h2>
                </div>

            
            
            </div>
            @if (!IS_NULL($ticket))

                    @php
                        $n=0;
                    @endphp
                @foreach ($evento->fechas as $fecha)
                    
                    @if ($fecha->fecha>=now()->subDays(1))
                        @php
                            $n+=1;
                        @endphp
                    @endif
                @endforeach
                    @if ($n==0)
                        <div class="text-center">
                            <div class="flex items-center justify-center pb-5 bg-red-600 p-2 text-white py-2 mt-4">
                                @php
                                    $dias=['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];
                                @endphp
                                @if ($fecha->name=='keyname')
                                    <label class="mx-auto text-center font-bold"> No hay Entranamientos Anunciados
                                    </label>
                                @else
                                    <p class="text-base leading-none"> {{$fecha->name}}</p>
                                @endif
                                    
                            </div>
                        </div>
                    @else

                        <div class="max-w-4xl sm:px-10 py-2">
                                
                                @livewire('organizador.ticket-inscripcion', ['ticket' => $ticket], key($ticket->id))

                                <x-table-responsive>

            

                            
                                        <table class="min-w-full divide-y divide-gray-200 mb-20 pb-20">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    @if ($evento->type=='sorteo')
                                                        Número
                                                    @else
                                                        Detalles
                                                    @endif
                                                </th>
                                                
                                                    @if ($evento->type=='pista')
                                                        
                                                    @elseif ($evento->type=='desafio')

                                                    @elseif ($evento->type=='sorteo')
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Sorteo
                                                        </th>
                                                    @else
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Categoria
                                                        </th>
                                                    @endif   
                                            
                                                @if ($evento->datos==null)

                                              
                                                @else
                                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Número
                                                    </th>
                                                @endif
                                                <th  class="text-center mr-4 text-xs font-medium text-gray-500 uppercase tracking-wider justify-end ml-auto">
                                                    Precio
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                
                                                                        @foreach($ticket->inscripcions as $inscripcion)
                                                                        
                                                                                <tr>
                                                                                    <td class="px-6 py-4 whitespace-nowrap">

                                                                                        @if ($inscripcion->fecha->name=='keyname')
                                                                                            <label class=""> Entrenamiento {{date('d/m/Y', strtotime($inscripcion->fecha->fecha))}}</label>
                                                                                            <br>
                                                                                            {{$inscripcion->fecha_categoria->categoria->name}}
                                                                                        @elseif($evento->type=='sorteo')
                                                                                            <label class=""> {{$inscripcion->id}}</label>
                                                                                        @else
                                                                                            <label class=""> {{$inscripcion->fecha->name}}</label>
                                                                                        @endif
                                                                                        
                                                                                    </td>
                                                                                    @if ($evento->type=='pista')

                                                                                    @elseif ($evento->type=='desafio')

                                                                                    @elseif ($evento->type=='sorteo')
                                                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                                                        
                                                                                            {{$evento->titulo}}
                                                                                        
                                                                                        </td>
                                                                                    @else
                                                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                                                    
                                                                                            {{$inscripcion->fecha_categoria->categoria->name}}
                                                                                        
                                                                                        </td>
                                                                                    @endif
                                                                                
                                                                                        @if ($evento->datos==null)                                                                                   
                            
                                                                                        @else
                                                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                                                <div class="items-center">
                                                                                                    <p class="mx-4 text-center">{{$inscripcion->nro}}</p>
                                                                                                </div>
                                                                                            </td>
                                                                                        @endif

                                                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                                                            <div class="items-center">
                                                                                                
                                        
                                                                                                    <form action="{{route('ticket.inscripcions.destroy',$inscripcion)}}" method="POST">
                                                                                                        @csrf
                                                                                                        @method('delete')
                                                                                                        <input name="ticket_id" type="hidden" value="{{$ticket->id}}">

                                                                                                            <p class="mx-4 text-center" > ${{number_format($inscripcion->cantidad)}} 

                                                                                                        <button class="" ><i class="fas fa-trash cursor-pointer text-red-500 ml-6" type="submit" alt="Eliminar"></i> </button>
                                                                                                        
                                                                                                    </form>
                                                                                                    </p>
                                                                                            </div>
                                                                                        </td>
                                                                                    
                                                
                                    
                                                                                </tr>
                                                                        @endforeach
                                                                        @if ($evento->type=='sorteo' && $ticket->inscripcions->count()>1)
                                                                            <tr>
                                                                                <td>

                                                                                </td>
                                                                                <td>
                                                                                    
                                                                                </td>
                                                                                <td class="">
                                                                                    <form action="{{route('ticket.inscripcions.clean',$ticket)}}" method="POST">
                                                                                        @csrf
                                                                                        @method('delete')
                                                                                       
                                                                                            <p class="mx-4 text-center" > Eliminar todo 

                                                                                        <button class="" ><i class="fas fa-trash cursor-pointer text-red-500 ml-6" type="submit" alt="Eliminar"></i> </button>
                                                                                        
                                                                                    </form>
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                            </tbody>

                                        </table>
                            
                                </x-table-responsive>

                        </div>
                    
                    @endif

            @endif

        
            
        </div>
    </section>
   

    

    <div class="w-full bg-white items-center px-8 py-4 mx-auto border  cursor-pointer rounded-xl">
        <div class="flex justify-between">
                <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600 sm:h-9 sm:w-9" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>

                <div class="flex flex-col items-center mx-5 space-y-1">
                    <h2 class="text-lg font-medium text-gray-900 sm:text-2xl ">4) Pago</h2>
                
                </div>
            </div>
            
         
        </div>
        @if ($ticket->inscripcions->count()>0)
            <section id="pagando">

                @livewire('ticket.ticket-code', ['ticket' => $ticket], key($ticket->id))
                
                            <div class="max-w-4xl px-10 mt-6 py-2 bg-gray-100">
                                <div class="flex items-center justify-between px-8">
                                    @if ($evento->type=='pista')
                                        <p class="text-base leading-none text-gray-800 ">Entradas</p>
                                    @elseif ($evento->type=='sorteo')
                                        <p class="text-base leading-none text-gray-800 ">
                                            Compra de {{$ticket->inscripcions->count()}} números
                                        </p>
                                    @else
                                        <p class="text-base leading-none text-gray-800 ">Inscripción</p>
                                    @endif
                                
                                <p class="text-base leading-none text-gray-800 ">${{number_format($ticket->inscripcion)}}</p>
                                </div>

                                    @if ($ticket->code_id && $evento->type=='desafio')
                                        <div class="flex items-center justify-between px-8 my-2">
                                                <p class="text-base leading-none text-gray-800 ">Descuento</p>
                                         
                                        <p class="text-base leading-none text-gray-800 ">-$1.000</p>
                                        </div>
                                    @endif
                            </div>
                           
                           
                        <div>
                           
                          

                            
                            <div class="flex items-center pb-6 justify-between lg:pt-5 pt-2 px-8">
                            <p class="text-2xl leading-normal text-gray-800 ">Total</p>
                            @if ($ticket->code_id && $evento->type=='desafio')
                                <p class="text-2xl font-bold leading-normal text-right text-gray-800 ">${{number_format($ticket->inscripcion-1000)}}</p>
                            @else
                                <p class="text-2xl font-bold leading-normal text-right text-gray-800 ">${{number_format($ticket->inscripcion)}}</p>
                            @endif
                            </div>
                        </div>
                        @if ($ticket->inscripcion==0)
                            <form action="{{route('ticket.semipago',$ticket)}}" method="POST">
                                @csrf
                                <div class="flex justify-center">
                                    <button class="btn btn-danger mt-4" >¡Inscribirme ahora!</button>
                                </div>
                            </form>
                        @else
                            <div class="max-w-4xl bg-white rounded-xl shadow-md pt-6 pb-4 px-2 sm:px-8 ">
                                <div class="max-w-4xl flex justify-between items-center">
                                
                                    <div class="items-center">
                                        <img class="h-full w-40  object-contain" src="{{asset('img/mercadopago.png')}}" alt="">
                                    
                                    </div>
                                    <div class="hidden sm:flex items-center">
                                    
                                        <p class="text-lg my-auto text-center">Paga Utilizando tarjeta de Crédito o Débito</p>
                                    </div>
                                    
                                
                                        <div class="cho-container mt-2 mb-4">
                                            <!-- Esto es <a href="" class="font-bold py-2 px-4 rounded bg-blue-500 text-white">Pagar</a> un comentario -->
                                        </div>
                                    

                                </div>
                    
                        
                                <div class="flex justify-center sm:hidden items-center">
                                
                                    <p class="text-base my-auto text-center">Paga Utilizando tarjeta de Crédito o Débito</p>
                                </div>
                            
                            </div>
                        @endif
                        

                        @can('Super admin')
                            <div>
                                <form action="{{route('ticket.enrolled',$ticket)}}" method="POST">
                                    @csrf
                                
                                    <button class="font-bold py-2 px-4 rounded bg-blue-500 text-white mt-4" >Agregar Gratis</button>
                                    
                                </form>

                                <form action="{{route('ticket.semipago',$ticket)}}" method="POST">
                                    @csrf
                                
                                    <button class="btn btn-danger mt-4" >Agregar Simulación Pago</button>
                                    
                                </form>
                            </div>
                        @endcan
                    


                            <hr>

                <p class="text-sm mt-4">Esta compra esta protegida por todos los protocolos asignados por mercado pago, una vez hecha el pago sera redireccionado hasta su entrada, no la comparta en redes sociales, para más detalles visite nuestros <a href="" class="text-red-500 font-bold">Terminos y Condiciones</a></p>
            </section>
                
            
        @endif
    </div>
   

    <div class="flex justify-center mb-2">
        <a href="{{route('ticket.evento.show', $ticket->evento)}}">
                <button class="bg-gray-800 px-8 py-2 tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-80">
            Volver Atras
                </button>
        </a>
        
    </div>

    
    <h1 class="text-center text-xs text-gray-400 py-12">Todos Los derechos Reservados</h1>

</div>

</div>









    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        // Agrega credenciales de SDK
          const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
                locale: 'es-AR'
          });
        
          // Inicializa el checkout
          mp.checkout({
              preference: {
                  id: '{{ $preference->id }}'
              },
              render: {
                    container: '.cho-container', // Indica el nombre de la clase donde se mostrará el botón de pago
                    label: 'Pagar', // Cambia el texto del botón de pago (opcional)
              }
        });
        </script>

</x-app-layout>