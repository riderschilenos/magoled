<x-app-layout>

    <x-slot name="tl">
            
        <title>Lista de Eventos</title>
        
        
    </x-slot>

    <div class="max-w-4xl mx-auto px-2 sm:px-6 mt-2 lg:px-8">
        @livewire('pistas.admin-pista-home')
    </div>
    
    @livewire('organizador.eventos-index')

</x-app-layout>