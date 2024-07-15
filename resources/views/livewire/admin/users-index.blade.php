<div>
    <div class="card">
        <div class="card-header">
            <input wire:keydown="limpiar_page" wire:model="search" class="form-control w-100" placeholder="Escriba un nonbre">
        </div>

        @if ($users->count())
            
      
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th></th>

                    </thead>
                    
                    <tbody>
                        @foreach ($users->reverse() as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}-{{$user->email}}</td>
                                <td>{!! Form::model($user, ['route'=>['admin.users.update2',$user],'method' => 'put']) !!}

                                    <x-jet-label for="password" value="{{ __('Password') }}" />
                                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
                                    
                                    {!! Form::submit('Actualizar', ['class'=>'btn btn-primary mt-2']) !!}
                                    {!! Form::close() !!}
                                    </td>

                                <td width="10px">
                                    <a class="font-bold py-2 px-4 rounded bg-blue-500 text-white" href="{{route('admin.users.edit',$user)}}">Editar</a>
                                </td>
                            </tr>
                            
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{$users->links()}}
            </div>
            
        @else
            <div class="card-body">
                <strong>No hay registros que coincidan</strong>
            </div>
       

        @endif
    </div>
</div>
