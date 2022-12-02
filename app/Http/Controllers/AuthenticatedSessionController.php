<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request){
        //return $request;
        //return $request;
        $cred = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        
        //return $cred;
        if(!Auth::attempt($cred, $request->boolean('recuerdame'))){
            //return Auth::attempt($cred, $request->boolean('recuerdame'));
            //return "error";
            throw ValidationException::withMessages([
                'incorrect' => 'Usuario o contraseña incorrectos',
            ]);
        }
        //return "ok";
        $user= DB::table('users')->where('name', $request->input('name'))->first();
        $usuario= DB::table('Usuarios')->where('Id_usuario', $user->id_usuario)->first();
        $rol= DB::table('Tipos_usuarios')->where('Id_tipo_usuario', $usuario->Id_tipo_usuario)->first();
        $request->session()->regenerate();
        session(['rol'=> $rol->Descripcion ]);
        switch($rol->Descripcion){
            case 'Usuario':
                return redirect()->intended('/usuario');        
                break;
            case 'Ponente':
                return redirect()->intended('/ponente');
                break;
            case 'Administrador':
                return redirect()->intended('/');
                break;
        }
        //return redirect()->intended('/');
    }
}