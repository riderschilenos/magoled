<x-app-layout>

    <x-slot name="tl">
            
        <title>MagoLed Chile</title>
        
    </x-slot>



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
                <div  class="my-6 text-2xl sm:text-xl mx-1 leading-none font-bold text-gray-900 flex justify-between">
                    <div>
                        <h1 class="text-xl mx-2 font-bold cursor-pointer flex items-center">Hola {{Auth()->user()->name}}</h1>
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
                            <button class=" bg-white px-3 font-bold py-2 rounded-lg text-sm uppercase tracking-tight overflow-visible w-full md:w-32">
                                <div class=" -top-2 -right-2 px-2.5 py-0.5 bg-red-500 rounded-full text-xs text-white">
                                    {{auth()->user()->tickets->where('status','=',3)->count()}}
                                 </div>
                                <div class="flex justify-center mx-2">   <img src="{{asset('img/ticket.png')}}" class="w-6 mr-2 py-1"> 
                                Tickets </div>
                               
                            </button>
                        </a>
                        {{-- 
                            @if(auth()->user()->vendedor) 
                                @if(auth()->user()->vendedor->estado==2)
                                    <a href="{{route('vendedor.pedidos.create')}}" class="hidden sm:flex">
                                        <button class="btn btn-success mt-2 text-center text-base whitespace-nowrap">Nuevo Pedido</button>
                                    </a>
                                    
                                @endif
                            @endif
                            @if(auth()->user()->tickets || auth()->user()->vendedor) 
                                @if(auth()->user()->vendedor)
                                    @if(auth()->user()->vendedor->estado==2)
                                        <a href="{{route('organizador.tickets.create')}}" class="hidden sm:flex">
                                            <button class="btn btn-success mt-2 text-center text-base whitespace-nowrap">Nuevo Ticket</button>
                                        </a>
                                    @endif
                                @elseif(auth()->user()->tickets) 
                                        @foreach (auth()->user()->tickets as $ticket)
                                            @if ($ticket->evento->type=='sorteo' && $ticket->status>=3)
                                                <a href="{{route('organizador.tickets.create')}}" class="hidden sm:flex">
                                                    <button class="btn btn-success mt-2 text-center text-base whitespace-nowrap">Nuevo Ticket</button>
                                                </a>
                                                @break
                                            @endif
                                        @endforeach   
                                
                                @endif 
                            @endif
                       comment --}}
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
                    <div>
                        @if (auth()->user()->socio)
                            <div class=" font-sans flex justify-center mb-2">
                        
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
                        @if(auth()->user()->vendedor) 
                            @if(auth()->user()->vendedor->estado==2)
                                <div class=" font-sans flex justify-center mb-2">
                            
                                    <div class="w-full mx-auto">
                                        <a href="{{route('vendedor.pedidos.create')}}">
                                            <div class="transition-all duration-300 bg-white hover:bg-gray-100 cursor-pointer rounded-lg shadow-md border-b-4 border-green-600 p-6 flex justify-center items-center">
                                                        
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                </svg>
                                                
                                                
                                                <h1 class="text-center ml-2">Nuevo Pedido</h1>
                                            </div>
                                        </a>
                                    </div>
                            
                                </div>

                            
                            @endif
                        @endif
                        @if(auth()->user()->tickets || auth()->user()->vendedor) 
                             @if(auth()->user()->vendedor)
                                @if(auth()->user()->vendedor->estado==2)
                                    <div class=" font-sans flex justify-center mb-2">
                                
                                        <div class="w-full mx-auto">
                                            <a href="{{route('organizador.tickets.create')}}">
                                                <div class="transition-all duration-300 bg-white hover:bg-gray-100 cursor-pointer rounded-lg shadow-md border-b-4 border-green-600 p-6 flex justify-center items-center">
                                                            
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                    </svg>
                                                    
                                                    
                                                    <h1 class="text-center ml-2">Nuevo Ticket</h1>
                                                </div>
                                            </a>
                                        </div>
                                
                                    </div>

                                  
                                @endif
                            @elseif(auth()->user()->tickets) 
                                    @foreach (auth()->user()->tickets as $ticket)
                                        @if ($ticket->evento->type=='sorteo' && $ticket->status>=3)
                                            <div class=" font-sans flex justify-center mb-2">
                                    
                                                <div class="w-full mx-auto">
                                                    <a href="{{route('organizador.tickets.create')}}">
                                                        <div class="transition-all duration-300 bg-white hover:bg-gray-100 cursor-pointer rounded-lg shadow-md border-b-4 border-green-600 p-6 flex justify-center items-center">
                                                                    
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                            </svg>
                                                            
                                                            
                                                            <h1 class="text-center ml-2">Nuevo Ticket</h1>
                                                        </div>
                                                    </a>
                                                </div>
                                        
                                            </div>
                                            @break
                                        @endif
                                    @endforeach   
                               
                            @endif 
                        @endif
                        
                    </div>

                    @if (auth()->user())
                        <div>
                            @if(auth()->user()->vendedor) 
                                @if(auth()->user()->vendedor->estado==2)
                                    
                                    <div class="font-sans flex justify-center mb-2">
                            
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

                                    <div class="font-sans flex justify-center mb-2">
                            
                                        <div class="w-full mx-auto">
                                            <a href="{{route('vendedor.contabilidad', auth()->user()->vendedor)}}">
                                                <div class="transition-all duration-300 bg-white hover:bg-gray-100 cursor-pointer rounded-lg shadow-md border-b-4 border-red-600 p-6 flex justify-center items-center">
                                                            
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                    </svg>
                                                    
                                                    
                                                    <h1 class="text-center ml-2">Mis Ganancias</h1>
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
                    @can('Diseño')
                        
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
                    @endcan
                    @can('Super admin')
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
                            <div class="font-sans flex justify-center mt-2">
                        
                                <div class="w-full mx-auto">
                                    <a href="{{ route('vendedores.index.desktop') }}">
                                        <div class="transition-all duration-300 bg-white hover:bg-gray-100 cursor-pointer rounded-lg shadow-md border-b-4 border-blue-600 p-6 flex justify-center items-center">
                                                    
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                            </svg>
                                            
                                            <h1 class="text-center ml-2">AdminVendedores</h1>
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
                            <div class="grid grid-cols-3 sm:grid-cols-1">
                                <div class="photo-wrapper flex justify-center mt-2">
                                        <img loading="lazy" class="cursor-pointer h-32 w-32 object-cover rounded-md mx-auto" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <h1 class="text-center my-2 font-bold">¡Hola!</h1>
                                    <h1 class="text-center my-2 font-bold">Bienvenidos a MagoLed</h1>
                                    <div class="flex justify-center w-full">

                                        <a href="{{route('foros.index')}}" class="w-full mx-2 whitespace-nowrap sm:hidden">
                                            <button class="flex justify-center btn bg-red-500 hover:bg-red-600 text-white w-full items-center justify-items-center mt-2 whitespace-nowrap">ACCESO FORO ONLINE</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
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
                    <div class="col-span-5 sm:col-span-3 flex justify-center items-center hidden">
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
    
    {{-- comment
        <div class="max-w-7xl mx-auto px-4 pt-10 sm:px-6 mb-4 lg:px-8 grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-4 gap-y-4">
            @if ($riders->count()>0)
                
                @foreach ($riders as $rider)

                    <x-socio-card :socio="$rider" />
                    
                @endforeach
                
            @endif

        </div>
 --}}
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
    {{-- 
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-8">
        @if ($series->count()>0)
                
            @foreach ($series as $peli)

                <x-serie-card :serie="$peli" />
                
            @endforeach
        
        @endif

    </div>
    comment --}}
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
    {{-- comment
    <div class="max-w-7xl mx-auto px-4 mt-2 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-x-6 gap-y-8">

        @foreach ($autos as $auto)

            <x-vehiculo-card :vehiculo="$auto" />
            
        @endforeach

    </div>
 --}}
  
        

</section>

@livewire('footer')



</x-app-layout > 

