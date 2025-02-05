@extends('layout')


@section('title', 'Listado de productos')

@section('content')
<div class="table-responsive">
    <table  class="table">
        <tr>
            <td>#</td>
            <td>nombre</td>
            <td>precio</td>
            <td>cantidad</td> 
            <td>categoría</td> 
            <td>descripción</td> 
            <td>código de producto</td> 
        </tr>

    
    @foreach ($products as $product)
        

    <tr>
            <td>
                <div>
                    <a href="/product/{{ $product->id }}" class="btn btn-primary"><i class="bi bi-search"></i></a>
                    <a href="/product/actualizar/{{ $product->id }}" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                    <a href="/product/eliminar/{{ $product->id }}" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                </div>

            </td>
            <td style="">{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td> 
            <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $CATEGORIES[$product->category] }}</td>  
            <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $product->description }}</td> 
            <td>{{ $product->sku_code }}</td> 
    </tr>

    @endforeach

    </table>
    {{ $products->links() }}
</div>
    <a href="/products/nuevo" class="btn btn-success"><i class="bi bi-plus"></i> Nuevo producto</a>


@endsection