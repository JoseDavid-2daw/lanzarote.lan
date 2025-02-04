@extends('layout')


@section('title', 'Listado de usuarios')

@section('content')
<div class="table-responsive">
    <table  class="table">
        <tr>
            <td>#</td>
            <td>nombre</td>
            <td>email</td>
        </tr>

    
    @foreach ($usuarios as $usuario)
        

    <tr>
            <td>
                <div>
                    <a href="/usuario/{{ $usuario->id }}" class="btn btn-primary"><i class="bi bi-search"></i></a>
                    <a href="/usuario/actualizar/{{ $usuario->id }}" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                    <a href="/usuario/eliminar/{{ $usuario->id }}" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                </div>

            </td>
            <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $usuario->name }}</td> 
            <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $usuario->email }}</td> 
    </tr>

    @endforeach

    </table>
    {{ $usuarios->links() }}
</div>
    <a href="/usuarios/nuevo" class="btn btn-success"><i class="bi bi-plus"></i> Nuevo usuario</a>


@endsection