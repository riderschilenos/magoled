<x-app-layout>

    <x-slot name="tl">
            
        <title>Agregar Nuevo Participante</title>
        
        
    </x-slot>

  
        <div class="max-w-7xl mx-auto px-2 py-2 sm:py-8 sm:my-2">
            <div class="">
                <div class="py-4">
                    @livewire('vendedor.pedidos-create',['type'=>'ticket'])
                </div>
            </div>

        </div>


   
</x-app-layout>