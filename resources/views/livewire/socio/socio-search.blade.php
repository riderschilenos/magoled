<div class="mb-8" x-data="setup()">
    @php

    $bicicletas=0;
    $motos=0;

        foreach ($sociosfull as $socio) {
            
           
                if ($socio->disciplina_id==2 or $socio->disciplina_id==4 or $socio->disciplina_id==5 or $socio->disciplina_id==8 ) {
                    $bicicletas+=1;}
                else {
                    $motos+=1;
                
                }    
            
            
        }


    @endphp
    <div>
        @if ($type=="search")
            <div class="grid grid-cols-3"> 
                <div class="col-span-3 md:col-span-2 flex justify-center items-center mx-auto hidden">
                    <a href="{{route('socio.ranking.strava')}}">
                        <div class="bg-white w-full max-w-5xl mx-auto py-2 my-2 shadow-md rounded-md flex flex-col lg:flex-row justify-center items-center cursor-pointer">
                            <div class="w-full lg:w-1/2 lg:pr-8 lg:border-r-2 lg:border-slate-300 flex justify-center items-center my-auto">
                            
                                <div class="hidden md:flex justify-center my-auto items-center w-full max-w-sm h-36" style="perspective:1000px">
                                    <div id="creditCard" class="cursor-pointer transition-transform duration-500 " style="transform-style:preserve-3d">
                                        <div class="flex justify-center w-full h-36  my-auto items-center mx-auto rounded-xl text-white shadow-2xl" style="backface-visibility:hidden">
                                            <img src="{{asset('img/strava/strava.jpg')}}" class=" object-cover w-full h-full rounded-xl" />
                                        
                                        </div>
                                    
                                    </div>
                                </div>
                            
                        
                            </div>
                            <div class="w-full lg:w-1/2 lg:pl-2">
                                @livewire('socio.strava-count-total')
                            </div>
                        
                        
                        </div>
                    </a>
                </div>

                <div class="col-span-3 md:col-span-3 order-1 md:order-2">
                        <div>
                            <h1 class="text-center font-bold mt-4 text-2xl">¿Cuántos Magos de la Iluminación Hay en Chile?</h1>
                        </div>
                        
                                
                
                        <div class="mt-4 grid grid-cols-1 lg:grid-cols-3">
                            
                            <div>
                        
                            </div>
                        
                            
                            <div class="block">
                                <div class="flex justify-center ">
                        
                                    
                                        
                                    <button @click="activeTab = 0" class="btn text-white text-sm w-full max-w-xs items-center justify-items-center mx-2" :class="activeTab===0? ' bg-red-600' : '  bg-gray-900'" >{{$bicicletas+$motos}}<br> TOTAL</button>
                                    <button @click="activeTab = 1" class="btn text-white text-sm w-full max-w-xs items-center justify-items-center" :class="activeTab===1? ' bg-red-600' : '  bg-gray-900'" >{{$motos}}<br> MOTO</button>
                                    <button @click="activeTab = 2" class="btn text-white text-sm w-full max-w-xs items-center justify-items-center mx-2" :class="activeTab===2? ' bg-red-600' : '  bg-gray-900'" >{{$bicicletas}}<br> BICICLETA</button>
                                
                                    
                        
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 grid grid-cols-1 lg:grid-cols-3 gap-x-4">
                            
                            <div>

                            </div>
                        
                            <div class="hidden sm:block">
                                <div class="flex justify-center mr-4 ">

                                    
                                        @if(auth()->user())
                                            @if(auth()->user()->socio)
                                                <div class="flex justify-center gap-2">
                                                    <a href="{{ route('socio.show', auth()->user()->socio) }}">
                                                        <button class="font-bold py-2 px-4 rounded bg-blue-500 text-white w-full items-center justify-items-center whitespace-nowrap">Perfil</button>
                                                    </a>
                                                    <a href="{{route('socio.create')}}">
                                                        <button class="btn btn-success w-full items-center justify-items-center whitespace-nowrap">Suscripción</button>
                                                    </a>
                                                </div>
                                            @else
                                                <a href="{{route('socio.create')}}">
                                                    <button class="btn btn-success w-full items-center justify-items-center whitespace-nowrap">Crear Perfil Rider</button>
                                                </a>
                                            @endif
                                        @else
                                            <a href="{{route('socio.create')}}">
                                                <button class="btn btn-success w-full items-center justify-items-center whitespace-nowrap">Crear Perfil Rider</button>
                                            </a>
                                        @endif    
                                    

                                </div>
                            </div>
                    
                        </div>                                                      
                </div>
            </div>
        @else
            <h1 class="text-center text-2xl my-6">Perfiles Relacionados</h1>
        @endif

        <div class="px-2 py-2">
            <input wire:keydown="limpiar_page" wire:model="search"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Ingrese el nombre de un rider" autocomplete="off">
        </div>
        
        @if ($socios->count())

       
            <section class="mb-4 pt-2 pb-12">
               
                 
                      
                        <div x-show="activeTab===0">   
                            <div class="max-w-7xl mx-auto sm:px-2 lg:px-6 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-y-4 gap-x-4">
                                    
                                @foreach ($socios as $socio)

                            
                                <div class="hidden sm:block">
                                    <article class="">
                                        <div class="grid grid-cols-6 shadow-lg rounded-lg">
                                            <div class="col-span-2 items-center content-center my-auto px-1 py-1 bg-main-color">
                                                <a href="{{ route('socio.show.desktop', $socio) }}">
                                                   
                                                    <div class="relative">
                                                        <!-- User Avatar -->
                                                        @if ($socio->user)
                                                            @if (str_contains($socio->user->profile_photo_url,'https://ui-'))
                                                                <img class="w-40 h-40 rounded-md object-cover" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="">
                                                            @else
                                                                <img class="w-40 h-40 rounded-md object-cover" src="{{ $socio->user->profile_photo_url }}" alt="{{ $socio->name }}" alt="{{ $socio->name }}">
                                                  
                                                            @endif
                                                        @else
                                                            <img class="w-40 h-40 rounded-md object-cover" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="">
                                                        @endif
                                                        
                                                        <!-- Online Status Dot -->
                                                        
                                                        @if(Cache::has('user-is-online-' . $socio->user->id))
                                                            <div class="absolute -right-3 bottom-3 h-5 w-5 sm:top-2 rounded-full border-4 border-white bg-green-500 sm:invisible md:visible" title="User is online">
                                                            </div>
                                                        @else
                                                            <div class="absolute -right-3 bottom-3 h-5 w-5 sm:top-2 rounded-full border-4 border-white bg-red-500 sm:invisible md:visible" title="User is online">
                                                            </div>
                                                        @endif
                                                          
                                    
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="pl-2 py-2 col-span-4 bg-white flex flex-col">
                                                <div class="flex justify-between">
                                                    <a href="{{ route('socio.show.desktop', $socio) }}">
                                                        <p class="text-gray-500 text-base font-bold mt-auto">{{ strtoupper(Str::limit($socio->name." ".$socio->second_name, 20)) }}</p>
                                                    </a>
                                                    <div class="flex mx-2 items-center">
                                                        @if ($socio->user->resultados->where('status',2)->count()>0)
                                                            {{ $socio->user->resultados->where('status',2)->count()}}  <img class="w-3 h-3 mx-1" src="{{asset('img/copa.png')}}" alt="">
                                                        @else
                                                            0 <img class="w-3 h-3 mx-1" src="{{asset('img/copa.png')}}" alt="">
                                                        @endif
                                                    </div>
                                                </div>
                                               
                                                
                                                <div class="flex items-center content-center">
                                                    @if($socio->direccion)
                                                        <div class="px-2 py-2 text-red-500 font-semibold content-center">
                                                        <i class="fa fa-map-marker my-auto py-auto" aria-hidden="true"></i>
                                                    </div>
                                                    
                                                        <div class="px-2 py-2">{{Str::limit($socio->direccion->comuna.', '.$socio->direccion->region,20)}}</div>
                                                    @endif
                                                </div>
                                    
                                                @php
                                                    $now = config('app.now_global');
                                                    $borndate = strtotime($socio->born_date);
                                                    // Calcula la diferencia en segundos
                                                    $diferencia_segundos = strtotime($now) - $borndate;
                                                    $diferencia_anios = floor($diferencia_segundos / (365 * 24 * 60 * 60));
                                                @endphp
                                                <div class="text-sm text-gray-500 flex justify-start">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 mr-2">
                                                        {{$diferencia_anios}} Años
                                                    </span>
                                                
                                                </div>
                                    
                                                
                                                <div class="flex justify-betten items-center content-center mt-auto">
                                    
                                                    <span class="">
                                                        @if ($socio->disciplina)
                                                             <a href="{{ route('socio.show.desktop', $socio) }}">
                                                                <span class="bg-red-500 py-1 px-2 rounded text-white text-sm">{{$socio->disciplina->name}}</span>
                                                            </a>
                                                        @endif
                                    
                                                    </span>
                                                   
                                                                                        
                                                        @php
                                                            $n=0;
                                                        @endphp
                                                        @foreach ($socio->user->vehiculos as $vehiculo)
                                                            @if($vehiculo->status==5 || $vehiculo->status==6)
                                                                @php
                                                                    $n+=1;
                                                                @endphp    
                                                            @endif
                                                        @endforeach
                                                      
                                                        <a href="{{ route('socio.show.desktop', $socio) }}" class="flex ml-auto whitespace-nowrap">
                                                           @if ($n==1)
                                                                <div class="flex ml-auto whitespace-nowrap">
                                                                    <div class="py-2">{{$n}} Registro</div>
                                                                    <div class="p-2 py-2 text-red-500 font-semibold content-center">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                                                        </svg>
                                                                        
                                                                    </div>
                                                                </div>
                                                               
                                                           @elseif($n==0 || $n>1)
                                                                <div class="flex ml-auto whitespace-nowrap">
                                                                    <div class="py-2">{{$n}} Registros</div>
                                                                    <div class="p-2 py-2 text-red-500 font-semibold content-center">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                                                        </svg>
                                                                        
                                                                    </div>
                                                                </div>
                                                           @endif
                                                        </a>
                                                        
                                                </div>
                                               
                                                <!-- Aquí puedes añadir más detalles del socio si es necesario -->
                                                <!-- Sigue el formato similar al perfil del vehículo -->
                                                <!-- Recuerda reemplazar $socio con la variable correcta -->
                                            </div>
                                          
                                        </div>
                                    </article>
                                </div>
                                <div class="block sm:hidden">
                                    <x-socio-card2 :socio="$socio" />
                                </div>
                                      
                    
                                @endforeach
                            </div>
                        </div>
                        <div x-show="activeTab===1">
                            <div class="max-w-7xl mx-auto sm:px-2 lg:px-6 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-y-4 gap-x-4">
                
                                @foreach ($sociosmoto as $socio)

                            

                                <div class="hidden sm:block">
                                    <article class="">
                                        <div class="grid grid-cols-6 shadow-lg rounded-lg">
                                            <div class="col-span-2 items-center content-center my-auto px-1 py-1 bg-main-color">
                                                <a href="{{ route('socio.show.desktop', $socio) }}">
                                                   
                                                    <div class="relative">
                                                        <!-- User Avatar -->
                                                        @if ($socio->user)
                                                            @if (str_contains($socio->user->profile_photo_url,'https://ui-'))
                                                                <img class="w-40 h-40 rounded-md object-cover" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="">
                                                            @else
                                                                <img class="w-40 h-40 rounded-md object-cover" src="{{ $socio->user->profile_photo_url }}" alt="{{ $socio->name }}" alt="{{ $socio->name }}">
                                                  
                                                            @endif
                                                        @else
                                                            <img class="w-40 h-40 rounded-md object-cover" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="">
                                                        @endif
                                                        
                                                        <!-- Online Status Dot -->
                                                        
                                                        @if(Cache::has('user-is-online-' . $socio->user->id))
                                                            <div class="absolute -right-3 bottom-3 h-5 w-5 sm:top-2 rounded-full border-4 border-white bg-green-500 sm:invisible md:visible" title="User is online">
                                                            </div>
                                                        @else
                                                            <div class="absolute -right-3 bottom-3 h-5 w-5 sm:top-2 rounded-full border-4 border-white bg-red-500 sm:invisible md:visible" title="User is online">
                                                            </div>
                                                        @endif
                                                          
                                    
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="pl-2 py-2 col-span-4 bg-white flex flex-col">
                                                <div class="flex justify-between">
                                                    <a href="{{ route('socio.show.desktop', $socio) }}">
                                                        <p class="text-gray-500 text-base font-bold mt-auto">{{ strtoupper(Str::limit($socio->name." ".$socio->second_name, 20)) }}</p>
                                                    </a>
                                                    <div class="flex mx-2 items-center">
                                                        @if ($socio->user->resultados->where('status',2)->count()>0)
                                                            {{ $socio->user->resultados->where('status',2)->count()}}  <img class="w-3 h-3 mx-1" src="{{asset('img/copa.png')}}" alt="">
                                                        @else
                                                            0 <img class="w-3 h-3 mx-1" src="{{asset('img/copa.png')}}" alt="">
                                                        @endif
                                                    </div>
                                                </div>
                                               
                                                
                                                <div class="flex items-center content-center">
                                                    @if($socio->direccion)
                                                        <div class="px-2 py-2 text-red-500 font-semibold content-center">
                                                        <i class="fa fa-map-marker my-auto py-auto" aria-hidden="true"></i>
                                                    </div>
                                                    
                                                        <div class="px-2 py-2">{{Str::limit($socio->direccion->comuna.', '.$socio->direccion->region,20)}}</div>
                                                    @endif
                                                </div>
                                    
                                                @php
                                                    $now = config('app.now_global');
                                                    $borndate = strtotime($socio->born_date);
                                                    // Calcula la diferencia en segundos
                                                    $diferencia_segundos = strtotime($now) - $borndate;
                                                    $diferencia_anios = floor($diferencia_segundos / (365 * 24 * 60 * 60));
                                                @endphp
                                                <div class="text-sm text-gray-500 flex justify-start">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 mr-2">
                                                        {{$diferencia_anios}} Años
                                                    </span>
                                                
                                                </div>
                                    
                                                
                                                <div class="flex justify-betten items-center content-center mt-auto">
                                    
                                                    <span class="">
                                                        @if ($socio->disciplina)
                                                             <a href="{{ route('socio.show.desktop', $socio) }}">
                                                                <span class="bg-red-500 py-1 px-2 rounded text-white text-sm">{{$socio->disciplina->name}}</span>
                                                            </a>
                                                        @endif
                                    
                                                    </span>
                                                   
                                                                                        
                                                        @php
                                                            $n=0;
                                                        @endphp
                                                        @foreach ($socio->user->vehiculos as $vehiculo)
                                                            @if($vehiculo->status==5 || $vehiculo->status==6)
                                                                @php
                                                                    $n+=1;
                                                                @endphp    
                                                            @endif
                                                        @endforeach
                                                      
                                                        <a href="{{ route('socio.show.desktop', $socio) }}" class="flex ml-auto whitespace-nowrap">
                                                           @if ($n==1)
                                                                <div class="flex ml-auto whitespace-nowrap">
                                                                    <div class="py-2">{{$n}} Registro</div>
                                                                    <div class="p-2 py-2 text-red-500 font-semibold content-center">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                                                        </svg>
                                                                        
                                                                    </div>
                                                                </div>
                                                               
                                                           @elseif($n==0 || $n>1)
                                                                <div class="flex ml-auto whitespace-nowrap">
                                                                    <div class="py-2">{{$n}} Registros</div>
                                                                    <div class="p-2 py-2 text-red-500 font-semibold content-center">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                                                        </svg>
                                                                        
                                                                    </div>
                                                                </div>
                                                           @endif
                                                        </a>
                                                        
                                                </div>
                                               
                                                <!-- Aquí puedes añadir más detalles del socio si es necesario -->
                                                <!-- Sigue el formato similar al perfil del vehículo -->
                                                <!-- Recuerda reemplazar $socio con la variable correcta -->
                                            </div>
                                          
                                        </div>
                                    </article>
                                </div>
                                <div class="block sm:hidden">
                                    <x-socio-card2 :socio="$socio" />
                                </div>

                                    
                    
                                @endforeach
                            </div>
                        </div>
                        <div x-show="activeTab===2">
                            <div class="max-w-7xl mx-auto sm:px-2 lg:px-6 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-y-4 gap-x-4">
                
                                @foreach ($sociosbici as $socio)
                                    <div class="hidden sm:block">
                                        <article class="">
                                            <div class="grid grid-cols-6 shadow-lg rounded-lg">
                                                <div class="col-span-2 items-center content-center my-auto px-1 py-1 bg-main-color">
                                                    <a href="{{ route('socio.show.desktop', $socio) }}">
                                                    
                                                        <div class="relative">
                                                            <!-- User Avatar -->
                                                            @if ($socio->user)
                                                                @if (str_contains($socio->user->profile_photo_url,'https://ui-'))
                                                                    <img class="w-40 h-40 rounded-md object-cover" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="">
                                                                @else
                                                                    <img class="w-40 h-40 rounded-md object-cover" src="{{ $socio->user->profile_photo_url }}" alt="{{ $socio->name }}" alt="{{ $socio->name }}">
                                                    
                                                                @endif
                                                            @else
                                                                <img class="w-40 h-40 rounded-md object-cover" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="">
                                                            @endif
                                                            
                                                            <!-- Online Status Dot -->
                                                            
                                                            @if(Cache::has('user-is-online-' . $socio->user->id))
                                                                <div class="absolute -right-3 bottom-3 h-5 w-5 sm:top-2 rounded-full border-4 border-white bg-green-500 sm:invisible md:visible" title="User is online">
                                                                </div>
                                                            @else
                                                                <div class="absolute -right-3 bottom-3 h-5 w-5 sm:top-2 rounded-full border-4 border-white bg-red-500 sm:invisible md:visible" title="User is online">
                                                                </div>
                                                            @endif
                                                            
                                        
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="pl-2 py-2 col-span-4 bg-white flex flex-col">
                                                    <div class="flex justify-between">
                                                        <a href="{{ route('socio.show.desktop', $socio) }}">
                                                            <p class="text-gray-500 text-base font-bold mt-auto">{{ strtoupper(Str::limit($socio->name." ".$socio->second_name, 20)) }}</p>
                                                        </a>
                                                        <div class="flex mx-2 items-center">
                                                            @if ($socio->user->resultados->where('status',2)->count()>0)
                                                                {{ $socio->user->resultados->where('status',2)->count()}}  <img class="w-3 h-3 mx-1" src="{{asset('img/copa.png')}}" alt="">
                                                            @else
                                                                0 <img class="w-3 h-3 mx-1" src="{{asset('img/copa.png')}}" alt="">
                                                            @endif
                                                        </div>
                                                    </div>
                                                
                                                    
                                                    <div class="flex items-center content-center">
                                                        @if($socio->direccion)
                                                            <div class="px-2 py-2 text-red-500 font-semibold content-center">
                                                            <i class="fa fa-map-marker my-auto py-auto" aria-hidden="true"></i>
                                                        </div>
                                                        
                                                            <div class="px-2 py-2">{{Str::limit($socio->direccion->comuna.', '.$socio->direccion->region,20)}}</div>
                                                        @endif
                                                    </div>
                                        
                                                    @php
                                                        $now = config('app.now_global');
                                                        $borndate = strtotime($socio->born_date);
                                                        // Calcula la diferencia en segundos
                                                        $diferencia_segundos = strtotime($now) - $borndate;
                                                        $diferencia_anios = floor($diferencia_segundos / (365 * 24 * 60 * 60));
                                                    @endphp
                                                    <div class="text-sm text-gray-500 flex justify-start">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 mr-2">
                                                            {{$diferencia_anios}} Años
                                                        </span>
                                                    
                                                    </div>
                                        
                                                    
                                                    <div class="flex justify-betten items-center content-center mt-auto">
                                        
                                                        <span class="">
                                                            @if ($socio->disciplina)
                                                                <a href="{{ route('socio.show.desktop', $socio) }}">
                                                                    <span class="bg-red-500 py-1 px-2 rounded text-white text-sm">{{$socio->disciplina->name}}</span>
                                                                </a>
                                                            @endif
                                        
                                                        </span>
                                                    
                                                                                            
                                                            @php
                                                                $n=0;
                                                            @endphp
                                                            @foreach ($socio->user->vehiculos as $vehiculo)
                                                                @if($vehiculo->status==5 || $vehiculo->status==6)
                                                                    @php
                                                                        $n+=1;
                                                                    @endphp    
                                                                @endif
                                                            @endforeach
                                                        
                                                            <a href="{{ route('socio.show.desktop', $socio) }}" class="flex ml-auto whitespace-nowrap">
                                                            @if ($n==1)
                                                                    <div class="flex ml-auto whitespace-nowrap">
                                                                        <div class="py-2">{{$n}} Registro</div>
                                                                        <div class="p-2 py-2 text-red-500 font-semibold content-center">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                                                            </svg>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                
                                                            @elseif($n==0 || $n>1)
                                                                    <div class="flex ml-auto whitespace-nowrap">
                                                                        <div class="py-2">{{$n}} Registros</div>
                                                                        <div class="p-2 py-2 text-red-500 font-semibold content-center">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                                                            </svg>
                                                                            
                                                                        </div>
                                                                    </div>
                                                            @endif
                                                            </a>
                                                            
                                                    </div>
                                                
                                                    <!-- Aquí puedes añadir más detalles del socio si es necesario -->
                                                    <!-- Sigue el formato similar al perfil del vehículo -->
                                                    <!-- Recuerda reemplazar $socio con la variable correcta -->
                                                </div>
                                            
                                            </div>
                                        </article>
                                    </div>
                                    <div class="block sm:hidden">
                                        <x-socio-card2 :socio="$socio" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                       
                   
                   
                        <div class="hidden md:flex justify-center mt-4">
                            <a class="btn btn-danger cursor-pointer text-center mt-1"  wire:click="loadMore(10)">Ver Más</a>
                          </div>
               
            
            </section>
      
            
        @else
            <div class="px-6 py-4">
                No hay ningun registro
            </div>
        @endif 
        
        <div class="flex justify-center text-gray-400 px-6 py-4">
            Cargando....
         </div>
        
    </div>
  
        <script>
         
        function setup() {
            return {
            activeTab: 0,
            tabs: [
                "TOTAL",
                "MOTO",
                "BICICLETA"
            ]
            };
        };
            document.addEventListener('livewire:load', function () {
                window.addEventListener('scroll', function() {
                        window.livewire.emit('loadMore2');
                });
            });
        </script>




</div>
