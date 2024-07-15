<div>
    @php
$total=0;
$ventastotal=0;
$comprastotal=0;
$mermatotal=0;

foreach ($smartphones->reverse() as $smartphone){
    $total=$total+$smartphone->stock;
    if ($smartphone->ordenes) {
        foreach ($smartphone->ordenes as $orden) {
            if ($orden->pedido->status>3) {
                if ($orden->cantidad) {
                    $ventastotal+=$orden->cantidad;
                } else {
                    $ventastotal+=1;
                }
            }
        }
    }
    if ($smartphone->stocks) {
        foreach ($smartphone->stocks as $stock) {
            if ($stock->detalle=="Ingreso") {
                $comprastotal+=$stock->cantidad;
            } elseif($stock->detalle=="Merma") {
                $mermatotal+=$stock->cantidad;
            }
        }
    }
    
}

$total2=0;
$ventastotal2=0;
$comprastotal2=0;
$mermatotal2=0;

foreach ($smartphonesall->reverse() as $smartphone){
    $total=$total+$smartphone->stock;
    if ($smartphone->ordenes) {
        foreach ($smartphone->ordenes as $orden) {
            if ($orden->pedido->status>3) {
                if ($orden->cantidad) {
                    $ventastotal2+=$orden->cantidad;
                } else {
                    $ventastotal2+=1;
                }
            }
        }
    }
    if ($smartphone->stocks) {
        foreach ($smartphone->stocks as $stock) {
            if ($stock->detalle=="Ingreso") {
                $comprastotal2+=$stock->cantidad;
            } elseif($stock->detalle=="Merma") {
                $mermatotal2+=$stock->cantidad;
            }
        }
    }
    
}


@endphp
    

    <div class="0 ">
        
        <div class="grid grid-cols-1 md:grid-cols-3 justify-content-md-center mt-12 gap-4">

            <div class="bg-white p-6 m-4">
                <div class="">
                    
                       
                        
                        <div class="form-group">
                            <Label class="w-80 mt-4">Marca:</Label>
                                <div class="items-center ">
                                    
                                    <select wire:model="selectedmarca" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($marcas as $marca)
                            
                                            <option value="{{$marca->id}}">{{$marca->name}}</option>
                                            
                                        @endforeach
                                    </select>
                                </div>
        
        
                
        
                            
                        
        
                           
        
                        {!! Form::open(['route'=>'admin.smartphone.store', 'autocomplete'=>'off', 'method'=> 'POST' ]) !!}
                                @csrf
        
        
                            {!! Form::hidden('marcasmartphone_id',$selectedmarca) !!}
                          
                         
        
                            <div class="mb-4 mt-2">
                                {!! Form::label('modelo','Modelo') !!}
                                {!! Form::text('modelo',null, ['class'=>'form-control','placeholder'=>'Ingrese el nombre del modelo']) !!}
                            </div>
        
                          
                            @error('modelo')
                                <span class="text-danger">{{$message}}</span>
                                
                            @enderror
        
                            <div class="mb-4">
                                {!! Form::label('stock', 'Stock:') !!}
                                {!! Form::number('stock', null , ['class'=>'form-control', 'placeholder'=>'Ingrese el stock actual']) !!}
                            
                                @error('stock')
                                    <strong class="text-xs text-red-600">{{$message}}</strong>
                                @enderror
                            </div>
        
                        </div>
                        {!! Form::submit('Crear Smartphone', ['class'=>'font-bold py-2 px-4 rounded bg-blue-500 text-white']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            
            <div class="">
                <div class="bg-white text-gray-500 bg-success mb-3 p-4" style="max-width: 18rem;">
                <div class="card-body">
                    @foreach ($marcasmartphones as $marcasmartphone)
                        @php
                            $subtotal=0;
                        @endphp
                        @foreach ($smartphones as $smartphone)
                            @if ($smartphone->marcasmartphone_id==$marcasmartphone->id)




                                @php
                                     $subtotal=$subtotal+$smartphone->stock;
                                @endphp
                               
                                
                            @endif
                            
                        @endforeach
                        <h5 class="text-gray-700">{{$subtotal}}  {{$marcasmartphone->name}} </h5><br>
                    @endforeach
                   
                </div>
                </div>
            </div>

                <div class="">
                    <div class="bg-white text-gray-700 bg-danger mb-3 p-4" style="max-width: 18rem;">
                        <div class="font-bold">Capital</div>
                        <div class="card-body">
                        

                                <h3>${{number_format(($comprastotal2-$ventastotal2-$mermatotal2)*2500)}}</h1>
                                @if ($search)
                                    <h3>-${{number_format(($comprastotal-$ventastotal-$mermatotal)*2500)}}</h1>
                                @endif
                               
                        
                        </div>
                </div>

                <div class="bg-white text-gray-700 bg-danger mb-3 p-4" style="max-width: 18rem;">
                    <div class="font-bold">Stock Critico</div>
                    <div class="card-body">
                        @php
                            $subcritico=0;
                        @endphp
                        @foreach ($smartphones as $item)
                            @if ($item->stock<3 && $item->notification=='checked')
                                @php
                                     $subcritico+=1;
                                @endphp
                            
                                <h5 class="card-title"> {{$item->modelo}} Stock: {{$item->stock}}</h5>
                                
                            @endif
                            
                            
                        @endforeach
                        @if ($subcritico==0)

                            <h3>Sin Stock Critico</h1>
                        @endif
                    
                    </div>
                </div>
                <div class="bg-white text-gray-700 bg-danger mb-3 p-4" style="max-width: 18rem;">
                    <div>
                        Total Carcasas Compradas: {{$comprastotal}}
                    </div>
                    <div>
                        Total Carcasas Vendidas: {{$ventastotal}}
                    </div>
                    <div>
                        Total Merma Carcasas: {{$mermatotal}}
                    </div>
                    <div>
                        Stock Total: {{$comprastotal2-$ventastotal2-$mermatotal2}}
                    </div>
                    @if ($search)
                        <div>
                            Stock Actual: {{$comprastotal-$ventastotal-$mermatotal}}
                        </div>
                    @endif
                </div>
                <button wire:click="refresh()" class="font-bold py-2 px-4 rounded bg-blue-500 text-white">
                    Refresh
                </button>
            </div>
           
            
        </div>
    </div>

    
      

@if (session('info'))
    <div class="alert alert-success">
        {{session('info')}}
    </div>
@endif
<div class="px-2 py-2">
    <input wire:model="search"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Ingrese el nombre de un rider" autocomplete="off">
</div>
<div class="card">
    <div class="card-body">
        <div class="overflow-x-auto">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Notificación</th>
                        <th>Compras</th>
                        <th>Ventas</th>
                        <th>Merma</th>
                        <th>stock</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                
                    @foreach ($smartphones as $smartphone)
                    
                        <tr>
                            <td>
                                {{$smartphone->id}}
                            </td>
                            <td>
                                {{$smartphone->marcasmartphone->name}}
                            </td>
                            <td>
                                {{$smartphone->modelo}}
                            </td>
                            <td>
                                    <input type="checkbox" {{$smartphone->notification}} wire:click="toggleNotification({{$smartphone->id}})">
    
                            </td>
                            <td>
                                @php
                                    $compratotal=0;
                                    $merma=0;
                                    $ventas=0;
                                    foreach ($smartphone->stocks as $stock) {
                                        if ($stock->detalle=="Ingreso") {
                                            $compratotal+=$stock->cantidad;
                                        } else {
                                            $merma+=$stock->cantidad;
                                        }
                                        
                                    
                                    }
                                @endphp
                                
                            {{$compratotal}}
                                    
                            </td>
                            
                            <td>
                                @foreach ($smartphone->ordenes as $orden)
                                    @if ($orden->pedido->status>3) 
                                        @php
                                            if ($orden->cantidad) {
                                                $ventas+=$orden->cantidad;
                                            } else {
                                                $ventas+=1;
                                            }
                                        @endphp
                                    @endif
                                @endforeach
                                {{$ventas}}
                                    
                            </td>
                            <td>
                                {{$merma}}
                            </td>
                            <td>
                              
                                 <button class="font-bold py-2 px-4 rounded bg-white text-gray-800 text-sm" wire:click="edit({{$smartphone->id}})"> {{$smartphone->stock}}</button>

                               
                                    
                            </td>
                            <td width="10px">
                                @if ($obj==$smartphone->id)
                                <select wire:model="detalle" class="form-input w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none">
                                    <option value="Ingreso">Ingreso</option>
                                    <option value="Merma">Merma</option>
                                </select>
                               
                                    <div class="flex items-center mt-4">
                                        <label class="w-32">Cantidad:</label>
                                    
                                        <input wire:model="stock" class="form-input w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none">
                                    </div>
            
                            
                                    
                                    <div class="mt-4 flex justify-end">
                                        <button wire:click="stockcreate({{$smartphone->id}})" type="submit" class="font-bold py-2 px-4 rounded bg-blue-500 text-white text-sm">Agregar</button>
                                        <button type="button" class="btn btn-danger text-sm ml-2" wire:click="cancel" >Cancelar</button>
                                    
                                    </div>
                                    
                               
            

                                @else
                                
                                    <div class="flex">
                                        <button wire:click="editadd1({{$smartphone->id}})" class="mr-2 font-bold py-2 px-4 rounded bg-blue-500 text-white text-sm" wire:click="edit({{$smartphone->id}})">1</button>
                                        <button wire:click="editadd2({{$smartphone->id}})" class="mr-2 font-bold py-2 px-4 rounded bg-blue-500 text-white text-sm" wire:click="edit({{$smartphone->id}})">2</button>
                                        <button wire:click="editadd3({{$smartphone->id}})" class="font-bold py-2 px-4 rounded bg-blue-500 text-white text-sm" wire:click="edit({{$smartphone->id}})">3</button>
                                    </div>

                                @endif
                                
            
                            </td>
                            <td width="10px">
                                @can('Super admin')
                                    <form action="{{route('admin.smartphone.destroy',$smartphone)}}" method="POST">
                                        @csrf
                                        @method('delete')

                                        <button class="btn btn-danger btn-sm" type="submit"> Eliminar</button>
                                    </form>
                                @endcan
                            
                            </td>
                        </tr>
                        @if ($obj==$smartphone->id)
                        <thead>
                            <tr class="w-full">
                                <td class="text-center">
                                    Historial Stocks
                                </td>
                            </tr>
                        </thead>
                            @foreach ($smartphone->stocks->reverse() as $stock)
                                
                                <tr>
                                    <td>
                                    
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        {{$stock->detalle}}
                                    </td>
                                    <td>
                                        {{$stock->cantidad}}
                                        
                                    </td>
                                    <td>
                                        {{$stock->created_at}}
                                    </td>
                                    <td>
                                        <button wire:click="destroystock({{$stock->id}})">
                                            Eliminar
                                        </button> 
                                    </td>
                                    <td>
                                        @php
                                            $smartphone->stock=$smartphone->stocks->count()-$smartphone->ordenes->count();
                                            $smartphone->save();
                                        @endphp
                                            
                                    </td>
                                    <td width="10px">
                                        @if ($obj==$smartphone->id)
                                                
                                    

                                        @else
                                        
                                            
                                            <button class="font-bold py-2 px-4 rounded bg-blue-500 text-white text-sm" wire:click="edit({{$smartphone->id}})">Editar Stock</button>

                                        @endif
                                        
                    
                                    </td>
                                    <td width="10px">
                                    
                                    
                                    </td>
                                </tr>
                                
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
