<x-app-layout>

    <x-slot name="tl">
            
        <title>Listado de tiendas - Admin</title>
        
        
    </x-slot>

    <link
	href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
	rel="stylesheet">
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <h1 class="my-4 text-center font-bold text-lg">Listado de Tiendas</h1>
    <div class="mx-2 md:mx-6 xl:mx-12 pb-20">
        <x-table-responsive>
                <table class="table text-gray-400 border-separate space-y-1 text-sm">
                    <thead class="bg-white text-gray-800">
                        <tr>
                            <th class="p-3">Tienda</th>
                            <th class="p-3 text-left">Categoria</th>
                            <th class="p-3 text-left">Disciplina</th>
                            <th class="p-3 text-left">Facturación</th>
                            <th class="p-3 text-left">Total</th>
                            <th class="p-3 text-left">Productos</th>
                            <th class="p-3 text-left">Estado</th>
                            <th class="p-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tiendas as $tienda)
                                @php
                                    $total=0;
                                    $total7=0;
                                    $total30=0;
                                @endphp
                           
                            @foreach ($tienda->subpagos($tienda->id) as $pago)
                            @php
                                $total+=$pago->cantidad;
                            @endphp
                            @endforeach

                            @if ($tienda->id==4)
                                @if ($tickets30)
                                    @foreach ($tickets30 as $ticket)
                                    @php
                                        $total30+=$ticket->inscripcion;
                                    @endphp
                                    @endforeach
                                @endif
                                @if ($sortedTickets30)
                                    @foreach ($sortedTickets30 as $ticket)
                                    @php
                                        $total30+=$ticket->inscripcion;
                                    @endphp
                                    @endforeach
                                @endif
                                
                                @if ($suscripcions30)
                                    @foreach ($suscripcions30 as $suscripcion)
                                    @php
                                        $total30+=$suscripcion->precio;
                                    @endphp
                                    @endforeach
                                @endif
                            @endif
                            
                            {{-- comment      
                            
                            @foreach ($pagos7 as $pago)
                            @php
                                $total7+=$pago->cantidad;
                            @endphp
                            @endforeach
                             --}}
                            @foreach ($tienda->subpagos30($tienda->id) as $pago)
                            @php
                                $total30+=$pago->cantidad;
                            @endphp
                            @endforeach

                            <tr class="bg-white">
                                <td class="p-3">
                                    <a href="{{route('tiendas.edit',$tienda)}}">
                                        <div class="flex align-items-center pr-6 ">
                                            <img class="rounded-full h-12 w-12  object-cover" src="https://images.unsplash.com/photo-1613588718956-c2e80305bf61?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=634&q=80" alt="unsplash image">
                                            <div class="ml-3">
                                                <div class="">{{$tienda->nombre}}</div>
                                                <div class="text-gray-500">{{$tienda->user->email}}</div>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                                <td class="p-3">
                                    {{$tienda->disciplina->name}}
                                </td>
                                <td class="p-3">
                                    Velocidad
                                </td>
                                <td class="p-3 font-bold">
                                    ${{number_format($total30,0)}}
                                </td>
                                <td class="p-3 font-bold">
                                    ${{number_format($total,0)}}
                                </td>
                                <td class="p-3 font-bold">
                                   @if ($tienda->productos)
                                       {{$tienda->productos->count()}}
                                   @else
                                       0
                                   @endif
                                </td>
                                <td class="p-3">
                                    <span class="bg-green-400 text-gray-50 rounded-md px-2">available</span>
                                </td>
                                <td class="p-3 flex justify-center items-center content-center pt-6" >
                                    <a href="{{route('tiendas.edit',$tienda)}}" class="text-gray-400 hover:text-gray-100 mr-2 my-auto" target="_blank">
                                        <i class="material-icons-outlined text-base">visibility</i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-gray-100  mx-2 my-auto">
                                        <i class="material-icons-outlined text-base">edit</i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-gray-100  ml-2 my-auto">
                                        <i class="material-icons-round text-base">delete_outline</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                      
                    </tbody>
                </table>
        </x-table-responsive>
    </div>
<style>
	.table {
		border-spacing: 0 15px;
	}

	i {
		font-size: 1rem !important;
	}

	.table tr {
		border-radius: 20px;
	}

	tr td:nth-child(n+5),
	tr th:nth-child(n+5) {
		border-radius: 0 .625rem .625rem 0;
	}

	tr td:nth-child(1),
	tr th:nth-child(1) {
		border-radius: .625rem 0 0 .625rem;
	}
</style>
  

</x-app-layout>