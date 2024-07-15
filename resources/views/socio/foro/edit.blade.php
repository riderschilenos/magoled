<x-app-layout>

    <x-slot name="tl">
            
        <title>Administrador De foros | RidersChilenos</title>
        
        
    </x-slot>

    <div class="container py-8 ">
        
        <div class="card">
            <div class="card-body">
                <h1 class="text-2xl font-bold">Nuevo Foro</h1>
                <hr class="mt-2 mb-6">

                {!! Form::model($foro, ['route'=>['foros.update',$foro],'method' => 'put', 'files'=> true , 'autocomplete'=>'off']) !!}
                    
               
                    @php
                        $categorias=['PUBLICO GENERAL'=>'PUBLICO GENERAL']
                    @endphp
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            {!! Form::label('categoria', 'Categoria:') !!}
                            {!! Form::select('categoria', $categorias, null , ['class'=>'form-input block w-full mt-1']) !!}
                        </div>
                        <div>
                            <div class="mb-4">
                                {!! Form::label('titulo', 'Titulo') !!}
                                {!! Form::text('titulo', null , ['class' => 'form-input block w-full mt-1'.($errors->has('titulo')?' border-red-600':'')]) !!}
        
                                @error('titulo')
                                    <strong class="text-xs text-red-600">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">
    
                            <div class="hidden">
                                {!! Form::label('slug', 'Slug') !!}
                            </div>
                            <h1>URL:</h1>
                            {!! Form::text('slug', null , ['readonly'=>'redonly','class' => 'form-input block w-full mt-1']) !!}
                        </div>

                    </div>

                   
                       
                        <div class="mb-4">
                            {!! Form::label('descripcion', 'Descripción') !!}
                            {!! Form::textarea('descripcion', null , ['class' => 'form-input block w-full mt-1']) !!}
                            
                            @error('descripcion')
                                <strong class="text-xs text-red-600">{{$message}}</strong>
                            @enderror
                        </div>
                      
    
                    

                    <div class="flex justify-end">
                        {!! Form::submit('Actualizar foro', ['class'=>'font-bold py-2 px-4 rounded bg-blue-500 text-white cursor-pointer']) !!}
                    </div>

                {!! Form::close() !!}
            </div>
          
        </div>

    </div>

    <x-slot name="js">
        <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
        <script src="{{asset('js/filmmaker/series/form.js')}}"></script>
    </x-slot>
        
     
</x-app-layout>