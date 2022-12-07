<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Persona;
use App\Models\Tipo_usuario;
use App\Models\User;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\Tipo_usuarioController;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios= Usuario::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $persona= new Persona;
        $persona->Nombre= $request->input('nombre');
        $persona->Apellido1= $request->input('apellido');
        $persona->Apellido2= $request->input('apellido2');
        $persona->save();

        $usuario= new Usuario;
        $usuario->Username= $persona->Nombre.$persona->Apellido1.$persona->Apellido2;
        $usuario->Password= bcrypt($request->input('password'));
        $usuario->Id_Persona= (int)Persona::latest('Id_persona')->first()->Id_persona;
        $usuario->Id_tipo_usuario= $request->input('role');
        $usuario->save();

        User::create([
            'name' => $persona->Nombre.$persona->Apellido1.$persona->Apellido2,
            'password' => bcrypt($request->input('password')), //$usuario->Password,
            'Id_usuario' =>  (int)Usuario::latest('Id_usuario')->first()->Id_usuario,
        ]);
        return to_route('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()  //$id)
    {
        return view('profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) //$id)
    {
  
        //comprobamos que el nombre no este en uso
        $names= DB::table('users')->select('name')->get();
        foreach($names as $name){
            if($name == $request->input('username')){
                throw ValidationException::withMessages([
                    'incorrect' => 'El nombre de usuario ya esta en uso.',
                ]);
            }
        } 
        $user= new User;
        $usuario= new Usuario;
        $user= DB::table('users')->where('Id_usuario', session('id_usuario'))->first();
        $usuario= DB::table('Usuarios')->where('Id_usuario', session('id_usuario'))->first();
        if($request->username!= null){
            DB::table('Usuarios')->where('Id_usuario', session('id_usuario'))->update(['Username' => $request->input('username')]);
            DB::table('users')->where('Id_usuario', session('id_usuario'))->update(['name' => $request->input('username')]);   
        }
        if($request->password!= null){
            DB::table('Usuarios')->where('Id_usuario', session('id_usuario'))->update(['Password' => bcrypt($request->input('password'))]);
            DB::table('users')->where('Id_usuario', session('id_usuario'))->update(['password' => bcrypt($request->input('password'))]);
        }
        $idTipo= DB::table('Tipos_usuarios')->where('Descripcion', session('rol'))->first();
        DB::table('Usuarios')->where('Id_usuario', session('id_usuario'))->update(['Id_tipo_usuario' => $idTipo->Id_tipo_usuario]);
       
        return redirect()->intended('/usuario');
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
