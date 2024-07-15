<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="facebook-domain-verification" content="et4ybouboiv1kxdkkqknc1zjtsz9qw" />
        <link rel="shortcut icon" href="{{asset('img/logo.png')}}">

        @isset($tl)

            {{$tl}}
            
        @else
            <title>{{ config('app.name', 'Laravel') }}</title>

        @endisset

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('vendor/fontawesome-free/css/all.min.css')}}">
   
             <!-- Google tag (gtag.js) -->
                <script async src="https://www.googletagmanager.com/gtag/js?id=G-92Q72DQR36"></script>
                <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
        
                gtag('config', 'G-92Q72DQR36');
                </script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @yield('css')
               
        @livewireStyles
               
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100 pb-12"  x-data="{@routeIs('home') home: true @else home: false @endif, base: true, socio: false, evento: false,registro: false, user: false, vendedor: false, novedades: false}">
            
            @livewire('navigation-menu')

            <!-- Page Content -->
            
            <div class="w-full text-white bg-main-color block sm:hidden">
                <div x-data="{ open: false }"
                    class="flex flex-col max-w-screen-xl pt-3 pb-4 sm:py-0 px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
                    <div class="flex flex-row items-center justify-center">
                        @livewire('search')
                    </div>
                </div>
            </div>

            <div class="container pt-0 sm:pt-8 pb-12 grid grid-cols-5 mb-12 mt-10 sm:my-2">

                <aside class="hidden sm:block">
                    <a href="{{route('vendedor.home.index')}}" class="font-bold text-lg mb-4 cursor-pointer"><i class="fas fa-arrow-circle-left text-gray-800"></i> Listado de pedidos</a>
        
                    <ul class="text-sm text-gray-600 mt-2 mb-4">
                        <li class="leading-7 mb-1 border-l-4 @routeIs('vendedor.pedidos.edit',$pedido) border-indigo-400 @else border-transparent @endif pl-2">
                            <a href="{{route('vendedor.pedidos.edit',$pedido)}}">Información del pedido</a>
                        </li>
                        <li class="leading-7 mb-1 border-l-4 @routeIs('vendedor.pedido.diseno',$pedido) border-indigo-400 @else border-transparent @endif pl-2">
                            <a href="{{route('vendedor.pedido.diseno',$pedido)}}">Diseño</a>
                        </li>
                   
                        <li class="leading-7 mb-1 border-l-4 @routeIs('pedido.seguimiento',$pedido) border-indigo-400 @else border-transparent @endif pl-2">
                            <a href="{{route('pedido.seguimiento',$pedido)}}">Seguimiento</a>
                        </li>
                    </ul>

                    {!! Form::open(['route'=>'admin.generar.etiquetas', 'autocomplete'=>'off', 'method'=> 'GET' , 'target' => '_blank']) !!}
                                       
    
                                            
                   
                        <input type="hidden" name="selectedetiquetas[]" value="{{$pedido}}">
                   
      


                        

                        <div class="flex justify-center">
                            {!! Form::submit('Imprimir Etiqueta', ['class'=>'font-bold py-2 px-4 rounded bg-red-500 text-white cursor-pointer mt-6']) !!}
                        </div>
                    
                    {!! Form::close() !!}
                    
                


                    
        
                </aside>

                <div class="block sm:hidden py-4 px-5 col-span-5">
                    <div class="flex">
                    @routeIs('pedido.seguimiento',$pedido)
                        <a href="{{route('home')}}" class="font-bold text-lg mb-4 cursor-pointer"><i class="fas fa-arrow-circle-left text-gray-800"></i> Home</a>
                    @else
                        <a href="{{route('vendedor.home.index')}}" class="font-bold text-lg mb-4 cursor-pointer"><i class="fas fa-arrow-circle-left text-gray-800"></i> Listado de la pedidos</a>
                    
                    @endif
                    @routeIs('pedido.seguimiento',$pedido)
                        <a class="btn btn-danger flex ml-auto" href='javascript:getlink();'><img class="h-4 w-4 mt-1 mr-2" src="https://img.icons8.com/ios-filled/50/ffffff/copy.png"/> Copiar URL</a>
                    @else
                        <a href="{{route('pedido.seguimiento',$pedido)}}" class="ml-auto btn btn-danger">SEGUIMIENTO</a>
                    @endif

                     </div>
                </div>

                <div class="col-span-5 sm:col-span-4 card">
                    

                    <main class="px-6 py-2 text-gray-600">
        
                        {{$slot}}
                        
                    </main>
                    
        
                </div>
        
                
            </div>
        
        </div>

        @stack('modals')

        @livewireScripts

        @isset($js)

            {{$js}}

        @endisset
        
    </body>
</html>
