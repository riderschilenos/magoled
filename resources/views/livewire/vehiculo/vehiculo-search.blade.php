<div>
    @php

    $motos=0;
    $bicicletas=0;

        foreach ($vehiculosall as $vehiculo) {
            if ($vehiculo->status==5) {
                if ($vehiculo->vehiculo_type->id==9 or $vehiculo->vehiculo_type->id==10 or $vehiculo->vehiculo_type->id==11 ) {
                    $bicicletas+=1;}
                else {
                    $motos+=1;
                
                }    
            }
        }


    @endphp
    <div class="bg-white">
    <div x-data="setup()">

      @if ($type=="search")
          
     
        <div>
            <h1 class="text-center font-bold text-2xl pt-2">¿Cuántas Motos y Bicicletas Hay Registradas en Chile?</h1>
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
          <div class="hidden max-w-7xl mx-auto sm:px-2 lg:px-8 grid grid-cols-1 sm:grid-cols-2 mt-8">
              <article class="hidden">
                  <figure class="hidden sm:flex justify-center">
                      <a href="{{route('socio.index')}}"><img class="md:mr-8 ml-8 object-contain object-center" width="460" src="{{asset('img/home/qrpubli2.png')}}" alt=""></a>
                  </figure>
                  <figure class="flex justify-center sm:hidden">
                      <a href="{{route('socio.index')}}"><img class="mx-auto md:mr-8 object-contain object-center" width="280" src="{{asset('img/home/qrpubli2.png')}}" alt=""></a>
                  </figure>

              
              </article>
              <article class="hidden">
                      <div>

                          <div>
                              
                              <div class="flex-wrap md:flex justify-center">
                              
                                  <!-- Step Checkout -->
                                  <div class="my-12 ml-2 md:ml-12 mt-4 d:mt-4  md:w-2/3">
                                    <div class="relative flex pb-4">
                                      <div class="absolute inset-0 flex h-full w-10 items-center justify-center">
                                        <div class="pointer-events-none h-full w-1 bg-gray-200"></div>
                                      </div>
                                      <div class="relative z-10 inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-500 text-white">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="h-5 w-5" viewBox="0 0 24 24">
                                          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                        </svg>
                                      </div>
                                      <div class="flex-grow pl-4">
                                        <h2 class="title-font mb-1 text-sm font-medium tracking-wider text-gray-900">1 Registro AntiRobo</h2>
                                        <p class="font-laonoto leading-relaxed">
                                          Al momento de escanear el  <br />
                                          <b>QR CODE </b>se despliega la Información sobre la pertenencia del vehiculo
                                        </p>
                                      </div>
                                    </div>
                                    <div class="relative flex pb-4">
                                      <div class="absolute inset-0 flex h-full w-10 items-center justify-center">
                                        <div class="pointer-events-none h-full w-1 bg-gray-200"></div>
                                      </div>
                                      <div class="relative z-10 inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-500 text-white">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="h-5 w-5" viewBox="0 0 24 24">
                                          <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                                        </svg>
                                      </div>
                                      <div class="flex-grow pl-4">
                                        <h2 class="title-font mb-1 text-sm font-medium tracking-wider text-gray-900">2 Registro de Mantenciones</h2>
                                        <p class="font-laonoto leading-relaxed">Podras <b>registrar</b><b> de cada una de las mantenciones realizadas a tu vehiculo</b>.</p>
                                      </div>
                                    </div>
                                    <div class="relative flex pb-4">
                                      <div class="relative z-10 inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-500 text-white">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="h-5 w-5" viewBox="0 0 24 24">
                                          <circle cx="12" cy="5" r="3"></circle>
                                          <path d="M12 22V8M5 12H2a10 10 0 0020 0h-3"></path>
                                        </svg>
                                      </div>
                                      <div class="flex-grow pl-4">
                                        <h2 class="title-font mb-1 text-sm font-medium tracking-wider text-gray-900">3 Facil Instalación / Sin mantención</h2>
                                        <p class="font-laonoto leading-relaxed">
                                          Lo compras una vez y disfrutas sin costos de <span> <b>mantención</b></span
                                          >.
                                        </p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                          </div>



                          <a class="hidden sm:flex justify-center" href="{{route('garage.vehiculo.create')}}">
                              
                              <button class="btn max-w-sm btn-block bg-red-600 shadow h-10 px-4 rounded-lg text-white mr-4 mb-2" wire:click="resetFilters">
                              
                                  Inscribe tu Juguete

                              </button>
                          </a>

                      </div>
              
              </article>
            

          </div>
          <a class="flex justify-center mt-4" href="{{route('garage.vehiculo.create')}}">
                              
              <button class="btn max-w-sm btn-block bg-red-600 shadow h-10 px-4 rounded-lg text-white mb-2">
              
                  Inscribe tu Juguete

              </button>
          </a>
      @else
        <h1 class="text-center text-2xl my-6">Otras motos y bicicletas</h1>
      @endif
    
    

        <div class="px-2 my-2">
            <input wire:keydown="limpiar_page" wire:model="search"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Buscar por Nombre del Dueño" autocomplete="off">
        </div>
        
        @if($vehiculos->count())
            
          <div x-show="activeTab===0">   
              <div class="mx-1 max-w-7xl px-1 lg:px-8 mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-y-4">

                  @foreach ($vehiculos as $vehiculo)
                        <div class="hidden sm:block">
                          <x-mivehiculo-card :vehiculo="$vehiculo" />  
                        </div>
                        <div class="block sm:hidden">
                          <x-vehiculo-card2 :vehiculo="$vehiculo" />    
                        </div>
                  @endforeach
          
              </div>
          </div>
          <div x-show="activeTab===1"> 
              <div class="mx-1 max-w-7xl px-1 lg:px-8 mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-y-4">

                  @foreach ($vehiculosmoto as $vehiculo)
                        <div class="hidden sm:block">
                          <x-mivehiculo-card :vehiculo="$vehiculo" />  
                        </div>
                        <div class="block sm:hidden">
                          <x-vehiculo-card2 :vehiculo="$vehiculo" />    
                        </div>
                  @endforeach
          
              </div>
          </div>
          <div x-show="activeTab===2">  
                <div class="mx-1 max-w-7xl px-1 lg:px-8 mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-y-4">

                    @foreach ($vehiculosbici as $vehiculo)
                          <div class="hidden sm:block">
                            <x-mivehiculo-card :vehiculo="$vehiculo" />  
                          </div>
                          <div class="block sm:hidden">
                            <x-vehiculo-card2 :vehiculo="$vehiculo" />    
                          </div>
                    @endforeach
            
                </div>
          </div> 
          <div class="hidden md:flex justify-center mt-4">
            <a class="btn btn-danger cursor-pointer text-center mt-1"  wire:click="loadMore(10)">Ver Más</a>
          </div>
        @else
            <div class="px-6 py-4 text-center">
                No hay ningun registro de vehiculo en venta
            </div>
            
        @endif
          <div class="flex justify-center text-gray-400 px-6 py-4">
            Cargando....
        </div>
        <div class="px-6 py-4">
            {{$vehiculos->links()}}
        </div>
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
