<x-app-layout>

    <x-slot name="tl">
            
        <title>Tienda {{$tienda->nombre}}</title>
        
        
    </x-slot>

        
       

        <div class="">

            <div class="">
                
                    

                  

                   

                @livewire('vendedor.public-show',['tienda_id'=>$tienda->id])
                
                    
                
            </div>

        </div>  


</x-app-layout>