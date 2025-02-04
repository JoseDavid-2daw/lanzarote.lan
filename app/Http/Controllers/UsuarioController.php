<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        $usuarios  = User::paginate(7);
        $ROLES     = User::ROLES;

        return view('usuarios.usuario',compact('usuarios','ROLES'));
    }


    function formulario($oper='', $id='')
    {
        $usuario   = empty($id)? new User() : User::find($id);
        $ROLES     = User::ROLES;
    
        return view('usuarios.formulario',compact('usuario','oper','ROLES'));
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
            $validacion_rol = '';
            foreach(User::ROLES as $codigo_rol => $texto_rol)
            {
                $validacion_rol .= $codigo_rol .',';
            }

            $validacion_rol = substr($validacion_rol,0,-1);
            
            $validatedData = $request->validate([
                'name'              => 'required|string|max:255',
                'email'             => 'required|email|max:255',
                'password'          => 'required|max:255',
                'rol'               => 'required|in:'.$validacion_rol,
            ], [
                'name.required'     => 'El nombre es obligatorio.',
                'name.string'       => 'Debe ser de tipo cadena de texto.',
                'name.max'          => 'Máximo 255 caracteres',

                'name.max'          => 'Máximo 255 caracteres',

                'email.required'    => 'El email es obligatorio.',
                'email.email'       => 'Email inválido.',
                'email.max'         => 'Máximo 255 caracteres',

                'password.required' => 'La contraseña es obligatoria.',
                'password.max'      => 'Máximo 255 caracteres',

                'rol.required'      => 'El rol es obligatorio.',
            ]);

            $usuario = empty($request->id)? new User() : User::find($request->id);

            $usuario->name     = $request->name;
            $usuario->email    = $request->email;
            $usuario->password = $request->password;
            $usuario->rol      = $request->rol;
            //dd($usuario);
            $usuario->save();

            if ($usuario->rol === 'AM') {
                $usuario->assignRole('admin');
            }
            else 
            {
                $usuario->syncRoles(['user']);
            }

            $salida = redirect()->route('usuarios.alta')->with([
                    'success'  => 'Usuario insertado correctamente.'
                    ,'formData' => $usuario
                ]
            );

        }

        return $salida;
    }
}
