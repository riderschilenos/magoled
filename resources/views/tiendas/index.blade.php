<x-app-layout>

    <x-slot name="tl">
            
        <title>Lista de Productos</title>
        
        
    </x-slot>

        
       

        <div class="max-w-7xl mx-auto pb-8">

            <div class="">
                
                    

                  

                   

                @livewire('vendedor.public-show',['tienda_id'=>"NULL"])
                    
                
            </div>

        </div>  


</x-app-layout>