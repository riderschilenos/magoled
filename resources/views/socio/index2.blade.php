<x-app-layout>

    <x-slot name="tl">
            
        <title>Lista de Riders</title>
        
        
    </x-slot>

        
        <div class="words sm:hidden bg-white pt-2 overflow-x-auto whitespace-no-wrap border-b-2 font-bold text-gray-700">
            <div class="ml-4 pl-2 flex justify-center">
                <a href="">
                    <div class="px-4 ml-12 py-2 cursor-pointer underline text-gray-900">Magos</div>
                </a>
               
                <a href="{{Route('foros.index')}}">
                    <div class="px-4 py-2 cursor-pointer hover:underline">Foro</div>
                </a>
                <a href="{{Route('ticket.evento.index.desktop')}}">
                    <div class="px-4 py-2 cursor-pointer hover:underline"  >Eventos</div>
                </a>
            
                <div class="px-4 py-2 cursor-pointer hover:underline text-gray-900" @click="user = false; home = false; video = true; socio = false; evento = false; registro = false; vendedor = false; base = false" >Proyectos</div>
                <div class="px-4 py-2 cursor-pointer hover:underline" @click="user = false; novedades = true; home = false; socio = false; evento = false; registro = false; vendedor = false; base = false" >Novedades</div>
            
            <!-- Agrega más categorías aquí -->
            </div>
        </div>

        <div class="max-w-7xl mx-auto pb-8">

            <div class="card">
                
                    

                  
               
                   

                    @livewire('socio.socio-search',['type'=>'search'])
                    
                
            </div>

        </div>  

   

</x-app-layout>