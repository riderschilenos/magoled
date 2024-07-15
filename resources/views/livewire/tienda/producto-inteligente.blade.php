<div>
    @php
        $total=0;
        $ventatotal=0;
        foreach ($productos as $producto) {
            if ($producto->personalizable=="no") {
                if (intval($producto->costo)>0 && intval($producto->stock)>0){
                        $total+=$producto->costo*$producto->stock;
                        $ventatotal+=$producto->precio*$producto->stock;
                            }
            }  
        }
    @endphp
    <div class="">
                <div class="bg-white p-4 rounded-md w-full">
             
                    <div class="grid grid-cols-2 md:grid-cols-4 items-center gap-y-2">
                        <div class="flex bg-gray-50 items-center p-2 rounded-md col-span-2 md:col-span-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                        <input type="text" wire:model="search" wire:keydown.enter="findProduct" placeholder="Escanear SKU" class="bg-gray-50 outline-none ml-1 block" autofocus>
                        
                        </div>
                        <div class="flex ml-auto text-gray-9 col-span-2">
                            <button class="bg-gray-100 px-4 py-2 rounded-md  font-semibold tracking-wide cursor-pointer ml-2">{{$productosall->count()}} Productos</button>
                             <button class="bg-gray-100 px-4 py-2 rounded-md  font-semibold tracking-wide cursor-pointer ml-2">Inversión ${{number_format($total)}}</button>
                            <button class="bg-gray-100 px-4 py-2 rounded-md  font-semibold tracking-wide cursor-pointer ml-2 whitespace-nowrap">En Venta ${{number_format($ventatotal)}}</button>
                            <button class="bg-gray-100 px-4 py-2 rounded-md  font-semibold tracking-wide cursor-pointer ml-2">Ganancia ${{number_format($ventatotal-$total)}}</button>
                        </div>
                        <div class="flex ml-auto col-span-2 md:col-span-1">
                                <a href="{{route('tiendas.productos.manual',$tienda)}}">
                                    <button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer ml-2">Nuevo Producto</button>
                                </a>
                        </div>
                    </div>
                    <div class="flex mt-4">
                        <div class="ml-4">
                            Tipo de producto:<br>
                            <div>
                                <input type="checkbox" wire:model.live="filters.personalizable" id="personalizable" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <label for="personalizable">Personalizable</label>
                              </div>
                              <div>
                                <input type="checkbox" wire:model.live="filters.stock" id="stock" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <label for="stock">De Stock</label>
                              </div>

                            <select wire:model.live="filters.folio" name="" id="" class="hidden border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-40">
                              <option value="">Todos</option>
                              <option value="vacio">Vacios</option>
                              <option value="cero">Peso Cero</option>
                              
                             
                            </select>
                          </div>
                    </div>
                 </div>
             
                
                 
                    @if (IS_NULL($product))
                        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="">
                                <thead>
                                    <tr>
                                        <th
                                        class="py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600">
                                        Nombre
                                        </th>
                                        <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Compras
                                        </th>
                                        <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Ventas
                                        </th>
                                        <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Merma
                                        </th>
                                        <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Stock
                                        </th>
                                        <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Precio
                                        </th>
                                        <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Costo
                                        </th>
                                        <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Inversión
                                        </th>
                                        <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Personalizable
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    @if ($producto->image)
                                                        <img class="w-full h-full rounded-full"
                                                        src="{{Storage::url($producto->image)}}"
                                                        alt="" />
                                                    @else
                                                        <img class="w-full h-full rounded-full"
                                                        src="https://broxtechnology.com/images/iconos/box.png"
                                                        alt="" />
                                                    @endif
                                                
                                                            </div>
                                                    <div class="ml-3 cursor-pointer">
                                                        <a href="{{route('tiendas.productos.edit',$producto)}}">
                                                            <p class="text-gray-900 whitespace-no-wrap text-left">
                                                            {{$producto->name}}
                                                            @if ($producto->sku)
                                                                <br>sku: {{$producto->sku}}
                                                            @endif
                                                        
                                                            </p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                @php
                                                     $mermas=0;
                                                @endphp
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    @if ($producto->personalizable=='si')
                                                        <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight text-xs">
                                                        <span aria-hidden class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                                        <span class="relative">Personalizable</span>
                                                    @else
                                                        @if ($producto->stocks->count()>0)
                                                            @php
                                                                $newstock=0;
                                                               
                                                                foreach($producto->stocks as $stock){
                                                                    if ($stock->detalle=="Ingreso") {
                                                                        $newstock+=$stock->cantidad;
                                                                    }
                                                                    if ($stock->detalle=="Merma") {
                                                                        $mermas+=$stock->cantidad;
                                                                    }
                                                                    
                                                                }
                                                            @endphp
                                                            {{$newstock}}
                                                            
                                                        @else
                                                            <a href="{{route('tiendas.productos.edit',$producto)}}">
                                                              0
                                                            </a>
                                                      
                                                        @endif
                                                    
                                                        
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    @if ($producto->personalizable=='si')
                                                        <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight text-xs">
                                                        <span aria-hidden class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                                        <span class="relative">Personalizable</span>
                                                    @else
                                                        @if ($producto->ordenes->count()>0)
                                                            @php
                                                                $ordenescount=0;
                                                                foreach($producto->ordenes as $orden){
                                                                    if ($orden->pedido->status>3) {
                                                                        if ($orden->cantidad) {
                                                                            $ordenescount+=$orden->cantidad;
                                                                        } else {
                                                                            $ordenescount+=1;
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            {{$ordenescount}}
                                                            
                                                        @else
                                                            <a href="{{route('tiendas.productos.edit',$producto)}}">
                                                               0
                                                            </a>
                                                      
                                                        @endif
                                                    
                                                        
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    @if ($producto->personalizable=='si')
                                                        <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight text-xs">
                                                        <span aria-hidden class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                                        <span class="relative">Personalizable</span>
                                                    @else

                                                       {{$mermas}}
                                                    
                                                        
                                                    @endif
                                                </p>
                                            </td>

                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                @if ($producto->personalizable=='si')
                                                    <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight text-xs">
                                                    <span aria-hidden class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">Personalizable</span>
                                                @else
                                                    @if ($producto->stock)
                                                        {{$producto->stock}}
                                                    @elseif($producto->stock==null)
                                                        <a href="{{route('tiendas.productos.edit',$producto)}}">
                                                            <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                            <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                            <span class="relative">Pendiente</span>
                                                        </a>
                                                    @else
                                                        <a href="{{route('tiendas.productos.edit',$producto)}}">
                                                        0
                                                        </a>
                                                    @endif
                                                
                                                    
                                                @endif
                                            </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                ${{number_format($producto->precio)}}
                                            </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                @if ($producto->costo)
                                                ${{number_format($producto->costo)}}
                                            @else
                                                <a href="{{route('tiendas.productos.edit',$producto)}}">
                                                    <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">Pendiente</span>
                                                </a>
                                            @endif
                                            </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    @if ($producto->personalizable=='si')
                                                    <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight text-xs">
                                                    <span aria-hidden class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">Personalizable</span>
                                                @else
                                                    
                                                    @if (intval($producto->costo)>0 && intval($producto->stock)>0)
                                                        ${{number_format($producto->costo*$producto->stock)}}
                                                    @else
                                                        $0
                                                    @endif
                                                
                                                    
                                                @endif
                                                
                                                </p>
                                                </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                @if ($producto->personalizable=='si')
                                                        <span
                                                                    class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                                    <span aria-hidden
                                                                        class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">SI</span>
                                                @elseif ($producto->personalizable=='no')
                                                        <span
                                                                    class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                                    <span aria-hidden
                                                                        class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">NO</span>
                                                @else
                                                <div class="flex justify-center">
                                                    <div  wire:click="set_personalizadoon({{$producto->id}})" class="cursor-pointer">
                                                    <span
                                                                class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                                                <span aria-hidden
                                                                    class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                                <span class="relative">SI</span>
                                            </div>
                                            <div wire:click="set_personalizadooff({{$producto->id}})" class="cursor-pointer">
                                                                            <span
                                                                            class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                                                            <span aria-hidden
                                                                                class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                                            <span class="relative">NO</span>
                                                        </div>
                                                        </div>
                                                @endif
                                               
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div
                                class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                                <span class="text-xs xs:text-sm text-gray-900">
                                           {{$productos->links()}}
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
                    @endif
                
                
              </div>
           </div>
     </div>
     <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
     <script>
                        
            ClassicEditor
            .create(document.querySelector('#descripcion'), {
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'underline',
                        'strikethrough',
                        'link',
                        '|',
                        'bulletedList',
                        'numberedList',
                        'todoList',
                        '|',
                        'outdent',
                        'indent',
                        '|',
                        'alignment',
                        'fontBackgroundColor',
                        'fontColor',
                        'fontSize',
                        'fontFamily',
                        '|',
                        'highlight',
                        'subscript',
                        'superscript',
                        'removeFormat',
                        'code',
                        'codeBlock',
                        '|',
                        'imageInsert',
                        'blockQuote',
                        'insertTable',
                        'mediaEmbed',
                        'pageBreak',
                        '|',
                        'undo',
                        'redo',
                        '|',
                        'horizontalLine',
                        'htmlEmbed',
                        'MathType',
                        '|',
                        'exportPdf',
                        'exportWord',
                        'exportHtml',
                        '|',
                        'find',
                        'selectAll',
                        'sourceEditing',
                        '|',
                        'undo',
                        'redo'
                    ],
                    shouldNotGroupWhenFull: true
                },
                language: 'es',
                image: {
                    toolbar: [
                        'imageTextAlternative',
                        'imageStyle:full',
                        'imageStyle:side',
                        '|',
                        'imageResize',
                        'imageResize:50',
                        'imageResize:75',
                        '|',
                        'imageTextAlternative'
                    ]
                },
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells',
                        'tableProperties',
                        'tableCellProperties'
                    ]
                },
                licenseKey: '',
            })
            .catch(error => {
                console.error(error);
            });
     </script>
     <script>
        document.addEventListener('keydown', function(event) {
            if (event.code === 'Enter') {
                // Obtener el valor del escáner de código de barras
                let scannedValue = /* Lógica para obtener el valor escaneado */;
                
                // Asignar el valor escaneado al input y disparar el evento keydown
                let inputField = document.querySelector('input[type="text"]');
                inputField.value = scannedValue;
                inputField.dispatchEvent(new Event('input'));
                inputField.dispatchEvent(new KeyboardEvent('keydown', {'key': 'Enter'}));
            }
        });
    </script>
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            setTimeout(() => {
                let inputField = document.querySelector('input[type="text"]');
                inputField.value = '';
            }, 5000); // Limpiar después de 5 segundos (ajusta este valor según sea necesario)
        });
    </script>
</div>
