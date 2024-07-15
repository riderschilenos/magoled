<x-app-layout>
    <x-slot name="tl">
            
        <title>Vendedores RidersChilenos</title>
        
        
    </x-slot>
       
         

                @can('Super admin')
                    <div class="bg-gray-700 pt-4">
                    
                


                        <div class="max-w-4xl mx-auto px-2 sm:px-6 mt-2 lg:px-8 pb-4" x-data="{whatsap: true}">
                                
                                @livewire('admin.money-info')

                            <div class="flex justify-between">
                                
                                <div>
                                    <button class="btn btn-success ml-2 text-center text-xl" x-on:click="whatsap=!whatsap">Whatsapp RCH</button>
                                    
                                    <button class="btn btn-success ml-2 text-center text-xl mt-2" x-on:click="whatsap=!whatsap">Historial WTSP</button>
                                </div>
                               
                                
                                <div>
                                    <a href="{{route('strava.sync')}}">
                                        <button class="btn btn-danger ml-2 mb-2 text-center text-xl">Strava Sync</button>
                                    </a>
                                    <a href="{{route('strava.check')}}">
                                        <button class="btn btn-danger ml-2 text-center text-xl">Strava Check</button>
                                    </a>
                                </div>
                                <a href="{{route('contabilidad')}}">
                                    <button class="btn btn-danger ml-2 text-center text-xl">Gráficos y Estadisticas</button>
                                </a>

                                

                            </div>

                            <div x-show="!whatsap">

                            @livewire('admin.whatsapp-sender-cliente')

                            </div>
                        </div>

                        <div class="max-w-7xl mx-auto px-2 sm:px-6 mt-2 lg:px-8">
                            @livewire('admin.pedidos-count',['tienda'=>null])
                        </div>

                    </div>
                @endcan  
                @livewire('vendedor.pedidos-index')
                <div class="max-w-4xl mx-auto px-2 sm:px-6 mt-2 lg:px-8">
                    @livewire('pistas.admin-pista-home')
                </div>
           
       
</x-app-layout>