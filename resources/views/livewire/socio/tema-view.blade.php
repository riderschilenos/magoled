
<div class="max-w-7xl mx-auto pb-8 mt-10" x-data="{formcreate:false}">
    @php
    $dias=['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];
    @endphp
        <script>
        function handleFormAction(action) {
            const form = document.getElementById('myForm');
            if (action === 'storefotos') {
                form.action = 'temas.storefotos';
            } else if (action === 'submit') {
                form.action = '{{route("posts.store")}}';
            }
            form.submit();
        }
        </script>
   
    @php
        $socio=$tema->user->socio;
    @endphp

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
               <li class="flex items-center">
                   <a href="{{Route('foros.show',$tema->foro)}}" class="text-gray-600 hover:text-blue-500 transition-colors duration-300">{{$tema->foro->titulo}}</a>
                   <span class="mx-2">/</span>
                
               </li>
             </ol>
       </header>

       <div class="flex justify-between items-center mr-2 hidden">
           <h1 class="font-bold text-2xl mb-2 mt-4 px-4 text-gray-800">{{$tema->titulo}}</h1>
           
       </div>

       <div x-data="{fullview: false}" >            
          

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
           <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>



           <div class="bg-gray-100 pb-2">
             
               <!-- End of Navbar -->

               <div class="max-w-7xl mx-auto mb-5">
                   <div class="md:flex no-wrap md:-mx-2">
                       <!-- Left Side -->
                       <div class="w-full md:w-3/12 md:mx-2"  x-data="{open: true}" wire:ignore>
                           <!-- Profile Card -->
                               @switch($socio->status)
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
                                       <p class="ml-2 tracking-wide">{{ $socio->name." ".$socio->second_name }} {{ $socio->last_name }} </p>
                                           @if ($socio->status==1) 
                                               <div class="star-icon z-10 my-auto ml-2"> <!-- Contenedor de la estrella con z-index -->
                                                   <i class="fa fa-star text-yellow-400 text-xl my-auto items-center"></i> <!-- Estrella usando Font Awesome (ajusta el tamaño y el color según necesites) -->
                                               </div>
                                           @endif
                                       </div>
                                       
                                   </div>
                                       @can('perfil_propio', $socio)

                                       
                                           <a href="{{route('socio.edit',$socio)}}" class="ml-2"><h5 class="text-blue-600 font-bold text-sm cursor-pointer ml-4">(Editar)</h5></a>
                                       @else

                                           @can('Super admin')
                               
                           
                                               <div class="flex justify-center mb-3">
                                                   <a href="{{route('socio.points', $socio)}}">
                                                       <span class="bg-red-500 py-1 px-2 rounded text-white text-sm text-center flex">
                                                           @livewire('socio.point-count', ['socio' => $socio]) Pts
                                                       </span>
                                                   </a>
                                               </div>
                                           @endcan

                                       @endcan
                                       
                                  
                           </div>

                               <div class="grid grid-cols-3 sm:grid-cols-3">
                                   <div class="content-center items-center">
                                       <div class="image overflow-hidden" x-on:click="fullview=true">
                                           @if (str_contains($socio->user->profile_photo_url,'https://ui-'))
                                               <img class="h-32  w-24  mx-auto object-cover rounded-lg"
                                               src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg"
                                               alt="Rider Chileno">
                                           @else
                                               <img class="h-32 w-24  object-cover rounded-lg"
                                               src="{{ $socio->user->profile_photo_url }}"
                                               alt="{{ $socio->name." ".$socio->second_name }} {{ $socio->last_name }}">
               
                                           @endif
                                          
                                       </div>
                                       
                                       @can('perfil_propio', $socio)
                                           <h1 class="text-gray-400 font-bold text-xs leading-8 my-1 ml-auto"><a href="{{ route('profile.show') }}">Editar Foto</a></h1>
                                       @endcan
                                   </div>
                                   <div class="col-span-2 px-4 w-full">
                                       <a href="{{route('socio.show', $socio)}}">
                                           <h1 class="text-blue-400 font-bold text-lg leading-8 mb-1">{{ '@'.$socio->slug }}</h1>
                                       </a>  
                                       <div class="flex content-center">
                                           <div class="px-2 py-2 text-red-500 font-semibold content-center">
                                               <i class="fas fa-birthday-cake content-arount" aria-hidden="true"></i>
                                           </div>
                                           <div class="px-2 py-2 text-sm">{{date('d-m-Y', strtotime($socio->born_date))}}</div>
                                       </div>
                                   
                                       <div class="flex items-center content-center">
                                                   @if($socio->direccion)
                                                       <div class="px-2 py-2 text-red-500 font-semibold content-center">
                                                       <i class="fa fa-map-marker my-auto py-auto" aria-hidden="true"></i>
                                                   </div>
                                                   
                                                       <div class="px-2 py-2">{{Str::limit($socio->direccion->comuna.', '.$socio->direccion->region,20)}}</div>
                                                   @endif
                                       </div>

                                      

                                     

                                       
                                   </div>
                                   
                               </div>

                            


                                  
                               
                           
                                  
                            
                                   <ul
                                       class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm hidden">
                                       <li class="flex items-center py-3">
                                           <span>Suscripción</span>
                                               @switch($socio->status)
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
                        
                           <!-- Friends card -->
                           
                           <!-- End of friends card -->
                       </div>
                       <!-- Right Side -->
                       <div class="w-full md:w-9/12 mx-0 sm:mx-2 bg-white flex flex-col">
                           <!-- Profile tab -->
                           <!-- About Section -->
                           <!-- End of about section -->
                       
                           <!-- garage and movie -->
                           <div class="bg-white shadow-sm rounded-sm flex-grow">
                               <div class="grid grid-cols-1 sm:grid-cols-1">
                                   <div class="bg-white">
                                       <div class="items-center p-3 flex justify-between space-x-3 font-semibold text-gray-900 text-xl leading-8">
                                           <div class="flex items-center"> 
                                               <span class="text-red-500 font-bold">
                                                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                       <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                                                   </svg>
                                               </span>
                                               <span class="ml-2">{!!$tema->titulo!!}</span>
                                           </div>
                       
                                           <div class="hidden">
                                               @can('perfil_propio', $socio)  
                                               <a href="{{route('garage.vehiculo.create')}}"><span class="btn btn-danger text-white font-bold text-sm align-middle">Eliminar Tema</span></a>
                                               @endcan
                                           </div>
                                       </div>
                                       
                                       <h1 class="mx-4 mt-4 mb-16">{!!$tema->content!!}
                                   </div>
                               </div>
                           </div>
                       
                           <!-- Buttons -->
                           <div class="buttons flex mx-2 sm:mx-4 mb-2 justify-between  mt-auto">
                                <div class="inline-flex items-center rounded-md shadow-sm">
                                            
                                        @php
                                            $lk=0;
                                            $unlk=0;
                                        @endphp
                                        @if ($tema->likes)
                                            @foreach ($tema->likes as $like)
                                                @if ($like->type=="like")
                                                    @php
                                                        $lk+=1;
                                                    @endphp
                                                @elseif($like->type=="unlike")
                                                    @php
                                                        $unlk+=1;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                        @if (auth()->user())
                                            @php
                                                $check=false;
                                                foreach ($tema->likes as $like) {
                                                    if ($like->user_id==auth()->user()->id) {
                                                        $check=$like->id;
                                                        $checktype=$like->type;
                                                        break;
                                                    }else{
                                                        $check=false;
                                                    }
                                                }
                                            @endphp
                                            @if ($check!=false)
                                                @if ($checktype=='like')
                                                    <button class="text-blue-600 text-sm bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                                        <span>
                                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" class="text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M885.9 533.7c16.8-22.2 26.1-49.4 26.1-77.7 0-44.9-25.1-87.4-65.5-111.1a67.67 67.67 0 0 0-34.3-9.3H572.4l6-122.9c1.4-29.7-9.1-57.9-29.5-79.4A106.62 106.62 0 0 0 471 99.9c-52 0-98 35-111.8 85.1l-85.9 311H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h601.3c9.2 0 18.2-1.8 26.5-5.4 47.6-20.3 78.3-66.8 78.3-118.4 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7-.2-12.6-2-25.1-5.6-37.1zM184 852V568h81v284h-81zm636.4-353l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 22.4-13.2 42.6-33.6 51.8H329V564.8l99.5-360.5a44.1 44.1 0 0 1 42.2-32.3c7.6 0 15.1 2.2 21.1 6.7 9.9 7.4 15.2 18.6 14.6 30.5l-9.6 198.4h314.4C829 418.5 840 436.9 840 456c0 16.5-7.2 32.1-19.6 43z"></path></svg>
                                                        </span>
                                                    <span>{{$lk}}</span>
                                                    </button>
                                                @else
                                                    <button  wire:click='likeupdate({{$check}})' class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                                        <span>
                                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" class="text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M885.9 533.7c16.8-22.2 26.1-49.4 26.1-77.7 0-44.9-25.1-87.4-65.5-111.1a67.67 67.67 0 0 0-34.3-9.3H572.4l6-122.9c1.4-29.7-9.1-57.9-29.5-79.4A106.62 106.62 0 0 0 471 99.9c-52 0-98 35-111.8 85.1l-85.9 311H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h601.3c9.2 0 18.2-1.8 26.5-5.4 47.6-20.3 78.3-66.8 78.3-118.4 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7-.2-12.6-2-25.1-5.6-37.1zM184 852V568h81v284h-81zm636.4-353l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 22.4-13.2 42.6-33.6 51.8H329V564.8l99.5-360.5a44.1 44.1 0 0 1 42.2-32.3c7.6 0 15.1 2.2 21.1 6.7 9.9 7.4 15.2 18.6 14.6 30.5l-9.6 198.4h314.4C829 418.5 840 436.9 840 456c0 16.5-7.2 32.1-19.6 43z"></path></svg>
                                                        </span>
                                                    <span>{{$lk}}</span>
                                                    </button>
                                                @endif
                                                @if ($checktype=='unlike')
                                                    <button class="text-blue-600 text-sm bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                                        <span>
                                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" class="text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M885.9 490.3c3.6-12 5.4-24.4 5.4-37 0-28.3-9.3-55.5-26.1-77.7 3.6-12 5.4-24.4 5.4-37 0-28.3-9.3-55.5-26.1-77.7 3.6-12 5.4-24.4 5.4-37 0-51.6-30.7-98.1-78.3-118.4a66.1 66.1 0 0 0-26.5-5.4H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h129.3l85.8 310.8C372.9 889 418.9 924 470.9 924c29.7 0 57.4-11.8 77.9-33.4 20.5-21.5 31-49.7 29.5-79.4l-6-122.9h239.9c12.1 0 23.9-3.2 34.3-9.3 40.4-23.5 65.5-66.1 65.5-111 0-28.3-9.3-55.5-26.1-77.7zM184 456V172h81v284h-81zm627.2 160.4H496.8l9.6 198.4c.6 11.9-4.7 23.1-14.6 30.5-6.1 4.5-13.6 6.8-21.1 6.7a44.28 44.28 0 0 1-42.2-32.3L329 459.2V172h415.4a56.85 56.85 0 0 1 33.6 51.8c0 9.7-2.3 18.9-6.9 27.3l-13.9 25.4 21.9 19a56.76 56.76 0 0 1 19.6 43c0 9.7-2.3 18.9-6.9 27.3l-13.9 25.4 21.9 19a56.76 56.76 0 0 1 19.6 43c0 9.7-2.3 18.9-6.9 27.3l-14 25.5 21.9 19a56.76 56.76 0 0 1 19.6 43c0 19.1-11 37.5-28.8 48.4z"></path></svg>
                                                        </span>
                                                    <span>{{$unlk}}</span>
                                                    </button>
                                                @else
                                                    <button wire:click='likeupdate({{$check}})' class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                                        <span>
                                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" class="text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M885.9 490.3c3.6-12 5.4-24.4 5.4-37 0-28.3-9.3-55.5-26.1-77.7 3.6-12 5.4-24.4 5.4-37 0-28.3-9.3-55.5-26.1-77.7 3.6-12 5.4-24.4 5.4-37 0-51.6-30.7-98.1-78.3-118.4a66.1 66.1 0 0 0-26.5-5.4H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h129.3l85.8 310.8C372.9 889 418.9 924 470.9 924c29.7 0 57.4-11.8 77.9-33.4 20.5-21.5 31-49.7 29.5-79.4l-6-122.9h239.9c12.1 0 23.9-3.2 34.3-9.3 40.4-23.5 65.5-66.1 65.5-111 0-28.3-9.3-55.5-26.1-77.7zM184 456V172h81v284h-81zm627.2 160.4H496.8l9.6 198.4c.6 11.9-4.7 23.1-14.6 30.5-6.1 4.5-13.6 6.8-21.1 6.7a44.28 44.28 0 0 1-42.2-32.3L329 459.2V172h415.4a56.85 56.85 0 0 1 33.6 51.8c0 9.7-2.3 18.9-6.9 27.3l-13.9 25.4 21.9 19a56.76 56.76 0 0 1 19.6 43c0 9.7-2.3 18.9-6.9 27.3l-13.9 25.4 21.9 19a56.76 56.76 0 0 1 19.6 43c0 9.7-2.3 18.9-6.9 27.3l-14 25.5 21.9 19a56.76 56.76 0 0 1 19.6 43c0 19.1-11 37.5-28.8 48.4z"></path></svg>
                                                        </span>
                                                    <span>{{$unlk}}</span>
                                                    </button>
                                                @endif
                                                
                                            @else
                                                <button wire:click='temalike({{$tema->id}})' class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                                        <span>
                                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" class="text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M885.9 533.7c16.8-22.2 26.1-49.4 26.1-77.7 0-44.9-25.1-87.4-65.5-111.1a67.67 67.67 0 0 0-34.3-9.3H572.4l6-122.9c1.4-29.7-9.1-57.9-29.5-79.4A106.62 106.62 0 0 0 471 99.9c-52 0-98 35-111.8 85.1l-85.9 311H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h601.3c9.2 0 18.2-1.8 26.5-5.4 47.6-20.3 78.3-66.8 78.3-118.4 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7-.2-12.6-2-25.1-5.6-37.1zM184 852V568h81v284h-81zm636.4-353l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 22.4-13.2 42.6-33.6 51.8H329V564.8l99.5-360.5a44.1 44.1 0 0 1 42.2-32.3c7.6 0 15.1 2.2 21.1 6.7 9.9 7.4 15.2 18.6 14.6 30.5l-9.6 198.4h314.4C829 418.5 840 436.9 840 456c0 16.5-7.2 32.1-19.6 43z"></path></svg>
                                                        </span>
                                                    <span>{{$lk}}</span>
                                                </button>
                                            
                                                <button wire:click='temaunlike({{$tema->id}})' class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                                    <span>
                                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" class="text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M885.9 490.3c3.6-12 5.4-24.4 5.4-37 0-28.3-9.3-55.5-26.1-77.7 3.6-12 5.4-24.4 5.4-37 0-28.3-9.3-55.5-26.1-77.7 3.6-12 5.4-24.4 5.4-37 0-51.6-30.7-98.1-78.3-118.4a66.1 66.1 0 0 0-26.5-5.4H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h129.3l85.8 310.8C372.9 889 418.9 924 470.9 924c29.7 0 57.4-11.8 77.9-33.4 20.5-21.5 31-49.7 29.5-79.4l-6-122.9h239.9c12.1 0 23.9-3.2 34.3-9.3 40.4-23.5 65.5-66.1 65.5-111 0-28.3-9.3-55.5-26.1-77.7zM184 456V172h81v284h-81zm627.2 160.4H496.8l9.6 198.4c.6 11.9-4.7 23.1-14.6 30.5-6.1 4.5-13.6 6.8-21.1 6.7a44.28 44.28 0 0 1-42.2-32.3L329 459.2V172h415.4a56.85 56.85 0 0 1 33.6 51.8c0 9.7-2.3 18.9-6.9 27.3l-13.9 25.4 21.9 19a56.76 56.76 0 0 1 19.6 43c0 9.7-2.3 18.9-6.9 27.3l-13.9 25.4 21.9 19a56.76 56.76 0 0 1 19.6 43c0 9.7-2.3 18.9-6.9 27.3l-14 25.5 21.9 19a56.76 56.76 0 0 1 19.6 43c0 19.1-11 37.5-28.8 48.4z"></path></svg>
                                                    </span>
                                                    <span>{{$unlk}}</span>
                                                </button>
                                            @endif

                                        @else
                                                <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                                        <span>
                                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" class="text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M885.9 533.7c16.8-22.2 26.1-49.4 26.1-77.7 0-44.9-25.1-87.4-65.5-111.1a67.67 67.67 0 0 0-34.3-9.3H572.4l6-122.9c1.4-29.7-9.1-57.9-29.5-79.4A106.62 106.62 0 0 0 471 99.9c-52 0-98 35-111.8 85.1l-85.9 311H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h601.3c9.2 0 18.2-1.8 26.5-5.4 47.6-20.3 78.3-66.8 78.3-118.4 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7-.2-12.6-2-25.1-5.6-37.1zM184 852V568h81v284h-81zm636.4-353l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 22.4-13.2 42.6-33.6 51.8H329V564.8l99.5-360.5a44.1 44.1 0 0 1 42.2-32.3c7.6 0 15.1 2.2 21.1 6.7 9.9 7.4 15.2 18.6 14.6 30.5l-9.6 198.4h314.4C829 418.5 840 436.9 840 456c0 16.5-7.2 32.1-19.6 43z"></path></svg>
                                                        </span>
                                                    <span>{{$lk}}</span>
                                                </button>
                                                <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                                    <span>
                                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" class="text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M885.9 490.3c3.6-12 5.4-24.4 5.4-37 0-28.3-9.3-55.5-26.1-77.7 3.6-12 5.4-24.4 5.4-37 0-28.3-9.3-55.5-26.1-77.7 3.6-12 5.4-24.4 5.4-37 0-51.6-30.7-98.1-78.3-118.4a66.1 66.1 0 0 0-26.5-5.4H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h129.3l85.8 310.8C372.9 889 418.9 924 470.9 924c29.7 0 57.4-11.8 77.9-33.4 20.5-21.5 31-49.7 29.5-79.4l-6-122.9h239.9c12.1 0 23.9-3.2 34.3-9.3 40.4-23.5 65.5-66.1 65.5-111 0-28.3-9.3-55.5-26.1-77.7zM184 456V172h81v284h-81zm627.2 160.4H496.8l9.6 198.4c.6 11.9-4.7 23.1-14.6 30.5-6.1 4.5-13.6 6.8-21.1 6.7a44.28 44.28 0 0 1-42.2-32.3L329 459.2V172h415.4a56.85 56.85 0 0 1 33.6 51.8c0 9.7-2.3 18.9-6.9 27.3l-13.9 25.4 21.9 19a56.76 56.76 0 0 1 19.6 43c0 9.7-2.3 18.9-6.9 27.3l-13.9 25.4 21.9 19a56.76 56.76 0 0 1 19.6 43c0 9.7-2.3 18.9-6.9 27.3l-14 25.5 21.9 19a56.76 56.76 0 0 1 19.6 43c0 19.1-11 37.5-28.8 48.4z"></path></svg>
                                                    </span>
                                                    <span>{{$unlk}}</span>
                                                </button>
                                        @endif
                                    
                                    <button class="hidden text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-r-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                            </span>
                                        <span>Delete</span>
                                    </button>
                                </div>

                               <div class="inline-flex items-center rounded-md shadow-sm">
                                    <a href="#responder">
                                    <button wire:click="responder_tema({{$tema->id}})" class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-r-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path fill-rule="evenodd" d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                                                </svg>
                                                
                                            </span>
                                        <span>Responder</span>
                                    </button>
                                    </a>
                               </div>
                                 
                                 
                              
                           </div>
                         
                       </div>
                       
                       
                   </div>
               </div>
           </div>

           @foreach ($posts as $post)
               @php
                   $socio=$post->user->socio;
               @endphp
               <div class="bg-gray-100 pb-2">
               
                   <!-- End of Navbar -->
   
                   <div class="max-w-7xl mx-auto mb-5">
                       <div class="md:flex no-wrap md:-mx-2">
                           <!-- Left Side -->
                           <div class="w-full md:w-3/12 md:mx-2"  x-data="{open: true}" wire:ignore>
                               <!-- Profile Card -->
                                   @switch($socio->status)
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
                                           <p class="ml-2 tracking-wide">{{ $socio->name." ".$socio->second_name }} {{ $socio->last_name }} </p>
                                               @if ($socio->status==1) 
                                                   <div class="star-icon z-10 my-auto ml-2"> <!-- Contenedor de la estrella con z-index -->
                                                       <i class="fa fa-star text-yellow-400 text-xl my-auto items-center"></i> <!-- Estrella usando Font Awesome (ajusta el tamaño y el color según necesites) -->
                                                   </div>
                                               @endif
                                           </div>
                                           
                                       </div>
                                           @can('perfil_propio', $socio)
   
                                           
                                               <a href="{{route('socio.edit',$socio)}}" class="ml-2"><h5 class="text-blue-600 font-bold text-sm cursor-pointer ml-4">(Editar)</h5></a>
                                           @else
   
                                               @can('Super admin')
                                   
                               
                                                   <div class="flex justify-center mb-3">
                                                       <a href="{{route('socio.points', $socio)}}">
                                                           <span class="bg-red-500 py-1 px-2 rounded text-white text-sm text-center flex">
                                                               @livewire('socio.point-count', ['socio' => $socio]) Pts
                                                           </span>
                                                       </a>
                                                   </div>
                                               @endcan
   
                                           @endcan
                                           
                                   
                               </div>
   
                                   <div class="grid grid-cols-3 sm:grid-cols-3">
                                       <div class="content-center items-center">
                                           <div class="image overflow-hidden" x-on:click="fullview=true">
                                               @if (str_contains($socio->user->profile_photo_url,'https://ui-'))
                                                   <img class="h-32 w-24 mx-auto object-cover rounded-lg"
                                                   src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg"
                                                   alt="Rider Chileno">
                                               @else
                                                   <img class="h-32 w-24 object-cover rounded-lg"
                                                   src="{{ $socio->user->profile_photo_url }}"
                                                   alt="{{ $socio->name." ".$socio->second_name }} {{ $socio->last_name }}">
                   
                                               @endif
                                           
                                           </div>
                                           
                                           @can('perfil_propio', $socio)
                                               <h1 class="text-gray-400 font-bold text-xs leading-8 my-1 ml-auto"><a href="{{ route('profile.show') }}">Editar Foto</a></h1>
                                           @endcan
                                       </div>
                                       <div class="col-span-2  px-4 w-full">
                                           <a href="{{route('socio.show', $socio)}}">
                                               <h1 class="text-blue-400 font-bold text-lg leading-8 mb-1">{{ '@'.$socio->slug }}</h1>
                                           </a>  
                                           <div class="flex content-center">
                                               <div class="px-2 py-2 text-red-500 font-semibold content-center">
                                                   <i class="fas fa-birthday-cake content-arount" aria-hidden="true"></i>
                                               </div>
                                               <div class="px-2 py-2 text-sm">{{date('d-m-Y', strtotime($socio->born_date))}}</div>
                                           </div>
                                       
                                           <div class="flex items-center content-center">
                                                       @if($socio->direccion)
                                                           <div class="px-2 py-2 text-red-500 font-semibold content-center">
                                                           <i class="fa fa-map-marker my-auto py-auto" aria-hidden="true"></i>
                                                       </div>
                                                       
                                                           <div class="px-2 py-2">{{Str::limit($socio->direccion->comuna.', '.$socio->direccion->region,20)}}</div>
                                                       @endif
                                           </div>
   
                                       
   
                                               
                                         
   
                                           
                                       </div>
                                      
                                   </div>
   
                                  
   
   
   
                                   
                                   
                               
                                   
                               
                                       <ul
                                           class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm hidden">
                                           <li class="flex items-center py-3">
                                               <span>Suscripción</span>
                                                   @switch($socio->status)
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
                           
                               <!-- Friends card -->
                               
                               <!-- End of friends card -->
                           </div>
                           <!-- Right Side -->
                           <div class="w-full md:w-9/12 mx-0 sm:mx-2 bg-white flex flex-col">
                               <!-- Profile tab -->
                               <!-- About Section -->
                               <!-- End of about section -->
                           
                               <!-- garage and movie -->
                               <div class="bg-white shadow-sm rounded-sm flex-grow">
                                   <div class="grid grid-cols-1 sm:grid-cols-1">
                                       <div class="bg-white">
                                           <div class="items-center p-3 flex justify-between space-x-3 font-semibold text-gray-900 text-xl leading-8">
                                               <div class="flex items-center"> 
                                                   <span class="text-red-500 font-bold">
                                                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                           <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                                                       </svg>
                                                   </span>
                                                   <span class="ml-2">{!!$tema->titulo!!}</span>
                                               </div>
                           
                                               <div class="hidden">
                                                   @can('perfil_propio', $socio)  
                                                   <a href="{{route('garage.vehiculo.create')}}"><span class="btn btn-danger text-white font-bold text-sm align-middle">Eliminar Tema</span></a>
                                                   @endcan
                                               </div>
                                           </div>

                                            @if ($post->respuestatema)
                                                <div class="w-full px-2">
                                                    <table class="border-collapse w-full">
                                                        <thead>
                                                            <tr>
                                                                <th class="p-3 font-bold text-xs text-left  bg-yellow-200 text-gray-600 border border-gray-300 hidden lg:table-cell">{{$post->respuestatema->user->name}} Dijo:</th>
                                                            
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="bg-yellow-50 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-4 lg:mb-0">
                                                                <td class="w-full lg:w-auto px-3 pt-6 pb-3 text-gray-800 text-left border border-b block lg:table-cell relative lg:static">
                                                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">{{$post->respuestatema->user->name}} Dijo:</span>
                                                                    {!!$post->respuestatema->content!!}
                                                                </td>
                                                            
                                                            </tr>
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                            @if ($post->respuestapost)
                                                <div class="w-full px-2">
                                                    <table class="border-collapse w-full">
                                                        <thead>
                                                            <tr>
                                                                <th class="p-3 font-bold text-xs text-left  bg-yellow-200 text-gray-600 border border-gray-300 hidden lg:table-cell">{{$post->respuestapost->user->name}} Dijo:</th>
                                                            
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="bg-yellow-50 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-4 lg:mb-0">
                                                                <td class="w-full lg:w-auto px-3 pt-6 pb-3 text-gray-800 text-left border border-b block lg:table-cell relative lg:static">
                                                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">{{$post->respuestapost->user->name}} Dijo:</span>
                                                                    {!!$post->respuestapost->content!!}
                                                                </td>
                                                            
                                                            </tr>
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                           
                                           <h1 class="mx-4 mt-4 mb-16">{!!$post->content!!}</h1>
                                       </div>
                                   </div>
                               </div>
                           
                               <!-- Buttons -->
                               <div class="buttons flex mx-2 sm:mx-4 mb-2 justify-between  mt-auto">
                                <div class="inline-flex items-center rounded-md shadow-sm">
                                    @php
                                        $lk=0;
                                        $unlk=0;
                                    @endphp
                                    @if ($post->likes)
                                        @foreach ($post->likes as $like)
                                            @if ($like->type=="like")
                                                @php
                                                    $lk+=1;
                                                @endphp
                                            @elseif($like->type=="unlike")
                                                @php
                                                    $unlk+=1;
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (auth()->user())
                                        @php
                                            $check=false;
                                            foreach ($post->likes as $like) {
                                                if ($like->user_id==auth()->user()->id) {
                                                    $check=$like->id;
                                                    $checktype=$like->type;
                                                    break;
                                                }else{
                                                    $check=false;
                                                }
                                            }
                                        @endphp
                                        @if ($check!=false)
                                            @if ($checktype=='like')
                                                <button class="text-blue-600 text-sm bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                                    <span>
                                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" class="text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M885.9 533.7c16.8-22.2 26.1-49.4 26.1-77.7 0-44.9-25.1-87.4-65.5-111.1a67.67 67.67 0 0 0-34.3-9.3H572.4l6-122.9c1.4-29.7-9.1-57.9-29.5-79.4A106.62 106.62 0 0 0 471 99.9c-52 0-98 35-111.8 85.1l-85.9 311H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h601.3c9.2 0 18.2-1.8 26.5-5.4 47.6-20.3 78.3-66.8 78.3-118.4 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7-.2-12.6-2-25.1-5.6-37.1zM184 852V568h81v284h-81zm636.4-353l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 22.4-13.2 42.6-33.6 51.8H329V564.8l99.5-360.5a44.1 44.1 0 0 1 42.2-32.3c7.6 0 15.1 2.2 21.1 6.7 9.9 7.4 15.2 18.6 14.6 30.5l-9.6 198.4h314.4C829 418.5 840 436.9 840 456c0 16.5-7.2 32.1-19.6 43z"></path></svg>
                                                    </span>
                                                <span>{{$lk}}</span>
                                                </button>
                                            @else
                                                <button wire:click='likeupdate({{$check}})' class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                                    <span>
                                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" class="text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M885.9 533.7c16.8-22.2 26.1-49.4 26.1-77.7 0-44.9-25.1-87.4-65.5-111.1a67.67 67.67 0 0 0-34.3-9.3H572.4l6-122.9c1.4-29.7-9.1-57.9-29.5-79.4A106.62 106.62 0 0 0 471 99.9c-52 0-98 35-111.8 85.1l-85.9 311H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h601.3c9.2 0 18.2-1.8 26.5-5.4 47.6-20.3 78.3-66.8 78.3-118.4 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7-.2-12.6-2-25.1-5.6-37.1zM184 852V568h81v284h-81zm636.4-353l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 22.4-13.2 42.6-33.6 51.8H329V564.8l99.5-360.5a44.1 44.1 0 0 1 42.2-32.3c7.6 0 15.1 2.2 21.1 6.7 9.9 7.4 15.2 18.6 14.6 30.5l-9.6 198.4h314.4C829 418.5 840 436.9 840 456c0 16.5-7.2 32.1-19.6 43z"></path></svg>
                                                    </span>
                                                    <span>{{$lk}}</span>
                                                </button>
                                            @endif
                                            @if ($checktype=='unlike')
                                                <button class="text-blue-600 text-sm bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                                    <span>
                                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" class="text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M885.9 490.3c3.6-12 5.4-24.4 5.4-37 0-28.3-9.3-55.5-26.1-77.7 3.6-12 5.4-24.4 5.4-37 0-28.3-9.3-55.5-26.1-77.7 3.6-12 5.4-24.4 5.4-37 0-51.6-30.7-98.1-78.3-118.4a66.1 66.1 0 0 0-26.5-5.4H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h129.3l85.8 310.8C372.9 889 418.9 924 470.9 924c29.7 0 57.4-11.8 77.9-33.4 20.5-21.5 31-49.7 29.5-79.4l-6-122.9h239.9c12.1 0 23.9-3.2 34.3-9.3 40.4-23.5 65.5-66.1 65.5-111 0-28.3-9.3-55.5-26.1-77.7zM184 456V172h81v284h-81zm627.2 160.4H496.8l9.6 198.4c.6 11.9-4.7 23.1-14.6 30.5-6.1 4.5-13.6 6.8-21.1 6.7a44.28 44.28 0 0 1-42.2-32.3L329 459.2V172h415.4a56.85 56.85 0 0 1 33.6 51.8c0 9.7-2.3 18.9-6.9 27.3l-13.9 25.4 21.9 19a56.76 56.76 0 0 1 19.6 43c0 9.7-2.3 18.9-6.9 27.3l-13.9 25.4 21.9 19a56.76 56.76 0 0 1 19.6 43c0 9.7-2.3 18.9-6.9 27.3l-14 25.5 21.9 19a56.76 56.76 0 0 1 19.6 43c0 19.1-11 37.5-28.8 48.4z"></path></svg>
                                                    </span>
                                                <span>{{$unlk}}</span>
                                                </button>
                                            @else
                                                <button wire:click='likeupdate({{$check}})' class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                                    <span>
                                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" class="text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M885.9 490.3c3.6-12 5.4-24.4 5.4-37 0-28.3-9.3-55.5-26.1-77.7 3.6-12 5.4-24.4 5.4-37 0-28.3-9.3-55.5-26.1-77.7 3.6-12 5.4-24.4 5.4-37 0-51.6-30.7-98.1-78.3-118.4a66.1 66.1 0 0 0-26.5-5.4H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h129.3l85.8 310.8C372.9 889 418.9 924 470.9 924c29.7 0 57.4-11.8 77.9-33.4 20.5-21.5 31-49.7 29.5-79.4l-6-122.9h239.9c12.1 0 23.9-3.2 34.3-9.3 40.4-23.5 65.5-66.1 65.5-111 0-28.3-9.3-55.5-26.1-77.7zM184 456V172h81v284h-81zm627.2 160.4H496.8l9.6 198.4c.6 11.9-4.7 23.1-14.6 30.5-6.1 4.5-13.6 6.8-21.1 6.7a44.28 44.28 0 0 1-42.2-32.3L329 459.2V172h415.4a56.85 56.85 0 0 1 33.6 51.8c0 9.7-2.3 18.9-6.9 27.3l-13.9 25.4 21.9 19a56.76 56.76 0 0 1 19.6 43c0 9.7-2.3 18.9-6.9 27.3l-13.9 25.4 21.9 19a56.76 56.76 0 0 1 19.6 43c0 9.7-2.3 18.9-6.9 27.3l-14 25.5 21.9 19a56.76 56.76 0 0 1 19.6 43c0 19.1-11 37.5-28.8 48.4z"></path></svg>
                                                    </span>
                                                <span>{{$unlk}}</span>
                                                </button>
                                            @endif
                                            
                                        @else
                                            <button wire:click='like({{$post->id}})' class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                                    <span>
                                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" class="text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M885.9 533.7c16.8-22.2 26.1-49.4 26.1-77.7 0-44.9-25.1-87.4-65.5-111.1a67.67 67.67 0 0 0-34.3-9.3H572.4l6-122.9c1.4-29.7-9.1-57.9-29.5-79.4A106.62 106.62 0 0 0 471 99.9c-52 0-98 35-111.8 85.1l-85.9 311H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h601.3c9.2 0 18.2-1.8 26.5-5.4 47.6-20.3 78.3-66.8 78.3-118.4 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7-.2-12.6-2-25.1-5.6-37.1zM184 852V568h81v284h-81zm636.4-353l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 22.4-13.2 42.6-33.6 51.8H329V564.8l99.5-360.5a44.1 44.1 0 0 1 42.2-32.3c7.6 0 15.1 2.2 21.1 6.7 9.9 7.4 15.2 18.6 14.6 30.5l-9.6 198.4h314.4C829 418.5 840 436.9 840 456c0 16.5-7.2 32.1-19.6 43z"></path></svg>
                                                    </span>
                                                <span>{{$lk}}</span>
                                            </button>
                                        
                                            <button wire:click='unlike({{$post->id}})' class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                                <span>
                                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" class="text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M885.9 490.3c3.6-12 5.4-24.4 5.4-37 0-28.3-9.3-55.5-26.1-77.7 3.6-12 5.4-24.4 5.4-37 0-28.3-9.3-55.5-26.1-77.7 3.6-12 5.4-24.4 5.4-37 0-51.6-30.7-98.1-78.3-118.4a66.1 66.1 0 0 0-26.5-5.4H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h129.3l85.8 310.8C372.9 889 418.9 924 470.9 924c29.7 0 57.4-11.8 77.9-33.4 20.5-21.5 31-49.7 29.5-79.4l-6-122.9h239.9c12.1 0 23.9-3.2 34.3-9.3 40.4-23.5 65.5-66.1 65.5-111 0-28.3-9.3-55.5-26.1-77.7zM184 456V172h81v284h-81zm627.2 160.4H496.8l9.6 198.4c.6 11.9-4.7 23.1-14.6 30.5-6.1 4.5-13.6 6.8-21.1 6.7a44.28 44.28 0 0 1-42.2-32.3L329 459.2V172h415.4a56.85 56.85 0 0 1 33.6 51.8c0 9.7-2.3 18.9-6.9 27.3l-13.9 25.4 21.9 19a56.76 56.76 0 0 1 19.6 43c0 9.7-2.3 18.9-6.9 27.3l-13.9 25.4 21.9 19a56.76 56.76 0 0 1 19.6 43c0 9.7-2.3 18.9-6.9 27.3l-14 25.5 21.9 19a56.76 56.76 0 0 1 19.6 43c0 19.1-11 37.5-28.8 48.4z"></path></svg>
                                                </span>
                                                <span>{{$unlk}}</span>
                                            </button>
                                        @endif

                                    @else
                                            <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                                    <span>
                                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" class="text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M885.9 533.7c16.8-22.2 26.1-49.4 26.1-77.7 0-44.9-25.1-87.4-65.5-111.1a67.67 67.67 0 0 0-34.3-9.3H572.4l6-122.9c1.4-29.7-9.1-57.9-29.5-79.4A106.62 106.62 0 0 0 471 99.9c-52 0-98 35-111.8 85.1l-85.9 311H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h601.3c9.2 0 18.2-1.8 26.5-5.4 47.6-20.3 78.3-66.8 78.3-118.4 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7-.2-12.6-2-25.1-5.6-37.1zM184 852V568h81v284h-81zm636.4-353l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 22.4-13.2 42.6-33.6 51.8H329V564.8l99.5-360.5a44.1 44.1 0 0 1 42.2-32.3c7.6 0 15.1 2.2 21.1 6.7 9.9 7.4 15.2 18.6 14.6 30.5l-9.6 198.4h314.4C829 418.5 840 436.9 840 456c0 16.5-7.2 32.1-19.6 43z"></path></svg>
                                                    </span>
                                                <span>{{$lk}}</span>
                                            </button>
                                            <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                                <span>
                                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" class="text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M885.9 490.3c3.6-12 5.4-24.4 5.4-37 0-28.3-9.3-55.5-26.1-77.7 3.6-12 5.4-24.4 5.4-37 0-28.3-9.3-55.5-26.1-77.7 3.6-12 5.4-24.4 5.4-37 0-51.6-30.7-98.1-78.3-118.4a66.1 66.1 0 0 0-26.5-5.4H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h129.3l85.8 310.8C372.9 889 418.9 924 470.9 924c29.7 0 57.4-11.8 77.9-33.4 20.5-21.5 31-49.7 29.5-79.4l-6-122.9h239.9c12.1 0 23.9-3.2 34.3-9.3 40.4-23.5 65.5-66.1 65.5-111 0-28.3-9.3-55.5-26.1-77.7zM184 456V172h81v284h-81zm627.2 160.4H496.8l9.6 198.4c.6 11.9-4.7 23.1-14.6 30.5-6.1 4.5-13.6 6.8-21.1 6.7a44.28 44.28 0 0 1-42.2-32.3L329 459.2V172h415.4a56.85 56.85 0 0 1 33.6 51.8c0 9.7-2.3 18.9-6.9 27.3l-13.9 25.4 21.9 19a56.76 56.76 0 0 1 19.6 43c0 9.7-2.3 18.9-6.9 27.3l-13.9 25.4 21.9 19a56.76 56.76 0 0 1 19.6 43c0 9.7-2.3 18.9-6.9 27.3l-14 25.5 21.9 19a56.76 56.76 0 0 1 19.6 43c0 19.1-11 37.5-28.8 48.4z"></path></svg>
                                                </span>
                                                <span>{{$unlk}}</span>
                                            </button>
                                    @endif
                                 
                                   <button class="hidden text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-r-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                       <span>
                                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                           <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                         </svg>
                                         </span>
                                       <span>Delete</span>
                                   </button>
                               </div>

                                <div class="inline-flex items-center rounded-md shadow-sm">
                                        <a href="#responder">
                                        <button wire:click="responder_post({{$post->id}})" class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-r-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path fill-rule="evenodd" d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                                                    </svg>
                                                    
                                                </span>
                                            <span>Responder</span>
                                        </button>
                                        </a>
                                </div>
                                    
                                    
                                
                            </div>

                             
                           </div>
                           
                           
                       </div>
                   </div>
               </div>
           @endforeach

           <div class="bg-gray-100 pb-2">
             
               <!-- End of Navbar -->
           
               <div class="max-w-7xl mx-auto mb-5">
                   <div class="md:flex no-wrap md:-mx-2">
                       <!-- Left Side -->
                       <div class="w-full md:w-3/12 md:mx-2"  x-data="{open: true}" wire:ignore>
                           @if (auth()->user())
                                @if (auth()->user()->socio)
                                    @php
                                        $socio=auth()->user()->socio;
                                    @endphp
                                    <div>
                                        <!-- Profile Card -->
                                        @switch($socio->status)
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
                                                    <p class="ml-2 tracking-wide">{{ $socio->name." ".$socio->second_name }} {{ $socio->last_name }} </p>
                                                        @if ($socio->status==1) 
                                                            <div class="star-icon z-10 my-auto ml-2"> <!-- Contenedor de la estrella con z-index -->
                                                                <i class="fa fa-star text-yellow-400 text-xl my-auto items-center"></i> <!-- Estrella usando Font Awesome (ajusta el tamaño y el color según necesites) -->
                                                            </div>
                                                        @endif
                                                    </div>
                                                    
                                                </div>
                                                    @can('perfil_propio', $socio)
            
                                                    
                                                        <a href="{{route('socio.edit',$socio)}}" class="ml-2"><h5 class="text-blue-600 font-bold text-sm cursor-pointer ml-4">(Editar)</h5></a>
                                                    @else
            
                                                        @can('Super admin')
                                            
                                        
                                                            <div class="flex justify-center mb-3">
                                                                <a href="{{route('socio.points', $socio)}}">
                                                                    <span class="bg-red-500 py-1 px-2 rounded text-white text-sm text-center flex">
                                                                        @livewire('socio.point-count', ['socio' => $socio]) Pts
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        @endcan
            
                                                    @endcan
                                                    
                                            
                                        </div>

                                        <div class="grid grid-cols-3 sm:grid-cols-3">
                                            <div class="content-center items-center">
                                                <div class="image overflow-hidden" x-on:click="fullview=true">
                                                    @if (str_contains($socio->user->profile_photo_url,'https://ui-'))
                                                        <img class="h-32 w-24 mx-auto object-cover rounded-lg"
                                                        src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg"
                                                        alt="Rider Chileno">
                                                    @else
                                                        <img class="h-32 w-24 object-cover rounded-lg"
                                                        src="{{ $socio->user->profile_photo_url }}"
                                                        alt="{{ $socio->name." ".$socio->second_name }} {{ $socio->last_name }}">
                        
                                                    @endif
                                                    
                                                </div>
                                                
                                                @can('perfil_propio', $socio)
                                                    <h1 class="text-gray-400 font-bold text-xs leading-8 my-1 ml-auto"><a href="{{ route('profile.show') }}">Editar Foto</a></h1>
                                                @endcan
                                            </div>
                                            <div class="col-span-2 px-4 w-full">
                                                <a href="{{route('socio.show', $socio)}}">
                                                    <h1 class="text-blue-400 font-bold text-lg leading-8 mb-1">{{ '@'.$socio->slug }}</h1>
                                                </a>  
                                                <div class="flex content-center">
                                                    <div class="px-2 py-2 text-red-500 font-semibold content-center">
                                                        <i class="fas fa-birthday-cake content-arount" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="px-2 py-2 text-sm">{{date('d-m-Y', strtotime($socio->born_date))}}</div>
                                                </div>
                                            
                                                <div class="flex items-center content-center">
                                                            @if($socio->direccion)
                                                                <div class="px-2 py-2 text-red-500 font-semibold content-center">
                                                                <i class="fa fa-map-marker my-auto py-auto" aria-hidden="true"></i>
                                                            </div>
                                                            
                                                                <div class="px-2 py-2">{{Str::limit($socio->direccion->comuna.', '.$socio->direccion->region,20)}}</div>
                                                            @endif
                                                </div>

                                                

                                                    
                                            
                                                
                                            </div>
                                           
                                        </div>

                                    
                                        <ul
                                            class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm hidden">
                                            <li class="flex items-center py-3">
                                                <span>Suscripción</span>
                                                    @switch($socio->status)
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
                                @else
                                    
                                @endif 
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
            

                           @endif
                       
                        </div>
                           <!-- Friends card -->
                           
                           <!-- End of friends card -->
                       </div>
                       <!-- Right Side -->
                       <div class="w-full md:w-9/12 mx-0 sm:mx-2 bg-white flex flex-col">
                           <!-- Profile tab -->
                           <!-- About Section -->
                           <!-- End of about section -->
                       
                           <!-- garage and movie -->
                           <div class="bg-white shadow-sm rounded-sm flex-grow">
                                <section id="responder">
                                    <div class="grid grid-cols-1 sm:grid-cols-1">
                                        <div class="bg-white">
                                            <div class="items-center p-3 flex justify-between space-x-3 font-semibold text-gray-900 text-xl leading-8">
                                                <div class="flex items-center"> 
                                                    <span class="text-red-500 font-bold">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                                                        </svg>
                                                    </span>
                                                    <span class="ml-2">{!!$tema->titulo!!}</span>
                                                </div>
                            
                                                <div class="hidden">
                                                    @can('perfil_propio', $socio)  
                                                    <a href="{{route('garage.vehiculo.create')}}"><span class="btn btn-danger text-white font-bold text-sm align-middle">Eliminar Tema</span></a>
                                                    @endcan
                                                </div>
                                            </div>
                                            
                                            {{-- Contenido  formulario --}}

                                            @if ($respuestatema)
                                                <div class="w-full px-2">
                                                    <table class="border-collapse w-full">
                                                        <thead>
                                                            <tr>
                                                                <th class="p-3 font-bold text-xs text-left  bg-yellow-200 text-gray-600 border border-gray-300 hidden lg:table-cell">{{$respuestatema->user->name}} Dijo:</th>
                                                            
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="bg-yellow-50 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-4 lg:mb-0">
                                                                <td class="w-full lg:w-auto px-3 pt-6 pb-3 text-gray-800 text-left border border-b block lg:table-cell relative lg:static">
                                                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">{{$respuestatema->user->name}} Dijo:</span>
                                                                    {!!$respuestatema->content!!}
                                                                </td>
                                                            
                                                            </tr>
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                            @if ($respuestapost)
                                                <div class="w-full px-2">
                                                    <table class="border-collapse w-full">
                                                        <thead>
                                                            <tr>
                                                                <th class="p-3 font-bold text-xs text-left  bg-yellow-200 text-gray-600 border border-gray-300 hidden lg:table-cell">{{$respuestapost->user->name}} Dijo:</th>
                                                            
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="bg-yellow-50 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-4 lg:mb-0">
                                                                <td class="w-full lg:w-auto px-3 pt-6 pb-3 text-gray-800 text-left border border-b block lg:table-cell relative lg:static">
                                                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">{{$respuestapost->user->name}} Dijo:</span>
                                                                    {!!$respuestapost->content!!}
                                                                </td>
                                                            
                                                            </tr>
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif

                                                @if (auth()->user())
                                                    <form method="POST" action="action.php" id="myForm"  wire:ignore>

                                                        @csrf
                    
                                                        {!! Form::hidden('tema_id', $tema->id) !!}

                                                        @if (auth()->user())
                                                            {!! Form::hidden('user_id', auth()->user()->id) !!}
                                                        @endif
                                                        @if ($respuestatema)
                                                            {!! Form::hidden('replytema_id', $respuestatema->id) !!}
                                                        @endif
                                                        @if ($respuestapost)
                                                            {!! Form::hidden('post_id', $respuestapost->id) !!}
                                                        @endif
                                                        
                    
                    
                                                    
                                                        <div class="mb-4">
                                                            <label class="text-xl text-gray-600 hidden">Contenido<span class="text-red-500">*</span></label></br>
                                                            
                                                            @if ($respuestatema || $respuestapost)
                                                                <textarea name="content" autofocus class="border-2 border-gray-500"></textarea>
                                                            @else
                                                                <textarea name="content" class="border-2 border-gray-500"></textarea>
                                                            @endif
                                                              
                                                        
                                                        </div>
                                                        
                                                        <div class="grid grid-cols-2 md:grid-cols-3 mx-2 md:mx-8 p-1 gap-6 mb-8">
                                                            <span class="rounded-lg p-3 bg-gray-500 cursor-pointer text-white hover:bg-gray-400 text-center hidden" onclick="handleFormAction('storefotos')" required>Agregar imágenes</span>
                                                            <span class="rounded-lg p-3 bg-gray-500 cursor-pointer text-white hover:bg-gray-400 text-center hidden" onclick="handleFormAction('storefotos')" required>Agregar reels</span>
                                                            
                                                            <button type="button" class="rounded-lg p-3 bg-blue-500 text-white hover:bg-blue-400" onclick="handleFormAction('submit')" required>Publicar respuesta</button>
                                                        </div>
                                                    </form>
                                            @else
                                                <p class="text-center my-12"> SOLO USUARIOS PUEDEN AGREGAR COMENTARIOS</p>
                                            @endif
                                        
                                            
                                        </div>
                                    </div>
                                </section>
                           </div>
                       
                           <!-- Buttons -->
                          
                       </div>
                       
                       <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

                       <script>
                           CKEDITOR.replace( 'content' );
                       </script>
                       
                   </div>
               </div>
        
           </div>
       </div>

    

       

   </section>

 


</div>  