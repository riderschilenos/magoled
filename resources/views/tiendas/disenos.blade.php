<x-tienda-layout :tienda="$tienda">
      <main>

          @livewire('admin.pedidos-diseno',['tienda'=>$tienda->id])
          
      </main>
</x-tienda-layout>