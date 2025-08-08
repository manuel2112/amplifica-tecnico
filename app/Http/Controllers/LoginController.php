<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login_index()
    {
        return view('login.index');
    }

    public function login_index_post(Request $request)
    {
        $validate = $request->validate(
            [
                'correo' => 'required|email:rfc,dns',
                'password' => 'required|min:6',
            ],
            [
                'correo.required' => 'El campo E-Mail está vacío',
                'correo.email' => 'El E-Mail ingresado no es válido',
                'password.required' => 'El campo Contraseña está vacío',
                'password.min' => 'El campo Contraseña debe tener al menos 6 caracteres',
            ]
        );
        // die(Auth::attempt(['email' => $request->input('correo'), 'password' => $request->input('password')]));
        if (Auth::attempt(['email' => $request->input('correo'), 'password' => $request->input('password')])) {
            $user = User::where(['id' => Auth::id()])->first();
            $request->session()->put('user_id', $user->id);
            $request->session()->put('user_name', $user->name);
            $request->session()->put('user_email', $user->email);

            return redirect()->intended('/');
        } else {
            session()->flash('css', 'danger');
            session()->flash('mensaje', 'Las credenciales indicadas no son válidas');

            return redirect()->route('login_index');
        }
    }

    public function login_salir(Request $request)
    {
        Auth::logout();
        $request->session()->forget('user_id');
        $request->session()->forget('user_name');
        $request->session()->forget('user_email');

        return redirect()->route('login_index');
    }
}
