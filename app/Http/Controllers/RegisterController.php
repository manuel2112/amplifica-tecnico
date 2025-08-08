<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register_get()
    {
        return view('register.register');
    }

    public function register_post(Request $request)
    {
        $request->validate(
            [
                'nombre' => 'required|min:6',
                'correo' => 'required|email:rfc,dns|unique:users,email',
                'password' => 'required|min:6|confirmed',
            ],
            [
                'nombre.required' => 'El campo Nombre está vacío',
                'nombre.min' => 'El campo Nombre debe tener al menos 6 caracteres',
                'correo.required' => 'El campo E-Mail está vacío',
                'correo.email' => 'El E-Mail ingresado no es válido',
                'password.required' => 'El campo Password está vacío',
                'password.min' => 'El campo Password debe tener al menos 6 caracteres',
                'password.required' => 'El campo Password está vacío',
                'password.min' => 'El campo Password debe tener al menos 6 caracteres',
                'password.confirmed' => 'Las contraseñas ingresadas no coiciden',
            ]
        );
        $user = User::create(
            [
                'name' => $request->input('nombre'),
                'email' => $request->input('correo'),
                'password' => Hash::make($request->input('password')),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );
        session()->flash('css', 'success');
        session()->flash('mensaje', 'Se ha creado el registro exitosamente');

        return redirect()->route('login_index');
    }
}
