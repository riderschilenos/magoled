<x-app-layout>
    <x-slot name="tl">
            
        <title>Historial de Tickets - {{$user->name}}</title>
    </x-slot>
  
        <div class="min-h-screen bg-blue-900">
            @livewire('evento-view', ['user' => $user], key($user->id))
        </div>
  
</x-app-layout>