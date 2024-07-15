@extends('adminlte::page')

@section('title', 'RidersChilenos')

@section('content_header')
    <h1>Crear nueva disciplina</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=>'admin.disciplinas.store']) !!}
                <div class="form-group">
                    {!! Form::label('name','Nombre') !!}
                    {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'Ingrese el nombre de la disciplina']) !!}

                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                        
                    @enderror

                </div>
                {!! Form::submit('Crear Disciplina', ['class'=>'btn bg-blue-500 text-white']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop