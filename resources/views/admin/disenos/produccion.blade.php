<x-app-layout>
    <x-slot name="tl">
            
        <title>Producción RidersChilenos</title>
        
        
    </x-slot>
    
    @livewire('admin.pedidos-produccion',['type'=>"produccion","tienda"=>null])

    
</x-app-layout>