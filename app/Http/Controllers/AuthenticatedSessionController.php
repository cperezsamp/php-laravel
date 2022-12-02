<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
        $request->session()->regenerate();

        return redirect()->intended('/');
    }
}
