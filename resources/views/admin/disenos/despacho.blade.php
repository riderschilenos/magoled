<x-app-layout>
    <x-slot name="tl">
            
        <title>Producción RidersChilenos</title>
        
        
    </x-slot>
    
    @livewire('admin.pedidos-produccion',['type'=>"despacho","tienda"=>null])

    
</x-app-layout>