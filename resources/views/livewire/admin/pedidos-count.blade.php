<div>
   <div class="max-w-4xl mx-auto sm:px-6 mt-2 lg:px-8">
      <div class="mt-2 sm:mt-4 mb-4 w-full grid grid-cols-3 md:grid-cols-3 xl:grid-cols-3 gap-x-2 gap-y-2 items-center content-center">
   

            <a href="{{route('admin.disenos.index')}}">
               <div class="max-w-xl  bg-white shadow rounded-lg p-2 sm:p-6 xl:p-8 my-2">
                  <div class="flex items-center">
                     <div class="flex-shrink-0">
                        <span class="text-4xl sm:text-4xl leading-none font-bold text-gray-900">{{number_format($diseños->count())}}</span>
                        <h3 class="sm:hidden text-base font-normal text-gray-500">Diseño</h3>
                        <h3 class="hidden sm:block text-base font-normal text-gray-500">Diseño</h3>
                     </div>
                     <div class="hidden sm:flex w-10 items-center justify-end flex-1 text-red-500 text-base font-bold cursor-pointer">
                        
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                           <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                     </div>
                  </div>
               </div>
            </a>

            <a href="{{route('admin.disenos.produccion')}}">
               <div class="max-w-xl  bg-white shadow rounded-lg p-2 sm:p-6 xl:p-8 my-2">
                  <div class="flex items-center">
                     <div class="flex-shrink-0">
                        <span class="text-4xl sm:text-4xl leading-none font-bold text-gray-900">{{number_format($produccion->count())}}</span>
                        <h3 class="sm:hidden text-base font-normal text-gray-500">Producción</h3>
                        <h3 class="hidden sm:block text-base font-normal text-gray-500">Producción</h3>
                     </div>
                     <div class="hidden sm:flex ml-5 w-10 items-center justify-end flex-1 text-red-500 text-base font-bold cursor-pointer">
                        
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                           <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                     </div>
                  </div>
               </div>
            </a>

            <a href="{{route('admin.disenos.despacho')}}">
               <div class="max-w-xl  bg-white shadow rounded-lg p-2 sm:p-6 xl:p-8 my-2">
                  <div class="flex items-center">
                     <div class="flex-shrink-0">
                        <span class="text-4xl sm:text-4xl leading-none font-bold text-gray-900">{{number_format($despacho->count())}}</span>
                        <h3 class="sm:hidden text-base font-normal text-gray-500">Despacho</h3>
                        <h3 class="hidden sm:block text-base font-normal text-gray-500">Despacho</h3>
                     </div>
                     <div class="hidden sm:flex ml-5 w-10 items-center justify-end flex-1 text-red-500 text-base font-bold cursor-pointer">
                        
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                           <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                     </div>
                  </div>
               </div>
            </a>

      </div>
   </div>
   
   @if ($cliente)
      <div class="flex-1 p:2 sm:p-6 justify-between flex flex-col h-screen">
            <div class="flex sm:items-center justify-between py-3 border-b-2 border-gray-200">
            <div wire:click="cliente_clean" class="flex items-center space-x-4">
               <div class="w-12">
                
                  <div>
                     <img src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="" class="w-12 h-12 rounded-full">
                  </div>
               </div>
               <div class="flex flex-col leading-tight">
                  <div class="text-2xl mt-1 flex items-center">
                     <span class="text-white mr-3">{{$cliente->name}}</span>
                  </div>
                  <span class="text-lg text-gray-300">{{$cliente->fono}}</span>
               </div>
            </div>
            <div class="flex items-center space-x-2">
               <button type="button" class="inline-flex items-center justify-center rounded-lg border h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                  </svg>
               </button>
               <button type="button" class="inline-flex items-center justify-center rounded-lg border h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                  </svg>
               </button>
               <button type="button" class="inline-flex items-center justify-center rounded-lg border h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                  </svg>
               </button>
            </div>
         </div>
         <div id="messages" class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
            @foreach ($mensajes as $mensaje)
               
               @if (substr(str_replace(' ', '', $cliente->fono), -8)==substr(str_replace(' ', '', $mensaje->numero), -8))
                  @if ($mensaje->type=='enviado')
                        <div class="chat-message">
                           <div class="flex items-end justify-end">
                              <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-1 items-end">
                                 <div><span class="px-4 py-2 rounded-lg inline-block rounded-br-none bg-gray-300 text-gray-600 ">{{$mensaje->mensaje}}-{{$mensaje->created_at->format('H:i')}}</span></div>
                              </div>
                              <img src="https://riderschilenos.cl/img/logo.png" alt="My profile" class="w-6 h-6 rounded-full order-2">
                           </div>
                        </div>
                        
                  @else
                        <div class="chat-message">
                           <div class="flex items-end">
                              <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start">
                                 <div><span class="px-4 py-2 rounded-lg inline-block rounded-bl-none bg-gray-300 text-gray-600">{{$mensaje->mensaje}}-{{$mensaje->created_at->format('H:i')}}</span></div>
                              </div>
                              <img src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="My profile" class="w-6 h-6 rounded-full order-1">
                           </div>
                        </div>
                     
                  @endif
               @endif
              
            @endforeach
         </div>
         <div class="border-t-2 border-gray-200 px-4 pt-4 mb-2 sm:mb-0">
            <div class="relative flex">
            
               <input type="text" placeholder="Escribe tu Mensaje!" class="w-full focus:outline-none focus:placeholder-gray-400 text-gray-600 placeholder-gray-600 pl-12 bg-gray-200 rounded-md py-3">
               <div class="absolute right-0 items-center inset-y-0 hidden sm:flex">
                  <button type="button" class="inline-flex items-center justify-center rounded-full h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                     </svg>
                  </button>
                  <button type="button" class="inline-flex items-center justify-center rounded-full h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                     </svg>
                  </button>
                  <button type="button" class="inline-flex items-center justify-center rounded-full h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                     </svg>
                  </button>
                  <button type="button" class="inline-flex items-center justify-center rounded-lg px-4 py-3 transition duration-500 ease-in-out text-gray-600 bg-blue-500 hover:bg-blue-400 focus:outline-none">
                     <span class="font-bold">Enviar</span>
                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 w-6 ml-2 transform rotate-90">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                     </svg>
                  </button>
               </div>
            </div>
         </div>
      </div>
   @endif

   <h1 class="text-center text-xs text-white "><b>{{number_format($diseños->count()+$produccion->count()+$despacho->count())}}</b> Pedidos</h1>
      
   <div class="mt-2 sm:mt-4 mb-4 w-full grid grid-cols-2 md:grid-cols-4 xl:grid-cols-5 gap-x-1 gap-y-1 items-center content-center">
  
      @foreach ($diseños as $diseño)

         <div class="max-w-xl  bg-white shadow rounded-lg p-2 sm:p-2 xl:p-8 my-1 mx-1  cursor-pointer" wire:click="set_cliente({{$diseño->id}})">
            <div class="grid grid-cols-4 items-center border-b-2 pb-2 mb-2">
               <div class="w-12">
                
                  <div>
                     <img src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="" class="w-12 h-12 rounded-full">
                  </div>
               </div>
               <div class="flex flex-col ml-2 col-span-3">
                  <div class="text-md mt-1 flex items-center text-center">
                     <span class="text-gray-700 text-center">
                        @if($diseño->pedidoable_type=='App\Models\Socio')
                              @foreach ($socios as $socio)
                                    @if($socio->id == $diseño->pedidoable_id)
                                             {{Str::limit($socio->user->name,12)}}
                                    @endif
                              @endforeach
                        @endif
                        @if($diseño->pedidoable_type=='App\Models\Invitado')
                              @foreach ($invitados as $invitado)
                                    @if($invitado->id == $diseño->pedidoable_id)
                                          {{Str::limit($invitado->name,12)}} 
                                    @endif
                              @endforeach
                        @endif
                     </span>
                  </div>
                  <span class="whitespace-nowrap mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                     Pend. de diseño
                 </span>
               </div>
            </div>
            @foreach ($diseño->ordens->reverse() as $orden)
               <div class="flex justify-center">
                  @if($orden->smartphone)
                     <span class="whitespace-nowrap mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                        {{Str::limit($orden->producto->name,6)." (".$orden->smartphone->marcasmartphone->name."; ".$orden->smartphone->modelo.")"}}
                        
                     </span>
                     
                  @else
                     <span class="whitespace-nowrap mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                        {{$orden->producto->name}}
                     </span>
                     
                  @endif
               </div>
            @endforeach
         </div>
      @endforeach
      @foreach ($produccion as $diseño)

         <div class="max-w-xl  bg-white shadow rounded-lg p-2 sm:p-2 xl:p-8 my-1 mx-1  cursor-pointer" wire:click="set_cliente({{$diseño->id}})">
            <div class="grid grid-cols-4 items-center border-b-2 pb-2 mb-2">
               <div class="w-12">
                
                  <div>
                     <img src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="" class="w-12 h-12 rounded-full">
                  </div>
               </div>
               <div class="flex flex-col ml-2 col-span-3">
                  <div class="text-md mt-1 flex items-center">
                     <span class="text-gray-700 ml-2">
                        @if($diseño->pedidoable_type=='App\Models\Socio')
                              @foreach ($socios as $socio)
                                    @if($socio->id == $diseño->pedidoable_id)
                                             {{Str::limit($socio->user->name,12)}}
                                    @endif
                              @endforeach
                        @endif
                        @if($diseño->pedidoable_type=='App\Models\Invitado')
                              @foreach ($invitados as $invitado)
                                    @if($invitado->id == $diseño->pedidoable_id)
                                          {{Str::limit($invitado->name,12)}} 
                                    @endif
                              @endforeach
                        @endif
                     </span>
                  </div>
                  <span class="whitespace-nowrap mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                     Pend. de producción
                 </span>
               </div>
            </div>
            @foreach ($diseño->ordens->reverse() as $orden)
               <div class="flex justify-center">
                  @if($orden->smartphone)
                     <span class="whitespace-nowrap mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                        {{Str::limit($orden->producto->name,6)." (".$orden->smartphone->marcasmartphone->name."; ".$orden->smartphone->modelo.")"}}
                        
                     </span>
                     
                  @else
                     <span class="whitespace-nowrap mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                        {{$orden->producto->name}}
                     </span>
                     
                  @endif
               </div>
            @endforeach
         </div>
      @endforeach
      @foreach ($despacho as $diseño)

         <div class="max-w-xl  bg-white shadow rounded-lg p-2 sm:p-2 xl:p-8 my-1 mx-1  cursor-pointer" wire:click="set_cliente({{$diseño->id}})">
            <div class="grid grid-cols-4 items-center border-b-2 pb-2 mb-2">
               <div class="w-12">
               
                  <div >
                     <img src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="" class="w-12 h-12 rounded-full z-1">
                  </div>
               </div>
               <div class="flex flex-col ml-2 col-span-3">
                  <div class="text-md mt-1 flex items-center">
                     <span class="text-gray-700 ml-2">
                        @if($diseño->pedidoable_type=='App\Models\Socio')
                              @foreach ($socios as $socio)
                                    @if($socio->id == $diseño->pedidoable_id)
                                             {{Str::limit($socio->user->name,12)}}
                                    @endif
                              @endforeach
                        @endif
                        @if($diseño->pedidoable_type=='App\Models\Invitado')
                              @foreach ($invitados as $invitado)
                                    @if($invitado->id == $diseño->pedidoable_id)
                                          {{Str::limit($invitado->name,12)}} 
                                    @endif
                              @endforeach
                        @endif
                     </span>
                  </div>
                  <span class="whitespace-nowrap mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                     Pend. de despacho
                 </span>
               </div>
            </div>
            @foreach ($diseño->ordens->reverse() as $orden)
               <div class="flex justify-center">
                  @if($orden->smartphone)
                     <span class="whitespace-nowrap mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                        {{Str::limit($orden->producto->name,6)." (".$orden->smartphone->marcasmartphone->name."; ".$orden->smartphone->modelo.")"}}
                        
                     </span>
                     
                  @else
                     <span class="whitespace-nowrap mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                        {{$orden->producto->name}}
                     </span>
                     
                  @endif
               </div>
            @endforeach
         </div>
      @endforeach
   </div>

  
   
   <style>
      .scrollbar-w-2::-webkit-scrollbar {
      width: 0.25rem;
      height: 0.25rem;
      }
      
      .scrollbar-track-blue-lighter::-webkit-scrollbar-track {
      --bg-opacity: 1;
      background-color: #f7fafc;
      background-color: rgba(247, 250, 252, var(--bg-opacity));
      }
      
      .scrollbar-thumb-blue::-webkit-scrollbar-thumb {
      --bg-opacity: 1;
      background-color: #edf2f7;
      background-color: rgba(237, 242, 247, var(--bg-opacity));
      }
      
      .scrollbar-thumb-rounded::-webkit-scrollbar-thumb {
      border-radius: 0.25rem;
      }
   </style>
   
   <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
   <script>

      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;

      var pusher = new Pusher('4d3ca11564f1836a8e92', {
         cluster: 'us2'
      });

      var channel = pusher.subscribe('countpedidos-channel');
      channel.bind('my-event', function(data) {
            window.livewire.emit('actualizarPedidosCount');
            var audio = new Audio('{{asset('msn2.mp3')}}'); // Reemplaza 'url_del_sonido.mp3' con la ruta de tu archivo de sonido
            audio.play();
      });
   </script>

   <script>
      const el = document.getElementById('messages')
      el.scrollTop = el.scrollHeight
   </script>


</div>
