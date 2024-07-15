<div>
    @can('Super admin')
        <section class="card mb-4">
            <div class="card-body">
                <div class="flex justify-center items-center">
                    <input wire:model="premio" class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Indicar premio...">
                    <button class="bg-red-500 shadow h-12 px-4 rounded-lg text-white font-bold ml-4" onclick="mostrarCargaYMostrarGanador()">
                        <i class="fas fa-medal text-base mr-2"></i>
                        Obtener Ganador Test
                    </button>
                        
                </div>
            </div>
        </section>
    @endcan

    <div id="loading" style="display:none;" class="flex justify-center">
        <div>
            <img src="{{asset('img/cargando.gif')}}" alt="Cargando..." class="flex justify-center ml-2">
            <p class="text-center text-xs mb-6">Buscando Ganador...</p>
        </div>
    </div>

    @foreach ($evento->ganadores->reverse() as $ganador)

        <section class="card mb-4">
            <div class="card-body">
                <h1 class="font-bold">  PREMIO: {{$ganador->premio}}</h1>
                <h1 class="font-semibold mb-2 text-sm whitespace-nowrap">Número Ganador: #{{$ganador->nro_premio}} (Ticket #{{$ganador->inscripcion->ticket->id}})</h1>
                <div class="flex items-center mb-4">
                    @if (str_contains($ganador->inscripcion->ticket->user->profile_photo_url,'https://ui-'))
                        <img class="flex h-14 w-14 rounded-full shadow-lg object-cover" src="https://static.vecteezy.com/system/resources/previews/021/155/831/original/motocross-helmet-mascot-logo-racer-rider-cyclist-sport-concept-suitable-for-print-web-avatar-profile-and-more-vector.jpg" alt="{{ $evento->organizador->name }}"  />
                    
                    @else
                        <img class="flex h-14 w-14 rounded-full shadow-lg object-cover" src="{{ $ganador->inscripcion->ticket->user->profile_photo_url }}" alt="{{ $ganador->inscripcion->ticket->user->name }}"  />
                    
                    @endif
                    
                    <div class="ml-4">
                        <h1 class="font-fold text-gray-500 text-lg">Ganador: {{ $ganador->name }}</h1>
                            @if ($ganador->inscripcion->ticket->user->socio)
                                @php
                                    $now = config('app.now_global');
                                    $borndate = strtotime($ganador->inscripcion->ticket->user->socio->born_date);
                                    // Calcula la diferencia en segundos
                                    $diferencia_segundos = strtotime($now) - $borndate;
                                    $diferencia_anios = floor($diferencia_segundos / (365 * 24 * 60 * 60));
                                @endphp
                                <div class="flex justify-start">
                                    <a class="text-blue-400 text-sm font-bold" href="{{route('socio.show',$ganador->inscripcion->ticket->user->socio)}}">{{'@'.Str::slug($ganador->inscripcion->ticket->user->socio->slug,'')}}</a>
                               
                                    <span class="ml-4 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 mr-2">
                                        {{$diferencia_anios}} Años
                                    </span>
                                
                                </div>
                            @endif
                        <h1 class="font-fold text-gray-500 text-lg">Fecha de compra: {{ $ganador->inscripcion->updated_at }}</h1>
                    </div>
                </div>
            </div>
        </section>

    @endforeach

    <script>
        function mostrarCargaYMostrarGanador() {
            document.getElementById('loading').style.display = 'flex'; // Mostrar la imagen de carga
            setTimeout(function() {
                document.getElementById('loading').style.display = 'none'; // Ocultar la imagen de carga después de 3 segundos
                window.livewire.emit('add_winner');// Aquí puedes agregar el código para mostrar el ganador
            }, 3000); // 3000 milisegundos = 3 segundos
        }
    </script>
    
</div>
