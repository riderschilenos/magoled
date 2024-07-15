<x-app-layout>

    <x-slot name="tl">
            
        <title>Crear Nuevo Pedido</title>
        
        
    </x-slot>

   
        <div class="container py-8 my-12 sm:my-2">
            <div class="card">
                <div class="px-3 py-4">
                    
                    <h1 class="text-2xl font-bold text-center">CREAR NUEVO PEDIDO</h1>
                    <hr class="mt-2 mb-6">
                    
                    @livewire('vendedor.pedidos-create',['type'=>'pedido'])
                  
                
                </div>
            </div>

        </div>


 
</x-app-layout>