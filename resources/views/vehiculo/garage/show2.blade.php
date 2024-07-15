<x-app-layout>
    <x-slot name="tl">
            
        <title>{{$vehiculo->marca->name.' '.strtoupper($vehiculo->modelo).'-'.$vehiculo->cilindrada.'cc '.$vehiculo->año}}</title>
        
        
    </x-slot>

   

           
<style>
    .slider::-webkit-scrollbar {
  display: none;
}
</style>

@if(session('info'))
<div class="flex justify-center">
    <div class="justify-center" x-data="{notificacion: true}" x-show="notificacion">
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded justify-center w-full flex my-2 mx-2 items-center" role="alert">
        <strong class="font-bold mx-2 my-auto">Felicidades!</strong>
        <span class="flex">{{session('info')}}</span>
        <span class="mx-3 top-0 bottom-0 right-0">
        <svg x-on:click="notificacion=false" class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
    </div>
    </div>
</div>
@endif
            <section class="bg-gray-700 pb-6 mb-8 ">
               
                <div class="container grid grid-cols-1 md:grid-cols-2 gap-6">
                    <figure class="block pt-6">
                        <div>
                            @if($vehiculo->image->first())
                            
                                {{-- comment <img class="h-80 w-full object-cover object-center" src="{{Storage::url($vehiculo->image->first()->url)}}" alt="">--}}
                                
                                    <ul class="slider snap-mandatory flex overflow-x-auto gap-0 snap-x before:shrink-0 before:w-[30vw] after:shrink-0 after:w-[30vw]" style='z-index: 1 ; '>
                                        @foreach ($vehiculo->image as $image)  
                                        <li class="shrink-0 snap-center w-full snap-mandatory">  
                                            <section class="bg-cover bg-center" style="background-color: rgba(209, 213, 219, 0.15); z-index: 1">     
                                                <img class="" src="{{Storage::url($image->url)}}" alt="" style="scroll-snap-align: center;">
                                            </section>
                                        </li>
                                        @endforeach
                                    </ul>

                                    <div class="flex justify-between text-white">
                                        <button id="prevButton">Anterior</button>
                                        <button id="nextButton">Siguiente</button>
                                    </div>

                                <div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8 grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-6 gap-y-8" style='z-index: 10 ;'>

                                    @foreach ($vehiculo->image as $image)
                        
                                        <img class="h-24 w-full object-contain object-center image-button" data-target="{{ $image->id }}" src="{{Storage::url($image->url)}}" alt="">
                                    
                                        
                                    @endforeach

                                    @can('vehiculo_propio', $vehiculo)
                                            <a href="{{route('garage.image',$vehiculo)}}" class="my-auto">
                                                <div>
                                                    <img class="h-10 w-full object-contain object-center my-auto" src="{{asset('img/vehiculo/camara.png')}}" alt="">
                                                    <h1 class="text-center text-xs text-white">AGREGAR</h1>
                                                </div>
                                            </a>
                                    @endcan
                        
                                </div>
                              
                            @elseif($vehiculo->vehiculo_type_id==10)

                                <ul class="slider snap-mandatory flex overflow-x-auto gap-0 snap-x before:shrink-0 before:w-[30vw] after:shrink-0 after:w-[30vw]" style='z-index: 1 ; '>
                                
                                    <li class="shrink-0 snap-center w-full snap-mandatory">  
                                        <section class="bg-cover bg-center" style="background-color: rgba(209, 213, 219, 0.15); z-index: 1">     
                                            <img class="" src="{{asset('img/bmx.jpeg')}}" alt="" style="scroll-snap-align: center;">
                                        </section>
                                    </li>
                                
                                </ul>
                            @elseif($vehiculo->vehiculo_type_id==11)

                                <ul class="slider snap-mandatory flex overflow-x-auto gap-0 snap-x before:shrink-0 before:w-[30vw] after:shrink-0 after:w-[30vw]" style='z-index: 1 ; '>
                                
                                    <li class="shrink-0 snap-center w-full snap-mandatory">  
                                        <section class="bg-cover bg-center" style="background-color: rgba(209, 213, 219, 0.15); z-index: 1">     
                                            <img class="" src="{{asset('img/dirt.jpeg')}}" alt="" style="scroll-snap-align: center;">
                                        </section>
                                    </li>
                                
                                </ul>
                            
                            @else
                                <ul class="slider snap-mandatory flex overflow-x-auto gap-0 snap-x before:shrink-0 before:w-[30vw] after:shrink-0 after:w-[30vw]" style='z-index: 1 ; '>
                                    
                                    <li class="shrink-0 snap-center w-full snap-mandatory">  
                                        <section class="bg-cover bg-center" style="background-color: rgba(209, 213, 219, 0.15); z-index: 1">     
                                            <img class="" src="https://www.greenmedical.cl/wp-content/uploads/2019/10/producto-sin-imagen.png" alt="" style="scroll-snap-align: center;">
                                        </section>
                                    </li>
                                
                                </ul>
                            @endif
                        </div>
                        <div class="hidden">
                            @if($vehiculo->image->first())
                            
                                <img class="h-80 w-full object-cover object-center" src="{{Storage::url($vehiculo->image->first()->url)}}" alt="">
                                <div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8 grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-6 gap-y-8">
        
                                    @foreach ($vehiculo->image as $image)
                        
                                        <img class="h-24 w-full object-contain object-center" src="{{Storage::url($image->url)}}" alt="">
                                
                                        
                                    @endforeach

                                    @can('vehiculo_propio', $vehiculo)
                                        <a href="{{route('garage.image',$vehiculo)}}" class="my-auto">
                                            <div>
                                                <img class="h-10 w-full object-contain object-center my-auto" src="{{asset('img/vehiculo/camara.png')}}" alt="">
                                                <h1 class="text-center text-xs text-white">AGREGAR</h1>
                                            </div>
                                        </a>
                                    @endcan
                        
                                </div>
                                
                            @else
                                <img class="h-60 w-full object-cover object-center" src="https://www.greenmedical.cl/wp-content/uploads/2019/10/producto-sin-imagen.png" alt="">
                            
                            @endif
                        </div>
                    </figure>
    
                    <div class="text-white items-center mt-8">
                        <h1 class="text-4xl">{{$vehiculo->marca->name.' '.strtoupper($vehiculo->modelo).'-'.$vehiculo->cilindrada.'cc '.$vehiculo->año}}</h1>
                        @can('Super admin')
                            @if($vehiculo->ubicacion)
                                <h2 class="text xl mb-3">Ubicación: {{$vehiculo->ubicacion}}</h2>
                            @endif
                        @endcan
                        {{-- comment
                        
                        <p class="mb-2"><i class="fas fa-wrench"></i> <b>3</b> Mantenciones registradas</p>
                        --}}
                        <p class="mb-2"><i class="fas fa-biking"></i> Tipo de vehiculo: {{$vehiculo->vehiculo_type->name}}</p>
                        <p class="mb-2"><i class="fas fa-clock"></i> Año: {{$vehiculo->año}}</p>
                        @if ($vehiculo->precio)
                            <p class="my-2 text-2xl"><i class="fas fa-dollar-sign"></i> Precio: ${{number_format($vehiculo->precio, 0, '.', '.')}}-.</p>
                    
                        @endif


    
                        @if ($qr)
                            @if ($qr->value==5000)
                                <img class="h-24 w-16 object-contain object-center mt-24 ml-4" src="{{asset('img/home/qrsilver.png')}}" alt="">
                            @elseif($qr->value==10000)
                                <img class="h-24 w-16 object-contain object-center mt-24 ml-4" src="{{asset('img/home/qrgold.png')}}" alt="">
                            @endif
                            
                        @endif
                        
                        <section class="card mt-12 w-full md:w-10/12">
                            <div class="card-body">
                                @if($vehiculo->property==1)
                                    <div class="flex items-center">
    
                                        @if (str_contains($vehiculo->user->profile_photo_url,'https://ui-'))
                                            <img class="flex h-16 w-16 rounded-full shadow-lg object-cover" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="">
                                            
                                        @else
                                            <img class="flex h-16 w-16 rounded-full shadow-lg object-cover" src="{{ $vehiculo->user->profile_photo_url }}" alt=""  />
                                        
                                        @endif
                                          
                                        <div class="ml-4">
        
                                            
                                                <h1 class="font-fold text-gray-500 text-lg"> 
        
                                                @if($vehiculo->status==5)
        
                                                    Dueño:
                                                    
                                                @else
                                                    Vendedor: 
                                                @endif
                                                    
                                                @if($vehiculo->user->socio)
                                                    {{ $vehiculo->user->socio->name." ".$vehiculo->user->socio->second_name }} {{ $vehiculo->user->socio->last_name }}</h1>
                                                @else
                                                    {{ $vehiculo->user->name }}</h1>
                                                @endif
        
                                            @if($vehiculo->user->socio)
    
                                                <a class="text-blue-400 text-sm font-bold" href="{{route('socio.show', $vehiculo->user->socio)}}">{{'@'.$vehiculo->user->socio->slug}}</a>
        
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Vendedor:</div>
                                        
                                        <div class="px-4 py-2">{{ $vehiculo->nombre }}</div>
                                    </div>
                                @endif
        
                                @if($vehiculo->property==2)
                                    <hr class="w-full py-4">
                                    <p class="text-sm text-center">Esta publicación fue realizada por un agende de ventas de RidersChilenos</p>
        
                                    <div class="flex items-center mt-6">
                                        @if($vehiculo->user->socio)
                                        <a href="{{route('socio.show', $vehiculo->user->socio)}}"><img class="flex h-14 w-14 rounded-full shadow-lg object-cover" src="{{ $vehiculo->user->profile_photo_url }}" alt=""  /></a>
                                            
                                        @else
                                            <img class="flex h-14 w-14 rounded-full shadow-lg object-cover" src="{{ $vehiculo->user->profile_photo_url }}" alt=""  />
                                        @endif
                                        
                                        <div class="ml-4">
        
                                            
                                            
        
        
                                            @if($vehiculo->user->socio)
                                            <a href="{{route('socio.show', $vehiculo->user->socio)}}"><h1 class="font-fold text-gray-500 text-lg">Agente: {{ $vehiculo->user->name }}</h1></a>
                                                <a class="text-blue-400 text-sm font-bold" href="{{route('socio.show', $vehiculo->user->socio)}}">{{'@'.$vehiculo->user->socio->slug}}</a>
                                            @else
                                                
                                            <h1 class="font-fold text-gray-500 text-lg">Agente: {{ $vehiculo->user->name }}</h1>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                
                            </div>
                        </section>
                        {{-- comment
                        <p class="mb-2"><i class="fas fa-adjust"></i> Aro: </p>
                        <p class="mb-2"><i class="fas fa-star"></i> Ofertas: 40</p>
                        --}}
                    </div>
    
                </div>
    
            </section>
            <div class="container grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="order-1 lg:col-span-2 lg:order-1 ">
                    <section class="card  mb-8">
                        <div class="card-body">
                            <div class="grid grid-cols-2">
                            
                                <div>
                                    <h1 class="font-bold text-2xl mb-2 text-gray-800 items-center">{{$vehiculo->marca->name.' '.strtoupper($vehiculo->modelo).'-'.$vehiculo->cilindrada.'cc '.$vehiculo->año}}</h1>
                                    
                                    
                                </div>
                                <div>
                                    @isset($vehiculo->marca->image)
                            
                        
                                    
                                        <img class="h-14 w-20 object-contain object-center ml-auto" src="{{Storage::url($vehiculo->marca->image->url)}}" alt="">
                        
                            
                                    @endisset
                                    
                        
                                </div>
                                
                            </div>
    
                            <div class="text-gray-700">
                                <div class="grid md:grid-cols-1 text-sm">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Marca:</div>
                                        <div class="px-4 py-2">{{ $vehiculo->marca->name }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Modelo:</div>
                                        <div class="px-4 py-2">{{ $vehiculo->modelo}}</div>
                                    </div>
                                    @if($vehiculo->cilindrada)
                                        <div class="grid grid-cols-2">
                                            <div class="px-4 py-2 font-semibold">cilindrada: </div>
                                            <div class="px-4 py-2">{{ $vehiculo->cilindrada}}</div>
                                        </div>
                                    @endif
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Año:</div>
                                        <div class="px-4 py-2">{{ $vehiculo->año}}</div>
                                    </div>
                                    @if($vehiculo->nro_serie)
                                        <div class="grid grid-cols-2">
                                            <div class="px-4 py-2 font-semibold">Nro Serie:</div>
                                            <div class="px-4 py-2" >
                                               <h1 alt="{{ $vehiculo->nro_serie}}"> {{ $vehiculo->nro_serie}}</h1>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-2">
                                            <div class="px-4 py-2 font-semibold">Nro Chasis:</div>
                                            <div class="px-4 py-2" >
                                               <h1 alt="{{ $vehiculo->nro_serie}}"> {{ $vehiculo->nro_serie}}</h1>
                                            </div>
                                        </div>
                                    @endif
                                    
                                </div>
                                
                            </div>
                            @if($vehiculo->descripcion)
                                <div class="text-gray-700">
                                    <div class="grid md:grid-cols-1 text-sm">
                                        <div class="px-4 py-2 font-semibold text-lg">Descripción:</div>
                                        <div class="px-4 pb-2 text-lg">{!! $vehiculo->descripcion !!}</div>
                                        
                                    </div>
                                </div>
                            @endif
                            
    
                            
                        </div>
    
                    </section>  

                    @livewire('vehiculo.vehiculo-mantencion',['vehiculo' => $vehiculo])

                    <hr class="mt-2 mb-2 sm:mb-6">
                        {{-- comment                    @if ($qr)
                                            
                                        @else
                                        <section class="mb-8">
                                            
                        
                                            <div class="flex">
                                                <h1 class="font-bold text-2xl mb-2 text-gray-800">Mantenciones</h1>
                                                
                                            </div>
                        
                                            <div class="flex items-center bg-red-500 text-white text-sm font-bold px-4 py-3" role="alert">
                                                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                                <p>Seccion exclusiva para Riders con KitQR Activo</p>
                                            </div>
                        
                                        </section>
                                        @endif
                            --}}

                    
    
                </div>
    
    
                <div class="order-2 lg:order-2">
                    <section class="card mb-28">
                        <div class="card-body">
                            @if($vehiculo->property==1)
                                <div class="flex items-center">

                                    @if (str_contains($vehiculo->user->profile_photo_url,'https://ui-'))
                                        <img class="flex h-16 w-16 rounded-full shadow-lg object-cover" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="">
                                        
                                    @else
                                        <img class="flex h-16 w-16 rounded-full shadow-lg object-cover" src="{{ $vehiculo->user->profile_photo_url }}" alt=""  />
                                    
                                    @endif
                                      
                                    <div class="ml-4">
    
                                        
                                            <h1 class="font-fold text-gray-500 text-lg"> 
    
                                            @if($vehiculo->status==5)
    
                                                Dueño:
                                                
                                            @else
                                                Vendedor: 
                                            @endif
                                                
                                            @if($vehiculo->user->socio)
                                                {{ $vehiculo->user->socio->name." ".$vehiculo->user->socio->second_name }} {{ $vehiculo->user->socio->last_name }}</h1>
                                            @else
                                                {{ $vehiculo->user->name }}</h1>
                                            @endif
    
                                        @if($vehiculo->user->socio)

                                            <a class="text-blue-400 text-sm font-bold" href="{{route('socio.show', $vehiculo->user->socio)}}">{{'@'.$vehiculo->user->socio->slug}}</a>
    
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Vendedor:</div>
                                    
                                    <div class="px-4 py-2">{{ $vehiculo->nombre }}</div>
                                </div>
                            @endif
    
                            <div class="text-gray-700">
                                <div class="grid md:grid-cols-1 text-sm">
                                    <div class="grid grid-cols-2">
                                        @can('Super admin')
                                            <div class="px-4 py-2 font-semibold">Ubicación:</div>
                                                @if($vehiculo->user->socio)
                                                    @if ($vehiculo->user->socio->direccion)
                                                    <div class="px-4 py-2">{{$vehiculo->user->socio->direccion->comuna}}, {{$vehiculo->user->socio->direccion->region}}</div>
                                                    @else
                                                    <div class="px-4 py-2">{{ $vehiculo->ubicacion }}</div>
                                                    @endif
                                                    
                                                @else
                                                    <div class="px-4 py-2">{{ $vehiculo->ubicacion }}</div>
                                                @endif
                                            
                                            </div>
                                        

                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Fono:</div>
                                            @if($vehiculo->user->socio)
    
                                                <div class="px-4 py-2">{{ $vehiculo->user->socio->fono}}</div>
                                            @else
                                                <div class="px-4 py-2">{{ $vehiculo->fono}}</div>
                                            @endif
                                        
                                    </div>
                                    @endcan
                                    <div class="grid grid-cols-2">
                                            @if($vehiculo->status==5)
    
                                            <div class="px-4 py-2 font-semibold">Fecha de inscripción</div>
                                            @else
                                                <div class="px-4 py-2 font-semibold">Fecha de publicación</div>
                                            @endif
                                        
                                        <div class="px-4 py-2">{{$vehiculo->created_at->format('d-m-Y')}}</div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Email:</div>
                                            @if($vehiculo->status==5)
    
                                            <div class="px-4 py-2">{{ $vehiculo->user->email}}</div>
                                            @else
                                                <div class="px-4 py-2">{{ $vehiculo->email}}</div>
                                            @endif
                                        
                                    </div>
                                    
                                </div>
                            </div>
    
                            @if($vehiculo->property==2)
                                <hr class="w-full py-4">
                                <p class="text-sm text-center">Esta publicación fue realizada por un agende de ventas de RidersChilenos</p>
    
                                <div class="flex items-center mt-6">
                                    @if($vehiculo->user->socio)
                                    <a href="{{route('socio.show', $vehiculo->user->socio)}}"><img class="flex h-14 w-14 rounded-full shadow-lg object-cover" src="{{ $vehiculo->user->profile_photo_url }}" alt=""  /></a>
                                        
                                    @else
                                        <img class="flex h-14 w-14 rounded-full shadow-lg object-cover" src="{{ $vehiculo->user->profile_photo_url }}" alt=""  />
                                    @endif
                                    
                                    <div class="ml-4">
    
                                        
                                        
    
    
                                        @if($vehiculo->user->socio)
                                        <a href="{{route('socio.show', $vehiculo->user->socio)}}"><h1 class="font-fold text-gray-500 text-lg">Agente: {{ $vehiculo->user->name }}</h1></a>
                                            <a class="text-blue-400 text-sm font-bold" href="{{route('socio.show', $vehiculo->user->socio)}}">{{'@'.$vehiculo->user->socio->slug}}</a>
                                        @else
                                            
                                        <h1 class="font-fold text-gray-500 text-lg">Agente: {{ $vehiculo->user->name }}</h1>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            
                        </div>
                    </section>
                </div>
    
            </div>

            <div class="max-w-7xl mx-auto pb-8">

                <div class="card">
                    @livewire('vehiculo.vehiculo-search',['type'=>'profile'])
                </div>
    
            </div>  
       
    <script>
        document.getElementById('prevButton').addEventListener('click', function() {
        const slider = document.querySelector('.slider');
        const currentPosition = slider.scrollLeft;
        const newPosition = currentPosition - slider.offsetWidth;
        
        slider.scrollTo({
            left: newPosition,
            behavior: 'smooth' // Esto proporcionará una transición suave
        });
        });

        document.getElementById('nextButton').addEventListener('click', function() {
        const slider = document.querySelector('.slider');
        const currentPosition = slider.scrollLeft;
        const newPosition = currentPosition + slider.offsetWidth;
        
        slider.scrollTo({
            left: newPosition,
            behavior: 'smooth' // Esto proporcionará una transición suave
        });
        });

        const imageButtons = document.querySelectorAll('.image-button');
        const slider = document.querySelector('.slider');

        imageButtons.forEach((button, index) => {
        button.addEventListener('click', function() {
            const newPosition = index * slider.offsetWidth;
            slider.scrollTo({
            left: newPosition,
            behavior: 'smooth'
            });
        });
        });

    </script>
    

</x-app-layout>