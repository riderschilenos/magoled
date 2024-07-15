
    <div class="">
      @php
          $dias=['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];
      @endphp
        <div class="bg-white p-4 rounded-md w-full">
             
                 <div class="flex justify-between items-center ">
                    <div class="flex bg-gray-50 items-center p-2 rounded-md">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                          fill="currentColor">
                          <path fill-rule="evenodd"
                             d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                             clip-rule="evenodd" />
                       </svg>
                       <input wire:keydown="limpiar_page" wire:model="search" class="bg-gray-50 outline-none ml-1 block " type="text" name="" id="" placeholder="search...">
                    </div>
                    <div class="mx-auto flex justify-center">
                     
                        {{$pedidos30->count()}} Pedidos del mes
                    </div>
                       <div class="flex ml-auto">
                          <button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">New Report</button>
                          <button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer ml-2">Nuevo Pedido</button>
                       </div>
                    </div>
                 </div>
             
                 <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                       <table class="min-w-full leading-normal">
                          <thead>
                             <tr>
                                <th
                                   class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                   Nombre
                                </th>
                                <th
                                   class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                   Productos
                                </th>
                                <th
                                   class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                   Fecha
                                </th>
                                <th
                                   class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                   QRT
                                </th>
                                <th
                                   class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                   Status
                                </th>
                             </tr>
                          </thead>
                          <tbody>

                            @foreach ($pedidos as $pedido)
                                <tr>
                                   <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                      <div class="flex items-center">
                                        id:{{$pedido->id}}
                                         <div class="flex-shrink-0 w-10 h-10 ml-4">
                                           
                                            <img class="w-full h-full rounded-full"
                                                           src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                                           alt="" />
                                                  </div>
                                            <div class="ml-3">
                                               <p class="text-gray-900 whitespace-no-wrap">
                                                @if($pedido->pedidoable_type=='App\Models\Socio')
                                                @foreach ($socios as $socio)
                                                        
                                                        @if($socio->id == $pedido->pedidoable_id)
                                                            <a href="{{route('vendedor.pedidos.edit',$pedido)}}" target="_blank">
                                                                {{$socio->user->name}}
                                                            
                                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                    Socio
                                                                </span>
                                                            </a>
                                                        @endif
                                                @endforeach
                                            @endif
                                            @if($pedido->pedidoable_type=='App\Models\Invitado')
                                                @foreach ($invitados as $invitado)
                                                        
                                                        @if($invitado->id == $pedido->pedidoable_id)
                                                        <a href="{{route('vendedor.pedidos.edit',$pedido)}}"  target="_blank">
                                                            {{$invitado->name}} 
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                Invitado
                                                            </span>
                                                        </a>
                                                        @endif
                                                @endforeach
                                            @endif
                                               </p>
                                            
                                            </div>
                                         </div>
                                   </td>
                                   <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                       @foreach ($pedido->ordens->reverse() as $orden)
                                          <div class="flex justify-center">
                                             @if($orden->smartphone)
                                                <span class="whitespace-nowrap mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                   {{Str::limit($orden->producto->name,6)." (".$orden->smartphone->marcasmartphone->name."; ".$orden->smartphone->modelo.")"}}
                                                   
                                                </span>
                                                   
                                                @else
                                                   <span class="whitespace-nowrap mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                      {{$orden->producto->name}}
                                                   </span>
                                                   
                                                @endif
                                          </div>
                                       @endforeach
                                   </td>
                                   <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                       <div class="text-sm text-gray-500">{{$dias[date('N', strtotime($pedido->created_at))-1]}}</div>
                                       <div class="text-sm text-gray-900 whitespace-nowrap">{{$pedido->created_at->format('d-m-Y')}}</div>   
                                       <div class="text-sm text-gray-500">{{$pedido->created_at->format('H:i:s')}}</div>
                                   </td>
                                   <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                      <p class="text-gray-900 whitespace-no-wrap">
                                         43
                                      </p>
                                   </td>
                                   <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                       @switch($pedido->status)
                                          @case(1)
                                             <span class="inline-flex px-3 py-1 leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Borrador
                                             </span>
                                             @break
                                          @case(2)
                                             <span class="inline-flex px-3 py-1 leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Pendiente de Pago
                                             </span>
                                             @break
                                          @case(3)
                                             <span class="inline-flex px-3 py-1 leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Procesando Pago
                                             </span>
                                             @break
                                          @case(4)
                                             <span class="inline-flex px-3 py-1 leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pendiente de diseño
                                             </span>
                                             @break
                                             @case(5)
                                             <span class="inline-flex px-3 py-1 leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Pendiente de producción
                                             </span>
                                             @break
                                             @case(6)
                                             <span class="inline-flex px-3 py-1 leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pendiente de despacho
                                             </span>
                                             @break
                                             @case(7)
                                             <span class="inline-flex px-3 py-1 leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Despachado
                                             </span>
                                             @break
                                             @case(8)
                                             <span class="inline-flex px-3 py-1 leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Procesando Comisión
                                             </span>
                                             @break
                                             @case(9)
                                             <span class="inline-flex px-3 py-1 leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Cerrado
                                             </span>
                                             @break
                                          @default
                                        
                                       @endswitch
                                     
                                   </td>
                                </tr>
                            @endforeach
                            
                          </tbody>
                       </table>
                       <div
                          class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                          <span class="text-xs xs:text-sm text-gray-900">
                                    Showing 1 to 4 of 50 Entries
                                </span>
                          <div class="inline-flex mt-2 xs:mt-0">
                             <button
                                        class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-l">
                                        Prev
                                    </button>
                             &nbsp; &nbsp;
                             <button
                                        class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-r">
                                        Next
                                    </button>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
     </div>
