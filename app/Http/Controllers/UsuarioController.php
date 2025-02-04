<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UsuarioController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('usuarios.index', ['users' => $users]);
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('usuarios.show', ['user' => $user]);        
    }

    function listado()
    {

        $usuarios = User::paginate(7);

        return view('usuarios.usuario',compact('usuarios'));
    }


    function formulario($oper='', $id='')
    {
        $usuario = empty($id)? new User() : User::find($id);
    
        return view('usuarios.formulario',compact('usuario','oper'));
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

            $usuario = User::find($request->id);
            $usuario->delete();

            $salida = redirect()->route('usuarios.listado');
        }
        else
        {
            
            $validatedData = $request->validate([
                'name'         => 'required|string|max:255',
                'email'          => 'required|email|max:255',
                'password'     => 'required|max:255',
            ], [
                'name.required' => 'El nombre es obligatorio.',
                'name.string'   => 'Debe ser de tipo cadena de texto.',
                'name.max'      => 'Máximo 255 caracteres',

                'name.max'      => 'Máximo 255 caracteres',

                'email.required' => 'El email es obligatorio.',
                'email.email'    => 'Email inválido.',
                'email.max'      => 'Máximo 255 caracteres',

                'password.required' => 'La contraseña es obligatoria.',
                'password.max'      => 'Máximo 255 caracteres',
            ]);

            
        
            



            $usuario = empty($request->id)? new User() : User::find($request->id);

            $usuario->name      = $request->name;
            $usuario->email       = $request->email;
            $usuario->password = $request->password;

            $usuario->save();


            $salida = redirect()->route('usuarios.alta')->with([
                    'success'  => 'usuario insertado correctamente.'
                    ,'formData' => $usuario
                ]
            );

        }

        return $salida;
    }
}
