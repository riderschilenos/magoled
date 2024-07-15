<div>
    @php
                    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
                @endphp
           
    <style>
        .slider::-webkit-scrollbar {
      display: none;
    }
    </style>

<div class="pb-16 pt-4 bg-gradient-to-br from-gray-600 to-blue-300"> 

    <div class="max-w-7xl mx-auto pb-8">
        <div class="container m-auto px-6 text-gray-600 md:px-12 xl:px-6">
            <div class="mb-6 mt-4 space-y-2 text-center">
            <h2 class="text-2xl text-white font-bold md:text-4xl">Riders Destacados</h2>
            <p class="lg:w-6/12 lg:mx-auto text-white">Conoce las mejores memorias y recuerdos de los Rides Chilenos, este es un espacio para conmemorar logros y dejar un registro para la eternidad.</p>
            </div>
            <div class="flex items-center mb-4">   
                <label for="simple-search" class="sr-only">Buscar por Nombre del Rider</label>
                <div class="relative w-full">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="text" wire:keydown="limpiar_page" wire:model="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar por Nombre del Rider" required>
                </div>
            </div>
            <div class="grid gap-12 lg:grid-cols-2">
                @if ($resultados->count()>0)
                    @foreach ($resultados as $resultado)
                        @if ($resultadoid==$resultado->id)
                                            
                            <div class="lg:col-span-2">
                                <ul class="raider snap-mandatory flex overflow-x-auto gap-0 snap-x before:shrink-0 before:w-[30vw] after:shrink-0 after:w-[30vw]" style='z-index: 1 ; ' wire:click="resetresultado()">
                                    @if ($resultado->image->count()>0)
                                        @php
                                            $n=1;
                                        @endphp
                                        @foreach ($resultado->image as $image)
                                            <li class="shrink-0 snap-center w-full snap-mandatory">       
                                                <img class="" src="{{Storage::url($image->url)}}" alt="" style="scroll-snap-align: center;">
                                                <p class="text-center my-auto text-sm font-normal leading-none text-gray-400 dark:text-gray-500">({{$n.'/'.$resultado->image->count()}})</p>
                                            </li>
                                            @php
                                                $n+=1;
                                            @endphp
                                        @endforeach
                                    @else
                                        <li class="shrink-0 snap-center w-full snap-mandatory">       
                                            <img class="p-6" src="{{asset('img/copa.png')}}" alt="" style="scroll-snap-align: center;">
                                        </li>
                                    @endif
                                    
                                                        
                                </ul>
                            </div>
                        
                        @endif
                        <div class="@if ($resultadoid==$resultado->id) lg:col-span-2 @endif p-1 rounded-xl group flex space-x-6 bg-white bg-opacity-50 shadow-xl hover:bg-opacity-60" wire:click="setresultado({{$resultado->id}})">
                            <div class="h-56 w-4/12 object-contain md:objet-cover object-center rounded-lg transition duration-500 group-hover:rounded-xl pb-4 m-1">
                                @if($resultado->image->first())
                                    <img src="{{Storage::url($resultado->image->first()->url)}}" alt="" wire:click="setresultado({{$resultado->id}})" loading="lazy"  class="h-full w-full object-contain md:objet-cover rounded-lg">
                                @else
                                    <img src="{{asset('img/copa.png')}}" alt="" wire:click="setresultado({{$resultado->id}})" loading="lazy"  class="h-full w-full object-contain md:objet-cover rounded-lg p-4">
                                @endif    
                                <div class="col-span-2 mt-1 items-center content-center my-auto text-sm font-normal leading-none text-gray-900">
                                
                                            
                                    @if($resultado->image->first())
                                    
                                        <p class="text-center">({{'1/'.$resultado->image->count()}})</p>
                                    @else
                                    <p class="text-center">({{'0/0'}})</p>
                                    
                                    @endif    
                                    
                            
                    
            
                                </div>
                            </div>
                            <div class="w-7/12 pl-0 p-5">
                            <div class="space-y-2">
                                <div class="space-y-4">
                                <h4 class="text-2xl font-semibold text-cyan-900">{{$resultado->titulo}}</h4>
                                @can('perfil_propio', $resultado->user->socio)
                                    <time class="my-auto text-sm font-normal leading-none text-gray-900">
                                
                                        {{$meses[date('n', strtotime($resultado->fecha))-1]}}
                                        {{date('Y', strtotime($resultado->fecha))}}
                                
                                    </time>
                                    -
                                    <a href="{{route('socio.resultados.edit',$resultado)}}" class="my-auto text-sm font-normal leading-none text-gray-900  ml-2">editar</a>
                                @else
                                    <time class="my-auto text-sm font-normal leading-none text-gray9400">
                            
                                        {{$meses[date('n', strtotime($resultado->fecha))-1]}}
                                        {{date('Y', strtotime($resultado->fecha))}}
                                
                                    </time>
                                @endcan
                                <p class="text-gray-600">{{$resultado->descripcion}}</p>
                                </div>

                                <a href="{{route('socio.show', $resultado->user->socio)}}" class="block w-max text-cyan-600">
                                {{ '@'.$resultado->user->socio->slug }}
                                </a>  
                              
                            </div>
                            </div>
                        </div>

                    @endforeach
        
                @endif
                {{-- comment
                    <div class="p-1 rounded-xl group sm:flex space-x-6 bg-white bg-opacity-50 shadow-xl hover:rounded-2xl">
                        <img src="https://tailus.io/sources/blocks/twocards/preview/images/woman.jpg" alt="art cover" loading="lazy" width="1000" height="667" class="h-56 sm:h-full w-full sm:w-5/12 object-cover object-top rounded-lg transition duration-500 group-hover:rounded-xl">
                        <div class="sm:w-7/12 pl-0 p-5">
                        <div class="space-y-2">
                            <div class="space-y-4">
                            <h4 class="text-2xl font-semibold text-cyan-900">Provident de illo eveniet commodi fuga fugiat laboriosam expedita.</h4>
                            <p class="text-gray-600">Laborum saepe laudantium in, voluptates ex placeat quo harum aliquam totam, doloribus eum impedit atque! Temporibus...</p>
                            </div>
                            <a href="https://tailus.io" class="block w-max text-cyan-600">Read more</a>
                        </div>
                        </div>
                    </div>
                    <div class="p-1 rounded-xl group sm:flex space-x-6 bg-white bg-opacity-50 shadow-xl hover:rounded-2xl">
                        <img src="https://tailus.io/sources/blocks/twocards/preview/images/man.jpg" alt="art cover" loading="lazy" width="1000" height="667" class="h-56 sm:h-full w-full sm:w-5/12 object-cover object-top rounded-lg transition duration-500 group-hover:rounded-xl">
                        <div class="sm:w-7/12 pl-0 p-5">
                        <div class="space-y-2">
                            <div class="space-y-4">
                            <h4 class="text-2xl font-semibold text-cyan-900">Provident de illo eveniet commodi fuga fugiat laboriosam expedita.</h4>
                            <p class="text-gray-600">Laborum saepe laudantium in, voluptates ex placeat quo harum aliquam totam, doloribus eum impedit atque! Temporibus...</p>
                            </div>
                            <a href="https://tailus.io" class="block w-max text-cyan-600">Read more</a>
                        </div>
                        </div>
                    </div>
                --}}
            </div>
        </div>

    </div>

    

        
    <h1 class="text-center text-xs text-gray-900 py-6 mb-12">Todos Los derechos Reservados</h1>
    

</div>

@livewire('footer')
    
        <div class="max-w-5xl mx-auto hidden">
            @php
                $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            @endphp
            <h1 class="text-center font-bold text-2xl mb-4 mt-8">Galeria Riders Destacados</h1>
            <div class="px-2 my-2">
                <input wire:keydown="limpiar_page" wire:model="search"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Buscar por Nombre del Rider" autocomplete="off">
            </div>

            <ol class="">
                @if ($resultados->count()>0)
                    @foreach ($resultados as $resultado)
                        
                            <li class="bg-gray-100 rounded-lg px-2 py-1 my-2 mx-1 shadow-lg mb-4" x-data="{slr: false}">
                               
                                <div class="flex justify-center  rounded-lg p-1 items-center">
                                    <h3 class="text-lg font-semibold text-gray-700 cursor-pointer text-center" wire:click="setresultado({{$resultado->id}})">
                                          
                                          {{$resultado->titulo}}</h3>
                                 
                                </div>
                                @if ($resultadoid==$resultado->id)
                                    
                                    <div>
                                        <ul class="raider snap-mandatory flex overflow-x-auto gap-0 snap-x before:shrink-0 before:w-[30vw] after:shrink-0 after:w-[30vw]" style='z-index: 1 ; ' wire:click="resetresultado()">
                                            @if ($resultado->image->count()>0)
                                                @php
                                                    $n=1;
                                                @endphp
                                                @foreach ($resultado->image as $image)
                                                    <li class="shrink-0 snap-center w-full snap-mandatory">       
                                                        <img class="" src="{{Storage::url($image->url)}}" alt="" style="scroll-snap-align: center;">
                                                        <p class="text-center my-auto text-sm font-normal leading-none text-gray-400 dark:text-gray-500">({{$n.'/'.$resultado->image->count()}})</p>
                                                    </li>
                                                    @php
                                                        $n+=1;
                                                    @endphp
                                                @endforeach
                                            @else
                                                <li class="shrink-0 snap-center w-full snap-mandatory">       
                                                    <img class="" src="{{asset('img/copa.png')}}" alt="" style="scroll-snap-align: center;">
                                                </li>
                                            @endif
                                            
                                                                
                                        </ul>
                                    </div>
                                
                                @endif
                                <article class="grid grid-cols-6">
                                  
                                    @if ($resultadoid!=$resultado->id)
                                        
                                        <div class="px-2 py-2 col-span-4 ">
                                            <div class="flex justify-start ">
                                                <div class="items-center my-2">
                                                    <div wire:click="setresultado({{$resultado->id}})">
                                                        <p class="text-gray-500 text-base font-bold cursor-pointer">{{$resultado->descripcion}}</p>
                                                    </div>
                                                    @if ($resultado->user)
                                                        @if ($resultado->user->socio)
                                                            <a href="{{route('socio.show', $resultado->user->socio)}}">
                                                                
                                                                <h1 class="text-blue-400 font-bold text-lg leading-8 mb-1 mt-2">{{ '@'.$resultado->user->socio->slug }}</h1>
                                                  
                                                            </a>  
                                                        @else
                                                            -
                                                        @endif
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                        
                                        </div>
                                    @elseif ($resultadoid==$resultado->id)
                                        <div class="px-2 py-2 col-span-6 ">
                                            <div class="flex justify-center ">
                                                <div class="items-center my-2">
                                                    <div wire:click="setresultado({{$resultado->id}})">
                                                        <p class="text-gray-500 text-base font-bold cursor-pointer">{{$resultado->descripcion}}</p>
                                                    </div>
                                                    <a href="{{route('socio.show', $resultado->user->socio)}}">
                                                        <h1 class="text-blue-400 font-bold text-lg leading-8 mb-1 mt-2">{{ '@'.$resultado->user->socio->slug }}</h1>
                                                    </a>  
                                                </div>
                                            </div>
                                        
                                        </div>
                                    @endif
                                    @if ($resultadoid!=$resultado->id)
                                        <div class="col-span-2 items-center content-center my-auto">
                                        
                                            
                                                                    @if($resultado->image->first())
                                                                    
                                                                        <img class="w-full h-32 object-contain content-center items-center " src=" {{Storage::url($resultado->image->first()->url)}}" alt="" wire:click="setresultado({{$resultado->id}})">
                                                                    @else
                                                                        <img class="w-full h-32 object-contain content-center items-center " src="{{asset('img/copa.png')}}" alt="" wire:click="setresultado({{$resultado->id}})">
                                                                    
                                                                    @endif    
                                                                    
                                                            
                                                    
                                            
                                        </div>
                                    @endif
                                
                                </article>
                                <article class="grid grid-cols-6">
                                    <div class="px-2 col-span-4 ">
                                        
                                        <div class="flex justify-end  rounded-lg px-1 items-center">
                                            @can('perfil_propio', $resultado->user->socio)
                                                <time class="my-auto text-sm font-normal leading-none text-gray-400 dark:text-gray-500 ml-2">
                                            
                                                    {{$meses[date('n', strtotime($resultado->fecha))-1]}}
                                                    {{date('Y', strtotime($resultado->fecha))}}
                                            
                                                </time>
                                                -
                                                <a href="{{route('socio.resultados.edit',$resultado)}}" class="my-auto text-sm font-normal leading-none text-gray-400 dark:text-gray-500 ml-2">editar</a>
                                            @else
                                                <time class="my-auto text-sm font-normal leading-none text-gray-400 dark:text-gray-500 ml-2">
                                        
                                                    {{$meses[date('n', strtotime($resultado->fecha))-1]}}
                                                    {{date('Y', strtotime($resultado->fecha))}}
                                            
                                                </time>
                                            @endcan
                                        </div>
                                    
                                    </div>
                                    <div class="col-span-2 items-center content-center my-auto text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                     
                                          
                                                                @if($resultado->image->first())
                                                                
                                                                    <p class="text-center">({{'1/'.$resultado->image->count()}})</p>
                                                                @else
                                                                   <p class="text-center">({{'0/0'}})</p>
                                                                 
                                                                @endif    
                                                                
                                                           
                                                  
                                         
                                    </div>
                                    
                                    
                                
                                </article>
                            
    
                            </li>
    
                    @endforeach
               
                @endif
                   
               
              
               
            </ol>
           
          
        
        </div>

        

            <script>
               document.addEventListener('livewire:load', function () {
                window.addEventListener('scroll', function() {
                        window.livewire.emit('loadMore');
                    });
                });
            </script>
    
    
    </div>
    