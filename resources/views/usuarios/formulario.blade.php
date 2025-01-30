@extends('layout')


@section('title', 'Alta de usuario')

@section('content')


    @php

        if (session('formData'))
            $usuario = session('formData');

        $disabled = '';
        $boton_guardar = '<button type="submit" class="btn btn-primary">Guardar</button>';
        if (session('formData') || $oper == 'cons' || $oper == 'supr')
        {
            $disabled = 'disabled';

            if ($oper == 'supr')
                $boton_guardar = '<button type="submit" class="btn btn-danger">Eliminar</button>';
            else
                $boton_guardar = '';
        }
            



    @endphp

    <br />
    @if(session('success'))
        <p style="text-align:center;" class="alert alert-success">{{ session('success') }}</p>
    @endif
    
    <form action="{{ route('usuarios.almacenar') }}" method="POST">
        @csrf
        <input type="hidden" name="oper" value="{{ $oper }}" />
        <input type="hidden" name="id" value="{{ $usuario->id }}" />
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input {{ $disabled }} type="text" name="name" class="form-control" id="name" value="{{ old('name',$usuario->name)}}" placeholder="Nombre">
            @error('name') <p style="color: red;">{{ $message }}</p> @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input {{ $disabled }}  type="text" name="email" class="form-control" id="email" value="{{ old('email',$usuario->email)}}" placeholder="Email">
            @error('email') <p style="color: red;">{{ $message }}</p> @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input {{ $disabled }}  type="text" name="password" class="form-control" id="password"  value="{{ old('password',$usuario->password)}}" placeholder="Contraseña">
            @error('password') <p style="color: red;">{{ $message }}</p> @enderror
        </div>

        @php

        echo $boton_guardar ;
    
        @endphp

    </form>

@endsection


