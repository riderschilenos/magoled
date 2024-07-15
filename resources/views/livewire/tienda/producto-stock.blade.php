<div>

    <div class="flex items-center mb-4">
        <div class="block items-center mt-4 mr-4">
          <h1 class="2xl font-bold text-center">{{$producto->stock}} STOCK</h1>
        
        </div>
        <div class="block items-center mt-4">
            <label class="w-32">Añadir nuevo registro:</label>
            @error('stock')
                <strong class="text-xs text-red-600">{{$message}}</strong>
            @enderror
            <input wire:model="stock" wire:keydown.enter="stockcreate()" class="form-input w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none">
           
        </div>
        <select wire:model="detalle" class="form-input w-full border-2 border-gray-300 bg-white h-10 px-5 rounded-lg text-sm focus:outline-none mt-auto mx-2">
            <option value="Ingreso">Ingreso</option>
            <option value="Merma">Merma</option>
        </select>
       
          

    
            
            <div class="mt-auto flex justify-end">
              
                <button wire:click="stockcreate()" type="submit" class="font-bold py-2 px-4 rounded bg-blue-500 text-white text-sm">Agregar</button>
            
            </div>

    </div>


      <div class="overflow-x-auto mb-4">
        <table class="min-w-full bg-white shadow-md rounded-xl">
          <thead>
            <tr class="bg-blue-gray-100 text-gray-700">
              <th class="py-1 px-4 text-left">Tipo</th>
              <th class="py-1 px-4 text-left">Fecha</th>
              <th class="py-1 px-4 text-left">Cantidad</th>
              <th class="py-1 px-4 text-left">Action</th>
            </tr>
          </thead>
          <tbody class="text-blue-gray-900">
            @if ($producto->stocks->count()>0)
                @foreach ($producto->stocks->reverse() as $stock)
                    <tr class="border-b border-blue-gray-200">
                        <td class="py-1 px-4">
                            @if ($stockedit_id==$stock->id)
                                <select wire:model="wdetalle" class="form-input w-full border-2 border-gray-300 bg-white h-10 px-5 rounded-lg text-sm focus:outline-none mt-auto mx-2">
                                    <option value="Ingreso">Ingreso</option>
                                    <option value="Merma">Merma</option>
                                </select>
                            @else
                                {{$stock->detalle}} 
                            @endif</td>
                        <td class="py-1 px-4 whitespace-nowrap">{{$stock->created_at}}</td>
                        <td class="py-1 px-4">
                            @if ($stockedit_id==$stock->id)
                                <input wire:model="wstock" class="form-input w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none">
       
                            @else
                                {{$stock->cantidad}}
                            @endif</td>
                        <td class="py-1 px-4">
                            @if ($stockedit_id==$stock->id)
                                <span wire:click="save_stock()" class="font-medium text-green-600 hover:text-green-800 cursor-pointer mr-4">Guardar</span>
                              
                            @else
                                <span wire:click="set_editstock({{$stock->id}})" class="font-medium text-blue-600 hover:text-blue-800 cursor-pointer mr-4">Editar</span>
                                <span wire:click="destroystock({{$stock->id}})" class="font-medium text-red-600 hover:text-blue-800 cursor-pointer">Eliminar</span>
                            @endif</td>
                              
                        </td>
                    </tr>
                @endforeach
           @else
                <!-- Add more rows as needed -->
                <tr class="border-b border-blue-gray-200 bg-red-500">
                <td class="py-3 px-4 font-medium text-white font-bold" colspan="4">Sin Stock disponible</td>
                
                </tr>
            @endif
    

          </tbody>
        </table>
      </div>

</div>
