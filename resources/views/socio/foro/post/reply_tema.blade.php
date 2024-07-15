<x-app-layout>

    <x-slot name="tl">
            
        <title>Foros | MagoLed</title>
        
        
    </x-slot>

      @livewire('socio.tema-view',['tema_id'=>$tema->id,'replytema_id'=>$tema->id,'replypost_id'=>null])

   
</x-app-layout>