<x-app-layout>

    <x-slot name="tl">
            
        <title>{{$tema->titulo}} | RidersChilenos</title>
        
        
    </x-slot>

      @livewire('socio.tema-view',['tema_id'=>$tema->id,'replytema_id'=>null,'replypost_id'=>null])

   
</x-app-layout>