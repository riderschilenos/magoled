<div>

   @php
      $total=0;
   @endphp
    <style>
        /* width */
  ::-webkit-scrollbar {
  width: 5px;
  }

  /* Track */
  ::-webkit-scrollbar-track {
  background: #cfd8dc;
  border-radius: 5px;
  }

  /* Handle */
  ::-webkit-scrollbar-thumb {
  background: #b0bec5;
  border-radius: 5px;
  }

  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
  background: #90a4ae;
  }

  .bg-cyan-50, .hover\:bg-cyan-50:hover {
     background-color: #e0f7fa;
  }
  .bg-cyan-100, .hover\:bg-cyan-100:hover {
     background-color: #b2ebf2;
  }
  .bg-cyan-200, .hover\:bg-cyan-200:hover {
     background-color: #80deea;
  }
  .bg-cyan-300, .hover\:bg-cyan-300:hover {
     background-color: #4dd0e1;
  }
  .bg-cyan-400, .hover\:bg-cyan-400:hover {
     background-color: #26c6da;
  }
  .bg-cyan-500, .hover\:bg-cyan-500:hover {
     background-color: #00bcd4;
  }
  .bg-cyan-600, .hover\:bg-cyan-600:hover {
     background-color: #00acc1;
  }
  .bg-cyan-700, .hover\:bg-cyan-700:hover {
     background-color: #0097a7;
  }
  .bg-cyan-800, .hover\:bg-cyan-800:hover {
     background-color: #00838f;
  }
  .bg-cyan-900, .hover\:bg-cyan-900:hover {
     background-color: #006064;
  }


  .text-cyan-50, .hover\:text-cyan-50:hover {
     color: #e0f7fa;
  }
  .text-cyan-100, .hover\:text-cyan-100:hover {
     color: #b2ebf2;
  }
  .text-cyan-200, .hover\:text-cyan-200:hover {
     color: #80deea;
  }
  .text-cyan-300, .hover\:text-cyan-300:hover {
     color: #4dd0e1;
  }
  .text-cyan-400, .hover\:text-cyan-400:hover {
     color: #26c6da;
  }
  .text-cyan-500, .hover\:text-cyan-500:hover {
     color: #00bcd4;
  }
  .text-cyan-600, .hover\:text-cyan-600:hover {
     color: #00acc1;
  }
  .text-cyan-700, .hover\:text-cyan-700:hover {
     color: #0097a7;
  }
  .text-cyan-800, .hover\:text-cyan-800:hover {
     color: #00838f;
  }
  .text-cyan-900, .hover\:text-cyan-900:hover {
     color: #006064;
  }

  .bg-blue-gray-50, .hover\:bg-blue-gray-50:hover {
     background-color: #eceff1;
  }
  .bg-blue-gray-100, .hover\:bg-blue-gray-100:hover {
     background-color: #cfd8dc;
  }
  .bg-blue-gray-200, .hover\:bg-blue-gray-200:hover {
     background-color: #b0bec5;
  }
  .bg-blue-gray-300, .hover\:bg-blue-gray-300:hover {
     background-color: #90a4ae;
  }
  .bg-blue-gray-400, .hover\:bg-blue-gray-400:hover {
     background-color: #78909c;
  }
  .bg-blue-gray-500, .hover\:bg-blue-gray-500:hover {
     background-color: #607d8b;
  }
  .bg-blue-gray-600, .hover\:bg-blue-gray-600:hover {
     background-color: #546e7a;
  }
  .bg-blue-gray-700, .hover\:bg-blue-gray-700:hover {
     background-color: #455a64;
  }
  .bg-blue-gray-800, .hover\:bg-blue-gray-800:hover {
     background-color: #37474f;
  }
  .bg-blue-gray-900, .hover\:bg-blue-gray-900:hover {
     background-color: #263238;
  }

  .text-blue-gray-50, .hover\:text-blue-gray-50:hover {
     color: #eceff1;
  }
  .text-blue-gray-100, .hover\:text-blue-gray-100:hover {
     color: #cfd8dc;
  }
  .text-blue-gray-200, .hover\:text-blue-gray-200:hover {
     color: #b0bec5;
  }
  .text-blue-gray-300, .hover\:text-blue-gray-300:hover {
     color: #90a4ae;
  }
  .text-blue-gray-400, .hover\:text-blue-gray-400:hover {
     color: #78909c;
  }
  .text-blue-gray-500, .hover\:text-blue-gray-500:hover {
     color: #607d8b;
  }
  .text-blue-gray-600, .hover\:text-blue-gray-600:hover {
     color: #546e7a;
  }
  .text-blue-gray-700, .hover\:text-blue-gray-700:hover {
     color: #455a64;
  }
  .text-blue-gray-800, .hover\:text-blue-gray-800:hover {
     color: #37474f;
  }
  .text-blue-gray-900, .hover\:text-blue-gray-900:hover {
     color: #263238;
  }
  .bg-teal-50, .hover\:bg-teal-50:hover {
     background-color: #e0f2f1;
  }
  .bg-teal-100, .hover\:bg-teal-100:hover {
     background-color: #b2dfdb;
  }
  .bg-teal-200, .hover\:bg-teal-200:hover {
     background-color: #80cbc4;
  }
  .bg-teal-300, .hover\:bg-teal-300:hover {
     background-color: #4db6ac;
  }
  .bg-teal-400, .hover\:bg-teal-400:hover {
     background-color: #26a69a;
  }
  .bg-teal-500, .hover\:bg-teal-500:hover {
     background-color: #009688;
  }
  .bg-teal-600, .hover\:bg-teal-600:hover {
     background-color: #00897b;
  }
  .bg-teal-700, .hover\:bg-teal-700:hover {
     background-color: #00796b;
  }
  .bg-teal-800, .hover\:bg-teal-800:hover {
     background-color: #00695c;
  }
  .bg-teal-900, .hover\:bg-teal-900:hover {
     background-color: #004d40;
  }

  .text-teal-50, .hover\:text-teal-50:hover {
     color: #e0f2f1;
  }
  .text-teal-100, .hover\:text-teal-100:hover {
     color: #b2dfdb;
  }
  .text-teal-200, .hover\:text-teal-200:hover {
     color: #80cbc4;
  }
  .text-teal-300, .hover\:text-teal-300:hover {
     color: #4db6ac;
  }
  .text-teal-400, .hover\:text-teal-400:hover {
     color: #26a69a;
  }
  .text-teal-500, .hover\:text-teal-500:hover {
     color: #009688;
  }
  .text-teal-600, .hover\:text-teal-600:hover {
     color: #00897b;
  }
  .text-teal-700, .hover\:text-teal-700:hover {
     color: #00796b;
  }
  .text-teal-800, .hover\:text-teal-800:hover {
     color: #00695c;
  }
  .text-teal-900, .hover\:text-teal-900:hover {
     color: #004d40;
  }

  .nowrap {
  white-space: nowrap;
  }

  .glass {
  background-color: rgba(100, 120, 130, .6);
  backdrop-filter: blur(10px);
  }

  table td {
  vertical-align: top;
  }

  #receipt-content {
  max-height: 70vh;
  }

  @media print {
  .hide-print {
     display: none !important;
  }
  .print-area {
     display: block;
  }
  }
</style>
<main class="bg-blue-gray-50" >
<!-- noprint-area -->
<div class="hide-print flex flex-row h-screen antialiased text-blue-gray-800">


<!-- page content -->
<div class="flex-grow sm:flex">
  <!-- store menu -->
  <div class="flex flex-col bg-blue-gray-50 h-full w-full py-4">
     <div class="flex px-2 flex-row relative">
     <div class="absolute left-5 top-3 px-2 py-2 rounded-full bg-red-500 text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
     </div>
     <input  type="text" id="search" class="bg-white rounded-3xl shadow text-lg full w-full h-16 py-4 pl-16 transition-shadow focus:shadow-2xl focus:outline-none"
        placeholder="Buscar"
        wire:model="search" wire:keydown.enter="findProduct" autofocus/>
     </div>
     <div class="overflow-hidden mt-4">
     <div class="overflow-y-auto px-2">
      
      

        
        <div  class="grid grid-cols-2 sm:grid-cols-4 gap-4 pb-3">
            @foreach ($productos as $producto)
                
            <article class="flex flex-col" wire:click="addProduct({{$producto->id}})">
                <div class="bg-white shadow-xl rounded-lg  p-2  hover:shadow  hover:bg-gray-100">

                    <div class="photo-wrapper">
                        @if ($producto->image)
                            <img loading="lazy" class="cursor-pointer h-48 w-full object-cover rounded-md" src="{{Storage::url($producto->image)}}" alt="{{$producto->name}}">
                        @else
                            <img loading="lazy" class="cursor-pointer h-48 w-full object-cover rounded-md" src="https://broxtechnology.com/images/iconos/box.png">
                        @endif
                        
                    </div>


                    <div class="px-2 flex flex-1 flex-col">
                        <a href= "">
                            <div class="flex justify-between">
                                <h3 class="text-left cursor-pointer text-base font-bold text-gray-900">{{Str::limit($producto->name,10)}}</h3>
                                <h3 class="text-center items-center my-auto cursor-pointer text-base font-bold text-gray-900 ">${{number_format($producto->precio)}}</h3>
                          
                            </div>
                        </a>
                        
                        {{-- <div class="text-center text-gray-400 text-xs font-semibold ">
                            <p>Socio RidersChilenos</p>
                        </div> --}}
                       
                        
                      

                    </div>

                </div>
            </article>

            @endforeach
         </div>
     </div>
     </div>
  </div>
  <!-- end of store menu -->

  <!-- right sidebar -->
  <div class="w-12/12 sm:w-5/12 flex flex-col bg-blue-gray-50 h-full bg-white pr-4 pl-2 py-4">
    <div class="grid grid-cols-3 gap-2 my-2">
      
            @foreach ($pedidos->reverse() as $pedido)
               @php
                  $subtotalpedidos=0;
               @endphp
               @if ($pedido->ordens)
                  @foreach ($pedido->ordens as $orden)
                     @php
                         $subtotalpedidos+=$orden->producto->precio*$orden->cantidad;
                     @endphp
                  @endforeach
               @endif
               @if ($current->id==$pedido->id)
                  <div wire:click="set_current({{$pedido->id}})" class="bg-gray-300 text-center cursor-pointer rounded-lg shadow hover:shadow-lg focus:outline-none inline-block px-2 py-1 text-sm"><span>{{$pedido->id}} </span> <span>${{number_format($subtotalpedidos)}}</span></div>
                
               @else
                  <div wire:click="set_current({{$pedido->id}})" class="bg-white text-center cursor-pointer rounded-lg shadow hover:shadow-lg focus:outline-none inline-block px-2 py-1 text-sm"><span>{{$pedido->id}} </span> <span>${{number_format($subtotalpedidos)}}</span></div>
                
               @endif
               
               @endforeach
            @if($pedidos->count())
               <div wire:click="new_pedido()" class="bg-white text-center cursor-pointer rounded-lg shadow hover:shadow-lg focus:outline-none inline-block px-2 py-1 text-sm"><span>Nuevo</span></div>
            @endif
     
    </div>
        <div class="bg-white rounded-3xl flex flex-col shadow">
            @if ($current)
               
                  <!-- empty cart -->
               @if ($current->ordens->count()==0)
                  
                  <div class="flex-1 w-full p-4 opacity-25 select-none flex flex-col flex-wrap content-center justify-center">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-16 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                     </svg>
                     <p>
                     Carro Vacío
                     </p>
                  </div>
                  
               @endif
               @if ($current->ordens->count()>0)
               
                  <!-- cart items -->
                  <div  class="flex-1 flex flex-col overflow-auto">
                     <div class="h-16 text-center flex justify-center">
                     <div class="pl-8 text-left text-lg py-4 relative">
                     <!-- cart icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <div class="text-center absolute bg-cyan-500 text-white w-5 h-5 text-xs p-0 leading-5 rounded-full -right-2 top-3">{{$current->ordens->count()}}</div>
                        </div>

                        <div class="flex-grow px-8 text-right text-lg py-4 relative">
                        <!-- trash button -->
                           <button wire:click="destroy_pedido({{$current->id}})" class="text-blue-gray-300 hover:text-pink-500 ">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                              </svg>
                           </button>
                        </div>
                        
                     </div>

                     <div class="flex-1 w-full px-4 overflow-auto">
                     
                        @foreach ($current->ordens as $orden)
                           <div class="select-none mb-3 bg-blue-gray-50 rounded-lg w-full text-blue-gray-700 py-2 px-2 flex justify-center">
                              @if ($orden->producto->image)
                              
                                 <img src="{{Storage::url($orden->producto->image)}}" alt="" class="rounded-lg h-10 w-10 bg-white shadow mr-2">

                              @else
                              
                                 <img src="https://broxtechnology.com/images/iconos/box.png" alt="" class="rounded-lg h-10 w-10 bg-white shadow mr-2">

                              @endif
                              <div class="flex-grow">
                                    <h5 class="text-sm">{{Str::limit($orden->producto->name,12)}}</h5>
                                    <p class="text-xs block" >{{$orden->producto->precio}}</p>
                              </div>
                              <div class="py-1">
                                    <div class="w-28 flex gap-2 ml-2">
                                       <button wire:click="ordendown({{$orden->id}})" class="px-2 rounded-lg text-center py-1 text-white bg-blue-gray-600 hover:bg-blue-gray-700 focus:outline-none">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-3 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                          </svg>
                                       </button>
                                       <input value="{{$orden->cantidad}}" type="text" class="w-12 bg-white rounded-lg text-center shadow focus:outline-none focus:shadow-lg text-sm">
                                       <button wire:click="ordenup({{$orden->id}})" class="px-2 rounded-lg text-center py-1 text-white bg-blue-gray-600 hover:bg-blue-gray-700 focus:outline-none">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-3 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                          </svg>
                                       </button>
                                    </div>
                              </div>
                           </div>
                           @php
                              $total+=$orden->producto->precio*$orden->cantidad;
                           @endphp
                        @endforeach
                           

                     </div>
                  </div>
                  <!-- end of cart items -->

                  
               @endif
               
            @endif
            <!-- payment info -->
            <div class="select-none h-auto w-full text-center pt-3 pb-4 px-4">
                <div class="flex mb-3 text-lg font-semibold text-blue-gray-700">
                <div>TOTAL</div>
                <div class="text-right w-full">${{number_format($total,0)}}</div>
                </div>
                <div class="mb-3 text-blue-gray-700 px-3 pt-2 pb-3 rounded-lg bg-blue-gray-50">
                <div class="flex text-lg font-semibold">
                <div class="flex-grow text-left">DINERO</div>
                <div class="flex text-right">
                    <div class="mr-2">Clp</div>
                    <input type="text" class="w-28 text-right bg-white shadow rounded-lg focus:bg-white focus:shadow-lg px-2 focus:outline-none">
                </div>
                </div>
                <hr class="my-2">
                <div class="grid grid-cols-3 gap-2 mt-2">
                
                    <button class="bg-white rounded-lg shadow hover:shadow-lg focus:outline-none inline-block px-2 py-1 text-sm">+<span>5000</span></button>
                </div>
                </div>
                <div
                
                class="flex mb-3 text-lg font-semibold bg-cyan-50 text-blue-gray-700 rounded-lg py-2 px-3"
                >
                <div class="text-cyan-800">CHANGE</div>
                <div
                class="text-right flex-grow text-cyan-600">
                </div>
                </div>
                <div
        
                class="flex mb-3 text-lg font-semibold bg-pink-100 text-blue-gray-700 rounded-lg py-2 px-3"
                >
                <div class="text-right flex-grow text-pink-600">
                </div>
                </div>

                <div class="flex justify-center mb-3 text-lg font-semibold bg-cyan-50 text-cyan-700 rounded-lg py-2 px-3">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                  </svg>
                </div>

                <button  class="text-gray-900 rounded-2xl text-lg w-full py-3 focus:outline-none" >
                     SUBMIT
                </button>
                <div class="p-4 w-full">
                  @if ($current)
                  {{-- comment
                     <button wire:click="imprimirTicket({{$current->id}})" class="bg-cyan-500 text-white text-lg px-4 py-3 rounded-2xl w-full focus:outline-none" >PROCEED</button>
                   --}}
                     <button wire:click="printToThermalPrinter({{$current->id}})" class="bg-cyan-500 text-white text-lg px-4 py-3 rounded-2xl w-full focus:outline-none mt-2" >IMPRIMIR</button>
                  @endif
               </div>

            </div>
            <!-- end of payment info -->
        </div>
        <div class="bg-white rounded-3xl flex flex-col shadow mt-4">
       
         <!-- payment info -->
         <div class="select-none h-auto w-full text-center pt-3 pb-4 px-4">
             <div class="flex mb-3 text-lg font-semibold text-blue-gray-700">
             <div>CAJA 1</div>
             <div class="text-right w-full">${{number_format($total,0)}}</div>
             </div>
             <div class="mb-3 text-blue-gray-700 px-3 pt-2 pb-3 rounded-lg bg-blue-gray-50">
             <div class="flex text-lg font-semibold">
             <div class="flex-grow text-left">DINERO</div>
             <div class="flex text-right">
                 <div class="mr-2">Clp</div>
                 <input type="text" class="w-28 text-right bg-white shadow rounded-lg focus:bg-white focus:shadow-lg px-2 focus:outline-none">
             </div>
             </div>
             <hr class="my-2">
            
         </div>
         <!-- end of payment info -->
     </div>
    </div>
  <!-- end of right sidebar -->
</div>



<!-- modal receipt -->
<div class="fixed w-full h-screen left-0 top-0 z-10 flex flex-wrap justify-center content-center p-24 hidden">
  
    <div class="w-96 rounded-3xl bg-white shadow-xl overflow-hidden z-10">
        <div class="text-left w-full text-sm p-6 overflow-auto">
        <div class="text-center">
            <img src="img/receipt-logo.png" alt="Tailwind POS" class="mb-3 w-8 h-8 inline-block">
            <h2 class="text-xl font-semibold">TAILWIND POS</h2>
            <p>CABANG KONOHA SELATAN</p>
        </div>
        <div class="flex mt-4 text-xs">
            <div class="flex-grow">No: <span ></span></div>
            <div ></div>
        </div>
        <hr class="my-2">
        <div>
            <table class="w-full text-xs">
            <thead>
            <tr>
                <th class="py-1 w-1/12 text-center">#</th>
                <th class="py-1 text-left">Item</th>
                <th class="py-1 w-2/12 text-center">Qty</th>
                <th class="py-1 w-3/12 text-right">Subtotal</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="py-2 text-center"></td>
                    <td class="py-2 text-left">
                    <span ></span>
                    <br/>
                    <small></small>
                    </td>
                    <td class="py-2 text-center" ></td>
                    <td class="py-2 text-right" ></td>
                </tr>
            </tbody>
            </table>
        </div>
        <hr class="my-2">
        <div>
            <div class="flex font-semibold">
            <div class="flex-grow">TOTAL</div>
            <div></div>
            </div>
            <div class="flex text-xs font-semibold">
            <div class="flex-grow">PAY AMOUNT</div>
            <div ></div>
            </div>
            <hr class="my-2">
            <div class="flex text-xs font-semibold">
            <div class="flex-grow">CHANGE</div>
            <div ></div>
            </div>
        </div>
        </div>
        <div class="p-4 w-full">
         <button class="bg-cyan-500 text-white text-lg px-4 py-3 rounded-2xl w-full focus:outline-none" x-on:click="printAndProceed()">PROCEED</button>
        </div>
        </div>
    </div>
</div>
<!-- end of noprint-area -->

<div id="print-area" class="print-area">
  
</div>



</main>

 

</div>
