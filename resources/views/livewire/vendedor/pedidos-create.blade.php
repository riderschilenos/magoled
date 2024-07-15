<div x-data="{pendiente:false , retirado:false}">
    @php
    
    $dias=['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];

    @endphp

    @if ($type=='ticket' && $paytickets->count()>0)
        @php
            $pendiente=0;
            $npendiente=0;
            $pendientegasto=0;
            $npendientegasto=0;
            $retiradogasto=0;
            $nretiradogasto=0;
        @endphp
        @foreach ($paytickets as $item)
            @if (IS_NULL($item->gasto_id))
                @php
                    $pendiente+=$item->inscripcion;
                    $npendiente+=1;
                @endphp
            @endif
        @endforeach
        @foreach ($gastos as $gasto)
            @if ($gasto->estado==1)
                @php
                    $pendientegasto+=$gasto->cantidad;
                    $npendientegasto+=1;
                @endphp
            @endif
            @if ($gasto->estado==2)
                @php
                    $retiradogasto+=$gasto->cantidad;
                    $nretiradogasto+=1;
                @endphp
            @endif
            
        @endforeach
        <section class="container px-4 mx-auto card my-6">
            <h1 class="text-2xl font-bold text-center mt-6">RETIRO DE COMISIONES</h1>
            <hr class="mt-2 mb-6">
                <div class="flex flex-wrap my-4 justify-center">
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                            <div class="flex-auto p-4">
                                <div class="flex flex-wrap">
                                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">Disponible {{$npendiente}} Tickets</h5>
                                    <span class="font-bold text-xl">${{number_format($pendiente*0.1)}}</span>
                                    </div>
                                    <div class="relative w-auto pl-4 flex-initial">
                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500"><i class="far fa-chart-bar"></i></div>
                                    </div>
                                </div>
                                <div class="flex justify-center items-center mt-2">
                                    
                                    <div class="items-center content-center my-auto w-full">
                                        {!! Form::open(['route'=>'admin.gastos.store','files'=>true , 'autocomplete'=>'off', 'method'=> 'POST' ]) !!}
                                        @csrf
                                         
                                            {!! Form::hidden('user_id', Auth()->user()->id ) !!}
                
                                            {!! Form::hidden('metodo', 'TRANSFERENCIA' ) !!}

                                            {!! Form::hidden('gastotype_id', 14 ) !!}

                                            {!! Form::hidden('cantidad', $pendiente*0.1 ) !!}

                                            
                                            @foreach ($paytickets as $item)
                                                @if (IS_NULL($item->gasto_id))
                                                    <input type="hidden" name="selected[]" value="{{$item->id}}">
                                                @endif
                                            @endforeach

                                            {!! Form::hidden('estado', '1' ) !!}
                                            

                                            
                                            @if ($pendiente>0)
                                                {!! Form::submit('Retirar', ['class'=>'p-2 bg-red-500 text-white rounded-lg w-full cursor-pointer']) !!}
                                            
                                            @else
                                                <div class="p-2 bg-gray-300 text-gray-600 font-semibold rounded-lg w-full text-center">Retirar</div>
                                            @endif
                                               
                                        {!! Form::close() !!}
                                       
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    @if ($npendientegasto>0)
                        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                            <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                                    <div class="flex-auto p-4">
                                        <div class="flex flex-wrap">
                                            <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                                <h5 class="text-blueGray-400 uppercase font-bold text-xs">{{$npendientegasto}} Pendiente</h5>
                                                <span class="font-bold text-xl">${{number_format($pendientegasto)}}</span>
                                            </div>
                                            <div class="relative w-auto pl-4 flex-initial">
                                                <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500"><i class="fas fa-chart-pie"></i></div>
                                            </div>
                                        </div>
                                        <div class="flex justify-center items-center mt-2">
                                            <div class="items-center content-center my-auto w-full">
                                                <button x-on:click="pendiente=!pendiente , retirado=false" class="p-2 bg-yellow-500 text-white rounded-lg w-full">
                                                    Ver detalle
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                    </div>
                   @endif
                  
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                                <div class="flex-auto p-4">
                                    <div class="flex flex-wrap">
                                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                            <h5 class="text-blueGray-400 uppercase font-bold text-xs">{{$nretiradogasto}} Retirados</h5>
                                            <span class="font-bold text-xl">${{number_format($retiradogasto)}}</span>
                                        </div>
                                        <div class="relative w-auto pl-4 flex-initial">
                                            <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500"><i class="fas fa-chart-pie"></i></div>
                                        </div>
                                    </div>
                                    <div class="flex justify-center items-center mt-2">
                                        <div class="items-center content-center my-auto w-full">
                                            <button x-on:click="retirado=!retirado , pendiente=false" class="p-2 bg-blue-500 text-white rounded-lg w-full">
                                                Ver detalle
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                   </div>
                </div>
                <div x-show="pendiente">
                    @if ($gastos->count())
        
                        <table class="min-w-full divide-y divide-gray-200 my-4">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Nro
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Método
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cantidad                       
                                </th>
                               
                                
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $counter=$gastos->count();
                                @endphp
                            @foreach ($gastos as $pago)
                                    @php
                                        $counter-=1
                                    @endphp
                                @if ($pago->estado==1)
                                    @if ($pago->gastotype_id==14)
                                    
                                        
                                    
                                            <tr>
                                                <td class="px-6 py-4 justify-center">
                                                    <p class="text-center">{{$counter+1}}</p>
                                                
                                                </td>
                
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    
                                                    @if ($pago->metodo=="MERCADOPAGO")
                                                        <span class="px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                            MERCADOPAGO
                                                        </span>
                                                    @else
                                                        <span class="px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            TRANSFERENCIA
                                                        </span>
                                                        
                                                
                                                    @endif
                                                        
                                                    
                                                </td>
                
                                            
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900 ml-3">${{number_format($pago->cantidad)}}</div>
                                                    
                                                </td>
                                       
                                                
                
                                                
                
                                                <td class="px-6 py-4 whitespace-nowrap">    
                
                                                    @switch($pago->estado)
                                                        @case(1)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                                Pendiente de Aprobación
                                                            </span>
                                                            @break
                                                        @case(2)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                Aprobado
                                                            </span>
                                                            @break
                                                    
                                                            
                                                        @endswitch
                                                        
                                                </td>
                                                
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-500">{{$dias[date('N', strtotime($pago->created_at))-1]}}</div>
                                                    <div class="text-sm text-gray-900">{{$pago->created_at->format('d-m-Y')}}</div>    
                                                </td>
                                                {{-- comment 
                                                
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{route('vendedor.pedidos.edit',$pago)}}" class="text-indigo-600 hover:text-indigo-900">Ver detalles</a>
                                                    
                                                </td>--}}
                                            </tr>
                                    @endif
                                @endif
                                @endforeach
                            <!-- More people... -->
                            </tbody>
                        </table>
                       
                    @else
                        <div class="px-6 py-4">
                            No hay ningun retiro realizado
                        </div>
                    @endif 
                </div>
                <div x-show="retirado">
                    @if ($gastos->count())
        
                        <table class="min-w-full divide-y divide-gray-200 my-4">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Nro
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Método
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cantidad                       
                                </th>
                             
                                
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $counter=$gastos->count();
                                @endphp
                            @foreach ($gastos as $pago)
                                    @php
                                        $counter-=1
                                    @endphp
                                @if ($pago->estado==2)
                                    @if ($pago->gastotype_id==14)
                                    
                                        
                                    
                                            <tr>
                                                <td class="px-6 py-4 justify-center">
                                                    <p class="text-center">{{$counter+1}}</p>
                                                
                                                </td>
                
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    
                                                    @if ($pago->metodo=="MERCADOPAGO")
                                                        <span class="px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                            MERCADOPAGO
                                                        </span>
                                                    @else
                                                        <span class="px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            TRANSFERENCIA
                                                        </span>
                                                        
                                                
                                                    @endif
                                                        
                                                    
                                                </td>
                
                                            
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900 ml-3">${{number_format($pago->cantidad)}}</div>
                                                    
                                                </td>
                                          
                
                                                
                
                                                
                
                                                <td class="px-6 py-4 whitespace-nowrap">    
                
                                                    @switch($pago->estado)
                                                        @case(1)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                                Pendiente de Aprobación
                                                            </span>
                                                            @break
                                                        @case(2)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                Aprobado
                                                            </span>
                                                            @break
                                                    
                                                            
                                                        @endswitch
                                                        
                                                </td>
                                                
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-500">{{$dias[date('N', strtotime($pago->created_at))-1]}}</div>
                                                    <div class="text-sm text-gray-900">{{$pago->created_at->format('d-m-Y')}}</div>    
                                                </td>
                                                {{-- comment 
                                                
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{route('vendedor.pedidos.edit',$pago)}}" class="text-indigo-600 hover:text-indigo-900">Ver detalles</a>
                                                    
                                                </td>--}}
                                            </tr>
                                    @endif
                                @endif
                                @endforeach
                            <!-- More people... -->
                            </tbody>
                        </table>
                       
                    @else
                        <div class="px-6 py-4">
                            No hay ningun retiro realizado
                        </div>
                    @endif 
                </div>
        </section>
    
    @endif
    
    @if ($type=='ticket' && $tickets->count()>0)
       
        <section class="container px-4 mx-auto card"> 
            <h1 class="text-2xl font-bold text-center mt-10">Gestionar tickets Vendidos</h1>
            <hr class="mt-2 mb-6">
            <div class="flex flex-col">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 mb-2">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500">
                                            <div class="flex items-center gap-x-3">
                                                <button class="flex items-center gap-x-2">
                                                    <span>Nro Ticket</span>
        
                                                    <svg class="h-3" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                        <path d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                        <path d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z" fill="currentColor" stroke="currentColor" stroke-width="0.3" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </th>
        
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">
                                            Fecha
                                        </th>
        
                                      
        
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">
                                            Cliente
                                        </th>
        
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 whitespace-nowrap">
                                            Ingreso de Boletos
                                        </th>
        
                                        <th scope="col" class="relative py-3.5 px-4">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 ">
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                <div class="inline-flex items-center gap-x-3">
                                                    <span>#{{$ticket->id}}</span>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">{{$ticket->created_at->format('d/m/Y')}}</td>
                                     
                                            <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                <div class="flex items-center gap-x-2 mr-10">
                                                    @if ($ticket->socio)
                                                        @if (str_contains($ticket->socio->user->profile_photo_url,'https://ui-'))
                                                            <img class="object-cover w-8 h-8 rounded-full" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="">
                                                        @else
                                                            <img class="object-cover w-8 h-8 rounded-full" src="{{ $ticket->socio->user->profile_photo_url }}" alt="{{ $ticket->socio->name }}" alt="">
                                                        @endif
                                                    @else
                                                        <img class="object-cover w-8 h-8 rounded-full" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="">
                                                    @endif    
                                                    <div>
                                                        @if ($ticket->socio)
                                                            <h2 class="text-sm font-medium text-gray-800">{{$ticket->socio->name.' '.$ticket->socio->last_name}}</h2>
                                                        @else
                                                            <h2 class="text-sm font-medium text-gray-800">{{$ticket->imvitado->name}}</h2>
                                                        @endif
                                                           

                                                        <p class="text-xs font-normal text-gray-600">{{$ticket->user->email}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="hidden sm:flex px-4 py-4 text-sm text-gray-500 whitespace-nowrap flex justify-center" wire:ignore>
                                                @livewire('organizador.ticket-inscripcion', ['ticket' => $ticket], key($ticket->id))
                                            </td>
                                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                <div class="grid grid-cols-1 gap-y-4 items-center gap-x-6">

                                                    <a href="{{route('payment.checkout.ticket',$ticket)}}" target="_blank">
                                                        <button class="btn btn-primary p-2 w-full">
                                                            Pagar ${{number_format($ticket->inscripcion)}}
                                                        </button>
                                                    </a>
                                                        

                                                    @if ($ticket->status==1)
                                                        <button type="button" wire:click="alertConfirm({{$ticket->id}})" class="btn btn-danger p-2 w-full">Eliminar Ticket</button>
                                                    @endif

                                                    @can('Super admin')
                                                        @if ($ticket->status==1)
                                                            <button type="button" wire:click="alertPayment({{$ticket->id}})" class="btn btn-success cursor-pointer p-2 my-auto w-full">Pago Manual</button>
                                                        @endif
                                                    @endcan   

                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="sm:hidden" >

                                            <td colspan="4" class="w-full px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                @livewire('organizador.ticket-inscripcion', ['ticket' => $ticket], key($ticket->id))
                                            </td>
                                         
                                       
                                        </tr>
                                        @foreach ($ticket->inscripcions as $inscripcion)
                                            <tr>
                                                <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap"></td>
                                                <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                    <div class="inline-flex items-center gap-x-3">
                                                       
                                                        <span>#{{$inscripcion->id}}</span>
                                                    </div>
                                                </td>
                                               
                                             
                                                <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    <div class="flex items-center gap-x-2">
                                                        @if ($ticket->socio)
                                                            @if (str_contains($ticket->socio->user->profile_photo_url,'https://ui-'))
                                                                <img class="object-cover w-8 h-8 rounded-full" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="">
                                                            @else
                                                                <img class="object-cover w-8 h-8 rounded-full" src="{{ $ticket->socio->user->profile_photo_url }}" alt="{{ $ticket->socio->name }}" alt="">
                                                            @endif
                                                        @else
                                                            <img class="object-cover w-8 h-8 rounded-full" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="">
                                                        @endif 
                                                        <div>
                                                            @if ($ticket->socio)
                                                                <h2 class="text-sm font-medium text-gray-800 ">{{$ticket->socio->name.' '.$ticket->socio->last_name}}</h2>
                                                            @else
                                                                <h2 class="text-sm font-medium text-gray-800 ">{{$ticket->imvitado->name}}</h2>
                                                            @endif
                                                            

                                                            <p class="text-xs font-normal text-gray-600 ">{{$ticket->user->email}}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <div class="items-center flex justify-center">
                                                        <p class="mx-4 text-center" > ${{number_format($inscripcion->cantidad)}} 
                                                            @if ($ticket->status==1)
                                                                <form action="{{route('ticket.inscripcions.destroy',$inscripcion)}}" method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <input name="ticket_id" type="hidden" value="{{$ticket->id}}">
                                                                    <input name="pedidos_create" type="hidden" value="True" >
                                                                    
                                                                    <button class="" ><i class="fas fa-trash cursor-pointer text-red-500 ml-6" type="submit" alt="Eliminar"></i> </button>
                                                                    
                                                                </form>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                         
                                        @endforeach
                                        @if ($ticket->evento->type=='sorteo' && $ticket->inscripcions->count()>1  && $ticket->status==1)
                                            <tr>
                                                <td>

                                                </td>
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
                                          

                                    @endforeach
                               
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        
        </section>

    @endif

    <section class="mt-6 pb-24 card p-2">
        @if ($type=='ticket')
                
                <h1 class="text-2xl font-bold text-center mt-6">AGREGAR NUEVO PARTICIPANTE</h1>
                <hr class="mt-2 mb-6">
                
                    @if (IS_NULL($eventoid))
                        <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-4">
                            @foreach ($eventos as $evento)
                                <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
                                <div class="flex w-full items-center justify-between space-x-6 p-6">
                                    <div class="flex-1 truncate">
                                    <div class="flex items-center space-x-3">
                                        <h3 class="truncate text-sm font-medium text-gray-900">{{$evento->titulo}}</h3>
                                        <span class="inline-flex flex-shrink-0 items-center rounded-full bg-green-50 px-1.5 py-0.5 text-xs font-medium text-blue-600 ring-1 ring-inset ring-green-600/20">Disponible</span>
                                    </div>
                                    @if ($evento->type=='sorteo')
                                        @php
                                            $inscritos=0;
                                        @endphp
                                        @if ($evento->tickets->where('status','>=',3)->count()>0)
                                            @foreach ($evento->tickets->where('status','>=',3) as $tkts)
                                                @php
                                                    $inscritos+=$tkts->inscripcions->count();
                                                @endphp
                                            @endforeach
                                        @endif
            
                                        <p class="mt-1 truncate text-sm text-gray-500">{{$evento->limite-$inscritos}} Números disponibles</p>
                                    @endif
                                        

                                    </div>
                                    <img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300" src="{{Storage::url($evento->image->url)}}" alt="">
                                </div>
                                <div>
                                    <div class="-mt-px flex divide-x divide-gray-200">
                                        <div class="-ml-px flex w-0 flex-1 cursor-pointer">
                                            <span wire:click="set_eventoid({{$evento->id}})" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900 hover:bg-gray-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                                </svg>
                                                
                                                Seleccionar
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-4">
                            <li>

                            </li>
                            <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
                                <div class="flex w-full items-center justify-between space-x-6 p-6">
                                    <div class="flex-1 truncate">
                                    <div class="flex items-center space-x-3">
                                        <h3 class="truncate text-sm font-medium text-gray-900">{{$eventoselected->titulo}}</h3>
                                        <span class="inline-flex flex-shrink-0 items-center rounded-full bg-green-50 px-1.5 py-0.5 text-xs font-medium text-blue-600 ring-1 ring-inset ring-green-600/20">Seleccionado</span>
                                    </div>
                                    @if ($eventoselected->type=='sorteo')
                                        @php
                                            $inscritos=0;
                                        @endphp
                                        @if ($eventoselected->tickets->where('status','>=',3)->count()>0)
                                            @foreach ($eventoselected->tickets->where('status','>=',3) as $tkts)
                                                @php
                                                    $inscritos+=$tkts->inscripcions->count();
                                                @endphp
                                            @endforeach
                                        @endif
            
                                        <p class="mt-1 truncate text-sm text-gray-500">{{$eventoselected->limite-$inscritos}} Números disponibles</p>
                                    @endif
                                    </div>
                                    <img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300" src="{{Storage::url($eventoselected->image->url)}}" alt="">
                                </div>
                                <div>
                                    <div class="-mt-px flex divide-x divide-gray-200">
                                        <div class="-ml-px flex w-0 flex-1 cursor-pointer">
                                            <span class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900 bg-gray-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 font-bold">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                                </svg>
                                                
                                                Seleccionado
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </li> 
                        </ul>
                    @endif
            
        @endif
        
        @if ($type=='pedido' || $eventoid)
            
                @if (is_null($selectedSocios) && is_null($invitados))
                    <div class="bg-gray-100 border-t-4 mb-6 mx-3 border-gray-500 rounded-b text-gray-900 px-4 py-3 shadow-md" role="alert">
                        <div class="flex">
                        <div>
                    @if ($type=='pedido')
                        <p class="text-base ">
                            Debe indicar si el pedido sera para un invitado o un rider registrado. En caso de ser este último, podrá acceder a la información ya registrada, de lo contrario, puede buscar si el invitado a comprado anteriormente o registrar al nuevo cliente como invitado.
                        </p>
                    @else
                        <p class="text-base ">
                            Ingresa los datos del cliente
                        </p>
                    
                    @endif

                    </div>
                        </div>
                    </div>
                @endif
                @if ($type=='pedido')
                    <div class="flex justify-center">
                        <div class="flex">
                            <textarea id="myTextarea" wire:model="textoPortapapeles" class="sm:hidden w-full shadow-sm border-2 border-gray-300 bg-white px-5 pr-16 rounded-lg focus:outline-none" required autofocus autocomplete="off"></textarea>
                            <button class="sm:hidden btn btn-success mx-2 my-2" onclick="pegarDesdePortapapeles()">Pegar</button>
                        </div>
                    </div>
                @endif
                <div class="flex justify-center">
                    <div class="block">
                        @if ($textoPortapapeles)
                            <button wire:click="completarDesdePortapapeles">(Autocompletar)</button>
                        @endif
                    
                    </div>
                </div>
                @if ($type=='pedido' || is_null($socio_id))
                    <div class="px-6 py-4">
                        <input wire:keydown="limpiar_page" wire:model="search"  class=" flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Buscar..." required autofocus autocomplete="off">
                    </div>
                @endif
                <div class="flex items-center justify-center mb-2" >
                    @if(is_null($selectedSocios))   
                        <a class="btn btn-danger form-control cursor-pointer" wire:click="updateselectedInvitado">Nuevo</a>    
                    @endif
                    @if(is_null($invitados))
                        <a class="btn btn-success ml-2 form-control cursor-pointer" wire:click="updateselectedSocios">Rider Registrado</a>
                    @endif
                </div>

                @if(!is_null($selectedSocios) || ($search && $socios->count()>0 && is_null($invitado_id)))
                    @if(is_null($socio_id))
                    
                        <x-table-responsive>
                        

                            @if ($socios->count())

                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Riders Registrados
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Rut
                                        </th>
                                    
                                        <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">

                                        @foreach ($socios as $socio)
                                        
                                                
                                                <tr wire:click="updatesocio_id({{$socio->id}})" >
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                    
                                                                    <img class="h-11 w-11 object-cover object-center rounded-full" src="{{ $socio->user->profile_photo_url }}" alt=""  />
                                                                
                                                                    
                                                                
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm text-gray-900">
                                                                    {{$socio->name}}
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{$socio->email}}</div>
                                                        
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{$socio->rut}}</div>
                                                        
                                                    </td>

                                                    
                                                    

                                                    
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <a wire:click="updatesocio_id({{$socio->id}})" class="text-indigo-600 hover:text-indigo-900 cursor-pointer">Seleccionar</a>
                                                    
                                                    </td>
                                                </tr>

                        
                                        @endforeach
                                        <!-- More people... -->
                                    </tbody>
                                </table>
                                
                            @else
                                <div class="px-6 py-4">
                                    No hay ningun registro
                                </div>
                            @endif 

                            <div class="px-6 py-4">
                                {{$socios->links()}}
                            </div>
                        </x-table-responsive>

                        <div class="hidden flex justify-end">
                            <button type="button" class="btn btn-danger text-sm ml-2" wire:click="cancel" >Cancelar</button>
                            
                        </div>
                    @else    

                        <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-teal-900 pl-4 py-3 shadow-md my-4 mx-auto items-center max-w-sm" role="alert">
                            
                            <div class="flex">
                                <div class="py-1">
                                    @foreach ($selectedSocios as $socio)
                                        @if ($socio->id == $socio_id)

                                            <img class="h-11 w-11 object-cover object-center rounded-full mr-4" src="{{ $socio->user->profile_photo_url }}" alt=""  />
                                    
                                        @endif

                                    @endforeach
                                </div>
                                
                                <div>
                                    
                                    @foreach ($selectedSocios as $socio)
                                        @if ($socio->id == $socio_id)
                                            <p class="font-bold">{{$socio->user->name.", ".$socio->rut}}</p>
                                            @if ($socio->direccion)
                                                <p class="text-sm">{{$socio->direccion->comuna.", ".$socio->direccion->region}} </p>  
                                            @endif
                                        
                                        @endif

                                    @endforeach
                                </div>

                                <span class="relative top-0 bottom-0 right-0 ml-8 py-3" wire:click="resetsocio">
                                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cancelar</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                </span>
                            </div>
                        </div>

                        @if ($type=='ticket')
                            {!! Form::open(['route' => 'ticket.vendedores.store.registred', 'method'=> 'POST']) !!}
                                    @csrf
                            
                                {!! Form::hidden('socio_id',$socio_id) !!}
                                {!! Form::hidden('evento_id',$eventoid) !!}

                            


                                <div class="flex justify-center mb-24">
                                    <button type="button" class="font-semibold rounded-lg bg-red-600 hover:bg-red-500 text-white py-2 px-4 justify-center my-4 text-sm ml-2" wire:click="cancel" >Cancelar</button>
                                    {!! Form::submit('Ingresar Ticket', ['class'=>'font-semibold rounded-lg bg-green-600 hover:bg-green-500 text-white py-2 px-4 justify-center my-4 cursor-pointer ml-2']) !!}
                                </div>

                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['route' => 'vendedor.pedidos.store', 'method'=> 'POST']) !!}
                                    @csrf
                                {!! Form::hidden('user_id',auth()->user()->id) !!}

                                {!! Form::hidden('pedidoable_type','App\Models\Socio') !!}

                                {!! Form::hidden('pedidoable_id',$socio_id) !!}

                                <div class="bg-yellow-100 border-t-4 border-yellow-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-4 mx-auto items-center max-w-sm">

                                        <div class="flex items-center mt-4">
                                            <Label class="w-80">Despacho:</Label>
                                            <select wire:model="selecteddespacho" class="block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight  focus:bg-white focus:border-gray-500">
                                                <option value="">--Despacho--</option>

                                                    <option value="1">Domicilio</option>
                                                    <option value="2">Sucursal</option>
                                                    <option value="3">Retiro en tienda</option>
                            
                                            </select>
                                        </div>

                                        <div>
                                            @if(!is_null($transportistas))
                                                {!! Form::label('transportista_id', 'Transportista') !!}
                                                {!! Form::select('transportista_id', $transportistas, null , ['class'=>'form-input block w-full mt-1']) !!}
                                            @endif
                                        </div>
                            
                                </div>


                                <div class="flex justify-center mb-24">
                                    <button type="button" class="font-semibold rounded-lg bg-red-600 hover:bg-red-500 text-white py-2 px-4 justify-center my-4 text-sm ml-2" wire:click="cancel" >Cancelar</button>
                                    {!! Form::submit('Ingresar Pedido', ['class'=>'font-semibold rounded-lg bg-green-600 hover:bg-green-500 text-white py-2 px-4 justify-center my-4 cursor-pointer ml-2']) !!}
                                </div>

                            {!! Form::close() !!}
                        @endif

                    @endif 
                @endif

            @if(!is_null($invitados) || ($search && $guess->count() && is_null($socio_id)) || ($search && $socios->count()==0) || ($search && $guess->count()==0 && is_null($socio_id)))

                @if ($invitado_id)  

                    <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-teal-900 pl-4 py-3 shadow-md my-4 mx-auto items-center max-w-sm" role="alert">
                                
                        <div class="flex">
                            <div class="py-1">
                                @foreach ($guess as $invitado)
                                    @if ($invitado->id == $invitado_id)

                                        <img class="h-11 w-11 object-cover object-center rounded-full mr-4" src="{{asset('img/compras.jpg')}}" alt=""  />
                                
                                    @endif

                                @endforeach
                            </div>
                            
                            <div>
                                
                                @foreach ($guess as $invitado)
                                    @if ($invitado->id == $invitado_id)
                                        <p class="font-bold">{{$invitado->name.", ".$invitado->rut}}</p>
                                        @if ($invitado->direccion)
                                            <p class="text-sm">{{$invitado->direccion->comuna.", ".$invitado->direccion->region}} </p>  
                                        @endif
                                    @endif

                                @endforeach
                            </div>

                            <span class="relative top-0 bottom-0 right-0 ml-8 py-3" wire:click="resetsocio">
                                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cancelar</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                        </div>
                    </div>

                    {!! Form::open(['route' => 'vendedor.pedidos.store', 'method'=> 'POST']) !!}
                        @csrf
                    {!! Form::hidden('user_id',auth()->user()->id) !!}

                    {!! Form::hidden('pedidoable_type','App\Models\Invitado') !!}

                    {!! Form::hidden('invitado_status','asociado') !!}

                    {!! Form::hidden('pedidoable_id',$invitado_id) !!}

                    <div class="bg-yellow-100 border-t-4 border-yellow-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-4 mx-auto items-center max-w-sm">

                            <div class="flex items-center mt-4">
                                <Label class="w-80">Despacho:</Label>
                                <select wire:model="selecteddespacho" class="block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="">--Despacho--</option>

                                        <option value="1">Domicilio</option>
                                        <option value="2">Sucursal</option>
                                        <option value="3">Retiro en tienda</option>
                
                                </select>
                            </div>

                            <div>
                                @if(!is_null($transportistas))
                                    {!! Form::label('transportista_id', 'Transportista') !!}
                                    {!! Form::select('transportista_id', $transportistas, null , ['class'=>'form-input block w-full mt-1']) !!}
                                @endif
                            </div>

                    </div>


                    <div class="flex justify-end">

                        {!! Form::submit('Ingresar Pedido', ['class'=>'font-semibold rounded-lg bg-green-600 hover:bg-green-500 text-white py-2 px-4 justify-center ml-2 my-2']) !!}
                    </div>
                    {!! Form::close() !!}
                @else
                    @if ($type=='pedido')
                        <x-table-responsive>
                        

                            @if ($guess->count())

                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Invitados
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Rut
                                        </th>
                                    
                                        <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">

                                        @foreach ($guess as $invitado)
                        
                                                
                                                <tr wire:click="updateinvitado_id({{$invitado->id}})">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                    
                                                                    <img class="h-11 w-11 object-cover object-center rounded-full" src="{{asset('img/compras.jpg')}}" alt=""  />
                                                                
                                                                    
                                                                
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm text-gray-900">
                                                                    {{$invitado->name}}
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{$invitado->email}}</div>
                                                        
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{$invitado->rut}}</div>
                                                        
                                                    </td>

                                                    
                                                    

                                                    
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <a wire:click="updateinvitado_id({{$invitado->id}})" class="text-indigo-600 hover:text-indigo-900 cursor-pointer">Seleccionar</a>
                                                    
                                                    </td>
                                                </tr>

                                        
                                        @endforeach
                                        <!-- More people... -->
                                    </tbody>
                                </table>
                                
                            @else
                                <div class="px-6 py-4">
                                    No hay ningun registro
                                </div>
                            @endif 

                            <div class="px-6 py-4">
                                {{$guess->links()}}
                            </div>
                        </x-table-responsive>
                    @endif
                    
                    <h1 class="text-center my-4"> Crea un nuevo rider a continuacion</h1>
                    @if ($type=='pedido')
                        <div>
                            {!! Form::open(['route' => 'vendedor.pedidos.store', 'method'=> 'POST']) !!}
                            @csrf
                            {!! Form::hidden('user_id',auth()->user()->id) !!}
                            
                            {!! Form::hidden('pedidoable_type','App\Models\Invitado') !!}

                            {!! Form::hidden('invitado_status','creado') !!}

                            <div wire:ignore>
                                <div class="mb-4">
                                    {!! Form::label('name', 'Nombre') !!}
                                    {!! Form::text('name', $nombre, ['class' => 'form-input block w-full mt-1'.($errors->has('name')?' border-red-600':'')]) !!}

                                    @error('name')
                                        <strong class="text-xs text-red-600">{{$message}}</strong>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    {!! Form::label('rut', 'Rut') !!}
                                    {!! Form::text('rut', $rut , ['class' => 'form-input block w-full mt-1'.($errors->has('rut')?' border-red-600':'')]) !!}
                                
                                    @error('rut')
                                        <strong class="text-xs text-red-600">{{$message}}</strong>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    {!! Form::label('fono', 'Fono') !!}
                                    {!! Form::text('fono', $telefono , ['class' => 'form-input block w-full mt-1'.($errors->has('fono')?' border-red-600':'')]) !!}
                                
                                    @error('fono')
                                        <strong class="text-xs text-red-600">{{$message}}</strong>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    {!! Form::label('email', 'Email') !!}
                                    {!! Form::text('email', $email , ['class' => 'form-input block w-full mt-1'.($errors->has('email')?' border-red-600':'')]) !!}
                                
                                    @error('email')
                                        <strong class="text-xs text-red-600">{{$message}}</strong>
                                    @enderror
                                </div>
                                
                                
                                
                            </div>

                                    <div class="grid grid-cols-2 gap-4">
                                    
                                    
                                        <div class="items-center mt-4">
                                            
                                            <select wire:model="selecteddespacho" class="block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                                <option value="">--Despacho--</option>

                                                    <option value="1">Domicilio</option>
                                                    <option value="2">Sucursal</option>
                                                    <option value="3">Retiro en tienda</option>
                            
                                            </select>
                                        </div>

                                        <div>
                                            @if(!is_null($transportistas))
                                                {!! Form::label('transportista_id', 'Transportista:') !!}
                                                {!! Form::select('transportista_id', $transportistas, null , ['class'=>'form-input block w-full mt-1']) !!}
                                            @endif
                                        </div>
                                    
                                        <div>
                                        </div>
                            
                                    </div>
                                    <div class="flex justify-end">
                                    
                                        {!! Form::submit('Ingresar Pedido', ['class'=>'font-semibold rounded-lg bg-green-600 hover:bg-green-500 text-white py-2 px-4 justify-center ml-2']) !!}
                                    </div>
                                {!! Form::close() !!}
                        </div>
                    @else
                        <div>
                            
                            {!! Form::open(['route' => 'ticket.vendedores.store', 'method'=> 'POST']) !!}
                            @csrf
                            {!! Form::hidden('user_id',auth()->user()->id) !!}

                            {!! Form::hidden('evento_id',$eventoid ) !!}
                    
                
                                                            {!! Form::hidden('rut',$dni) !!}
                                                            

                                                                    
                                                                                                    
                                                                                        
                                                                                                    
                                                                <h1 class="text-xl pb-4 text-center">Datos Personales</h1>
                                                                <div class=" mx-auto px-2 sm:px-2 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-x-4 gap-y-8">
                                                                    <div class="md: col-span-3 lg:col-span-3 ">

                                                                        <div class="mb-4">
                                                                            <div class="grid grid-cols-2 gap-x-2">
                                        
                                                                                <div class="mb-4"  wire:ignore>
                                                                                    {!! Form::label('email', 'Email') !!}
                                                                                    {!! Form::text('email', null, [
                                                                                        'class' => 'w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm '.($errors->has('email')?' border-red-600':''),
                                                                                        'type' => 'email', // Agregar el atributo type con el valor 'email'
                                                                                    ]) !!}
                                                                                    @error('email')
                                                                                        <strong class="text-xs text-red-600">{{$message}}</strong>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="mb-4">
                                                                                    {!! Form::label('rut', 'Rut* (Sin puntos y con guión)') !!}
                                                                                    <input wire:model="dni" class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm"
                                                                                    type="text" name="dni" style="z-index: 10;" autocomplete="off"  id='rut-form'>
                                                                    
                                                                                                    
                                                                                
                                                                                    @error('name')
                                                                                        <strong class="text-xs text-red-600">{{$message}}</strong>
                                                                                    @enderror
                                                                                </div>
                                                                            
                                                                            </div>
                                                                            
                                                                        

                                                                            @if ($dni)
                                                                                <div x-data="{sview: true}">
                                                                                    <p class="text-center text-xs">Pincha sobre tu nombre si los datos coinciden con tu perfil <span x-on:click="sview=!sview" class="text-blue-500">(Ocultar/Mostrar)</span></p>
                                                                                    
                                                                                    <ul x-show="sview" class="relative z-1 left-0 w-full bg-white mt-1 rounded-lg overflow-hidden px-4">
                                                                                        
                                                                                        @forelse ($this->socios as $objet)
                                                                                            <li wire:click="updatesocio_id({{$objet->id}})" class="leading-10 px-5 text-sm cursor-pointer hover:bg-gray-300">
                                                                                                <p wire:click="updatesocio_id({{$objet->id}})">
                                                                                                    {{$objet->name}}-{{$objet->rut}}-{{$objet->email}} (Rider)
                                                                                                </p>
                                                                                            </li>
                                                                                            @empty
                                                                                        
                                                                                            
                                                                                    
                                                                                        @endforelse
                                                                                    
                                                                                        
                                                                                    </ul>
                                                                                </div>
                                                                                
                                                                            @else
                                                                                
                                                                            @endif
                                                                        </div>

                                                                        <div class="mb-4"  wire:ignore>
                                                                            {!! Form::label('name', 'Nombre') !!}
                                                                            {!! Form::text('name', null , ['class' => 'form-input block w-full mt-1'.($errors->has('name')?' border-red-600':'')]) !!}

                                                                            @error('name')
                                                                                <strong class="text-xs text-red-600">{{$message}}</strong>
                                                                            @enderror
                                                                        </div>
                                                                    
                                                                        <div class="mb-4"  wire:ignore>
                                                                            {!! Form::label('second_name', 'Segundo/Tercer Nombre (Opcional)') !!}
                                                                            {!! Form::text('second_name', null , ['class' => 'form-input block w-full mt-1'.($errors->has('titulo')?' border-red-600':'')]) !!}

                                                                            @error('second_name')
                                                                                <strong class="text-xs text-red-600">{{$message}}</strong>
                                                                            @enderror
                                                                        </div>

                                                                
                                                                        <div class="mb-4"  wire:ignore>
                                                                            {!! Form::label('last_name', 'Apellidos*') !!}
                                                                            {!! Form::text('last_name', null , ['class' => 'form-input block w-full mt-1'.($errors->has('titulo')?' border-red-600':'')]) !!}

                                                                            @error('last_name')
                                                                                <strong class="text-xs text-red-600">{{$message}}</strong>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="mb-4"  wire:ignore>
                                                                            {!! Form::label('born_date', 'Fecha de nacimiento') !!}
                                                                            {!! Form::date('born_date', null , ['class' => 'form-input block w-full mt-1'.($errors->has('nacimiento')?' border-red-600':''),'autocomplete'=>"off"]) !!}
                                                    
                                                                            @error('born_date')
                                                                                <strong class="text-xs text-red-600">{{$message}}</strong>
                                                                            @enderror
                                                                        </div>
                                                                    
                                                                        <div class="mb-4"  wire:ignore>
                                                                            {!! Form::label('fono', 'Fono*') !!}
                                                                            {!! Form::text('fono', null , ['class' => 'form-input block w-full mt-1'.($errors->has('fono')?' border-red-600':'')]) !!}

                                                                            @error('fono')
                                                                                <strong class="text-xs text-red-600">{{$message}}</strong>
                                                                            @enderror
                                                                        </div>
                            </div>

                        </div>
                        
                        <div class="flex justify-center">
                                    
                            {!! Form::submit('Crear Ticket', ['class'=>'font-semibold rounded-lg bg-green-600 hover:bg-green-500 text-white py-2 px-4 justify-center ml-2']) !!}
                        </div>
                        {!! Form::close() !!}
                
                    
                
            
                    @endif
                @endif
            

                    <div class="flex justify-end mb-24">
                        <button type="button" class="btn btn-danger text-sm ml-2" wire:click="cancel" >Cancelar</button>
                
                    </div>

            
                
                
                
            @endif

        @endif

    </section>    

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
                window.livewire.emit('pagomanual');
              }
            });
        });
        
         </script>

   
    
   
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const rutInput = document.getElementById('rut-form');
            rutInput.addEventListener('input', function () {
                // Remover todos los caracteres que no sean números, guiones o la letra 'k' (mayúscula o minúscula)
                const cleanedValue = this.value.replace(/[^0-9kK-]/g, '');
                // Aplicar el nuevo valor limpio al campo de entrada
                this.value = cleanedValue.toUpperCase(); // Convertir 'k' a mayúscula si es necesario
            });
        });
    </script>

</div>