<x-app-layout>

    <x-slot name="tl">
            
        <title>{{$foro->titulo}} | RidersChilenos</title>
        
        
    </x-slot>

        @php
             $dias=['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];
        @endphp
    <x-slot name="hsc">
        <script>
            function handleFormAction(action) {
                const form = document.getElementById('myForm');
                if (action === 'storefotos') {
                    form.action = 'temas.storefotos';
                } else if (action === 'submit') {
                    form.action = '{{route("temas.store")}}';
                }
                form.submit();
            }
        </script>
    </x-slot>

        <div class="max-w-7xl mx-auto pb-8 mt-10" @error('content') x-data="{formcreate:true}" @else x-data="{formcreate:false}" @enderror>

            <x-table-responsive>

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
                                <a href="{{Route('foros.index')}}" class="text-gray-600 hover:text-blue-500 transition-colors duration-300">{{$foro->categoria}}</a>
                                <span class="mx-2">/</span>
                             
                            </li>
                          </ol>
                    </header>

                    <div class="flex justify-between items-center mr-2">
                        <h1 class="font-bold text-2xl mb-2 mt-4 px-4 text-gray-800">{{$foro->titulo}}</h1>
                        
                        <button x-on:click="formcreate=!formcreate" class="btn btn-success items-center justify-items-center mt-2">Nuevo Tema</button>
                    </div>
                    <h1 class="mx-4 mt-4">{!!$foro->descripcion!!}</h1>

                </section>

                <div class="sm:fixed top-0 left-0 right-0 bottom-0 flex justify-center items-center"  style="background-color: rgb(0,0,0,0.5);"  x-show="formcreate">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-0 sm:mt-12">
                            <div class="px-6 pb-6 bg-white border-b border-gray-200">
                                <h1 class="text-right mt-2 cursor-pointer font-bold hover:text-red-500" x-on:click="formcreate=false">X</h1>
                                 @if (auth()->user())
                                     
                                    <form method="POST" action="action.php" id="myForm">

                                        @csrf

                                        {!! Form::hidden('foro_id', $foro->id) !!}

                                        @if (auth()->user())
                                            {!! Form::hidden('user_id', auth()->user()->id) !!}
                                        @endif
                                        


                                        <div class="mb-4">
                                            <label class="text-xl text-gray-600">Título <span class="text-red-500">*</span></label></br>
                                            <input type="text" class="border-2 border-gray-300 p-2 w-full" name="titulo" id="titulo" required>
                                            @error('titulo')
                                                <strong class="text-xs text-red-600">{{$message}}</strong>
                                            @enderror
                                        </div>
                                        <div class="mb-8">
                                            <label class="text-xl text-gray-600">Contenido<span class="text-red-500">*</span></label></br>
                                            <textarea name="content" class="border-2 border-gray-500"></textarea>
                                            @error('content')
                                                <strong class="text-xs text-red-600">{{$message}}</strong>
                                            @enderror
                                        </div>
                                        <div class="flex justify-between p-1">
                                            <span class="p-3 bg-gray-500 cursor-pointer text-white hover:bg-gray-400 hidden" onclick="handleFormAction('storefotos')" required>Agregar fotos</span>
                                            <button type="button" class="p-3 bg-blue-500 text-white hover:bg-blue-400" onclick="handleFormAction('submit')" required>Crear tema</button>
                                        </div>
                                    </form>
                                    
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
                            </div>
                        </div>

                    </div>
                </div>
            
                <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
            
                <script>
                    CKEDITOR.replace( 'content' );
                </script>

            <x-table-responsive>
                <table class="hidden sm:table min-w-full divide-y divide-gray-200 mb-14">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500">
                                TITULO
                            </th>
                        
                            
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            FECHA DE PUBLICACIÓN
                            </th>
                            
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                RESPUESTAS
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                VISTAS
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ÚLTIMO MENSAJE
                            </th>
                        
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($temas->reverse() as $tema)
                            <tr>

                                <td class="px-6 py-4 content-center">
                                    <div class="flex items-center">
                                        
                                        <div class="ml-2 flex-shrink-0 h-10 w-10">
                                            <a href="{{Route('temas.show',$tema)}}">
                                                @if (str_contains($tema->user->profile_photo_url,'https://ui-'))
                                                    <img class="h-11 w-11 object-cover object-center rounded-lg"
                                                    src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg"
                                                    alt="">
                                                @else
                                                    <img class="h-11 w-11 object-cover object-center rounded-lg"
                                                    src="{{ $tema->user->profile_photo_url }}"
                                                    alt="">
                    
                                                @endif
                                            
                                            </a>
                                        </div>
                                        <div class="ml-4 whitespace-nowrap">
                                                <a href="{{Route('temas.show',$tema)}}">
                                                    <div class="text-sm font-medium text-gray-900 text-left">
                                                       {{$tema->titulo}}
                                                       


                                                    </div>
                                                    
                                                    <div class="text-sm text-gray-500 text-left">

                                                        Autor: {{$tema->user->name}}
                                                        @if ($tema->user->socio)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                {{$tema->user->socio->disciplina->name}}
                                                            </span>
                                                        @endif
                                                                                    <span class="hidden px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                                                        FALTA DIRECCIÓN DE DESPACHO
                                                                                    </span>
                                                                                
                                                            <br>
                                                        
                                                                    <span class="hidden px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                    STARKEN
                                                                    </span>
                                                                    
                                                    </div>
                                                </a>
                                        </div>
                                            <div class="ml-auto whitespace-nowrap hidden">
                                                <a href="">
                                                    <div class="text-sm text-gray-900 ml-auto text-center mb-1">${{number_format(1000)}}</div>
                                                
                                                </a>
                                                
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Borrador
                                                    </span>
                                                
                                            </div>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{$dias[date('N', strtotime($tema->created_at))-1]}}</div>
                                    <div class="text-sm text-gray-900">{{$tema->created_at->format('d-m-Y')}}</div>  
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 mx-3">{{$tema->posts->count()}}<i class="fas fa-comments text-gray-400 mx-1"></i></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 mx-3">{{$tema->vistas}}<i class="fas fa-eye text-gray-400 mx-1"></i></div>
                                </td>
                            
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($tema->posts->count())
                                        <div class="text-sm text-gray-500 text-left">
                                            Autor: {{$tema->posts->first()->user->name}}
                                        </div>
                                        <div class="text-sm text-gray-500 text-left">
                                            Fecha: {{$tema->posts->first()->created_at}}
                                        </div>
                                    @endif
                                    
                                </td>

                            </tr>
                        @endforeach
                       

                    </tbody>
                </table>
                <table class="min-w-full sm:hidden divide-y divide-gray-200 mb-14">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500">
                                TITULO
                            </th>
                        
                            
                        
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($temas->reverse() as $tema)
                            <tr>

                                <td class="px-3 py-4 content-center">
                                    <div class="flex items-center">
                                        
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <a href="">

                                                @if (str_contains($tema->user->profile_photo_url,'https://ui-'))
                                                    <img class="h-11 w-11 object-cover object-center rounded-lg"
                                                    src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg"
                                                    alt="">
                                                @else
                                                    <img class="h-11 w-11 object-cover object-center rounded-lg"
                                                    src="{{ $tema->user->profile_photo_url }}"
                                                    alt="">
                    
                                                @endif
                                                    
                                            
                                            </a>
                                        </div>
                                        <div class="ml-2 whitespace-nowrap">
                                            <a href="{{Route('temas.show',$tema)}}">
                                                <div class="text-sm font-medium text-gray-900 text-left">
                                                {{$tema->titulo}}
                                                


                                                </div>
                                                
                                                <div class="text-sm text-gray-500 text-left">

                                                    Autor: {{$tema->user->name}}
                                                    <br>
                                                    @if ($tema->user->socio)
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            {{$tema->user->socio->disciplina->name}}
                                                        </span>
                                                    @endif
                                                                                <span class="hidden px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                                                    FALTA DIRECCIÓN DE DESPACHO
                                                                                </span>
                                                                            
                                                       
                                                    
                                                                <span class="hidden px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                STARKEN
                                                                </span>
                                                                
                                                </div>
                                            </a>
                                    </div>
                                        <div class="ml-auto whitespace-nowrap ">
                                            <a href="{{Route('temas.show',$tema)}}" class="flex justify-end">
                                                <div class="text-sm text-gray-900">{{$tema->vistas}}<i class="fas fa-eye text-gray-400 mx-1"></i></div>
                                            
                                            </a>
                                            
                                            <div class="text-sm text-gray-900">{{$tema->created_at->format('d-m-Y')}}</div>  
                                            
                                        </div>
                                    </div>
                                </td>
                                
                            

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </x-table-responsive>
                {{-- comment 
                
                <div class="px-6 py-4 flex">
                    <input wire:keydown="limpiar_page" wire:model="search" class="form-input flex-1 shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Ingrese el nombre o rut del cliente">
                    
                </div>
        
                @if ($pedidos->count())
        
                    <table class="min-w-full divide-y divide-gray-200 mb-14">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500">
                            Cliente / Subtotal
                            </th>
                        
                            
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Productos
                            </th>
                            
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fecha
                            </th>
                            <th class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
        
                            @foreach ($pedidos->reverse() as $pedido)
                            
                                    <tr>
                                        @php
                                        $subtotal=0;
                                        @endphp
        
                                        @if($pedido->pedidoable_type=="App\Models\Socio")
                                            @foreach ($pedido->ordens as $orden)
                                            @php
                                                
                                                $subtotal+=$orden->producto->precio-$orden->producto->descuento_socio;
        
                                            @endphp    
                                            @endforeach
        
                                            @endif
                                            @if($pedido->pedidoable_type=="App\Models\Invitado")
                                            @foreach ($pedido->ordens as $orden)
                                            @php
                                                
                                                $subtotal+=$orden->producto->precio;
        
                                            @endphp    
                                            @endforeach
        
                                        @endif
        
                                        <td class="px-6 py-4 content-center">
                                            <div class="flex items-center">
                                                
                                                <div class="ml-2 flex-shrink-0 h-10 w-10">
                                                    <a href="{{route('vendedor.pedidos.edit',$pedido)}}">
                                                        @isset($pedido->image)
                                                                <img class="h-11 w-11 object-cover object-center rounded-full" src="{{Storage::url($pedido->image->url)}}" alt="">
                                                        @else
                                                                <img class="h-11 w-11 object-cover object-center rounded-full" src="{{asset('img/compras.jpg')}}" alt="">
                                                        @endisset
                                                    </a>
                                                </div>
                                                <div class="ml-4 whitespace-nowrap">
                                                        <a href="{{route('vendedor.pedidos.edit',$pedido)}}">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                
                                                                    @if($pedido->pedidoable_type=='App\Models\Socio')
                                                                        @foreach ($socios as $socio)
                                                                                
                                                                                @if($socio->id == $pedido->pedidoable_id)
                                                                                    <a href="{{route('vendedor.pedidos.edit',$pedido)}}">
                                                                                        {{$socio->user->name}}
                                                                                    
                                                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                                            Socio
                                                                                        </span>
                                                                                
                                                                                @endif
                                                                        @endforeach
                                                                    @endif
                                                                    @if($pedido->pedidoable_type=='App\Models\Invitado')
                                                                        @foreach ($invitados as $invitado)
                                                                                
                                                                                @if($invitado->id == $pedido->pedidoable_id)
                                                                            
                                                                                    {{$invitado->name}} 
                                                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                                        Invitado
                                                                                    </span>
                                                                            
                                                                                @endif
                                                                        @endforeach
                                                                    @endif
        
        
                                                            </div>
                                                            
                                                            <div class="text-sm text-gray-500">
        
                                                        
                                                                
                                                                        @if($pedido->pedidoable_type=='App\Models\Socio')
                                                                            
                                                                            @foreach ($socios as $socio)
                                                                                @if(!is_null($socio->direccion))
                                                                                    @if($socio->id == $pedido->pedidoable_id)
                                                                                        {{$socio->direccion->comuna.", ".$socio->direccion->region}} 
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
        
                                                                        @if($pedido->pedidoable_type=='App\Models\Invitado')
                                                                            @foreach ($invitados as $invitado)
                                                                                
                                                                                    @if($invitado->id == $pedido->pedidoable_id)
                                                                                    
                                                                                        @if(!is_null($invitado->direccion))
                                                                                            {{$invitado->direccion->comuna.", ".$invitado->direccion->region}}
                                                                                        @else
                                                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                                                                FALTA DIRECCIÓN DE DESPACHO
                                                                                            </span>
                                                                                        @endif
                                                                                    
                                                                                    @endif
                                                                                
                                                                            @endforeach
                                                                        @endif
                                                                    <br>
                                                                    @switch($pedido->transportista->id)
                                                                        @case(1)
                                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                                {{$pedido->transportista->name}}
                                                                            </span>
                                                                            @break
                                                                        @case(2)
                                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                                {{$pedido->transportista->name}}
                                                                            </span>
                                                                            @break
                                                                            @case(3)
                                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                                                {{$pedido->transportista->name}}
                                                                            </span>
                                                                            @break
                                                                        
                                                                        @default
                                                                            
                                                                    @endswitch
                                                            </div>
                                                        </a>
                                                </div>
                                                    <div class="ml-auto whitespace-nowrap">
                                                        <a href="{{route('vendedor.pedidos.edit',$pedido)}}">
                                                            <div class="text-sm text-gray-900 ml-auto text-center mb-3">${{number_format($subtotal)}}</div>
                                                        
                                                        </a>
                                                        @switch($pedido->status)
                                                        @case(1)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                                Borrador
                                                            </span>
                                                            @break
                                                        @case(2)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                                Pendiente de Pago
                                                            </span>
                                                            @break
                                                        @case(3)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                                Procesando Pago
                                                            </span>
                                                            @break
                                                        @case(4)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                Pendiente de diseño
                                                            </span>
                                                            @break
                                                            @case(5)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                                Pendiente de producción
                                                            </span>
                                                            @break
                                                            @case(6)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                Pendiente de despacho
                                                            </span>
                                                            @break
                                                            @case(7)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                Despachado
                                                            </span>
                                                            @break
                                                            @case(8)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                Procesando Comisión
                                                            </span>
                                                            @break
                                                            @case(9)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                                Cerrado
                                                            </span>
                                                            @break
                                                        @default
                                                            
                                                        @endswitch
                                                    </div>
                                            </div>
                                        </td>
        
                                    
        
                                    
        
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 ml-3">{{$pedido->Ordens->count()}}<i class="fas fa-shopping-cart text-gray-400"></i></div>
                                            <div class="text-sm text-gray-500">Productos</div>
                                        </td>
        
                                        
        
                                        
        
                                    
                                        
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">{{$dias[date('N', strtotime($pedido->created_at))-1]}}</div>
                                            <div class="text-sm text-gray-900">{{$pedido->created_at->format('d-m-Y')}}</div>    
                                        </td>
        
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{route('vendedor.pedidos.edit',$pedido)}}" class="text-indigo-600 hover:text-indigo-900">Ver detalles</a>
                                            
                                        </td>
                                    </tr>
        
                            @endforeach
                        <!-- More people... -->
                        </tbody>
                    </table>
                @else
                    <div class="px-6 py-4">
                        No hay ningun registro coincidente
                    </div>
                @endif 
              --}}
            </x-table-responsive>

        </div>  

   
</x-app-layout>