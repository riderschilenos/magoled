<x-evento-layout>
    
    <x-slot name="tl">
            
        <title>{{$evento->titulo}}</title>
        @isset($evento->image)
            <link rel="shortcut icon" href="{{Storage::url($evento->image->url)}}">
        @else
            <link rel="shortcut icon" href="{{asset('img/logo.png')}}">
        @endisset
        
    </x-slot>

    
        
        <style>
            table {
              font-family: arial, sans-serif;
              border-collapse: collapse;
              width: 100%;
            }
            
            td, th {
              border: 1px solid #dddddd;
              text-align: center;
              padding: 8px;
            }
            
            tr:nth-child(even) {
              background-color: #dddddd;
            }
            
            /* Aplicar estilos específicos para pantallas pequeñas (menos de 600px de ancho) */
            @media screen and (max-width: 600px) {
              table {
                border-collapse: collapse;
                width: 100%;
              }
              th, td {
                padding: 6px;
                text-align: left;
              }
            }
            </style>
       
        <section class="bg-white md:py-4 mb-8 ">
            <div class=" max-w-7xl mx-auto sm:px-4 grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="flex sm:hidden justify-center">
                    @isset($evento->image)
                        <img class="w-full object-center object-contain"  src="{{Storage::url($evento->image->url)}}" alt="">
                    @else
                        <img class="w-full object-center" src="https://raindance.org/wp-content/uploads/2019/10/filmmaking-1080x675-1.jpg" alt="">
                    @endisset
                </div>
                <div class="hidden sm:flex justify-center">
                    @isset($evento->image)
                        <img class="h-80 w-80  object-center object-contain"  src="{{Storage::url($evento->image->url)}}" alt="">
                    @else
                        <img class="h-72 w-72 object-center" src="https://raindance.org/wp-content/uploads/2019/10/filmmaking-1080x675-1.jpg" alt="">
                    @endisset
                </div>

                <div class="text-gray-100 items-center my-auto bg-gray-700 p-4 rounded-2xl mx-2">
                    <h1 class="text-4xl">{{$evento->titulo}}</h1>
                    <h2 class="text xl mb-3">{{$evento->subtitulo}}</h2>
                    @if ($evento->limite>0)
                        
                    @if($evento->type=='sorteo')
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
                        
                        <p class="mb-2"><i class="fas fa-users"></i> {{$evento->limite-$inscritos}} Números disponibles    </p>
                        

                    @else
                        <p class="mb-2"><i class="fas fa-users"></i> {{$evento->limite-$evento->tickets()->where('status', '>=', 1)->count()}} Cupos disponibles    </p>
                    @endif
                       
                    @endif

                        @if ($evento->type=='pista')
                            <p class="mb-2"><i class="fas fa-calendar"></i> <b>+ {{$evento->fechas_count}}</b> Entrenamientos Realizados</p>
                        @elseif ($evento->type=='sorteo')

                        @else

                            <p class="mb-2"><i class="fas fa-calendar"></i> <b>{{$evento->fechas_count}}</b> 
                                @if ($evento->fechas_count>1)
                                    Fechas
                                @else
                                    Fecha 
                                @endif

                                @if ($fechas->count()>1)
                                    @foreach ($fechas as $fecha)       
                                        @if ($fecha->fecha>=now()->subDays(1))
                                            @if ($fecha->fecha)
                                            ( {{date('d/m/Y', strtotime($fecha->fecha))}} )
                                            @endif 
                                        @endif
                                    @endforeach
                                @endif
                            </p>
                        @endif
                   
                   
                    <p class="mb-2"><i class="fas fa-biking"></i> Disciplina: {{$evento->disciplina->name}}</p>
                    <p class="mb-2"><i class="fas fa-user"></i> Organizador: {{$evento->user->name}}</p>
                    @if ($evento->type=='sorteo')
                        <div>
                            <div class="inline-block mb-2 ms-[calc({{$inscritos*100/$evento->limite}}%-1.25rem)] py-0.5 px-1.5 bg-blue-50 border border-blue-200 text-xs font-medium text-blue-600 rounded-lg ">{{number_format($inscritos*100/$evento->limite,1)}}%</div>
                                <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                <div class="flex flex-col justify-center rounded-full overflow-hidden bg-blue-600 text-xs text-white text-center whitespace-nowrap transition duration-500 " style="width: {{$inscritos*100/$evento->limite}}%"></div>
                            </div>
                        </div>
                    @endif
                    {{-- comment 
                    @if ($evento->type!='pista')
                        <p class="mb-2"><i class="fas fa-users"></i> Inscritos:    {{$evento->tickets->where('status','>=',3)->count()}}</p>
                    @endif
                   --}}

                </div>

            </div>

        </section>

       

        <div class="container grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="order-2 md:col-span-2 lg:order-1">

              

                <section class="card">
                    <div class="card-body">

                        @if ($evento->type=='pista')
                            <h1 class="font-bold text-2xl mb-2 text-gray-800">¿Qué podrás disfrutar en esta pista?</h1>
                        @else
                            <h1 class="font-bold text-2xl mb-2 text-gray-800">¿Qué podrás disfrutar en este evento?</h1>
                        @endif
                        
                    
                        <p class="text-gray-700 text-base">{!!$evento->descripcion!!}</p>

                        @if ($evento->type=='pista')
                            <h1 class="font-bold text-xl my-4 text-gray-800">La Pista a Realizado {{$evento->fechas_count}} Entrenamientos.</h1>

                        @elseif($evento->type=='sorteo')
                        
                        @elseif($evento->type=='desafio')
                            <h1 class="font-bold text-xl my-4 text-gray-800">La organización estipula {{$evento->fechas_count}} etapas en este desafío.</h1>
                        @else
                            <h1 class="font-bold text-xl my-4 text-gray-800">La organización estipula {{$evento->fechas_count}} fechas para este campeonato.</h1>
                        
                        @endif
                        @if ($evento->type=='sorteo')

                        @else
                            <ul class="grid grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 mt-8">
                                @foreach ($fechas as $fecha)
                                    @if ($fecha->image)
                                    <li class="text-center"><img class="h-40 w-full object-contain" src=" {{Storage::url($fecha->image->url)}}" alt="">
                                        @if ($fecha->name=='keyname')
                                            Entrenamiento {{$fecha->fecha}}
                                        @else
                                            {{$fecha->name }} 
                                        @endif
                                
                                    </li>
                                    @else
                                    <li class="text-center"><img class="h-40 w-full object-contain" src=" {{Storage::url($evento->image->url)}}" alt=""> 
                                        @if ($fecha->name=='keyname')
                                            Entrenamiento {{$fecha->fecha}}
                                        @else
                                            {{$fecha->name }} 
                                        @endif
                                    </li>
                                    @endif
                                    
                                    
                                @endforeach
                            </ul>
                        @endif
                    </div>

                </section>

                

                <section class="mb-8">
                    

                    <header class="border border-gray-200 px-4 py-2 cursor bg-gray-200 mt-6 flex items-center">
                        <div>
                            @if ($evento->type=='pista')
                                <h1 class="font-bold text-lg text-gray-800">Riders Con Entrada</h1>
                            @else
                                @if($evento->type=='desafio' || $evento->type=='sorteo')
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
                                    
                                    @if ($evento->type=='sorteo')
                                        <h1 class="font-bold text-lg text-gray-800">{{$inscritos}} Números Vendidos</h1>                                
                                    @else
                                        <h1 class="font-bold text-lg text-gray-800">{{$inscritos}} Riders Inscritos</h1>
                                    @endif
                                    

                                @else
                                    <h1 class="font-bold text-lg text-gray-800">{{$tickets->count()}} Riders Inscritos</h1>
                                @endif
                                
                            @endif
                        </div>
                        @if ($evento->type=='sorteo')
                            <div class="w-full">
                                <p class="text-gray-600 text-sm text-center"> {{number_format($inscritos*100/$evento->limite,1)}}% de la meta completada</p>
                                <div class="relative pt-1 pb-4">
                                    <div class="overflow-hidden h-2 text-xs flex rounded bg-white">
                                    <div style="width:{{$inscritos*100/$evento->limite}}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-600 transition-all duration-500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                    </header>

                    <div class="bg-white">


                        <x-table-responsive>
                            {{-- comment
                                    <div class="px-6 py-4">
                                        <input wire:model="search" class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Buscar Rider...">
                                    </div>
                            --}}
                            @if ($tickets->count())
                    
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                   
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Nombre
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                            @if ($evento->type=='sorteo')
                                                Boletos
                                            @else
                                                Categoria
                                            @endif
                                        </th>
                                   
                                      
                                       
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                    
                                        @foreach ($tickets as $item)
                                            
                                                <tr>
                                                  
                                                    <td class="px-3 py-4 whitespace-nowrap">
                                                        @if ($item->ticketable_type=='App\Models\Socio')
                                                            @if ($item->user)
                                                                <div class="flex items-center">
                                                                    <div class="flex-shrink-0 h-10 w-10">
                                                                       
                                                                            @if ($item->user->socio)
                                                                                <a href="{{route('socio.show', $item->user->socio)}}">
                                                                                    @if (str_contains($item->user->profile_photo_url,'https://ui-'))
                                                                                        <img class="h-11 w-11 object-cover object-center rounded-full" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="{{ $item->user->name }}"  >
                                                                                    
                                                                                    @else
                                                                                        <img class="h-11 w-11 object-cover object-center rounded-full" src="{{$item->user->profile_photo_url}}" alt="">
                                                                                    
                                                                                    @endif
                                                                                </a>
                                                                            @else
                                                                                <img class="h-11 w-11 object-cover object-center rounded-full" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="{{ $item->user->name }}"  >
                                                                            @endif
                                                                        
                                                                    
                                                                    
                                                                        
                                                                    </div>
                                                                    <div class="ml-4">
                                                                        <div class="text-sm font-medium text-gray-900 text-left">
                                                                            
                                                                           
                                                                                @if ($item->user->socio)
                                                                                    <a href="{{route('socio.show', $item->user->socio)}}">
                                                                            
                                                                                        {{ Str::limit($item->user->name, 18) }}<br>
                                                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                                                           Ver Perfil Rider
                                                                                        </span>
                                                                                        @if(!is_null($item->user->socio->direccion))
                                                                                            <div class="text-xs flex items-center">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3 mx-1">
                                                                                                    <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                                                                                </svg>
                                                                                                
                                                                                                
                                                                                                {{$item->user->socio->direccion->comuna." ".Str::limit($item->user->socio->direccion->region,18)}} 
                                                                                            </div>
                                                                                        @endif

                                                                                    </a>
                                                                                @else
                                                                                        {{ Str::limit($item->user->name, 18) }}
                                                                                @endif
                                                                          
                                                                        </div>
                                                                      
                                                                        
                                                                    </div>
                                                                </div>
                                                                @if ($evento->type=='sorteo')
                                                                    @if ($item->inscripcions->count()==1)
                                                                         <div class="text-center">
                                                                            {{$item->inscripcions->count()}} Boleto
                                                                            <br>Ticket: {{$item->id}}
                                                                        </div>
                                                                    @else
                                                                         <div class="text-center">
                                                                            {{$item->inscripcions->count()}} Boletos
                                                                            <br>Ticket: {{$item->id}}
                                                                        </div>
                                                                    @endif
                                                                       
                                                                @endif
                                                            @else
                                                                <div class="flex items-center">
                                                                    <div class="flex-shrink-0 h-10 w-10">
                                                                    
                                                                                <img class="h-11 w-11 object-cover object-center rounded-full" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt=""  >
                                                                        
                                                                    
                                                                    
                                                                        
                                                                    </div>
                                                                    <div class="ml-4">
                                                                        <div class="text-sm font-medium text-gray-900 text-left">
                                                                            
                                                                        
                                                                                ID:{{$item->id}}
                                                                        
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>

                                                            @endif
                                                        @else

                                                            <div class="flex items-center">
                                                                <div class="flex-shrink-0 h-10 w-10">
                                                                    
                                                                            <img class="h-11 w-11 object-cover object-center rounded-full" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt=""  >
                                                                    
                                                                    
                                                                </div>
                                                                <div class="ml-4">
                                                                    <div class="text-sm font-medium text-gray-900">
                                                                        
                                                                        
                                                                            
                                                                                @foreach ($invitados as $invitado)
                                                                                    
                                                                                    @if ($item->ticketable_id==$invitado->id)
                                                                                        @can('Super admin')
                                                                                            <a href="https://api.whatsapp.com/send?phone=569{{substr(str_replace(' ', '', $invitado->fono), -8)}}&text=Hola%20que%20tal" target="_blank">
                                                                                                {{ Str::limit($invitado->name, 18) }}
                                                                                            </a>
                                                                                        @else
                                                                                            {{ Str::limit($invitado->name, 18) }}
                                                                                        @endcan
                                                                                          

                                                                                    @endif

                                                                                @endforeach

                                                                      
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>

                                                        @endif
                                                        
                                                    </td>
                    
                                              
                                                    
                                                    <td class="px-2 md:px-6 py-4 whitespace-nowrap text-center">
                                                        <div class="text-sm text-gray-900 text-center">
                                                                        @php
                                                                            $tot=0;
                                                                        @endphp
                                                                        
                                                                    @if ($evento->type=='sorteo')
                                                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-2 items-center mb-2 rounded-lg">
                                                                                            
                                                                            @foreach ($item->inscripcions->reverse() as $inscripcion)
                                                                                            
                                                                                                        @if ($item->user)
                                                                                                        
                                                                                                                <div class="px-4 py-4 whitespace-nowrap bg-gray-100">

                                                                                                                    @if($evento->type=='sorteo')
                                                                                                                        <p class="text-lg font-bold">
                                                                                                                            Boleto Nro: {{$inscripcion->id}}
                                                                                                                        </p>
                                                                                                                    @else
                                                                                                            
                                                                                                                        {{$inscripcion->fecha_categoria->categoria->name}}
                                                                                                                        <br>
                                                                                                                        {{$inscripcion->fecha->name}}
                                                                                                                    @endif
                                                                                                                
                                                                                                                </div>
                                                                                                                @if($evento->type=='desafio')
                                                                                                                    <div class="w-full mx-2 md:mx-8">
                                                                                                                            @if ($inscripcion->estado>=4)
                                                                                                                                <span class="ml-2 text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-base/none text-success bg-success-light rounded-lg">
                                                                                                                                    SUPERADO <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-1">
                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                                                                                                                    </svg>
                                                                                                                                </span>
                                                                                                                            @else
                                                                                                                                @php
                                                                                                                                if ($inscripcion->fecha->name=='Etapa 15 km') {
                                                                                                                                        $distancia=15;  
                                                                                                                                }elseif ($inscripcion->fecha->name=='Etapa 30 Km') {
                                                                                                                                        $distancia=30;
                                                                                                                                }elseif ($inscripcion->fecha->name=='Etapa 50Km') {
                                                                                                                                        $distancia=50;
                                                                                                                                }elseif ($inscripcion->fecha->name=='Etapa 100KM') {
                                                                                                                                        $distancia=100;
                                                                                                                                }else{
                                                                                                                                        $distancia=1;
                                                                                                                                    }
                                                                                                                                
                                                                                                                                    
                                                                                                                                    $total=0;
                                                                                                                                @endphp
                                                                                                                                @if ($inscripcion->ticket->user->activities)
                                                                                                                                    @foreach ($inscripcion->ticket->user->activities as $activitie)
                                                                                                                                        @php
                                                                                                                                            $date1=date($activitie->start_date_local);
                                                                                                                                            $date2=date($inscripcion->ticket->updated_at);
                                                                                                                                        @endphp
                                                                                                                                        {{-- comment
                                                                                                                                        {{$date1}}<br>
                                                                                                                                        {{$date2}} <br> --}}
                                                                                                                                    
                                                                                                                                        @if ($date1>$date2 && $activitie->type=='Ride')
                                                                                                                                            @php
                                                                                                                                                    $total+=floatval($activitie->distance);
                                                                                                                                            @endphp
                                                                                                                                        @endif
                                                                                                                                    
                                                                                                                                    @endforeach
                                                                                                                                @endif

                                                                                                                                <p class="text-gray-600 text-sm mt-4 "> {{$total*100/$distancia}}% completado </p>
                                                                                                                                <div class="relative pt-1 pb-4">
                                                                                                                                    <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-200">
                                                                                                                                    <div style="width: {{$total*100/$distancia}}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-600 transition-all duration-500">
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            
                                                                                                                            @endif 
                                                                                                                    </div>
                                                                                                                @endif 
                                                                                                        
                                                                                                        @else
                                                                                                                <div class="px-2 py-4 whitespace-nowrap bg-gray-100">
                                                                                                                
                                                                                                                    {{-- comment   {{$fecha->name}} --}} {{$inscripcion->fecha_categoria->categoria->name}}
                                                                                                                    <br>
                                                                                                                    {{$inscripcion->fecha->name}}                                                                                     
                                                                                                                
                                                                                                                </div>
                                                                                                                <div>
                                                                                                                    @if($evento->type=='desafio')
                                                                                                                        @if ($inscripcion->estado>=4)
                                                                                                                            <span class="ml-2 text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-base/none text-success bg-success-light rounded-lg">
                                                                                                                                SUPERADO <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-1">
                                                                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                                                                                                                </svg>
                                                                                                                            </span>
                                                                                                                        @else
                                                                                                                    
                                                                                                                            
                                                                                                                        @endif 
                                                                                                                    @endif  
                                                                                                                </div>
                                                                                                            
                                                                                                        @endif
                                                                            @endforeach
                                                                        </div> 
                                                                    @else
                                                                        
                                                                    
                                                                                          
                                                                            @foreach ($item->inscripcions->reverse() as $inscripcion)
                                                                                <div class="@if($evento->type=='desafio')flex @elseif($evento->type=='sorteo')grid grid-cols-4 @else grid grid-cols-1 @endif gap-2 items-center mb-2 rounded-lg">
                                                                                    @if ($item->user)
                                                                                                        
                                                                                                                <div class="px-4 py-4 whitespace-nowrap bg-gray-100">

                                                                                                                    @if($evento->type=='sorteo')
                                                                                                                        <p class="text-lg font-bold">
                                                                                                                            Boleto Nro: {{$inscripcion->id}}
                                                                                                                        </p>
                                                                                                                    @else
                                                                                                            
                                                                                                                        {{$inscripcion->fecha_categoria->categoria->name}}
                                                                                                                        <br>
                                                                                                                        {{$inscripcion->fecha->name}}
                                                                                                                    @endif
                                                                                                                
                                                                                                                </div>
                                                                                                                @if($evento->type=='desafio')
                                                                                                                    <div class="w-full mx-2 md:mx-8">
                                                                                                                            @if ($inscripcion->estado>=4)
                                                                                                                                <span class="ml-2 text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-base/none text-success bg-success-light rounded-lg">
                                                                                                                                    SUPERADO <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-1">
                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                                                                                                                    </svg>
                                                                                                                                </span>
                                                                                                                            @else
                                                                                                                                @php
                                                                                                                                if ($inscripcion->fecha->name=='Etapa 15 km') {
                                                                                                                                        $distancia=15;  
                                                                                                                                }elseif ($inscripcion->fecha->name=='Etapa 30 Km') {
                                                                                                                                        $distancia=30;
                                                                                                                                }elseif ($inscripcion->fecha->name=='Etapa 50Km') {
                                                                                                                                        $distancia=50;
                                                                                                                                }elseif ($inscripcion->fecha->name=='Etapa 100KM') {
                                                                                                                                        $distancia=100;
                                                                                                                                }else{
                                                                                                                                        $distancia=1;
                                                                                                                                    }
                                                                                                                                
                                                                                                                                    
                                                                                                                                    $total=0;
                                                                                                                                @endphp
                                                                                                                                @if ($inscripcion->ticket->user->activities)
                                                                                                                                    @foreach ($inscripcion->ticket->user->activities as $activitie)
                                                                                                                                        @php
                                                                                                                                            $date1=date($activitie->start_date_local);
                                                                                                                                            $date2=date($inscripcion->ticket->updated_at);
                                                                                                                                        @endphp
                                                                                                                                        {{-- comment
                                                                                                                                        {{$date1}}<br>
                                                                                                                                        {{$date2}} <br> --}}
                                                                                                                                    
                                                                                                                                        @if ($date1>$date2 && $activitie->type=='Ride')
                                                                                                                                            @php
                                                                                                                                                    $total+=floatval($activitie->distance);
                                                                                                                                            @endphp
                                                                                                                                        @endif
                                                                                                                                    
                                                                                                                                    @endforeach
                                                                                                                                @endif

                                                                                                                                <p class="text-gray-600 text-sm mt-4 "> {{number_format($total*100/$distancia,2)}}% completado </p>
                                                                                                                                <div class="relative pt-1 pb-4">
                                                                                                                                    <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-200">
                                                                                                                                    <div style="width: {{$total*100/$distancia}}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-600 transition-all duration-500">
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            
                                                                                                                            @endif 
                                                                                                                    </div>
                                                                                                                @endif 
                                                                                                        
                                                                                    @else
                                                                                                                <div class="px-2 py-4 whitespace-nowrap bg-gray-100">
                                                                                                                
                                                                                                                    {{-- comment   {{$fecha->name}} --}} {{$inscripcion->fecha_categoria->categoria->name}}
                                                                                                                    <br>
                                                                                                                    {{$inscripcion->fecha->name}}                                                                                     
                                                                                                                
                                                                                                                </div>
                                                                                                                <div>
                                                                                                                    @if($evento->type=='desafio')
                                                                                                                        @if ($inscripcion->estado>=4)
                                                                                                                            <span class="ml-2 text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-base/none text-success bg-success-light rounded-lg">
                                                                                                                                SUPERADO <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-1">
                                                                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                                                                                                                </svg>
                                                                                                                            </span>
                                                                                                                        @else
                                                                                                                    
                                                                                                                            
                                                                                                                        @endif 
                                                                                                                    @endif  
                                                                                                                </div>
                                                                                                            
                                                                                    @endif
                                                                                </div> 
                                                                            @endforeach
                                                                        
                                                                    @endif
                                                            
                                                        
                                                        </div>
                                                        
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
                    
                        </x-table-responsive>

                 
                    </div>
                </section>
               
                    {{-- comment
                        <div class="mb-12 py-20">
                            @livewire('eventos-reviews',['evento' => $evento])
                        </div>
                    --}}
               
            </div>


            <div class="order-1 lg:order-2">
                @if ($evento->type=='pista')
                    @if ($ticket)
                        <a href="{{route('payment.checkout.ticket', $ticket)}}">
                            <section class="card mb-6">
                                <div class="card-body">
        
                                    @if ($evento->type=='pista')
                                        <h1 class="font-bold text-2xl mb-2 text-gray-800">Próximos Entrenamientos</h1>
                                    @else
                                        <h1 class="font-bold text-2xl mb-2 text-gray-800">¿Que podrás disfrutar en este evento?</h1>
                                    @endif
                                    <ul class="grid grid-cols-1 lg:grid-cols-1 gap-x-4 gap-y-2 mt-4">
                                            @php
                                                $n=0;
                                            @endphp
                                        @foreach ($fechas as $fecha)
                                            
                                            @if ($fecha->fecha>=now()->subDays(1))
                                                <li class="text-center">
                                                    <div class="flex items-center justify-center pb-5 bg-blue-900 text-white py-2">
                                                        @php
                                                            $dias=['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];
                                                        @endphp
                                                        @if ($fecha->name=='keyname')
                                                            <label class="mx-auto text-center"> {{$dias[date('N', strtotime($fecha->fecha))-1]}} <br> {{date('d/m/Y', strtotime($fecha->fecha))}}
                                                            </label>
                                                        @else
                                                            <p class="text-base leading-none"> {{$fecha->name}}</p>
                                                        @endif
                                                            
                                                    </div>
                                                </li>
                                            
                                                @php
                                                    $n+=1;
                                                @endphp
                                            @endif
                                        @endforeach
                                                @if ($n==0)
                                                    <div class="text-center">
                                                        <div class="flex items-center justify-center pb-5 bg-red-600 p-2 text-white py-2">
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
                                                @endif
                                    </ul>
                                
                                </div>
        
                            </section>
                        </a>
                    @else
                        <a href="{{route('checkout.evento',$evento)}}">
                            <section class="card mb-6">
                                <div class="card-body">
        
                                    @if ($evento->type=='pista')
                                        <h1 class="font-bold text-2xl mb-2 text-gray-800">Próximos Entrenamientos</h1>
                                    @else
                                        <h1 class="font-bold text-2xl mb-2 text-gray-800">¿Que podrás disfrutar en este evento?</h1>
                                    @endif
                                    <ul class="grid grid-cols-1 lg:grid-cols-1 gap-x-4 gap-y-2 mt-4">
                                            @php
                                                $n=0;
                                            @endphp
                                        @foreach ($fechas as $fecha)
                                            
                                            @if ($fecha->fecha>=now()->subDays(1))
                                                <li class="text-center">
                                                    <div class="flex items-center justify-center pb-5 bg-blue-900 text-white py-2">
                                                        @php
                                                            $dias=['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];
                                                        @endphp
                                                        @if ($fecha->name=='keyname')
                                                            <label class="mx-auto text-center"> {{$dias[date('N', strtotime($fecha->fecha))-1]}} <br> {{date('d/m/Y', strtotime($fecha->fecha))}}
                                                            </label>
                                                        @else
                                                            <p class="text-base leading-none"> {{$fecha->name}}</p>
                                                        @endif
                                                            
                                                    </div>
                                                </li>
                                            
                                                @php
                                                    $n+=1;
                                                @endphp
                                            @endif
                                        @endforeach
                                                @if ($n==0)
                                                    <div class="text-center">
                                                        <div class="flex items-center justify-center pb-5 bg-red-600 p-2 text-white py-2">
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
                                                @endif
                                    </ul>
                                
                                </div>
        
                            </section>
                        </a>

                    @endif               
                @endif    
                
                <section class="card mb-4">
                    <div class="card-body">
                        <div class="flex items-center mb-4">
                            @if (str_contains($evento->organizador->profile_photo_url,'https://ui-'))
                                <img class="flex h-14 w-14 rounded-full shadow-lg object-cover" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="{{ $evento->organizador->name }}"  />
                            
                            @else
                                <img class="flex h-14 w-14 rounded-full shadow-lg object-cover" src="{{ $evento->organizador->profile_photo_url }}" alt="{{ $evento->organizador->name }}"  />
                            
                            @endif
                            
                            <div class="ml-4">
                                <h1 class="font-fold text-gray-500 text-lg">Organizador: {{ $evento->organizador->name }}</h1>
                                    @if ($evento->user->socio)
                                        <a class="text-blue-400 text-sm font-bold" href="{{route('socio.show',$evento->user->socio)}}">{{'@'.Str::slug($evento->user->socio->slug,'')}}</a>
                                        
                                    @endif
                            </div>
                        </div>

                       
                        @if ($ticket)
                            @if ($fechas->where('end_sell','!=',null)->count()>0)
                                    
                                <div id="countdownClock2" class="text-center my-2">
                                    Quedan 00:00:00 para inscribirse 
                                </div>

                            @endif

                                <a href="{{route('payment.checkout.ticket', $ticket)}}" class="btn btn-danger btn-block">
                                    @if ($evento->type=='pista')
                                        Finalizar Compra
                                    @else
                                        Finalizar Inscripción
                                    @endif
                                </a>
                        @else

                            @if($fechas->where('start_sell','!=',null)->count()>0)
                                @if ($fechas->where('start_sell','!=',null)->first()->start_sell>now())
                                    
                                    <div id="countdownClock" class="btn bg-blue-900 text-white btn-block cursor-wait">
                                        Faltan 00:00:00 para el inicio de las inscripciones
                                    </div>
                                @else
                                    
                                    @if ($fechas->where('end_sell','!=',null)->count()>0)
                                
                                        <div id="countdownClock2" class="text-center my-2">
                                            Quedan 00:00:00 para inscribirse
                                        </div>
                                        
                                    @endif
                                
                                    <a href="{{route('checkout.evento',$evento)}}" class="btn btn-danger btn-block">
                                        @if ($evento->type=='pista')
                                            Comprar
                                        @elseif ($evento->type=='sorteo')
                                            Obtener Números
                                        @else
                                            Inscribirme
                                        @endif
                                    </a>
                                    
                                @endif
                            
                            @else
                                @if ($fechas->where('end_sell','!=',null)->count()>0)
                               
                                    <div id="countdownClock2" class="text-center my-2">
                                        Quedan 00:00:00 para inscribirse
                                    </div>

                                @endif
                                <a href="{{route('checkout.evento',$evento)}}" class="btn btn-danger btn-block">
                                    @if ($evento->type=='pista')
                                        Comprar

                                    @elseif ($evento->type=='sorteo')
                                        Obtener Números
                                    @else
                                        Inscribirme
                                    @endif
                                </a>
                            @endif

                        @endif
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
                        @can('enrolled', $evento)
                                @if (auth()->user()->tickets->where('user_id',auth()->user()->id)->where('evento_id',$evento->id)->where('status',1)->first())
                                    @if($evento->type=='pista')
                                        <a class="btn btn-danger btn-block mt-4" href="{{route('ticket.view',auth()->user()->tickets->where('user_id',auth()->user()->id)->where('evento_id',$evento->id)->where('status',1)->first())}}">Ver mi Entrada</a>
                                    @else
                                        <a class="btn btn-danger btn-block mt-4" href="{{route('ticket.view',auth()->user()->tickets->where('user_id',auth()->user()->id)->where('evento_id',$evento->id)->where('status',1)->first())}}">Ver Tickets</a>
                                    @endif
                                @elseif(auth()->user()->tickets->where('user_id',auth()->user()->id)->where('evento_id',$evento->id)->where('status',3)->first())
                                @if($evento->type=='pista')
                                        <a class="btn btn-danger btn-block mt-4" href="{{route('ticket.view',auth()->user()->tickets->where('user_id',auth()->user()->id)->where('evento_id',$evento->id)->where('status',3)->first())}}">Ver mi Entrada</a>
                                    @else
                                        <a class="btn btn-danger btn-block mt-4" href="{{route('ticket.view',auth()->user()->tickets->where('user_id',auth()->user()->id)->where('evento_id',$evento->id)->where('status',3)->first())}}">Ver Tickets</a>
                                    @endif
                                @endif
                                
                                @if (auth()->user()->tickets)
                                    <a href="{{route('ticket.historial.view',auth()->user())}}" class="btn btn-danger btn-block mt-2">
                                        @if ($evento->type=='pista')
                                            Historial Compra
                                        @else
                                            Historial Compra
                                        @endif
                                    </a>
                                @endif
                                @if ($min == 0 && $max==0)
                                    @if ($evento->type=='pista')
                                        <p class="text-center text-gray-500 text-sm mb-1 mt-2">Entrada GRATIS</p>
                                    @else
                                        <p class="text-center text-gray-500 text-sm mb-1 mt-2">Inscripcion GRATIS</p>
                                    @endif
                                @elseif($min==$max)
                                    @if ($evento->type=='pista')
                                        <p class="text-center text-gray-500 text-sm mb-1 mt-2">Entradas</p>
                                    @else
                                        <p class="text-center text-gray-500 text-sm mb-1 mt-2">Inscripciones</p>
                                    @endif
                                        
                                    <div class="grid grid-cols-3 gap-x-2 gap-y-2 mx-auto mb-4 w-full  px-4">
                                        @foreach ($fech->categorias as $item)
                                            <div class="bg-gray-100 p-1 rounded-3xl w-full mx-2 items-center">
                                                @if ($item->inscripcion==0)
                                                    <p class=" text-gray-500 font-bold text-center">Gratis</p>
                                                @else
                                                    <p class=" text-gray-500 font-bold text-center">${{number_format($item->inscripcion)}}</p>
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

                                @else
                                    @if ($evento->type=='pista')
                                        <p class="text-center text-gray-500 text-sm mb-1 mt-2">Entradas</p>
                                    @else
                                        <p class="text-center text-gray-500 text-sm mb-1 mt-2">Inscripciones</p>
                                    @endif
                                    <div class="grid grid-cols-3 gap-x-2 gap-y-2 mx-auto mb-4 w-full  px-4 items-center my-auto">
                                        @foreach ($fech->categorias as $item)
                                            <div class="bg-gray-100 p-1 rounded-3xl w-full mx-2 items-center my-auto">
                                                @if ($item->inscripcion==0)
                                                    <p class=" text-gray-500 font-bold text-center">Gratis</p>
                                                @else
                                                    <p class=" text-gray-500 font-bold text-center">${{number_format($item->inscripcion)}}</p>
                                                @endif
                                                <p class="text-gray-500 text-sm text-center">{{$item->categoria->name}}</p> 
                                            </div>
                                        @endforeach

                                        <div class="hidden bg-gray-100 p-1 rounded-3xl w-full mx-1 items-center my-auto">
                                            @if ($max==0)
                                                <p class="text-gray-500 font-bold text-center">Gratis</p>
                                            @else
                                                <p class="text-gray-500 font-bold text-center">${{number_format($max)}}</p>
                                            @endif
                                        
                                            <p class="text-gray-500 text-sm text-center">Adultos</p> 
                                        </div>
                                        
                                    </div>
                                

                                @endif
                        @else 

                               

                                @if ($min == 0 && $max==0)
                                    @if ($evento->type=='pista')
                                        <p class="text-center text-gray-500 text-sm mb-1 mt-2">Entrada GRATIS</p>
                                    @else
                                        <p class="text-center text-gray-500 text-sm mb-1 mt-2">Inscripcion GRATIS</p>
                                    @endif
                                    

                                    
                                @elseif($min==$max)
                                    @if ($evento->type=='pista')
                                        <p class="text-center text-gray-500 text-sm mb-1 mt-2">Entradas</p>
                                    @else
                                        <p class="text-center text-gray-500 text-sm mb-1 mt-2">Inscripciones</p>
                                    @endif
                                        
                                    <div class="grid grid-cols-3 gap-x-2 gap-y-2 mx-auto mb-4 w-full  px-4">
                                        @foreach ($fech->categorias as $item)
                                            <div class="bg-gray-100 p-1 rounded-3xl w-full mx-2 items-center">
                                                @if ($item->inscripcion==0)
                                                    <p class=" text-gray-500 font-bold text-center">Gratis</p>
                                                @else
                                                    <p class=" text-gray-500 font-bold text-center">${{number_format($item->inscripcion)}}</p>
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

                                @else
                                    @if ($evento->type=='pista')
                                        <p class="text-center text-gray-500 text-sm mb-1 mt-2">Entradas</p>
                                    @else
                                        <p class="text-center text-gray-500 text-sm mb-1 mt-2">Inscripciones</p>
                                    @endif
                                    <div class="grid grid-cols-3 gap-x-2 gap-y-2 mx-auto mb-4 w-full  px-4 items-center my-auto">
                                        @foreach ($fech->categorias as $item)
                                            <div class="bg-gray-100 p-1 rounded-3xl w-full mx-2 items-center my-auto">
                                                @if ($item->inscripcion==0)
                                                    <p class=" text-gray-500 font-bold text-center">Gratis</p>
                                                @else
                                                    <p class=" text-gray-500 font-bold text-center">${{number_format($item->inscripcion)}}</p>
                                                @endif
                                                <p class="text-gray-500 text-sm text-center">{{$item->categoria->name}}</p> 
                                            </div>
                                        @endforeach

                                        <div class="hidden bg-gray-100 p-1 rounded-3xl w-full mx-1 items-center my-auto">
                                            @if ($max==0)
                                                <p class="text-gray-500 font-bold text-center">Gratis</p>
                                            @else
                                                <p class="text-gray-500 font-bold text-center">${{number_format($max)}}</p>
                                            @endif
                                           
                                            <p class="text-gray-500 text-sm text-center">Adultos</p> 
                                        </div>
                                        
                                    </div>
                                  

                                @endif

                                @if ($evento->user->vendedor)
                                    @if ($evento->user->vendedor->fono)
                                        <a href="https://api.whatsapp.com/send?phone=569{{substr(str_replace(' ', '', $evento->user->vendedor->fono), -8)}}&text=Hola,%20quiero%20m%C3%A1s%20informaci%C3%B3n%20sobre%20{{str_replace(' ', '%20', $evento->titulo)}}" target="_blank" class="btn btn-success mt-4 btn-block">
                                            Contactar al Whatsapp
                                        </a>
                                    @endif
                                @endif
                               
                                @if (auth()->user())
                                    @if (auth()->user()->tickets)
                                        <a href="{{route('ticket.historial.view',auth()->user())}}" class="btn btn-danger btn-block mt-2">
                                            @if ($evento->type=='pista')
                                                Historial Compra
                                            @else
                                                Historial Compra
                                            @endif
                                        </a>
                                    @endif
                                @endif
                                @if ($evento->entrada || $evento->entrada_niño)
                                  <p class="text-center text-gray-500 text-sm mb-1 mt-2">Entradas</p>

                                    <div class="flex justify-between mb-4">
                                        <div class="bg-gray-100 p-1 rounded-3xl w-full mx-1">
                                            <p class="mt-2 text-gray-500 font-bold text-center">${{number_format($evento->entrada_niño)}}</p>
                                            <p class="text-gray-500 text-sm text-center">Niños</p> 
                                        </div>
                                        <div class="bg-gray-100 p-1 rounded-3xl w-full mx-1">
                                            <p class="mt-2 text-gray-500 font-bold text-center">${{number_format($evento->entrada)}}</p>
                                            <p class="text-gray-500 text-sm text-center">Adultos</p> 
                                        </div>
                                    
                                    </div>
                               
                                    @isset($ticket)
                                        <a href="{{route('payment.checkout.ticket', $ticket)}}" class="btn btn-danger btn-block">Finalizar Compra</a>
                                    @else
                                        <a href="{{route('checkout.evento',$evento)}}" class="btn btn-danger btn-block">Obtener Entradas</a>
                                    @endif
                                    
                                @endif

                             
                                
                           
                    @endcan
                    </div>
                </section>

                <aside class="hidden lg:block">
                    @foreach ($similares as $similar)
                        <article class="flex mb-6">
                            <img class="h-32 w-40 object-cover"src="{{Storage::url($similar->image->url)}}" alt="">
                            <div class="ml-3">
                                <h1>
                                    <a class="font-bold text-gray-500 mb-3" href="{{route('ticket.evento.show', $similar)}}">{{Str::limit($similar->titulo, 40)}}</a>
                                </h1>

                                <div class="flex items-center mb-2">
                                    <img class="h-8 w-8 rounded-full shadow-lg object-cover" src="{{$similar->organizador->profile_photo_url}}" alt="">
                                    <p class="text-gray-700 text-sm ml-2">{{$similar->organizador->name}}</p>
                                </div>

                                <p class="text-sm"><i class="fas fa-star mr-2 text-yellow-400"></i>{{$similar->rating}}</p>
                            </div>
                        </article>
                    @endforeach
                </aside>
            </div>

            

        </div>

        <h1 class="text-center text-xs text-gray-400 py-12 mb-12">Todos Los derechos Reservados</h1>
        
    @if($fechas->where('start_sell','!=',null)->count()>0)
        @if (new DateTime($fechas->where('start_sell','!=',null)->first()->start_sell)>now())
            <script>
                function updateCountdownClock() {
                    var startSellTime = new Date("{{ $evento->fechas->where('start_sell', '!=', null)->first()->start_sell }}");
                    var currentTime = new Date();

                    var difference = startSellTime - currentTime;

                    if (difference > 0) {
                        var days = Math.floor(difference / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((difference % (1000 * 60)) / 1000);

                        document.getElementById("countdownClock").innerHTML =
                            "Falta " +
                            days +
                            "d " +
                            hours +
                            "h " +
                            minutes +
                            "m " +
                            seconds +
                            "s para comenzar";
                    } else {
                        document.getElementById("countdownClock").innerHTML = "¡La venta ya ha comenzado!";
                        window.location.href = "{{ route('checkout.evento', $evento) }}";
                    }

                    setTimeout(updateCountdownClock, 1000);
                }

                window.onload = updateCountdownClock;
            </script>
        @else
            @if($fechas->where('end_sell','!=',null)->count()>0)
                    
                <script>
                    function updateCountdownClock2() {
                        var startSellTime2 = new Date( <?php echo json_encode($evento->fechas->where('end_sell', '!=', null)->first()->created_at->addHours(720)) ?>);
                        var currentTime = new Date();

                        var difference = startSellTime2 - currentTime;

                        if (difference > 0) {
                            var days = Math.floor(difference / (1000 * 60 * 60 * 24));
                            var hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((difference % (1000 * 60)) / 1000);

                            document.getElementById("countdownClock2").innerHTML =
                                "Quedan " +
                                days +
                                "d " +
                                hours +
                                "h " +
                                minutes +
                                "m " +
                                seconds +
                                "s para finalizar";
                        } else {
                            document.getElementById("countdownClock2").innerHTML = startSellTime2;
                        //       window.location.href = "{{ route('checkout.evento', $evento) }}";
                        }

                        setTimeout(updateCountdownClock2, 1000);
                    }

                    window.onload = updateCountdownClock2;
                </script>
            
            @endif

        @endif
     @else
            @if($fechas->where('end_sell','!=',null)->count()>0)
                    
                <script>
                    function updateCountdownClock2() {
                        var startSellTime2 = new Date( <?php echo json_encode($evento->fechas->where('end_sell', '!=', null)->first()->created_at->addHours(720)) ?>);
                        var currentTime = new Date();

                        var difference = startSellTime2 - currentTime;

                        if (difference > 0) {
                            var days = Math.floor(difference / (1000 * 60 * 60 * 24));
                            var hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((difference % (1000 * 60)) / 1000);

                            document.getElementById("countdownClock2").innerHTML =
                                "Quedan " +
                                days +
                                "d " +
                                hours +
                                "h " +
                                minutes +
                                "m " +
                                seconds +
                                "s para finalizar";
                        } else {
                            document.getElementById("countdownClock2").innerHTML = "¡La venta ya ha comenzado!";
                        //       window.location.href = "{{ route('checkout.evento', $evento) }}";
                        }

                        setTimeout(updateCountdownClock2, 1000);
                    }

                    window.onload = updateCountdownClock2;
                </script>
            
            @endif

    @endif
   
</x-evento-layout>