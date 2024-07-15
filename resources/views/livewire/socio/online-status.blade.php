<div>
    @php
        $online=0;
        $countinvitado=0;
        $countuser=0;
        $numeros = range(1, 100);
        // Iterar sobre la matriz utilizando foreach
        foreach ($numeros as $numero) {
            if(Cache::has('invitado-is-online-'.$numero)){
                $online+=1;
                $countinvitado+=1;
             }
        }
    @endphp
    @foreach ($users as $user)
        @if(Cache::has('user-is-online-' . $user->id))
            @php
                $online+=1;
                $countuser+=1;
            @endphp
        @endif
    @endforeach
    @if ($type=='cell')
        <a href="{{Route('foros.index')}}" class="flex justify-center">
            <div class="flex justify-center items-center"> 
                <span class=" w-2.5 h-2.5 bg-green-400 border-1 border-white dark:border-gray-800 rounded-full mr-2 my-auto"></span>
                <p class="text-xs text-center"> {{$online}}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mx-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    @can('Super admin')
                        <a href="{{Route('socio.index.online')}}">
                            <p class="text-xs text-center">  Online</p>
                        </a>
                    @else
                        <p class="text-xs text-center">  Online</p>
                    @endcan
                
            </div>
        </a>
        @can('Super admin')
            <div class="text-center text-xs">
                ( {{$countuser}} User / {{$countinvitado}} Inv )
            </div>
        @endcan
        
    @elseif($type=='pc')
        <a href="{{Route('foros.index')}}" class="flex">
            <div class="relative flex items-center">
                <p class="text-md font-bold text-center mx-1 my-auto">{{$online}}</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <span class="top-0 left-9 absolute  w-2.5 h-2.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                @can('Super admin')
                    <div class="ml-3 text-xs hidden">
                        ( {{$countuser}} User / {{$countinvitado}} Inv )
                    </div>
                @endcan
            </div>
        </a>
        @can('Super admin')
            <a href="{{Route('socio.index.online.desktop')}}">
                 <p class="text-xs text-center">Online</p>
            </a>
        @else
             <p class="text-xs text-center">Online</p>
        @endcan
    @elseif($type=='list')

        <section class="container mx-auto p-6 font-mono">
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full overflow-x-auto">
                <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                    <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Edad</th>
                        <th class="px-4 py-3">Wtsp</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Last seen</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                        
                        @foreach ($numeros as $numero) 
                            @if(Cache::has('invitado-is-online-'.$numero))
                                <tr class="text-gray-700">
                                    <td class="px-4 py-3 border">
                                    <div class="flex items-center text-sm">
                                        <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                        <img class="object-cover w-full h-full rounded-full" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="" loading="lazy" />
                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                        </div>
                                        <div>
                                        <p class="font-semibold text-black">Invitado Nro. {{$numero}}</p>
                                        <p class="text-xs text-gray-600">Incognito</p>
                                        </div>
                                    </div>
                                    </td>
                                    <td class="px-4 py-3 text-ms font-semibold border">-</td>
                                    <td class="px-4 py-3 text-ms font-semibold border">-</td>
                                    <td class="px-4 py-3 text-xs border">
                                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"> En linea </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm border whitespace-nowrap">Hace 1 Min</td>
                                </tr>
                            @endif
                        @endforeach
                        @foreach ($users as $user)
                            @if($user->last_seen)
                                <tr class="text-gray-700">
                                    <td class="px-4 py-3 border">
                                        @if ($user->socio)
                                            
                                            <div class="flex items-center text-sm">
                                                <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                                <a href="{{Route('socio.show',$user->socio)}}">    
                                                    @if (str_contains($user->profile_photo_url,'https://ui-'))
                                                        <img class="object-cover w-full h-full rounded-full" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="" loading="lazy" />
                                                    @else
                                                        <img class="object-cover w-full h-full rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" alt="{{ $user->name }}" loading="lazy" />
                                                    @endif
                                                </a>
                                                <a href="{{Route('socio.show',$user->socio)}}">
                                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                    </div>
                                                    <div>
                                                    <p class="font-semibold text-black">{{$user->name}}</p>
                                                    <p class="text-xs text-gray-600">{{$user->email}}</p>
                                                    </div>
                                                </a>
                                            </div>
                                            
                                        @else
                                            <div class="flex items-center text-sm">
                                                <div class="relative w-8 h-8 mr-3 rounded-full md:block">

                                                @if (str_contains($user->profile_photo_url,'https://ui-'))
                                                    <img class="object-cover w-full h-full rounded-full" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="" loading="lazy" />
                                                @else
                                                    <img class="object-cover w-full h-full rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" alt="{{ $user->name }}" loading="lazy" />
                                                @endif
                                                    
                                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                </div>
                                                <div>
                                                <p class="font-semibold text-black">{{$user->name}}</p>
                                                <p class="text-xs text-gray-600">{{$user->email}}</p>
                                                </div>
                                            </div>
                                            
                                        @endif
                                    </td>
                                    
                                    <td class="px-4 py-3 text-ms font-semibold border">
                                        @if ($user->socio)
                                            @php
                                                $now = config('app.now_global');
                                                $borndate = strtotime($user->socio->born_date);
                                                // Calcula la diferencia en segundos
                                                $diferencia_segundos = strtotime($now) - $borndate;
                                                $diferencia_anios = floor($diferencia_segundos / (365 * 24 * 60 * 60));
                                            @endphp
                                            {{$diferencia_anios}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->socio)
                                            <a target="_blank" href="https://api.whatsapp.com/send?phone=569{{substr(str_replace(' ', '', $user->socio->fono), -8)}}&text=Hola">
                                                <p class="mx-4 text-sm font-bold">{{$user->socio->fono}}</p>
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-xs border">
                                    @if(Cache::has('user-is-online-' . $user->id))
                                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"> En linea </span>
                                    @else
                                        <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-sm"> Disconect </span>
                                    @endif
                                       
                                    </td>

                                    <td class="px-4 py-3 text-sm border whitespace-nowrap">
                                        @if(Cache::has('user-is-online-' . $user->id))
                                            Hace 1 Min
                                        @else
                                            {{date("H:i:s d-m-Y", strtotime($user->last_seen))}}
                                        @endif
                                      
                                    </td> 
                                </tr>
                            @endif
                        @endforeach
                        
                        
                    <!-- Resto de tus filas -->
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </section>
    
    @elseif($type=='foro')
        <h1 class="font-bold text-gray-500 text-lg">Conectados: {{$online}}</h1>

        <div class="flex flex-wrap">
            @foreach ($numeros as $numero) 
                @if(Cache::has('invitado-is-online-'.$numero))
                    <p class="text-gray-400 text-sm font-bold mr-1 mb-2"> @Invitado{{$numero}}</p>
                @endif
            @endforeach
            @foreach ($users as $user)
                @if(Cache::has('user-is-online-' . $user->id))
               
                    @if ($user->socio)
                        <a class="text-blue-400 text-sm font-bold mr-1 mb-2" href="{{Route('socio.show',$user->socio)}}">{{'@'.$user->socio->slug}}</a>     

                      
                        
                    @else

                        <p class="text-blue-400 text-sm font-bold mr-1 mb-2" href="">{{'@'.$user->name}}</p>   
                        
                        
                    @endif
                   
                @endif
            @endforeach
           
           
        </div>
    
    
    @endif
 {{--
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
 
       // Enable pusher logging - don't include this in production
       Pusher.logToConsole = true;
 
       var pusher = new Pusher('72cc414c47d204994d9d', {
          cluster: 'mt1'
       });
 
       var channel = pusher.subscribe('login-status');
       channel.bind('my-event', function(data) {
             window.livewire.emit('actualizarUsersCount');
       });
    </script>

    Knowing others is intelligence; knowing yourself is true wisdom. --}}
</div>
