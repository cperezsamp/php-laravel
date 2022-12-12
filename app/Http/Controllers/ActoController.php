<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acto;
use App\Models\Inscrito;
use DB;
use Arr;

class ActoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->input('mostrarVista')===null or $request->input('mostrarVista')==='3') {
            $botonClicado = $request->input('mostrarVista');
            $currentMonth = date('m');
            $actos = DB::table("Actos")
            ->whereRaw('MONTH(Fecha) = ?',[$currentMonth])
            ->get();
        }else if ($request->input('mostrarVista')==='2') {
            $botonClicado = $request->input('mostrarVista');
            $startDate = date('Y-m-d');
            $endDate = date('Y-m-d H:i:s', strtotime("7 days"));
            $actos = Acto::query()
                    ->whereDate('Fecha', '>=', $startDate)
                    ->whereDate('Fecha', '<=', $endDate)
                    ->get();
        }else if ($request->input('mostrarVista')==='1') {
            $botonClicado = $request->input('mostrarVista');
            $dia = date('Y-m-d');
            $actos = Acto::query()
            ->where('Fecha', '=', $dia)
            ->get();
        }
        
        //return View::make('usuario')->with('actos', $actos);
        return view('usuario', ['actos' => $actos, 'botonClicado' => $botonClicado]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crearacto');
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
        $acto= new Acto;
        $acto->Fecha= $request->fecha;
        $acto->Hora= $request->hora;
        $acto->Titulo= $request->titulo;
        $acto->Descripcion_corta= $request->descripcionc;
        $acto->Descripcion_larga= $request->descripcionl;
        $acto->Num_asistentes= $request->nasistentes;
        $acto->Id_tipo_acto= $request->tipo_acto;
        $acto->save();
        return redirect('admin');
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
    public function edit(Request $request)
    {
        $acto= DB::table('Actos')->where('Id_acto', '=', $request->id_acto  )->get()->first();
        return view('editaracto', ['acto' => $acto]);
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
    
    public static function colorButtonInscribirse($idActo)
    {
        $colorBoton= DB::table('Inscritos')->where('Id_acto', $idActo)->first();
        return $colorBoton;
    }
    
    public static function inscribirseBorrarse(Request $request)
    {
        $botonClicado = '-1';
        if ($request->input('inscribirBorrar') === 'borrarse') {
            $borrado = DB::table('Inscritos')->where('Id_persona', '=', $request->input('id_persona'))->where('id_acto', '=', $request->input('id_acto'))->delete();
            if ($borrado == 1) {
                $affected = DB::table('Actos')
                ->where('Id_acto', $request->input('id_acto'))
                ->update([
                    'Num_asistentes' => DB::raw('Num_asistentes - 1')
                ]);
                echo "<script>alert('Te has borrado correctamente del acto')</script>";
            }else{
                echo "<script>alert('Ha habido algun fallo al borrarte del acto')</script>";
            }
        }else{
            $insercion = DB::table('Inscritos')->insert([
                ['Id_persona' => $request->input('id_persona'), 'id_acto' => $request->input('id_acto'), 'Fecha_inscripcion' => date('Y-m-d H:i:s')]
            ]);
            if ($insercion == 1) {
                $affected = DB::table('Actos')
                            ->where('Id_acto', $request->input('id_acto'))
                            ->update([
                                'Num_asistentes' => DB::raw('Num_asistentes + 1')
                            ]);
                echo "<script>alert('Te has inscrito correctamente en el acto')</script>";
            }else{
                echo "<script>alert('Ha habido algun fallo al inscribirte en el acto acto')</script>";
            } 
        }
        
        $actos = Acto::get();
        //return view('usuario', ['actos' => $actos, 'botonClicado' => $botonClicado]);
        return redirect('usuario'); 
    }
    
    public static function mostrarEvento(Request $request)
    {
        $acto = Acto::query()
        ->where('Id_acto', '=', $request->input('id_acto'))
        ->get();
        //return View::make('usuario')->with('actos', $actos);
        return view('vistaEvento', ['acto' => $acto]);
    }

    public function admin(){
        //return ('in function');
        $actos= DB::table('Actos')->get();
        //return $actos;
        return view('admin', ['actos' => $actos]);
    }

    public function editarActo(Request $request){
        DB::table('Actos')->where('Id_acto', $request->id_acto)->update([
            'Fecha' => $request->fecha,
            'Hora' => $request->hora,
            'Titulo' => $request->titulo,
            'Descripcion_corta' => $request->descripcionc,
            'Descripcion_larga' => $request->descripcionl,
            'Num_asistentes' => $request->nasistentes,
            'Id_tipo_acto' => $request->tipo_acto                    
        ]);
        return redirect('/admin');

    }

    public function inscritos(Request $request){
        //return $request;
        $acto= DB::table('Inscritos')->where('Id_acto', '=', $request->id_acto)->get();
        //return $acto;
        return view('inscritos', ['acto'=> $acto]);
    }

    public function modificarInscritos(Request $request){
        
    }

    //funciones de la api

    public function apiGetActos(Request $request){
        $actos= Acto::all();
        return $actos;
    }

    public function apiGetActo(Request $request){
        $acto= Acto::findOrFail($request->id);
        return $acto;
    }

    public function apiCreateActo(Request $request){
        $acto= new Acto;
        $acto->Fecha= $request->fecha;
        $acto->Hora= $request->hora;
        $acto->Titulo= $request->titulo;
        $acto->Descripcion_corta= $request->descripcionc;
        $acto->Descripcion_larga= $request->descripcionl;
        $acto->Num_asistentes= $request->nasistentes;
        $acto->Id_tipo_acto= $request->tipo_acto;
        $acto->save();
        return $acto;
    }

    public function apiDeleteActo(Request $request){
        $acto= Acto::destroy($request->id);
        return $acto;
    }

    public function apiUpdateActo(Request $request){
        $acto= Acto::findOrFail($request->id);
        $acto->Fecha= $request->fecha;
        $acto->Hora= $request->hora;
        $acto->Titulo= $request->titulo;
        $acto->Descripcion_corta= $request->descripcionc;
        $acto->Descripcion_larga= $request->descripcionl;
        $acto->Num_asistentes= $request->nasistentes;
        $acto->Id_tipo_acto= $request->tipo_acto;
        $acto->save();
        return $acto;
    }
}
