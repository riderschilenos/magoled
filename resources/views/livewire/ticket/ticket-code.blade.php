<div >
    <div class="mb-4 mt-2 py-4 border-t border-gray-200">
        <div class="-mx-2 grid grid-cols-1 md:grid-cols-2">
            <div class="flex-grow px-2 lg:max-w-xs">  
                @if ($sociocode)
                        <label class="text-gray-600 font-semibold text-sm mb-2 ml-1">Codigo Activo </label>
                        <div>
                            <div class="w-full px-3 py-2 border border-gray-200 rounded-md text-center text-xl font-bold focus:outline-none focus:border-indigo-500 transition-colors" >
                                {{$sociocode->slug}}
                            </div>
                        </div>
                        <p class="text-gray-600 font-semibold text-sm mt-1 mb-1 ml-1 text-center">Coach</p>
                        <div>
                            <div class="w-full px-3 py-2 border border-gray-200 rounded-md text-center text-xl font-bold focus:outline-none focus:border-indigo-500 transition-colors" >
                                {{$sociocode->name}} {{$sociocode->lastname}}
                            </div>
                        </div>
                @endif
            </div>
            <div class="flex-grow px-2 lg:max-w-xs">
                <div>
                    <label class="text-gray-600 font-semibold text-sm mb-2 ml-1">Codigo de Inscripción</label>
                    <div>
                        <input wire:model="code" class="w-full px-3 py-2 border border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="XXXXXX" type="text"/>
                    </div>
                    @if ($sociocode)
                        @if ($code && $code!=$sociocode->slug)
                                <ul class=" z-1 left-0 bg-white mt-1 rounded-lg overflow-hidden px-4">
                                
                                    @forelse ($this->socios as $objet)
                                        <li class="leading-10 px-5 text-sm cursor-pointer bg-gray-100 border-t hover:bg-gray-300">
                                            <a href="{{route('checkout.addcode.vendedor', ['ticket' => $ticket, 'socio' => $objet])}}">{{$objet->name}} / {{'@'.$objet->slug}}</a>
                                        </li>
                                        @empty
                                    
                                        
                                
                                    @endforelse
                                
                                    
                                </ul>
                        @endif
                    @elseif($code)
                        <ul class=" z-1 left-0 bg-white mt-1 rounded-lg overflow-hidden px-4">
                                    
                            @forelse ($this->socios as $objet)
                                <li class="leading-10 px-5 text-sm cursor-pointer bg-gray-100 border-t hover:bg-gray-300">
                                    <a href="{{route('checkout.addcode.vendedor', ['ticket' => $ticket, 'socio' => $objet])}}">{{$objet->name}} / {{'@'.$objet->slug}}</a>
                                </li>
                                @empty
                            
                                
                        
                            @endforelse
                        
                            
                        </ul>
                    @endif
                </div>
                <div class="px-2 mt-6">
                    <button class="block w-full max-w-xs mx-auto border border-transparent bg-gray-400 hover:bg-gray-500 focus:bg-gray-500 text-white rounded-md px-5 py-2 font-semibold">Agregar</button>
                </div>
            </div>
           
        </div>
   

    </div>
</div>
