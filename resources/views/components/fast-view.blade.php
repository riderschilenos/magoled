@props(['series','riders','autos','socio2','disciplinas'])
<div>
    <style>
    :root {
        --main-color: #4a76a8;
        --rider-color: #314780;
    }

    .bg-main-color {
        background-color: var(--main-color);
    }

    .bg-rider-color {
        background-color: var(--rider-color);
    }

    .text-main-color {
        color: var(--main-color);
    }

    .border-main-color {
        border-color: var(--main-color);
    }
    </style>

  

    <div :class="{'block': user, 'hidden': ! user}" class="hidden">
        @if($socio2)
          
            <div x-data="{fullview2: false}">       
                    <div x-show="fullview2" x-on:click="fullview2=false" class="fixed sm:hidden top-0 left-0 right-0 bottom-0 flex justify-center items-center bg-white">
                        <div class="flex items-center" x-on:click="fullview2=false">
                            @if (str_contains($socio2->user->profile_photo_url,'https://ui-'))
                                <img class="w-full object-contain"
                                src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg"
                                alt="Rider Chileno">
                            @else
                                <img class="w-full object-contain"
                                src="{{ $socio2->user->profile_photo_url }}"
                                alt="{{ $socio2->name." ".$socio2->second_name }} {{ $socio2->last_name }}">
                            @endif
                        </div>
                    </div>
                @php
                    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
                @endphp
                <style>
                    :root {
                        --main-color: #4a76a8;
                    }
            
                    .bg-main-color {
                        background-color: var(--main-color);
                    }
            
                    .text-main-color {
                        color: var(--main-color);
                    }
            
                    .border-main-color {
                        border-color: var(--main-color);
                    }
                </style>
            
            
                <div class="bg-gray-100  min-h-screen pb-6">
                    <div class="w-full text-white bg-main-color hidden sm:block">
                        <div x-data="{ open: false }"
                            class="flex flex-col max-w-screen-xl py-5 sm:py-0 px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
                            <div class="flex flex-row items-center justify-between p-4 ">
                                <a href="{{route('socio.index')}}"
                                    class="hidden md:inline text-lg font-semibold tracking-widest uppercase rounded-lg focus:outline-none focus:shadow-outline cursor-pointer"><i class="fas fa-arrow-circle-left text-white-800"></i> Seguir Navegando</a>
                            
                            </div>
                        </div>
                    </div>
                    <!-- End of Navbar -->
                    <div class="max-w-7xl mx-auto mb-5">
                        <div class="md:flex no-wrap md:-mx-2">
                            <!-- Left Side -->
                            <div class="w-full md:w-3/12 md:mx-2"  x-data="{open: true}">
                                <!-- Profile Card -->
                                    @switch($socio2->status)
                                                            @case(1)
                                                            <div class="bg-white p-3 border-t-4 border-green-500">
                                                                @break
                                                            @case(2)
                                                            <div class="bg-white p-3 border-t-4 border-red-400">
                                                                @break
                                                            @default
                                                                
                                    @endswitch
                                <div class="flex items-center space-x-2 mb-2 font-semibold text-gray-900 leading-8 justify-between">
                                        <div class="flex items-center">
                                            <span clas="text-green-500">
                                                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </span>
                                            <div class="flex"> 
                                            <p class="ml-2 tracking-wide">{{ $socio2->name." ".$socio2->second_name }} {{ $socio2->last_name }} </p>
                                                @if ($socio2->status==1) 
                                                    <div class="star-icon z-10 my-auto ml-2"> <!-- Contenedor de la estrella con z-index -->
                                                        <i class="fa fa-star text-yellow-400 text-xl my-auto items-center"></i> <!-- Estrella usando Font Awesome (ajusta el tamaño y el color según necesites) -->
                                                    </div>
                                                @endif
                                            </div>
                                            
                                        </div>
                                            @can('perfil_propio', $socio2)

                                            
                                                <a href="{{route('socio.edit',$socio2)}}" class="ml-2"><h5 class="text-blue-600 font-bold text-sm cursor-pointer ml-4">(Editar)</h5></a>
                                            @else

                                                @can('Super admin')
                                    
                                
                                                    <div class="flex justify-center mb-3">
                                                        <a href="{{route('socio.points', $socio2)}}">
                                                            <span class="bg-red-500 py-1 px-2 rounded text-white text-sm text-center flex">
                                                                @livewire('socio.point-count', ['socio' => $socio2]) Pts
                                                            </span>
                                                        </a>
                                                    </div>
                                                @endcan

                                            @endcan
                                            
                                    
                                </div>

                                    <div class="flex">
                                        <div class="content-center items-center">
                                            <div class="image overflow-hidden" x-on:click="fullview2=true">
                                                @if (str_contains($socio2->user->profile_photo_url,'https://ui-'))
                                                    <img class="h-44 w-40 mx-auto object-cover"
                                                    src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg"
                                                    alt="">
                                                @else
                                                    <img class="h-44 w-42 object-cover"
                                                    src="{{ $socio2->user->profile_photo_url }}"
                                                    alt="">
                    
                                                @endif
                                            
                                            </div>
                                            @can('perfil_propio', $socio2)
                                                <h1 class="text-gray-400 font-bold text-xs leading-8 my-1 ml-auto"><a href="{{ route('profile.show') }}">Editar Foto</a></h1>
                                            @endcan
                                        </div>
                                        <div class="col-spam-3 px-4 w-full">
                                            <a href="{{route('socio.show', $socio2)}}">
                                                <h1 class="text-blue-400 font-bold text-lg leading-8 mb-1">{{ '@'.$socio2->slug }}</h1>
                                            </a>  
                                            <div class="flex content-center">
                                                <div class="px-2 py-2 text-red-500 font-semibold content-center">
                                                    <i class="fas fa-birthday-cake content-arount" aria-hidden="true"></i>
                                                </div>
                                                <div class="px-2 py-2 text-sm">{{date('d-m-Y', strtotime($socio2->born_date))}}</div>
                                            </div>
                                        
                                            <div class="flex items-center content-center">
                                                        @if($socio2->direccion)
                                                            <div class="px-2 py-2 text-red-500 font-semibold content-center">
                                                            <i class="fa fa-map-marker my-auto py-auto" aria-hidden="true"></i>
                                                        </div>
                                                        
                                                            <div class="px-2 py-2">{{Str::limit($socio2->direccion->comuna.', '.$socio2->direccion->region,20)}}</div>
                                                        @endif
                                            </div>

                                            <div class="text-gray-700">
                                            
                                            
                                                <button x-on:click="open=false" x-show="open" class="bg-gray-100 block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-200 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">Información de Contácto</button>
                                                <button x-on:click="open=true" x-show="!open" class="bg-gray-100 block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-200 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">Resume</button>
                                            </div>

                                                @if($socio2->user->vendedor) 
                                                    @if($socio2->user->vendedor->estado==2) 
                                                        @if($socio2->fono) 
                                                            <div >
                                                                <a href="{{route('socio.store.show', $socio2)}}">
                                                                    <button class="bg-red-600 block w-full text-white text-sm font-semibold rounded-lg hover:bg-red-500 focus:outline-none focus:shadow-outline focus:bg-red-500 hover:shadow-xs p-3 my-4">TIENDA ONLINE</button>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endif
                                        

                                            
                                        </div>
                                    </div>

                                    <div class="grid md:grid-cols-2 text-sm">
                                                
                                                    
                                        <div x-show="!open">
                                            @if($socio2->fono)
                                                <div class="grid grid-cols-2">
                                                    <div class="px-4 py-2 font-semibold">Nro. Contacto</div>
                                                    
                                                    @can('Ver dashboard')
                                                        <a  href="https://api.whatsapp.com/send?phone=569{{substr(str_replace(' ', '', $socio2->fono), -8)}}&text=Hola" target="_blank">
                                                            <div class="px-4 py-2">{{ $socio2->fono }}</div>
                                                        </a> 
                                                    @endcan
                                                    

                                                </div>
                                            @endif
                                            
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Email.</div>
                                                <div class="px-4 py-2">
                                                    <a class="text-blue-800" href="mailto:jane@example.com">{{$socio2->user->email}}</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>



                                    
                                    
                                
                                        @livewire('socio.socio-auspiciadores',['socio' => $socio2], key('socio-auspiciadores.'.$socio2->slug))

                                        @can('Super admin')
                                            
                                        
                                            <div class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded-lg shadow-sm ">
                                               

                                                @livewire('socio.socio-donacion', ['socio' => $socio2], key($socio2->id))
                                          
                                            
                                                <div class="mt-6 hidden">
                                                    <div class="flex justify-between">
                                                    <span class="font-semibold text-[#191D23]">Receiving</span>
                                                    <div class="flex cursor-pointer items-center gap-x-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <div class="font-semibold text-green-700">Add recipient</div>
                                                    </div>
                                                    </div>
                                            
                                                    
                                                </div>
                                            
                                                <div class="mt-2 hidden">
                                                    <div class="w-full cursor-pointer rounded-xl bg-blue-800 px-3 py-3 text-center font-semibold text-white hidden">AUSPICIAR A {{Str::limit(strtoupper($socio2->name),10)}}</div>
                                                </div>
                                            </div>

                                        @endcan
                                        <ul
                                            class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm hidden">
                                            <li class="flex items-center py-3">
                                                <span>Suscripción</span>
                                                    @switch($socio2->status)
                                                            @case(1)
                                                                <span class="ml-auto"><span class="bg-green-500 py-1 px-2 rounded text-white text-sm">Vigente</span></span>
                                                                @break
                                                            @case(2)
                                                                <span class="ml-auto"><span class="bg-red-500 py-1 px-2 rounded text-white text-sm">INACTIVO</span></span>
                                                                @break
                                                            @default
                                                                
                                                    @endswitch
                                                    
                                            </li>
                                            {{-- comment
                                            @if($socio->suscripcions)
                                                @if($socio->suscripcions->count())
                                                
                                                    <li class="flex items-center py-3">
                                                        <span>Fecha Vencimiento</span>
                                                        <span class="ml-auto">{{date('d', strtotime($socio->suscripcions->first()->end_date)).' de '.$meses[date('n', strtotime($socio->suscripcions->first()->end_date))-1].' del '.date('Y', strtotime($socio->suscripcions->first()->end_date))}}</span>
                                                    </li>
                                                @endif
                                            @endif --}}
                                        </ul>
                                
                                    
                            </div>
                                <!-- End of profile card -->
                                <div class="my-4"></div>
                                <!-- Friends card -->
                                
                                <!-- End of friends card -->
                            </div>
                            <!-- Right Side -->
                            <div class="w-full md:w-9/12 mx-0 sm:mx-2">
                                <!-- Profile tab -->
                                <!-- About Section -->
                            

                                <!-- End of about section -->

                            

                                <!-- garage and movie -->
                                <div class="bg-white shadow-sm rounded-sm">

                                    <div class="grid grid-cols-1 sm:grid-cols-1">
                                        <div class="bg-white hover:shadow">
                                            <div class="items-center p-3 flex justify-between space-x-3 font-semibold text-gray-900 text-xl leading-8">
                                                
                                                <div>
                                                    <span class="text-red-500">
                                                        <i class="fas fa-car text-white-800"></i>
                                                    </span>
                                                    <span>Garage</span>
                                                </div>

                                                <div>
                                                                @can('perfil_propio', $socio2)
                                                                <a href="{{route('garage.vehiculo.create')}}"><span class="btn btn-success text-white font-bold text-sm align-middle">Inscribir Vehículo</span></a>
                                                                @endcan
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="grid grid-cols-1 p-1 md:grid-cols-4 gap-1"> 

                                                @if ($socio2->user->vehiculos)
                                                    
                                                @php
                                                    $n=0;
                                                @endphp

                                                    @foreach ($socio2->user->vehiculos as $vehiculo)
                                                        @if($vehiculo->status==5 || $vehiculo->status==6)
                                                            <div class="hidden md:block">
                                                            
                                                                <div class="text-center p-2 m-2 bg-main-color rounded-xl">
                                                                    <a href="{{route('garage.vehiculo.show', $vehiculo)}}" class="text-main-color">
                                                                        @if($vehiculo->image->first())
                                                                            <img class="h-44 w-42 object-cover" src="{{Storage::url($vehiculo->image->first()->url)}}" alt="">
                                                                        @else
                                                                            <img class="h-44 w-42 object-cover" src="https://www.greenmedical.cl/wp-content/uploads/2019/10/producto-sin-imagen.png" alt="">
                                                                        @endif   
                                                                    
                                                                        <a href="{{route('garage.vehiculo.show', $vehiculo)}}"> 
                                                                            <h1 class="text-white mt-1 font-bold text-md">{{$vehiculo->marca->name.' '.strtoupper($vehiculo->modelo).'-'.$vehiculo->cilindrada.'cc '.$vehiculo->año}}</h1>
                                                                        </a>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="block md:hidden">
                                                                    <x-vehiculo-card2 :vehiculo="$vehiculo" />    
                                                            </div>
                                                            @php
                                                                $n+=1;
                                                            @endphp
                                                        @endif
                                                    @endforeach

                                                @endif
                                                {{-- comment 
                                                
                                                    <div class="text-center my-2">
                                                        <img class="h-24 w-34 mx-auto"
                                                            src="https://www.canyon.com/on/demandware.static/-/Sites-canyon-master/default/dwb5b29ea2/images/full/full_2021_/2021/full_2021_sender-cfr_2251_tm_P5.png"
                                                            alt="">
                                                        <a href="#" class="text-main-color">Kojstantin</a>
                                                    </div>
                                                    <div class="text-center my-2">
                                                        <img class="h-26 w-36 mx-auto"
                                                            src="https://www.motofichas.com/images/phocagallery/Honda/crf250r-2022/02-honda-crf250r-2022-estudio.jpg"
                                                            alt="">
                                                        <a href="#" class="text-main-color">James</a>
                                                    </div>
                                                    <div class="text-center my-2">
                                                        <img class="h-26 w-36 mx-auto"
                                                            src="https://i.ytimg.com/vi/qmfxU0KMBBg/maxresdefault.jpg"
                                                            alt="">
                                                        <a href="#" class="text-main-color">Natie</a>
                                                    </div>
                                                --}}
                                            </div>
                                            @if ($n==0)
                                                <div class="max-w-3xl flex justify-center mb-6 mt-4">
                                                    <a href="{{route('garage.vehiculo.create')}}">
                                                        <div class="flex justify-between py-6 px-4 bg-gray-200 hover:bg-gray-300 rounded-lg mx-2">
                                                            <div class="flex items-center space-x-4">
                                                                <img src="{{asset('img/bike.png')}}" class="h-14 w-14" alt="">
                                                                <div class="flex flex-col space-y-1">
                                                                    <span class="font-bold">Incribe tu Primer Moto o Bicicleta</span>
                                                                    <span class="text-sm text-center">Es Gratis y obtendras una ficha online para registrar Mantenciones y Servicios, ademas si agregar el nro de Chasis en el registro al cabo de 96 horas aparecera el registro en Google 🔥</span>
                                                                </div>
                                                            </div>
                                                        
                                                        </div>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2">
                                        <div class="bg-white p-3 hover:shadow">
                                            <div class="ml-2 flex justify-between mb-2 items-center space-x-3 font-semibold text-gray-900 text-xl leading-8">
                                                <div>
                                                    <span class="text-red-500">
                                                        <i class="fas fa-film text-white-800"></i>
                                                    </span>
                                                    <span>Curriculum Deportivo</span>
                                                </div>
                                                <div>
                                                    
                                                        <a href="{{route('socio.resultados.create')}}" class="btn btn-success text-white font-bold text-sm align-middle">Agregar</a>
                                                     
                                                </div>    
                                            </div>

                                            <!-- This is an example component -->
                                           
                                          
                                            
                                                @livewire('socio.curriculum-deportivo',['socio' => $socio2], key('curriculum-deportivo'.$socio2->slug))

                                    
                                            <div class="grid grid-cols-4 gap-4 hidden">
                                            
                                                @if ($socio2->user->serie_enrolled)
                                                    
                                                
                                                    @foreach ($socio2->user->serie_enrolled as $serie)
                                                        <div class="text-center my-2">
                                                            <a href="{{route('series.show', $serie)}}" class="text-main-color">
                                                                <img class="h-16 w-20 mx-auto"
                                                                src="{{Storage::url($serie->image->url)}}"
                                                                alt="">
                                                            </a>
                                                        </div>
                                                    @endforeach

                                                @endif
                                                                    
                                            </div>
                                        </div>
                                        
                                        

                                    </div>
                                    <!-- End of Experience and education grid -->
                                </div>

                                <div class="my-4">
                                
                                <div class="bg-white pt-3 pb-12 shadow-sm rounded-sm">

                                    <div class="mb-12 grid grid-cols-1 sm:grid-cols-2">
                                    
                                        <div class="bg-white p-3 hover:shadow">
                                            <div class="items-center flex space-x-3 font-semibold text-gray-900 text-xl leading-8 mb-3">
                                                <span class="text-red-500">
                                                    <i class="fas fa-dumbbell text-white-800"></i>
                                                </span>
                                                <span>Entrenamientos</span>
                                                
                                                                
                                                                <a href="{{route('socio.entrenamiento',$socio2)}}"><span class="text-blue-600 font-bold text-sm ml-12 align-middle"> (Ver más)</span></a>
                                                            
                                                            
                                                
                                            </div>
                                            @php
                                                $salidas=0;
                                                $km=0;
                                                $time=0;
                                                $now = config('app.now_global');
                                                if ($socio2->user->activities->count()>0) {
                                                    foreach ($socio2->user->activities as $activitie) {
                                                        $salidas+=1;
                                                        $km+=floatval($activitie->distance);
                                                    }

                                                    $firstdate=strtotime($socio2->user->activities()->orderBy('start_date_local', 'asc')->first()->start_date_local);
                                                     // Calcula la diferencia en segundos entre las dos fechas
                                                     $difference2 = strtotime($now) - $firstdate;
                                                            // Convierte la diferencia de segundos a días
                                                    $tiempo_entrenando = floor($difference2 / (60 * 60 * 24));
                                                }else{
                                                    $tiempo_entrenando =0;
                                                }
                                            @endphp
                                           <div class="flex justify-between items-center mt-4 mb-6 rounded-lg shadow-lg p-3">
                                                <div>
                                                    <span class="mt-2 text-xl font-medium text-gray-800">{{$salidas}}</span>
                                                    <h4 class="text-gray-600 text-sm">Salidas</h4>
                                                </div>
                                                <div>
                                                    <span class="mt-2 text-xl font-medium text-gray-800">{{$km}}</span>
                                                    <h4 class="text-gray-600 text-sm">Kilómetros</h4>
                                                
                                                </div>
                                                <div>
                                                    <span class="mt-2 text-xl font-medium text-gray-800">{{$tiempo_entrenando}} Días</span>
                                                    <h4 class="text-gray-600 text-sm">Entrenando</h4>
                                                </div>
                                            
                                            </div>
                                            <ul class="list-inside space-y-2">
                                                @if ($socio2->user->activities)
                                                    @foreach ($socio2->user->activities()->orderBy('start_date_local', 'desc')->take(6)->get() as $activity)
                                                        @php
                                                           
                                                           
                                                            $date1 = strtotime($activity->start_date_local);
                                                            $date2 = strtotime($now);

                                                            // Calcula la diferencia en segundos entre las dos fechas
                                                            $difference = $date2 - $date1;
                                                            // Convierte la diferencia de segundos a días
                                                            $daysDifference = floor($difference / (60 * 60 * 24));

                                                            
                                                        
                                                        @endphp
                                                        <li>
                                                            <div class="flex items-center">
                                                                <span class="text-yellow-600">
                                                                    @if ($activity->type=='Ride'|| $activity->type=='VirtualRide')
                                                                        <i class="fas fa-bicycle text-white-800"></i>
                                                                        @elseif($activity->type=='Velomobile')
                                                                            <i class="fas fa-bicycle text-white-800"></i>
                                                                        @elseif($activity->type=='Run')
                                                                            <i class="fas fa-running"></i>
                                                                        @else
                                                                            <i class="fas fa-dumbbell text-white-800"></i>
                                                                        @endif
                                                                    
                                                                </span>
                                                                <div class="ml-4">
                                                                    <div class="text-teal-600"> 
                                                                        @if ($activity->type=='Ride' || $activity->type=='VirtualRide')
                                                                            {{ number_format($activity->distance)}}   km Bicicleta
                                                                        @elseif($activity->type=='Velomobile')
                                                                            {{ number_format($activity->distance)}}   km Velomobil
                                                                        @elseif($activity->type=='Run')
                                                                        {{ number_format($activity->moving_time/60,1,',','.')}} Minutos de Trote
                                                                        
                                                                        @else
                                                                            {{ number_format($activity->moving_time/60,1,',','.')}} Minutos  {{ $activity->type}}
                                                                        @endif
                                                                    </div>
                                                                    <div class="text-gray-500 text-xs">{{ number_format($activity->moving_time/60,1,',','.') .'Minutos - '.Str::limit($activity->start_date_local,10)}} (Hace {{$daysDifference}} Dias)</div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    
                                                    @endforeach
                                                @endif
                                        
                                            </ul>
                   
                                            <ul class="list-inside space-y-2 ml-2 hidden">
                                                <li>
                                                    <div class="flex items-center">
                                                        <span class="text-yellow-600">
                                                            <i class="fas fa-dumbbell text-white-800"></i>
                                                        </span>
                                                        <div class="ml-4">
                                                            <div class="text-teal-600">50 Min Pesas.</div>
                                                            <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="flex items-center">
                                                        <span class="text-yellow-600">
                                                            <i class="fas fa-bicycle text-white-800"></i>
                                                        </span>
                                                        <div class="ml-4">
                                                            <div class="text-teal-600">70km Bicicleta</div>
                                                            <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="flex items-center">
                                                        <span class="text-yellow-600">
                                                            <i class="fas fa-running"></i>
                                                        </span>
                                                        <div class="ml-4">
                                                            <div class="text-teal-600">10k running</div>
                                                            <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="flex items-center">
                                                        <span class="text-yellow-600">
                                                            <i class="fas fa-bicycle text-white-800"></i>
                                                        </span>
                                                        <div class="ml-4">
                                                            <div class="text-teal-600">70km Bicicleta</div>
                                                            <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        
                                        </div>

                                        <div class="bg-white p-3 hover:shadow">
                                            <div class="flex items-center space-x-3 font-semibold text-gray-900 text-xl leading-8">
                                                <span class="text-red-500">
                                                    <i class="fas fa-film text-white-800"></i>
                                                </span>
                                                <span>MovieCollection</span>
                                                
                                                <a href="{{route('series.index')}}"><span class="text-blue-600 font-bold text-sm ml-12 align-middle"> (Ver más)</span></a>
                                                            
                                            </div>
                                            <div class="grid grid-cols-4 gap-4">
                                            
                                                @if ($socio2->user->serie_enrolled)
                                                    
                                                
                                                    @foreach ($socio2->user->serie_enrolled as $serie)
                                                        <div class="text-center my-2">
                                                            <a href="{{route('series.show', $serie)}}" class="text-main-color">
                                                                <img class="h-16 w-20 mx-auto"
                                                                src="{{Storage::url($serie->image->url)}}"
                                                                alt="">
                                                            </a>
                                                        </div>
                                                    @endforeach

                                                @endif
                                                    {{-- 
                                                        <div class="text-center my-2">
                                                            <img class="h-16 w-16 rounded-full mx-auto"
                                                                src="https://widgetwhats.com/app/uploads/2019/11/free-profile-photo-whatsapp-4.png"
                                                                alt="">
                                                            <a href="#" class="text-main-color">James</a>
                                                        </div>
                                                        <div class="text-center my-2">
                                                            <img class="h-16 w-16 rounded-full mx-auto"
                                                                src="https://lavinephotography.com.au/wp-content/uploads/2017/01/PROFILE-Photography-112.jpg"
                                                                alt="">
                                                            <a href="#" class="text-main-color">Natie</a>
                                                        </div>
                                                        <div class="text-center my-2">
                                                            <img class="h-16 w-16 rounded-full mx-auto"
                                                                src="https://bucketeer-e05bbc84-baa3-437e-9518-adb32be77984.s3.amazonaws.com/public/images/f04b52da-12f2-449f-b90c-5e4d5e2b1469_361x361.png"
                                                                alt="">
                                                            <a href="#" class="text-main-color">Casey</a>
                                                        </div>
                                                    --}}
                                                    
                                            </div>
                                        </div>
                                       
                                    </div>
                                    
                                </div> 

                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        @else

            <x-jet-authentication-card>
                <x-slot name="logo">
                    <x-jet-authentication-card-logo />
                </x-slot>
        
                <x-jet-validation-errors class="mb-4" />
        
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="flex justify-center mt-4 ">

                    <a href="https://riderschilenos.cl/login-google">
                        <button class="flex btn bg-blue-500 text-white w-full max-w-xs items-center justify-items-center mr-2 mt-2"><svg class="mr-2 -ml-1 w-4 h-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512"><path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path></svg>Ingresar Con Google<div></div></button>
                    </a>
                
                </div>
        
                <form method="POST" action="{{ route('login') }}">
                    @csrf
        
                    <div>
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>
        
                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>
        
                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-jet-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Recordar mi cuenta') }}</span>
                        </label>
                    </div>
        
                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 mr-auto" href="{{ route('register') }}">
                            {{ __('Registrarme') }}
                            </a>
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('Recuperar contraseña') }}
                            </a>
                        @endif
        
                        <x-jet-button class="ml-4">
                            {{ __('Ingresar') }}
                        </x-jet-button>
                    </div>
                </form>
            </x-jet-authentication-card>

        @endif
    </div>
    
    <div :class="{'block': home, 'hidden': ! home}" class="hidden">


                {{--         <div id="default-carousel" class="hidden sm:block mx-auto relative max-w-7xl md:mt-16" data-carousel="static" style='z-index: 1 ; '>
                    <!-- Carousel wrapper -->
                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                        <!-- Item 1 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <span class="hidden absolute text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 sm:text-3xl dark:text-gray-800">First Slide</span>
                            <img src="{{asset('img/homeslider/carcasas-min.png')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div>
                        <!-- Item 2 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{asset('img/homeslider/polerones-min.png')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div>
                        <!-- Item 3 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{asset('img/homeslider/poleras-min.png')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div>
                        <!-- Item 4 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{asset('img/homeslider/tienda-min.png')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div>
                    </div>
                    <!-- Slider indicators -->
                    <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                        <button type="button" class="w-3 h-3 mb-4 rounded-full" aria-current="false" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                    </div>
                    <!-- Slider controls -->
                    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
       
                    <section class="hidden md:hidden mt-12 sm:mt-16">
                                

                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-x-6 gap-y-8">
                                <article>
                                    <figure>
                                        <a href=" https://riderschilenos.cl/catalogos/polerones.pdf"><img class="rounded-xl h-35 w-55 object-cover" src="{{asset('img/mobileslider/polerones-min.png')}}" alt=""></a>
                                    </figure>

                                
                                </article>
                                <article>
                                    <figure>
                                        <a href="{{route('catalogo.carcasas')}}"><img class="rounded-xl h-35 w-55 object-cover" src="{{asset('img/mobileslider/carcasas-min.png')}}" alt=""></a>
                                    </figure>
                                
                                </article>
                                <article>
                                    <figure>
                                        <a href="catalogos/catalogopolerasmx_compressed.pdf"><img class="rounded-xl h-35 w-55 object-cover" src="{{asset('img/mobileslider/poleras-min.png')}}" alt=""></a>
                                    </figure>
                                
                                </article>
                            
                            
                            </div>

                    </section>
                
                    <figure class="hidden pt-0 pb-4">

                    
                    
                            <ul class="slider snap-mandatory flex overflow-x-auto gap-0 snap-x before:shrink-0 before:w-[30vw] after:shrink-0 after:w-[30vw]" style='z-index: 1 ; '>
                                
                                <li class="hidden shrink-0 snap-center w-full snap-mandatory">       
                                    <a href="https://riderschilenos.cl/eventos/mariocross"><img class="" src="{{asset('img/home/mariocross.png')}}" alt="" style="scroll-snap-align: center;"></a>
                                </li>
                                <li class="hidden shrink-0 snap-center w-full snap-mandatory">       
                                    <a href="{{route('catalogo.carcasas')}}"><img class="" src="{{asset('img/mobileslider/carcasas-min.png')}}" alt="" style="scroll-snap-align: center;"></a>
                                </li>
                                <li class="hidden shrink-0 snap-center w-full snap-mandatory">       
                                    <a href="catalogos/catalogopolerasmx_compressed.pdf"><img class="" src="{{asset('img/mobileslider/poleras-min.png')}}" alt="" style="scroll-snap-align: center;"></a>
                                </li>        
                                <li class="hidden shrink-0 snap-center w-full snap-mandatory">       
                                    <a href="https://tienda.riderschilenos.cl"><img class="" src="{{asset('img/mobileslider/tienda-minc.jpg')}}" alt="" style="scroll-snap-align: center;"></a>
                                </li>
                            
                            </ul>

                            <a href="https://tienda.riderschilenos.cl"><img class="hidden" src="{{asset('img/mobileslider/tienda-minc.jpg')}}" alt="" style="scroll-snap-align: center;"></a>
                        

                    
                    </figure>

                    
                    <section class="bg-cover bg-center hidden sm:hidden" style="background-image: url({{asset('img/home/homefotomini.png')}})">

                        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-8 pt-64 pb-8">
                            
                                <h1 class="text-white font-fold text-4xl text-center">RidersChilenos</h1>
                                <p class="text-white text-lg mt-2 mb-4 text-center">Bienvenidos al Portal Rider Más Grande del País </p>
                                    <!-- component -->
                                    <!-- This is an example component -->
                            
                                
                            
                        </div>

                    </section>
                comment --}}

        <section class="sm:mt-8">
            <div class="">

                @if (auth()->user())
                    <div class="max-w-6xl mx-auto px-2 sm:px-6 mt-2 lg:px-8">
                        <div  class="mt-6 text-2xl mb-4 sm:text-xl mx-1 leading-none font-bold text-gray-900 flex justify-between">
                            <div>
                                <h1 class="text-xl mx-2 font-bold cursor-pointer flex items-center" @click="user = true; novedades=false; home = false; socio = false; evento = false; registro = false; vendedor = false; base = false" >Hola {{Auth()->user()->name}}</h1>
                                @if (auth()->user()->socio)
                                    <a href="{{route('socio.points',auth()->user()->socio)}}">
                                        <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            TIENES @livewire('socio.point-count', ['socio' => auth()->user()->socio]) PUNTOS
                                        </span>
                                    
                                     
                                    </a>
                                @else
                                    <a href="{{route('socio.create')}}">
                                        <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            REGISTRATE Y GANA 100 PUNTOS
                                        </span>
                                    </a>
                                @endif
                                
                            </div>
                            <div class="grid grid-cols-1 justify-end text-center">
                                <a href="{{route('ticket.historial.view',auth()->user())}}">
                                    <button class="relative bg-white px-3 font-bold py-2 rounded-lg text-sm uppercase tracking-tight overflow-visible w-full md:w-32">
                                        <div class="flex justify-center mx-2">   <img src="{{asset('img/ticket.png')}}" class="w-6 mr-2 py-1"> 
                                        Tickets </div>
                                        <div class="absolute -top-2 -right-2 px-2.5 py-0.5 bg-red-500 rounded-full text-xs text-white">
                                           {{auth()->user()->tickets->where('status','=',3)->count()}}
                                        </div>
                                    </button>
                                </a>
                                @if(auth()->user()->vendedor) 
                                    @if(auth()->user()->vendedor->estado==2)
                                        <a href="{{route('vendedor.pedidos.create')}}">
                                            <button class="btn btn-success mt-2 text-center text-base whitespace-nowrap">Nuevo Pedido</button>
                                        </a>
                                        
                                    @endif
                                @endif
                                @if(auth()->user()->tickets || auth()->user()->vendedor) 
                                     @if(auth()->user()->vendedor)
                                        @if(auth()->user()->vendedor->estado==2)
                                            <a href="{{route('organizador.tickets.create')}}">
                                                <button class="btn btn-success mt-2 text-center text-base whitespace-nowrap">Nuevo Ticket</button>
                                            </a>
                                        @endif
                                    @elseif(auth()->user()->tickets) 
                                            @foreach (auth()->user()->tickets as $ticket)
                                                @if ($ticket->evento->type=='sorteo' && $ticket->status>=3)
                                                    <a href="{{route('organizador.tickets.create')}}">
                                                        <button class="btn btn-success mt-2 text-center text-base whitespace-nowrap">Nuevo Ticket</button>
                                                    </a>
                                                    @break
                                                @endif
                                            @endforeach   
                                       
                                    @endif 
                                @endif
                               
                            </div>
                        </div>
                    </div>

                   
                        @if (auth()->user()->socio)
                
                            @if (auth()->user()->vehiculos->count())
                                
                            @else
                
                                <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-8 my-4 @routeIs('garage.vehiculo.create') hidden @endif">
                                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                                    <strong class="font-bold">Falta poco!</strong>
                                    <span class="block sm:inline">Ahora puedes registrar tu moto o bicicleta, esto te permitira registrar sus servicios y mantenciones, entre otras cosas.</span>
                                    <a href="{{route('garage.vehiculo.create')}}">
                                        <button class="bg-green-600 block w-full text-white text-sm font-semibold rounded-lg hover:bg-green-400 focus:outline-none focus:shadow-outline focus:bg-green-400 hover:shadow-xs p-3 my-4">Registrar</button>
                                    </a>                                                
                                </div>
                                </div>
                
                
                                
                            @endif
                
                
                
                        @else
                
                            <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-8 my-4 @routeIs('socio.create') hidden @endif">
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                                    <p class="font-bold text-center">¡Bienvenido!</p>
                                    <span class="block sm:inline">Ahora puedes crear el perfil de Rider que te servira para enlazar tu perfil de Strava, registrar tu moto o bicicleta, registrar tus logros deportivos, contratar cursos o clases, entre otras cosas.</span>
                                    <a href="{{route('socio.create')}}">
                                        <button class="bg-green-500 block w-full text-white text-sm font-semibold rounded-lg hover:bg-green-700 focus:outline-none focus:shadow-outline focus:bg-gray-500 hover:shadow-xs p-3 my-4">CREAR PERFIL</button>
                                    </a>                                                
                                </div>
                            </div>
                            
                        @endif
                    
              

                        <div class="pb-2 max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-x-2 gap-y-2">
                                    
                                    @can('perfil_propio', auth()->user()->socio)
                                        @if (auth()->user()->AtletaStrava)
                                    
                                                
                                              @livewire('socio.strava-lugar-personal')
                                              
                                        
                                        @else
                                                <div class="bg-white p-6 rounded shadow-md">
                                                    <h2 class="text-lg font-semibold mb-2">Enlazar perfil de Strava</h2>
                                                    <div class="my-2">
                                                        <img src="{{asset('img/devstrava.png')}}" alt="Logo de Strava" class="object-cover h-14">
                                                    </div>
                                                   <p class="text-gray-600">Conecta tu cuenta de Strava para acceder a tus actividades y saber la distancia que haz recorrido.</p>
                                                    <div class="flex justify-center">
                                                <a href="https://www.strava.com/oauth/authorize?client_id=112140&response_type=code&redirect_uri=https://riderschilenos.cl/redireccion-strava&scope=profile:read_all,activity:read_all">
                                                    <img src="{{asset('img/btn_strava.png')}}" alt="Logo de Strava" class="object-cover h-10">
                                                </a>
                                            </div>
                                                    
                                                    <p class="mt-4 text-sm text-gray-500">
                                                        Al hacer clic en "Enlazar con Strava", serás redirigido a Strava para autorizar la conexión.
                                                    </p>
                                                </div>
                                        @endif
                                    @endcan
                                    @if (auth()->user()->tickets->where('status',3)->first())
                                        <div class="flex justify-center items-center my-auto order-2 md:order-1">
                                            <div>
                                                <h1 class="text-center">Desafío ft Strava Activo <div class="h-2 w-2 rounded-full"></div></h1>
                                                @if (auth()->user()->AtletaStrava)
                                                
                                                    @livewire('admin.strava-count', ['ticket' => auth()->user()->tickets->where('status',3)->first()], key(auth()->user()->tickets->where('type','desafio')->where('status',3)->first()->id))
                                            
                                                @else
                                                    
                                                    
                
                                                    <div class="bg-white p-6 rounded shadow-md">
                                                        <h2 class="text-lg font-semibold mb-2">Enlazar perfil de Strava</h2>
                                                        <div class="my-2">
                                                            <img src="{{asset('img/devstrava.png')}}" alt="Logo de Strava" class="object-cover h-14">
                                                        </div>
                                                        <p class="text-gray-600">Conecta tu cuenta de Strava para acceder a tus actividades y saber la distancia que haz recorrido.</p>
                                                        <div class="flex justify-center">
                                                            <a href="https://www.strava.com/oauth/authorize?client_id=112140&response_type=code&redirect_uri=https://riderschilenos.cl/redireccion-strava&scope=profile:read_all,activity:read_all">
                                                                <img src="{{asset('img/btn_strava.png')}}" alt="Logo de Strava" class="object-cover h-10">
                                                            </a>
                                                        </div>
                                                        
                                                        <p class="mt-4 text-sm text-gray-500">
                                                            Al hacer clic en "Enlazar con Strava", serás redirigido a Strava para autorizar la conexión.
                                                        </p>
                                                    </div>
                                                @endif  
                                            </div>     
                                        </div>
                                    @endif
                                    
                                    
                                    

                           

                        </div>

                        <div class="pb-2 max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-x-2 gap-y-2">
                                
                            @if (auth()->user()->socio)
                                <div class=" font-sans flex justify-center">
                              
                                    <div class="w-full mx-auto">
                                        <a href="{{route('socio.create')}}">
                                            <div class="transition-all duration-300 bg-white hover:bg-gray-100 cursor-pointer rounded-lg shadow-md border-b-4 border-blue-600 p-6 flex justify-center items-center">
                                                        
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                </svg>
                                                  
                                                
                                                <h1 class="text-center ml-2">Mis Datos</h1>
                                            </div>
                                        </a>
                                    </div>
                              
                                </div>
                            @endif
                            @if (auth()->user())
                            <div>
                                @if(auth()->user()->vendedor) 
                                    @if(auth()->user()->vendedor->estado==2)
                                        
                                        <div class=" font-sans flex justify-center mb-2">
                                
                                            <div class="w-full mx-auto">
                                                <a href="{{route('vendedores.index')}}">
                                                    <div class="transition-all duration-300 bg-white hover:bg-gray-100 cursor-pointer rounded-lg shadow-md border-b-4 border-blue-600 p-6 flex justify-center items-center">
                                                                
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                        </svg>
                                                        
                                                        
                                                        <h1 class="text-center ml-2">Mis Ventas</h1>
                                                    </div>
                                                </a>
                                            </div>
                                    
                                        </div>
                                        
                                    @endif
                                @endif
                                @if (auth()->user()->tiendas)
                                   
                                        @foreach (auth()->user()->tiendas as $tienda)
                                        
                                    

                                            <div class=" font-sans flex justify-center mb-2">
                                            
                                                <div class="w-full mx-auto">
                                                    <a href="{{route('tiendas.edit',$tienda)}}">
                                                        <div class="transition-all duration-300 bg-white hover:bg-gray-100 cursor-pointer rounded-lg shadow-md border-b-4 border-blue-600 p-6 flex justify-center items-center">
                                                                    
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                                                            </svg>
                                                            
                                                            
                                                            <h1 class="text-center ml-2">{{strtoupper(Str::limit($tienda->nombre,14))}}</h1>
                                                        </div>
                                                    </a>
                                                </div>
                                        
                                            </div>
                                        @endforeach
                                   
                                @endif
                            </div>    
                            @endif
                            @can('Super admin')
                                
                                <div>
                                    <div class="  font-sans flex justify-center mb-2">
                                
                                        <div class="w-full mx-auto">
                                            <a href="{{route('admin.disenos.index')}}">
                                                <div class="transition-all duration-300 bg-white hover:bg-gray-100 cursor-pointer rounded-lg shadow-md border-b-4 border-blue-600 p-6 flex justify-center items-center">
                                                            
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                                    </svg>
                                                    
                                                    <h1 class="text-center ml-2">Diseños</h1>
                                                </div>
                                            </a>
                                        </div>
                                
                                    </div>
                                    <div class="  font-sans flex justify-center mb-2">
                                
                                        <div class="w-full mx-auto">
                                            <a href="{{route('admin.disenos.produccion')}}">
                                                <div class="transition-all duration-300 bg-white hover:bg-gray-100 cursor-pointer rounded-lg shadow-md border-b-4 border-blue-600 p-6 flex justify-center items-center">
                                                            
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                                    </svg>
                                                    
                                                    <h1 class="text-center ml-2">Producción</h1>
                                                </div>
                                            </a>
                                        </div>
                                
                                    </div>
                                    <div class="  font-sans flex justify-center mb-2">
                                
                                        <div class="w-full mx-auto">
                                            <a href="{{route('admin.disenos.despacho')}}">
                                                <div class="transition-all duration-300 bg-white hover:bg-gray-100 cursor-pointer rounded-lg shadow-md border-b-4 border-blue-600 p-6 flex justify-center items-center">
                                                            
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                                    </svg>
                                                    
                                                    <h1 class="text-center ml-2">Despacho</h1>
                                                </div>
                                            </a>
                                        </div>
                                
                                    </div>
                                </div>

                                <div >
                                    <div class="font-sans flex justify-center">
                                
                                        <div class="w-full mx-auto">
                                            <a href="https://riderschilenos.cl/organizador/admin/evento/sorteo-moto-yamaha-ttr110-2019/inscritos">
                                                <div class="transition-all duration-300 bg-white hover:bg-gray-100 cursor-pointer rounded-lg shadow-md border-b-4 border-blue-600 p-6 flex justify-center items-center">
                                                            
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                                    </svg>
                                                    
                                                    <h1 class="text-center ml-2">Sorteo</h1>
                                                </div>
                                            </a>
                                        </div>
                                
                                    </div>
                                    <div class="font-sans flex justify-center mt-2">
                                
                                        <div class="w-full mx-auto">
                                            <a href="https://riderschilenos.cl/organizador/admin/evento/desaf-o-riderschilenos-ft-strava/inscritos">
                                                <div class="transition-all duration-300 bg-white hover:bg-gray-100 cursor-pointer rounded-lg shadow-md border-b-4 border-blue-600 p-6 flex justify-center items-center">
                                                            
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                                    </svg>
                                                    
                                                    <h1 class="text-center ml-2">Desafio</h1>
                                                </div>
                                            </a>
                                        </div>
                                
                                    </div>
                                    <div class="font-sans flex justify-center mt-2">
                                
                                        <div class="w-full mx-auto">
                                            <a href="{{ route('organizador.eventos.index') }}">
                                                <div class="transition-all duration-300 bg-white hover:bg-gray-100 cursor-pointer rounded-lg shadow-md border-b-4 border-blue-600 p-6 flex justify-center items-center">
                                                            
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                                    </svg>
                                                    
                                                    <h1 class="text-center ml-2">AdminEventos</h1>
                                                </div>
                                            </a>
                                        </div>
                                
                                    </div>
                                    <div class="font-sans flex justify-center mt-2">
                                
                                        <div class="w-full mx-auto">
                                            <a href="{{ route('vendedor.tiendas.index') }}">
                                                <div class="transition-all duration-300 bg-white hover:bg-gray-100 cursor-pointer rounded-lg shadow-md border-b-4 border-blue-600 p-6 flex justify-center items-center">
                                                            
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                                    </svg>
                                                    
                                                    <h1 class="text-center ml-2">AdminTiendas</h1>
                                                </div>
                                            </a>
                                        </div>
                                
                                    </div>
                                
                                </div>

                            @endcan

                           
                        </div>
                   
                        
                    {{-- commen
                        <div class="max-w-4xl mx-auto px-2 sm:px-6 mt-2 lg:px-8">
                            @livewire('pistas.admin-pista-home')
                        </div>

                         t --}}
                
                     
                        
                @else
                   {{-- comment 
                    <a class="hidden" href="https://riderschilenos.cl/eventos/mariocross">
                        <img class="h-full w-full object-cover object-center mt-4" src="{{asset('img/home/mariocross2.png')}}" alt="">
                    </a>
                    --}}
                    <div class="flex justify-center max-w-7xl mx-auto">
                        <div class="grid grid-cols-5 mx-auto">
                            <div class="col-span-5 sm:col-span-2 flex justify-center ">
                                <div class="  bg-white mx-auto px-6 pt-2 mb-4 mt-6 shadow-lg rounded-xl">

                                    <div class="photo-wrapper flex justify-center mt-2">
                                            <img loading="lazy" class="cursor-pointer h-44 w-44 object-cover rounded-md mx-auto" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="">
                                    </div>
                                    <h1 class="text-center my-2 font-bold">¡Hola!</h1>
                                    <h1 class="text-center my-2 font-bold">Bienvenidos a Riders Chilenos</h1>
                                    <h1 class="text-center my-2 text-md">Ingresa a tu Perfil Online</h1>

                                    <div class="flex justify-center mt-2 ">

                                        <a href="https://riderschilenos.cl/login-google">
                                            <button class="flex btn bg-blue-500 text-white w-full items-center justify-items-center mr-2 mt-2"><svg class="mr-2 -ml-1 w-4 h-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512"><path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path></svg>Ingresar Con Google<div></div></button>
                                        </a>
                                    
                                    </div>
                                    <div class="flex justify-center mt-2 mb-6">

                                        <a href="{{route('register')}}">
                                            <button class="btn btn-danger w-full max-w-xs items-center justify-items-center mr-2 mt-2">REGISTRO</button>
                                        </a>
                                        <a href="{{route('login')}}">
                                            <button class="btn btn-danger w-full max-w-xs items-center justify-items-center ml-2 mt-2">INICIAR SESION</button>
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <div class="col-span-5 sm:col-span-3 flex justify-center items-center">
                                <div class="px-4 py-2 bg-white">
                                    <a href="{{route('socio.ranking.strava')}}">
                                        @livewire('socio.strava-count-total')
                                    </a>
                                    <div class="w-full mx-auto px-2 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-x-6 gap-y-8 mb-6 mt-2">
                            
                                                    
                                            
                                        <article>

                                            <figure>
                                                <a href="{{route('socio.create')}}"><img class="rounded-xl h-35 w-55 object-cover" src="{{asset('img/home/registroriders.png')}}" alt=""></a>
                                            </figure>
                        
                                        
                                        </article>
                        
                                    
                                </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    @if (IS_NULL(auth()->user()))
                                <div class="hidden mt-2 mb-6 flex justify-center">
                                    <div class=" max-w-6xl px-2 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-y-4 gap-x-4 mx-4">
                    
                                      

                                            
                                            <article class=" grid grid-cols-6 shadow-lg rounded-lg bg-main-color">
                            
                                                <div class="col-span-2 items-center content-center my-auto px-2 py-2">
                                                 
                                                        <a href="https://riderschilenos.cl/eventos/desaf-o-riderschilenos-ft-strava"><h1 class="text-white text-base mb-2 font-bold">Desafío RidersChilenos ft Strava.</h1>
                                                 
                                                       
                                                                    <a href="https://riderschilenos.cl/eventos/desaf-o-riderschilenos-ft-strava"><img class="w-full h-32 object-contain my-auto content-center items-center" src="https://riderschilenos.cl/storage/eventos/0Mmi3RMQAE9622586C-A3CD-4C0E-801F-6FFC54BC1000.jpeg" alt=""></a>
                                                              
                                                     
                                                </div>
                                                    <div class="px-2 py-2 col-span-4 bg-white">
                                                        <a href="https://riderschilenos.cl/eventos/desaf-o-riderschilenos-ft-strava">
                                                                    <p class="text-gray-500 text-sm mt-auto">Disciplina:Full Rider</p> 
                                                                    <p class="text-gray-500 text-sm mb-2">Organizador: RidersChilenos</p>
                                                                 
                            
                                                                    </a>
                            
                                                                   
                                                        
                                                               
                                                                   
                                                                         
                                                                                <p class="text-center text-gray-500 text-sm mb-1 mt-2">Inscripcion</p>
                                                                                
                                                                                <a href= "https://riderschilenos.cl/eventos/desaf-o-riderschilenos-ft-strava" class="btn bg-gray-300 btn-block">
                                                                                    ${{number_format(10000)}}
                                                                                </a>
                            
                                                                 
                                                                        <a href="https://riderschilenos.cl/eventos/desaf-o-riderschilenos-ft-strava">
                                                                            <div class="flex mt-2">
                                                                                <p class="text-gray-500 text-md ">Riders Inscritos</p>
                                                                                <p class="text-sm text-gray-500 ml-auto"> 
                                                                                    <i class="fas fa-users"></i>
                                                                                   3
                                                                                </p>
                                                                            </div>
                                                                        </a>
                            
                                                                        <ul class="grid grid-cols-1 lg:grid-cols-1 gap-x-4 gap-y-2 mt-4">
                                                                           
                                                                    
                                                                                <li class="text-center">
                                                                                    <div class=" bg-red-600 text-white py-2 rounded-lg">
                                                                                       
                                                                                        <a href="https://riderschilenos.cl/eventos/desaf-o-riderschilenos-ft-strava">
                                                                                          
                                                                                                <p class="text-base leading-none dark:text-white"> Etapa 15km </p>
                                                                                         
                                                                                        </a>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="text-center">
                                                                                    <div class=" bg-red-600 text-white py-2 rounded-lg">
                                                                                        <a href="https://riderschilenos.cl/eventos/desaf-o-riderschilenos-ft-strava" >
                                                                                          
                                                                                            <p class="text-base leading-none dark:text-white"> Etapa 30km </p>
                                                                                     
                                                                                        </a>
                                                                                    </div>
                                                                                </li>
                                                                            
                                                                            
      
                                                                           
                                                                    </ul>
                            
                            
                            
                                                            
                                                    </div>
                            
                                            </article>

                                    </div>

                                </div>
          
                            <div class="hidden max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-x-6 gap-y-8 mb-6 mt-2">
                         
                                                
                                        
                                    <article>

                                        <figure>
                                            <a href="{{route('socio.create')}}"><img class="rounded-xl h-35 w-55 object-cover" src="{{asset('img/home/registroriders.png')}}" alt=""></a>
                                        </figure>
                    
                                    
                                    </article>
                    
                                
                            </div>
                    @endif
            
                   

                  

                @endif

            </div>
           
       
            <div class="bg-main-color flex justify-center pb-4 pt-6 z-10 hidden"> 
                <div class="">
                    @livewire('search')
                </div>
            </div>

            <div class="bg-main-color flex justify-center pb-4 pt-6 z-10"> 
           
              
                
                <div class="pb-2 bg-main-color max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-x-2 gap-y-2">
                    <article>
                        <figure>
                            <a href="{{route('socio.index')}}"><img class="rounded-xl h-35 w-55 object-cover" src="{{asset('img/home/RIDERS-min.png')}}" alt=""></a>
                        </figure>

                    
                    </article>
                    <article>
                        <figure>
                            <a href="{{route('garage.vehiculos.registerindex')}}"><img class="rounded-xl h-35 w-55 object-cover" src="{{asset('img/home/REGISTRO2-min.png')}}" alt=""></a>
                        </figure>
                    
                    </article>
                    <article>
                        <figure>
                            <a href="{{route('garage.usados')}}"><img class="rounded-xl h-35 w-55 object-cover" src="{{asset('img/home/USADOS2-min.png')}}" alt=""></a>
                        </figure>
                    
                    </article>
                    <article>
                        <figure>
                            <a href="{{route('series.index')}}"><img class="rounded-xl h-35 w-55 object-cover" src="{{asset('img/home/VIDEO-min.png')}}" alt=""></a>
                        </figure>
                        
                    </article>
                
                </div>

            </div>
        </section>
        
        <section class="bg-rider-color pb-12 pt-2">
            <h1 class="text-center text-white text-3xl my-4">Registro Nacional de Riders</h1>
            @livewire('socio.socios-count')

            <p class="text-center text-white pt-4 px-4 font-bold">¡Disfruta del Portal Rider Más Completo de Chile!</p>
            

            <div class="max-w-7xl mx-auto px-4 pt-10 sm:px-6 mb-4 lg:px-8 grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-4 gap-y-4">

                @foreach ($riders as $rider)

                    <x-socio-card :socio="$rider" />
                    
                @endforeach

            </div>

            <div class="flex justify-center mt-4 pt-4 hidden">
                <a href="{{route('socio.create')}}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ">
                    Crear Perfil Rider
                </a>
            </div>
            <div class="flex justify-center mt-2 pt-2 hidden">
                <a href="{{route('socio.index')}}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ">
                    Ver Todos
                </a>
            </div>
        
        </section>

        <h1 class="text-center text-3xl  pt-8">¿Buscas Panoramas?</h1>
        <p class="text-center  text-sm pb-4">Lo tenemos para ti</p>

        @livewire('pistas-home')

        <section class="mt-4 bg-rider-color pt-6 pb-50">
            <h1 class="text-center text-3xl text-white">Ultimos Videos y Carreras</h1>
            <p class="text-center text-white text-sm pb-6">Compra y apoya las producciones nacionales</p>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-8">

                @foreach ($series as $peli)

                    <x-serie-card :serie="$peli" />
                    
                @endforeach

            </div>
            <h1 class="text-center text-xs text-white py-12">Todos Los derechos Reservados</h1>
        </section>

        <section class="my-4  pb-12">
            <h1 class="text-center text-3xl text-gray-600 font-bold mt-2">Registro Riders Chilenos</h1>
            <p class="text-center text-gray-500 text-sm">Bicicletas, Motos y Otros.</p>
            <div class="flex justify-center my-2">
                <div class="grid grid-cols-2 gap-2">
                <a href="{{route('garage.vehiculo.create')}}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-center">
                    Publicar
                </a>
                <a href="{{route('garage.vehiculos.registerindex')}}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ">
                    Ver todos
                </a>

                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 mt-2 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-x-6 gap-y-8">

                @foreach ($autos as $auto)

                    <x-vehiculo-card :vehiculo="$auto" />
                    
                @endforeach

            </div>

          
                
        
        </section>

       @livewire('footer')

       
    </div>

    <div :class="{'block': socio, 'hidden': ! socio}" class="hidden">
        
        <div class="max-w-7xl mx-auto pb-8">

            <div class="card">
                
                    
    
                   

                <div  class="hidden mt-4 text-2xl mb-4 sm:text-xl mx-4 leading-none font-bold text-gray-900 flex justify-between">
                    <div class="flex justify-center">
                       
                        <button class="btn btn-success ml-6 text-center text-sm " @click="user = false; home = false; socio = true; evento = false; registro = false; vendedor = false; base = false" >RIDERS</button>
                               
                    </div>
                    <div class="flex justify-center">
                       
                        <button class="btn btn-danger ml-6 text-center text-sm" @click="evento = true; user = false; home = false; socio = false; registro = false; vendedor = false; base = false" >EVENTOS</button>
                               
                    </div>
                    <div class="flex justify-center">
                      
                                
                                    <button class="btn btn-danger mr-6 text-center text-sm" @click="user = false; home = false; socio = false; evento = false; registro = true; vendedor = false; base = false" >BIKES</button>
                               
                    </div>
                </div>
                    <div class="words sm:hidden bg-white pt-2 overflow-x-auto whitespace-no-wrap border-b-2 font-bold text-gray-700">
                        <div class="ml-4 pl-2 flex justify-center">
                            <div class="px-4 py-2 cursor-pointer underline text-gray-900" @click="user = false; home = false; socio = true; evento = false; registro = false; vendedor = false; base = false" >Riders</div>
                            <div class="px-4 py-2 cursor-pointer hover:underline" @click="evento = true; user = false; home = false; socio = false; registro = false; vendedor = false; base = false" >Eventos</div>
                            <div class="px-4 py-2 cursor-pointer hover:underline" @click="user = false; home = false; socio = false; evento = false; registro = true; vendedor = false; base = false" >Bikes</div>
                            <div class="px-4 py-2 cursor-pointer hover:underline" @click="user = false; novedades = true; home = false; socio = false; evento = false; registro = false; vendedor = false; base = false" >Novedades</div>
                            <div class="px-4 py-2 cursor-pointer hover:underline text-gray-900" @click="user = false; home = false; video = true; socio = false; evento = false; registro = false; vendedor = false; base = false" >Videos</div>
                        
                        <!-- Agrega más categorías aquí -->
                        </div>
                    </div>

                <div>

                </div>

    
            
    
                    @livewire('socio.socio-search',['type'=>'search'])
                    
                
            </div>
    
        </div>  

    </div>

    <div :class="{'block': evento, 'hidden': ! evento}" class="hidden">
        
        <div class="max-w-7xl mx-auto pb-8">

            <div class="card">
                
                    
    
                   

                <div  class="hidden mt-4 text-2xl mb-4 sm:text-xl mx-4 leading-none font-bold text-gray-900 flex justify-between">
                    <div class="flex justify-center">
                       
                        <button class="btn btn-danger ml-6 text-center text-sm" @click="user = false; home = false; socio = true; evento = false; registro = false; vendedor = false; base = false" >RIDERS</button>
                               
                    </div>
                    <div class="flex justify-center">
                       
                        <button class="btn btn-success ml-6 text-center text-sm" @click="evento = true; user = false; home = false; socio = false; registro = false; vendedor = false; base = false" >EVENTOS</button>
                               
                    </div>
                    <div class="flex justify-center">
                      
                                
                                    <button class="btn btn-danger mr-6 text-center text-sm" @click="user = false; home = false; socio = false; evento = false; registro = true; vendedor = false; base = false" >BIKES</button>
                               
                    </div>
                </div>
                <div class="words sm:hidden bg-white pt-2 overflow-x-auto whitespace-no-wrap border-b-2 font-bold text-gray-700">
                    <div class="ml-4 pl-2 flex justify-center">
                        <div class="px-4 py-2 cursor-pointer hover:underline" @click="user = false; home = false; socio = true; evento = false; registro = false; vendedor = false; base = false" >Riders</div>
                        <div class="px-4 py-2 cursor-pointer underline text-gray-900" @click="evento = true; user = false; home = false; socio = false; registro = false; vendedor = false; base = false" >Eventos</div>
                        <div class="px-4 py-2 cursor-pointer hover:underline" @click="user = false; home = false; socio = false; evento = false; registro = true; vendedor = false; base = false" >Bikes</div>
                        <div class="px-4 py-2 cursor-pointer hover:underline" @click="user = false; novedades = true; home = false; socio = false; evento = false; registro = false; vendedor = false; base = false" >Novedades</div>
                        <div class="px-4 py-2 cursor-pointer hover:underline text-gray-900" @click="user = false; home = false; video = true; socio = false; evento = false; registro = false; vendedor = false; base = false" >Videos</div>
                        
                      <!-- Agrega más categorías aquí -->
                    </div>
                  </div>
    
                <div>
                    <h1 class="text-center font-bold mt-4 text-2xl mb-2">¿Cual es tu Próximo Desafío?</h1>
                </div>

                <div class="hidden">
                    <div class="flex justify-center ">

                        
                            @if(auth()->user())
                                @if(auth()->user()->socio)
                                    <a href="{{ route('socio.show', auth()->user()->socio)}}">
                                        <button class="font-bold py-2 px-4 rounded bg-blue-500 text-white w-full max-w-xs items-center justify-items-center ">Mi Perfil</button>
                                    </a>
                                @else
                                    <a href="{{route('socio.create')}}">
                                        <button class="btn btn-success w-full max-w-xs items-center justify-items-center">Crear Perfil Rider</button>
                                    </a>
                                @endif
                            @else
                                <a href="{{route('socio.create')}}">
                                    <button class="btn btn-success w-full max-w-xs items-center justify-items-center">Crear Perfil Rider</button>
                                </a>
                            @endif    
                        

                    </div>
                </div>
    
                @livewire('eventos-index')
                    
                
            </div>
    
        </div>  

    </div>

    <div :class="{'block': registro, 'hidden': ! registro}" class="hidden">
     

        <div class="max-w-7xl mx-auto pb-8 ">      
            <div class="card">
                <div  class="hidden mt-4 text-2xl mb-2 sm:text-xl mx-4 leading-none font-bold text-gray-900 flex justify-between">
                    <div class="flex justify-center">
                       
                        <button class="btn btn-danger ml-6 text-center text-sm" @click="user = false; home = false; socio = true; evento = false; registro = false; vendedor = false; base = false" >RIDERS</button>
                               
                    </div>
                    <div class="flex justify-center">
                       
                        <button class="btn btn-danger ml-6 text-center text-sm" @click="evento = true; user = false; home = false; socio = false; registro = false; vendedor = false; base = false" >EVENTOS</button>
                               
                    </div>
                    <div class="flex justify-center">
                      
                                
                                    <button class="btn btn-success mr-6 text-center text-sm" @click="user = false; home = false; socio = false; evento = false; registro = true; vendedor = false; base = false" >BIKES</button>
                               
                    </div>
                </div>
                <div class="words sm:hidden bg-white pt-2 overflow-x-auto whitespace-no-wrap border-b-2 font-bold text-gray-700">
                    <div class="ml-4 pl-2 flex justify-center">
                        <div class="px-4 py-2 cursor-pointer hover:underline" @click="user = false; home = false; socio = true; evento = false; registro = false; vendedor = false; base = false" >Riders</div>
                        <div class="px-4 py-2 cursor-pointer hover:underline" @click="evento = true; user = false; home = false; socio = false; registro = false; vendedor = false; base = false" >Eventos</div>
                        <div class="px-4 py-2 cursor-pointer underline text-gray-900" @click="user = false; home = false; socio = false; evento = false; registro = true; vendedor = false; base = false" >Bikes</div>
                        <div class="px-4 py-2 cursor-pointer hover:underline" @click="user = false; novedades = true; home = false; socio = false; evento = false; registro = false; vendedor = false; base = false" >Novedades</div>
                        <div class="px-4 py-2 cursor-pointer hover:underline text-gray-900" @click="user = false; home = false; video = true; socio = false; evento = false; registro = false; vendedor = false; base = false" >Videos</div>
                        
                      <!-- Agrega más categorías aquí -->
                    </div>
                  </div>
            </div>  
                <div class="pb-4">
                    
                    
                        

                         

                    
                        
                    @livewire('vehiculo.vehiculo-search',['type'=>'search'])
                
                </div>
          

        </div>

        <x-slot name="js">
            <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
            <script src="{{asset('js/filmmaker/series/form.js')}}"></script>
        </x-slot>
    </div>

    <div :class="{'block': vendedor, 'hidden': ! vendedor}" class="hidden">
        
            <div class="max-w-7xl mx-auto pt-2 pb-8">
        
                        
                      @livewire('vendedor.public-show',['tienda_id'=>"NULL"])
                 
                
            </div>
        
       @livewire('footer')

    </div>

    <div :class="{'block': video, 'hidden': ! video}" class="hidden">
        <div class="words sm:hidden bg-white pt-2 overflow-x-auto whitespace-no-wrap border-b-2 font-bold text-gray-700">
            <div class="ml-4 pl-2 flex justify-center">
                <div class="px-4 py-2 cursor-pointer hover:underline text-gray-900" @click="user = false; home = false; socio = true; evento = false; registro = false; vendedor = false; video = false; base = false" >Riders</div>
                <div class="px-4 py-2 cursor-pointer hover:underline" @click="evento = true; user = false; home = false; socio = false; registro = false; vendedor = false; video = false; base = false" >Eventos</div>
                <div class="px-4 py-2 cursor-pointer hover:underline" @click="user = false; home = false; socio = false; evento = false; registro = true; vendedor = false; video = false; base = false" >Bikes</div>
                <div class="px-4 py-2 cursor-pointer hover:underline" @click="user = false; novedades = true; home = false; socio = false; evento = false; registro = false; vendedor = false; video = false; base = false" >Novedades</div>
                <div class="px-4 py-2 cursor-pointer underline text-gray-900" @click="user = false; home = false; socio = false; video = true; evento = false; registro = false; vendedor = false; base = false" >Videos</div>
            
            <!-- Agrega más categorías aquí -->
            </div>
        </div>

        <section class="hidden sm:block bg-cover bg-center" style="background-image: url({{asset('img/home/video.jpg')}})">

            <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-8 py-16">
                <div class="w-full md:w-3/4 lg:w-1/2">
                <h1 class="text-white font-fold text-4xl">RidesChilenos</h1>
                <p class="text-white text-lg mt-2 mb-4">Busca las mejores series riders del país.</p>
                    <!-- component -->
                    <!-- This is an example component -->
                    
                    @livewire('search')

                    
                </div>
            </div>

        </section>

        @livewire('series-index')
    </div>

    <div :class="{'block': novedades, 'hidden': ! novedades}" class="hidden">
     

        <div class="max-w-7xl mx-auto pb-8 ">      
            <div class="card">
                <div  class="hidden mt-4 text-2xl mb-2 sm:text-xl mx-4 leading-none font-bold text-gray-900 flex justify-between">
                    <div class="flex justify-center">
                       
                        <button class="btn btn-danger ml-6 text-center text-sm" @click="user = false; home = false; novedades = false; socio = true; evento = false; registro = false; vendedor = false; base = false" >RIDERS</button>
                               
                    </div>
                    <div class="flex justify-center">
                       
                        <button class="btn btn-danger ml-6 text-center text-sm" @click="evento = true; user = false; novedades = false; home = false; socio = false; registro = false; vendedor = false; base = false" >EVENTOS</button>
                               
                    </div>
                    <div class="flex justify-center">
                      
                                
                                    <button class="btn btn-success mr-6 text-center text-sm" @click="user = false; novedades = false; home = false; socio = false; evento = false; registro = true; vendedor = false; base = false" >BIKES</button>
                               
                    </div>
                </div>
                <div class="words sm:hidden bg-white pt-2 overflow-x-auto whitespace-no-wrap border-b-2 font-bold text-gray-700">
                    <div class="ml-4 pl-2 flex justify-center">
                        <div class="px-4 py-2 cursor-pointer hover:underline" @click="user = false; home = false; video = false; novedades = false; socio = true; evento = false; registro = false; vendedor = false; base = false" >Riders</div>
                        <div class="px-4 py-2 cursor-pointer hover:underline" @click="evento = true; user = false; video = false; novedades = false; home = false; socio = false; registro = false; vendedor = false; base = false" >Eventos</div>
                        <div class="px-4 py-2 cursor-pointer hover:underline text-gray-900" @click="user = false; video = false; novedades = false; home = false; socio = false; evento = false; registro = true; vendedor = false; base = false" >Bikes</div>
                        <div class="px-4 py-2 cursor-pointer underline text-gray-900" @click="user = false; novedades = true; video = false; home = false; socio = false; evento = false; registro = false; vendedor = false; base = false" >Novedades</div>
                        <div class="px-4 py-2 cursor-pointer hover:underline text-gray-900" @click="user = false; novedades = false; home = false; video = true; socio = false; evento = false; registro = false; vendedor = false; base = false" >Videos</div>
                      
                      <!-- Agrega más categorías aquí -->
                    </div>
                  </div>
            </div>  
                <div class="pb-4">
                    
                    
                        

                         
                    <div>
                        <h1 class="text-center font-bold text-2xl pt-2">Logros y Recuerdos Riders</h1>
                    </div>
                    <a class="flex justify-center mt-4" href="{{route('socio.resultados.create')}}">
                        <button class="btn max-w-sm btn-block btn-danger shadow h-10 px-4 rounded-lg text-white mb-2">
                        
                            Nueva Publicación
                        </button>
                    </a>
                    <div class="flex justify-center items-center">
                        @livewire('socio.galeria-resultados')
                    </div>
                    
                </div>
          

        </div>

      
    </div>

    <div :class="{'block': base, 'hidden': ! base}" class="hidden">
        {{$slot}}
    </div>
</div>