<x-app-layout>

    <x-slot name="tl">
            
        <title>Listado de Vendedores - Admin</title>
        
        
    </x-slot>

    <link
	href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
	rel="stylesheet">
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <h1 class="my-4 text-center font-bold text-lg">Listado de Vendedores</h1>
    <div class="mx-2 md:mx-6 xl:mx-12 pb-20">
        <x-table-responsive>
            @if ($vendedors->count())
            @php
                $totalint=0;
                $totalgan=0;
            @endphp
    @foreach ($vendedors as $vendedor)
       
            @foreach ($vendedor->user->pagos as $pago)
            @php
                $totalint+=$pago->cantidad;
            @endphp               
            @endforeach
    
            @foreach ($vendedor->user->gastos as $gasto)
                @php
                    $totalgan+=$gasto->cantidad;
                @endphp           
            @endforeach
    
    
    
    @endforeach 
          
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <th>ID</th>
                <th style="text-align: center;">Foto</th>
                <th>Nombre</th>
                <th>Fono</th>
                <th>Email</th>
                <th class="text-center">${{number_format($totalint)}}<br>Ventas</th>
                <th class="text-center">${{number_format($totalgan)}}<br>Ganancias</th>
                <th class="text-center">${{number_format(($totalgan*100)/$totalint)}}%<br>Margen</th>
                
                
                <th>Estado</th>
                
                <th></th>
    
            </thead>
            
            <tbody>
                @php
                    $n=1;
                @endphp
                @foreach ($vendedors as $vendedor)
                    @if ($vendedor->id!=1 && $vendedor->id!=25)
                        <tr>
                            <td>{{$n}}</td>
                            <td style="text-align: center;">                            
                                <img class="object-cover object-center" width="60px" src="{{ $vendedor->user->profile_photo_url }}" alt="">
                            </td>
                            <td>
                                <a href="{{route('vendedor.contabilidad', $vendedor)}}">
                                    {{$vendedor->user->name}}
                                </a></td>
                            <td>
                                @if ($vendedor->fono)
                                <a href="https://api.whatsapp.com/send?phone=569{{substr(str_replace(' ', '', $vendedor->fono), -8)}}&text=Hola%20que%20tal" target="_blank">
                                    {{str_replace(' ', '', $vendedor->fono)}}
                                </a> 
        
                                @endif</td>
                            <td>{{$vendedor->user->email}}</td>
                            <td class="text-center">
                                @php
                                    $total=0;
                                @endphp
                                @foreach ($vendedor->user->pagos as $pago)
                                
                                    @php
                                        $total+=$pago->cantidad;
                                    @endphp  
                                
                                                
                                @endforeach
                                
                                
                                ${{number_format($total)}}</td>
                            
                            <td class="text-center">
                                    @php
                                        $total2=0;
                                    @endphp
                                    @foreach ($vendedor->user->gastos as $gasto)
                                        @php
                                            $total2+=$gasto->cantidad;
                                        @endphp   
                                                    
                                    @endforeach
                                    
                                    
                                    ${{number_format($total2)}}
                                </td>
                          
                            <td class="text-center">
                                @if ($total>0)
                                    {{number_format(($total2*100)/$total)}}%
                                @else
                                    0%
                                @endif
                            </td>
                            
                            <td>
                                @if($vendedor->estado==2)
                                    {!! Form::open(['route'=>['admin.vendedors.update',$vendedor], 'method'=> 'PUT' ]) !!}
                                        @csrf
                                    {!! Form::submit('ACTIVO', ['class'=>'btn btn-success cursor-pointer']) !!}
                                    {!! Form::close() !!}
        
                                @else
                                    {!! Form::open(['route'=>['admin.vendedors.update',$vendedor], 'method'=> 'PUT' ]) !!}
                                        @csrf
                                    {!! Form::submit('INACTIVO', ['class'=>'btn btn-primary cursor-pointer']) !!}
                                    {!! Form::close() !!}
                                @endif
                            
                            </td>
                            <td>
                            </td>
                            <td width="10px">
                                {{-- comment 
                                <a class="btn btn-primary" href="{{route('socio.show', $vendedor)}}">Ver Perfil</a>--}}
                            </td>
                        </tr>
                        @php
                            $n+=1;
                        @endphp
                    @endif
                @endforeach
    
            </tbody>
        </table>
    </div>
    
    
    @else
    <div class="card-body">
        <strong>No hay registros que coincidan</strong>
    </div>
    
    
    @endif
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