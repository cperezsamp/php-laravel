<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Persona;
use App\Models\Tipo_usuario;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\Tipo_usuarioController;


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
        $usuario->Password= $request->input('password');
        $usuario->Id_Persona= (int)Persona::latest('Id_persona')->first()->Id_persona;
        $usuario->Id_tipo_usuario= $request->input('role');
        $usuario->save();
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
