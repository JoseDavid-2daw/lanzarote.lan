@extends('layout')


@section('title', 'Alta de producto')

@section('content')


    @php

        if (session('formData'))
            $product = session('formData');

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
    
    <form action="{{ route('products.almacenar') }}" method="POST">
        @csrf
        <input type="hidden" name="oper" value="{{ $oper }}" />
        <input type="hidden" name="id" value="{{ $product->id }}" />
        <div class="mb-3">
            <label for="name" class="form-label">Título</label>
            <input {{ $disabled }} type="text" name="name" class="form-control" id="name" value="{{ old('name',$product->name)}}" placeholder="Título">
            @error('name') <p style="color: red;">{{ $message }}</p> @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input {{ $disabled }}  type="text" name="price" class="form-control" id="price" value="{{ old('price',$product->price)}}" placeholder="Precio">
            @error('price') <p style="color: red;">{{ $message }}</p> @enderror
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Cantidad</label>
            <input {{ $disabled }}  type="text" name="quantity" class="form-control" id="quantity"  value="{{ old('quantity',$product->quantity)}}" placeholder="Cantidad">
            @error('quantity') <p style="color: red;">{{ $message }}</p> @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Categoría</label>
            <select {{ $disabled }}  name="category" id="category" class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option value="">Selecciona un género...</option>
                @foreach ($CATEGORIES as $clave_category => $texto_category)

                    @php
                        $selected = old('category') == $clave_category || $product->category == $clave_category ? 'selected="selected"' : '';
                    @endphp
        
    
        
                    <option value="{{ $clave_category }}" {{ $selected }}>{{ $texto_category }}</option>

                @endforeach
            </select>
            @error('category') <p style="color: red;">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea {{ $disabled }}  name="description" class="form-control" id="description" placeholder="Descripción...">{{ old('description',$product->description) }}</textarea>
            @error('description') <p style="color: red;">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="sku_code" class="form-label">Código de producto</label>
            <input {{ $disabled }}  type="text" name="sku_code" class="form-control" id="sku_code"  value="{{ old('sku_code',$product->sku_code)}}" placeholder="Código de producto">
            @error('sku_code') <p style="color: red;">{{ $message }}</p> @enderror
        </div>


        @php

        echo $boton_guardar ;
    
        @endphp

    </form>

@endsection


