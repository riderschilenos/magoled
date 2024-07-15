<div>
   
    <x-table-responsive>
                        

        @if ($foros->count())
        
            <table class="min-w-full divide-y divide-gray-200 mt-4">
                <thead class="bg-gray-50">
                  <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Titulo             
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Slug 
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status 
                        </th>
                      
                      <th>
                        Delete
                      </th>
                    
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                  @foreach ($foros as $foro)

                      

                              <tr> 
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex h-10 w-10">
                                        
                                    
                                            
                                            <img class="h-11 w-11 object-cover object-center rounded-full" src="{{asset('img/rider.jpg')}}" alt="">
                                        
                                            <div class="text-sm text-gray-900 ml-3">{{$foro->titulo}}</div>
                                        
                                    </div>
                                </div>
                                
                                
                            </td>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                      <div class="flex items-center">
                                         {{$foro->slug}}
                                      </div>
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                       {{$foro->status}}
                                    </div>
                                </td>

                          

                                 
                                  
                                        
                                        <td class="flex">
                                                <a href="{{Route('foros.edit',$foro)}}">
                                                    <button class="btn btn-danger my-auto mr-2">
                                                        Editar
                                                    </button>
                                                </a>
                                                <button wire:click='categoria_destroy({{$foro}})' class="btn btn-danger my-auto">
                                                DELETE
                                                </button>

                                        </td>

                                 
                                  
                              
                              </tr>
                              
                  @endforeach
                
                </tbody>

            </table>
        @else
            <div class="px-6 py-4">
                No hay categorias ingresadas
            </div>
        @endif 
        
    </x-table-responsive>

</div>
