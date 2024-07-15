<x-tienda-layout :tienda="$tienda">
    <main>
        
        
            <div class="px-6 pt-6 2xl:container">
               
                @livewire('admin.contabilidad',['tienda_id'=>$tienda->id])
            </div>
     
    </main>
</x-tienda-layout>