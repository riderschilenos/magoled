<x-tienda-layout :tienda="$tienda">
   
   @livewire('tienda.pos',['tienda'=>$tienda], key($tienda->id))
      

</x-tienda-layout>