<x-app-layout>

    <x-slot name="tl">
            
        <title>{{$producto->name}}</title>
        
        
    </x-slot>

                  
              <div class="max-w-7xl mx-auto mt-6 ">
                <nav aria-label="breadcrumb" class="block w-full">
                  <ol class="flex w-full flex-wrap items-center rounded-md bg-blue-gray-50 bg-opacity-60 py-2 px-4">
                    <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-blue-gray-900 antialiased transition-colors duration-300 hover:text-pink-500">
                      <a class="opacity-60" href="#">
                        <span>Docs</span>
                      </a>
                      <span class="pointer-events-none mx-2 select-none font-sans text-sm font-normal leading-normal text-blue-gray-500 antialiased">
                        /
                      </span>
                    </li>
                    <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-blue-gray-900 antialiased transition-colors duration-300 hover:text-pink-500">
                      <a class="opacity-60" href="#">
                        <span>Components</span>
                      </a>
                      <span class="pointer-events-none mx-2 select-none font-sans text-sm font-normal leading-normal text-blue-gray-500 antialiased">
                        /
                      </span>
                    </li>
                    <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-blue-gray-900 antialiased transition-colors duration-300 hover:text-pink-500">
                      <a
                        class="font-medium text-blue-gray-900 transition-colors hover:text-pink-500"
                        href="#"
                      >
                        Breadcrumbs
                      </a>
                    </li>
                  </ol>
                </nav>
              </div>

                <div class="max-w-7xl mx-auto bg-white mb-10">
                  <div class="mb-6 pb-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="order-1 lg:col-span-2 lg:order-1">
                        <section class="">
                            <div class="px-2 md:px-6 md:py-4">
                                
                                  <div class="grid grid-cols-2 md:grid-cols-5">
                                    <div class="col-span-2 md:col-span-3 md:px-4">
                                      <div x-data="{ image: 1 }" x-cloak>
                                        <div class="h-80 md:h-92 rounded-lg bg-gray-100 mb-4">
                                          <div x-show="image === 1" class="h-80 md:h-92   rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
                                              
                                              <div class="flex justify-center">
                                                  <img src="{{Storage::url($producto->image)}}" class="h-80 md:h-92 object-contain" alt="">
                                               </div>
                                          </div>
                              
                                          <div x-show="image === 2" class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
                                            <span class="text-5xl">2</span>
                                          </div>
                              
                                          <div x-show="image === 3" class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
                                            <span class="text-5xl">3</span>
                                          </div>
                              
                                          <div x-show="image === 4" class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
                                            <span class="text-5xl">4</span>
                                          </div>
                                        </div>
                              
                                        <div class="hidden md:flex mx-2 mb-4">
                                          <template x-for="i in 4">
                                            <div class="flex-1 px-2">
                                              <button x-on:click="image = i" :class="{ 'ring-2 ring-indigo-300 ring-inset': image === i }" class="focus:outline-none w-full rounded-lg h-24 md:h-32 bg-gray-100 flex items-center justify-center">
                                                  <div class="flex justify-center p-3">
                                                      <img src="{{Storage::url($producto->image)}}" class="p-2 h-20 w-20 md:h-24   md:w-24 object-cover" alt="">
                                                  </div>
                                              </button>
                                            </div>
                                          </template>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-span-2 md:px-4 mx-2">
                                      <h2 class="mb-2 leading-tight tracking-tight font-bold text-gray-800 text-2xl md:text-3xl">{{$producto->name}}</h2>
                                      @if ($producto->tienda)
                                            <p class="text-gray-500 text-sm">Vende: <a href="{{Route('tiendas.show',$producto->tienda)}}" class="text-indigo-600 hover:underline">{{$producto->tienda->nombre}}</a></p>
                                      @endif
                                      <div class="flex items-center space-x-4 my-4">
                                        <div>
                                          <div class="rounded-lg bg-gray-100 flex py-2 px-3">
                                            <span class="text-indigo-400 mr-1 mt-1">$</span>
                                            <span class="font-bold text-indigo-600 text-3xl">{{number_format($producto->precio)}}</span>
                                          </div>
                                        </div>
                                        <div class="flex-1">
                                          <p class="text-green-500 text-xl font-semibold">Save 12%</p>
                                          <p class="text-gray-400 text-sm">Inclusive of all Taxes.</p>
                                        </div>
                                      </div>
                              
                                      <p class="text-gray-500">
                                          @if ($producto->descripcion)
                                              {{$producto->descripcion}}
                                          @endif
                                      </p>
                              
                                      <div class="flex justify-between py-4 space-x-4">
                                        <div class="relative my-auto">
                                            <div class="text-center left-0 pt-2 right-0 absolute block text-xs uppercase text-gray-400 tracking-wide font-semibold mb-2">Talla</div>
                                            <select class="cursor-pointer appearance-none rounded-xl border mx-auto text-base border-gray-200 pl-4 pr-8 h-14 flex items-end pb-1 w-32 text-center">
                                            <option>S</option>
                                            <option>M</option>
                                            <option>L</option>
                                            <option>XL</option>
                                            <option>XXL</option>
                                            </select>
                            
                                      
                                        </div>
                                       
                                    </div>
                                    
                                      
                                    
                                    </div>
                                  </div>
                              
                              
                            </div>
        
                        </section>
        
                      
                    </div>
                    <div class="order-2 lg:order-2">
                        <section class="card m-4 border-2 rounded-lg">
                            <div class="card-body">
                              <div class="flex justify-between py-4 space-x-4">
                                  <div class="relative my-auto">
                                      <div class="text-center left-0 pt-2 right-0 absolute block text-xs uppercase text-gray-400 tracking-wide font-semibold mb-2">Cantidad</div>
                                      <select class="cursor-pointer appearance-none rounded-xl border mx-auto text-base border-gray-200 pl-4 pr-8 h-14 flex items-end pb-1 w-32 text-center">
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                      </select>
                      
                                
                                  </div>
                                 
                              </div>
                              <div class="w-full z-1 rounded overflow-hidden">
                                <div class="">
                                    <a href="https://api.whatsapp.com/send?phone=56963176726&text=Hola,%20quiero%20m%C3%A1s%20informaci%C3%B3n%20sobre%20{{str_replace(' ', '%20', $producto->name)}}" target="_blank">
                                        
                                        <button class="w-full mb-2 h-14 px-6 py-2 font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white">
                                            Agregar al Carro
                                        </button>
                                    </a>
                                   
                                </div>  
                                <div class="">
                               
                                  <a href="https://api.whatsapp.com/send?phone=56963176726&text=Hola,%20quiero%20m%C3%A1s%20informaci%C3%B3n%20sobre%20{{str_replace(' ', '%20', $producto->name)}}" target="_blank">
                                    <button class="w-full h-14 px-6 py-2 font-semibold rounded-xl bg-red-600 hover:bg-red-500 text-white">
                                        Comprar
                                    </button>
                                  </a>
                                </div>               
                                <div class="flex justify-center mt-6 mb-12">
                                <ul>
                                    <li class="flex items-center">
                                    <div class="bg-yellow-200 rounded-full p-2 fill-current text-yellow-700">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-umbrella"><path class="primary" d="M11 3.05V2a1 1 0 0 1 2 0v1.05A10 10 0 0 1 22 13c0 1.33-2 1.33-2 0a2 2 0 1 0-4 0c0 1.33-2 1.33-2 0a2 2 0 1 0-4 0c0 1.33-2 1.33-2 0a2 2 0 1 0-4 0c0 1.33-2 1.33-2 0a10 10 0 0 1 9-9.95z"/><path class="secondary" d="M11 14a1 1 0 0 1 2 0v5a3 3 0 0 1-6 0 1 1 0 0 1 2 0 1 1 0 0 0 2 0v-5z"/></svg>
                                    </div>
                                    <span class="text-gray-700 text-lg ml-3">Despacho a todo Chile</span>
                                    </li>
                                    <li class="flex items-center mt-3">
                                    <div class="bg-yellow-200 rounded-full p-2 fill-current text-yellow-700">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-shopping-bag"><path class="primary" d="M5 8h14a1 1 0 0 1 1 .92l1 12A1 1 0 0 1 20 22H4a1 1 0 0 1-1-1.08l1-12A1 1 0 0 1 5 8z"/><path class="secondary" d="M9 10a1 1 0 0 1-2 0V7a5 5 0 1 1 10 0v3a1 1 0 0 1-2 0V7a3 3 0 0 0-6 0v3z"/></svg>
                                    </div>
                                    <span class="text-gray-700 text-lg ml-3">Paga con tarjetas debito y crédito</span>
                                    </li>
                                    <li class="flex items-center mt-3">
                                    <div class="bg-yellow-200 rounded-full p-2 fill-current text-yellow-700">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-pie-chart"><path class="primary" d="M14 13h6.78a1 1 0 0 1 .97 1.22A10 10 0 1 1 9.78 2.25a1 1 0 0 1 1.22.97V10a3 3 0 0 0 3 3z"/><path class="secondary" d="M20.78 11H14a1 1 0 0 1-1-1V3.22a1 1 0 0 1 1.22-.97c3.74.85 6.68 3.79 7.53 7.53a1 1 0 0 1-.97 1.22z"/></svg>
                                    </div>
                                    <span class="text-gray-700 text-lg ml-3">2-3 Dias Hábiles en Despachar</span>
                                    </li>
                                </ul>
                                </div>
                            
                              </div>
                            </div>
                        </section>
        
                     
                    </div>
        
                  </div>

                </div>

                <h1 class="text-center py-6">Todos Los derechos Reservados</h1>
              

</x-app-layout>