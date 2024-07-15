<x-app-layout>

    <x-slot name="tl">
            
        <title>Foros | RidersChilenos</title>
        
        
    </x-slot>

        
     

        <div class="max-w-7xl mx-auto pb-8 mt-10 mb-20">

            <div class="container grid grid-cols-1 lg:grid-cols-4 gap-6">
            
                <div class="order-2 lg:col-span-3 lg:order-1">
    
                  
    
                    <section class="mb-8">
                        
                        <header class="border border-gray-200 px-4 py-2 cursor bg-gray-200 flex items-center">
                                <ol class="list-none p-0 inline-flex space-x-2">
                                  <li class="flex items-center">
                                    <svg onclick="window.location.href='/foros';" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" class="cursor-pointer hover:fill-blue-500 transition-colors duration-300" fill="#4b5563"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>        <span class="mx-2">/</span>
                                  </li>
                                  <li class="flex items-center">
                                    <a href="{{Route('foros.index')}}" class="text-gray-600 hover:text-blue-500 transition-colors duration-300">FOROS</a>
                                    <span class="mx-2">/</span>
                                  </li>
                                 
                                </ol>
                           
                             
                          
                            
                        </header>

                        <div class="card p-2 lg:p-4">
    
                               <h1 class="font-bold text-2xl mb-2 text-gray-800 text-center">-- PÚBLICO GENERAL --</h1>
                            
                        
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                @foreach ($foros as $foro)
                                    @if ($foro->categoria=="PUBLICO GENERAL")
                                       
                                            <div class="bg-gray-800 text-white rounded-md p-2">
                                                <div class="flex items-center">
                                                    
                                                    <div class="flex justify-between w-full">
                                                      
                                                        <div class="flex items-center">
                                                            <div class="p-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                                                                </svg>
    
                                                            </div>
                                                             <a href="{{Route('foros.show',$foro)}}" class="hover:underline hover:underline-offset-4 ">{{$foro->titulo}} </a>
                                                        </div>
                                                        <div class="flex items-center mr-2">
                                                            <a href="{{Route('foros.show',$foro)}}">
                                                              
                                                                <span class="flex items-center"> 
                                                                    {{$foro->vistas}}
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-1 w-4 h-4">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                    </svg>                      
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <hr class="w-full my-2">
                                                    <div class="">
                                                        <h1>ULTIMO</h1>
                                                        @if ($foro->temas->count()>0)
                                                            <a href="{{Route('foros.show',$foro)}}" class="whitespace-nowrap ml-2">{{$foro->temas->reverse()->first()->titulo}}</a>
                                                        @else
                                                            <a href="{{Route('foros.show',$foro)}}" class="whitespace-nowrap ml-2">Sin temas abiertos</a>
                                                        @endif
                                                    </div>
                                                    @if ($foro->temas->count()>0)
                                                        <div class="">
                                                            <h1>por</h1>
                                                            <a href="{{Route('foros.show',$foro)}}" class="whitespace-nowrap ml-2">{{$foro->temas->reverse()->first()->user->name}}</a>
                                                        </div>
                                                    @endif
                                                   
                                            
                                            </div>
                                      
                                    @endif
                                @endforeach
                          

                            </div>

                            <h1 class="font-bold text-2xl mb-2 mt-10 text-gray-800 text-center">-- FOROS POR DISCIPLINA --</h1>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                
                                @foreach ($foros as $foro)
                                    @if ($foro->categoria=="DISCIPLINA")
                                        <div class="bg-gray-800 text-white rounded-md p-2">
                                            <div class="flex items-center">
                                                
                                                <div class="flex justify-between w-full">
                                                
                                                    <div class="flex items-center">
                                                        <div class="p-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                                                            </svg>

                                                        </div>
                                                        <a href="{{Route('foros.show',$foro)}}" class="hover:underline hover:underline-offset-4 ">{{$foro->titulo}} </a>
                                                    </div>
                                                    <div class="flex items-center mr-2">
                                                        <a href="{{Route('foros.show',$foro)}}">
                                                            <span class="flex items-center">
                                                                {{$foro->vistas}}
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-1 w-4 h-4">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                </svg>      
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <hr class="w-full my-2">
                                                    <div class="">
                                                        <h1>ULTIMO:</h1>
                                                        @if ($foro->temas->count()>0)
                                                            <a href="{{Route('foros.show',$foro)}}" class="whitespace-nowrap ml-2">{{$foro->temas->reverse()->first()->titulo}}</a>
                                                        @else
                                                            <a href="{{Route('foros.show',$foro)}}" class="whitespace-nowrap ml-2">Sin temas abiertos</a>
                                                        @endif
                                                    </div>
                                                    @if ($foro->temas->count()>0)
                                                        <div class="">
                                                            <h1>Por:</h1>
                                                            <a href="{{Route('foros.show',$foro)}}" class="whitespace-nowrap ml-2">{{$foro->temas->reverse()->first()->user->name}}</a>
                                                        </div>
                                                    @endif
                                        
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                            
                            {{-- commen
                            <p class="text-gray-700 text-base">DESCRIPCIÓN</p>
    
                       
                            
                            <h1 class="font-bold text-xl my-4 text-gray-800">La organización estipula 5 fechas para este campeonato.</h1>
                           
                          
                                <ul class="grid grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 mt-8">
                                       
                                        <li class="text-center"><img class="h-40 w-full object-contain" src="" alt=""> 
                                          
                                                Entrenamiento 10
                                        
                                        </li>
                                      
                                        
                                        
                                   
                                </ul>
                          t --}}
                        </div>
    
                    </section>
    
                     {{-- comment
    
                    <section class="mb-8">
                        
    
                        <header class="border border-gray-200 px-4 py-2 cursor bg-gray-200 mt-6 flex items-center">
                            <div>
                                    <h1 class="font-bold text-lg text-gray-800">Riders Con Entrada</h1>
                              
                            </div>
                                <div class="w-full">
                                    <p class="text-gray-600 text-sm text-center">60% de la meta completada</p>
                                    <div class="relative pt-1 pb-4">
                                        <div class="overflow-hidden h-2 text-xs flex rounded bg-white">
                                        <div style="width:60%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-600 transition-all duration-500">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                          
                            
                        </header>
    
                        <div class="bg-white">
    
    
                          lista
                     
                        </div>
                    </section>
                   
                       
                            <div class="mb-12 py-20">
                                @livewire('eventos-reviews',['evento' => $evento])
                            </div>
                        --}}
                   
                </div>
    
    
                <div class="order-1 lg:order-2">
                  
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4">
                        <section class="card mb-4">
                            @if (auth()->user())
                                <div class="p-3">
                                    <h1 class="text-xl mx-2 font-bold cursor-pointer flex items-center" >Hola {{Auth()->user()->name}}</h1>
                                </div>
                            @else
                                <div class="">
                                    <div class="flex justify-center w-full">

                                        <a href="https://riderschilenos.cl/login-google" class="w-full mx-2">
                                            <button class="flex justify-center btn bg-blue-500 text-white w-full items-center justify-items-center mt-2"><svg class="mr-2 -ml-1 w-4 h-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512"><path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path></svg>Ingresar Con Google<div></div></button>
                                        </a>
                                    
                                    </div>
                                    <div class="flex justify-center w-full">

                                        <a href="{{route('register')}}" class="w-full mx-2">
                                            <button class="btn btn-danger w-full items-center justify-items-center mt-2">REGISTRO</button>
                                        </a>
                                    </div>
                                    <div class="flex justify-center mb-2 w-full">
                                        <a href="{{route('login')}}" class="w-full mx-2">
                                            <button class="btn btn-danger w-full items-center justify-items-center mt-2">INICIAR SESION</button>
                                        </a>

                                    </div>
            
                            
                                
            
                                
                                    
                                
            
                                </div>
                            @endif
                        </section>
                        <section class="card mb-4">
                            <div class="p-2">
                                <div class="flex items-center mb-4">
                                    
                                    
                                    <div class="">
                                      
                                        @livewire('socio.online-status',['type'=>'foro'])
                                               
                                                
                                    </div>
                                </div>
        
                        
                            
        
                            
                                
                            
        
                            </div>
        
                        </section>
                    </div>
                    <section class="card mb-4">
                        <div class="p-2">
                            <div class="flex items-center mb-4">
                                
                                
                                <div class="">
                                    <h1 class="font-fold text-gray-500 text-lg">Estadisticas del Foro</h1>

                                    
                                </div>
                            </div>
                            <div class="flex justify-between w-full">
                                <h1>Temas</h1>
                                <h1>{{$temas->count()}}</h1>
                            
                            </div>    
                            <div class="flex justify-between w-full">
                                <h1>Mensajes</h1>
                                <h1>{{$posts->count()}}</h1>
                            
                            </div>    
                            <div class="flex justify-between w-full">
                                <h1>Miembros</h1>
                                <h1>{{number_format($socios->count())}}</h1>
                            
                            </div>    
                      
                           
    
                          
                            
                          
    
                        </div>
    
                    </section>
    
                    @can('Super admin')
                    <div class="">
                      
                        <div class="flex justify-center w-full">

                            <a href="{{route('foros.create')}}" class="w-full mx-2">
                                <button class="btn btn-danger w-full items-center justify-items-center mt-2">Gestionar Foros</button>
                            </a>
                        </div>
                      
    

                    </div>
                    @endcan
                
                    <aside class="hidden lg:hidden">
                            <article class="flex mb-6">
                                <img class="h-32 w-40 object-cover"src="" alt="">
                                <div class="ml-3">
                                    <h1>
                                        <a class="font-bold text-gray-500 mb-3" href="">TITULO</a>
                                    </h1>
    
                                    <div class="flex items-center mb-2">
                                        <img class="h-8 w-8 rounded-full shadow-lg object-cover" src="" alt="">
                                        <p class="text-gray-700 text-sm ml-2">NOMBRE</p>
                                    </div>
    
                                    <p class="text-sm"><i class="fas fa-star mr-2 text-yellow-400"></i>5</p>
                                </div>
                            </article>
                      
                    </aside>
                </div>
    
                
    
            </div>

        </div>  

   
</x-app-layout>