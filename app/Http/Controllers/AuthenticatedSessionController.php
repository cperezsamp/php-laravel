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
        //$usuario= DB::table('Usuarios')->where('Id_usuario', $user->id_usuario)->first();
        $rol= DB::table('Tipos_usuarios')->where('Id_tipo_usuario', $usuario->Id_tipo_usuario)->first();
        $request->session()->regenerate();
        session(['rol'=> $rol->Descripcion ]);
        session(['id_usuario'=> $usuario->Id_usuario ]);
        session(['username'=> $usuario->Username ]);
        session(['persona'=> $usuario->Id_Persona ]);
        session(["tipoVista"=> ""]);
       
        switch($rol->Descripcion){
            case 'Usuario':
                //return redirect()->intended('/usuario');
                return redirect()->action([ActoController::class, 'index']);
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

    public function destroy(Request $requests){
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login');

    }

    public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        $req->session()->forget("rol");
        $req->session()->forget("id_usuario");
        $req->session()->forget("username");
        $req->session()->forget("persona");
        $req->session()->forget("tipoVista");
        $req->session()->reflash();
        
        return redirect('/login');
    }
    
}
