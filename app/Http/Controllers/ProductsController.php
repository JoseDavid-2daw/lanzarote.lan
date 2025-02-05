<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductsController extends Controller
{
    function listado()
    {

        $products = Product::paginate(7);

        $CATEGORIES     = Product::CATEGORIES;


        return view('products.product',compact('products','CATEGORIES'));
    }


    function formulario($oper='', $id='')
    {
        $product = empty($id)? new product() : product::find($id);
        
        $CATEGORIES     = product::CATEGORIES;

        return view('products.formulario',compact('CATEGORIES','product','oper'));
    }

    function mostrar($id)
    {
        return $this->formulario('cons', $id);
    }


    function actualizar($id)
    {
        return $this->formulario('modi', $id);

    }

    function eliminar($id)
    {
        return $this->formulario('supr', $id);

    }

    function alta()
    {
        return $this->formulario();
    }

    function almacenar(Request $request)
    {

        if ($request->oper == 'supr')
        {

            $product = product::find($request->id);
            $product->delete();

            $salida = redirect()->route('products.listado');
        }
        else
        {
            $validacion_category = '';
            foreach(product::CATEGORIES as $codigo_category => $texto_category)
            {
                $validacion_category .= $codigo_category .',';
            }

            $validacion_category = substr($validacion_category,0,-1);
            
            $validatedData = $request->validate([
                'name'           => 'required|string|max:255',
                'category'       => 'required|in:'.$validacion_category,
                'price'          => 'required|numeric|between:0,999999.99',
                'quantity'       => 'required|integer',
                'description'    => 'required|string',
                'sku_code'       => 'required|unique:products,sku_code'

            ], [
                'name.string'          => 'Debe ser de tipo cadena de texto.',
                'description.string'   => 'Debe ser de tipo cadena de texto.',
                'name.max'             => 'Máximo 255 caracteres',
                'description.max'      => 'Máximo 255 caracteres',

                'price.numeric'        => 'Debe ser de tipo decimal.',
                'quantity.integer'     => 'Debe ser de tipo entero.',

                'name.required'        => 'El nombre es obligatorio.',
                'description.required' => 'La descripcion es obligatorio.',
                'price.required'       => 'El precio es obligatorio.',
                'category.required'    => 'La categoría es obligatoria.',
                'sku_code.required'    => 'la sku_code es obligatoria.',
                'quantity.required'    => 'La cantidad es obligatoria.',

                'sku_code.unique'      => 'El código debe ser único',
            ]);

            $product = empty($request->id)? new product() : product::find($request->id);

            $product->name        = $request->name;
            $product->category    = $request->category;
            $product->price       = $request->price;
            $product->description = $request->description;
            $product->quantity    = $request->quantity;
            $product->sku_code    = $request->sku_code;

            $product->save();

            $salida = redirect()->route('products.alta')->with([
                    'success'  => 'product insertado correctamente.'
                    ,'formData' => $product
                ]
            );

        }

        return $salida;
    }

}
