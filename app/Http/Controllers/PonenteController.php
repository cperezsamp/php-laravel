<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class PonenteController extends Controller
{
    
    private $tipoVistaColorXdia = "btn btn-primary";
    private $tipoVistaColorXsemana = "btn btn-primary";
    private $tipoVistaColorXmes = "btn btn-primary";
    private $data = [];

    function index()
    {
        if (session("tipoVista") == "3") {
            $this->data = DB::select("SELECT * FROM Actos WHERE MONTHNAME(FECHA) = MONTHNAME(SYSDATE())");
            $this->tipoVistaColorXmes = "btn btn-success";
        }else if(session("tipoVista") == "2"){
            $this->data = DB::select("SELECT * FROM Actos WHERE FECHA BETWEEN DATE_FORMAT(SYSDATE(), '%Y-%m-%d') AND DATE_FORMAT(DATE_ADD(SYSDATE(), INTERVAL 7 DAY), '%Y-%m-%d'); ");
            $this->tipoVistaColorXsemana = "btn btn-success";
        }else if(session("tipoVista") == "1"){
            $this->data = DB::select("SELECT * FROM Actos WHERE fecha = DATE_FORMAT(sysdate(),'%Y/%m/%d')");
            $this->tipoVistaColorXdia = "btn btn-success";
        }
        else
        {
            $this->data = DB::select("SELECT * FROM Actos WHERE MONTHNAME(FECHA) = MONTHNAME(SYSDATE())");
            $this->tipoVistaColorXmes = "btn btn-success";
        }

        if(!empty($this->data))
        {
            foreach ($this->data as $acto) {
                
                $Id_acto = $acto->Id_acto;
                $persona = session("persona");
                $_data = DB::select("SELECT * FROM `Inscritos` WHERE Id_persona =  $persona and id_acto = $Id_acto");

                if(!empty($_data))
                {
                    $_data = current($_data);

                    $acto->nombreBoton = "borrarse";
                    $acto->colorBoton = "btn btn-warning";

                   
                    $acto->valueBoton = "incribir";
                }
                else
                {
                     $acto->nombreBoton = "inscribirse";
                    $acto->colorBoton = "btn btn-primary";
                    $acto->valueBoton = "borrarse";
                }


                $result = DB::select("SELECT count(*) as total FROM Lista_Ponentes WHERE Id_persona = $persona AND Id_acto = $Id_acto");

                if(!empty($result) && $result[0]->total != 0)
                {

                    $acto->esPonente = 'SI';
                    $acto->valueBotonPonente = "ponente";                  
                    $acto->nombreBotonPonente = "Quitarse como ponente";
                    $acto->colorBotonPonente = "btn btn-warning";
                }
                else
                {
                    $acto->esPonente = 'NO';
                    $acto->valueBotonPonente = "noponente";
                    $acto->nombreBotonPonente = "Ponerse como ponente";
                    $acto->colorBotonPonente = "btn btn-primary";
                }

            }
        }

        return view("ponente",[
            "tipoVistaColorXdia" => $this->tipoVistaColorXdia,
            "tipoVistaColorXsemana" => $this->tipoVistaColorXsemana,
            "tipoVistaColorXmes" => $this->tipoVistaColorXmes,
            "data" => $this->data
        ]);
    }

    function hanldeButton(Request $req)
    {
        if(!empty($req->mostrarVista))
            session(["tipoVista"=>$req->mostrarVista]);
        return redirect("/ponente");
    }

    function event_detail(Request $req)
    {
        $id_acto = $req->id_acto;
        $this->data = DB::select("SELECT `Fecha`, `Hora`, `Titulo`, `Descripcion_corta`, `Descripcion_larga`, `Num_asistentes`, `nombre`, `apellido1`, `apellido2`
                            FROM `Actos` a 
                            left join `Lista_Ponentes` lp
                                on a.Id_acto = lp.Id_acto
                            left join `Personas` u
                                on lp.Id_persona = u.Id_persona
                            WHERE a.Id_acto = $id_acto; ");
        if(!empty($this->data))
        {
            $this->data = current($this->data);
        }  

        return view("event_detail")->with("acto",$this->data);

    }

    function removeSpeaker(Request $req)
    {
        $msg = "";
        $Id_acto = $req->id_acto;
        $persona = session("persona");

        $table= "";
        $colums= "";
        $values = "";


        if(!empty($req->esPonente))
        {
            $table= "Lista_Ponentes";
            $colums ="Id_persona,Id_acto,Orden";
            $values ="$persona, $Id_acto,1";
        }
        if(!empty($req->inscribirBorrar))
        {
            $date = date('Y-m-d H:i:s');
            $table= "Inscritos";
            $colums ="Id_persona,Id_acto,Fecha_inscripcion";
            $values ="$persona, $Id_acto,'$date'";
        }

        $is_exist = DB::Select("Select * FROM $table WHERE Id_persona = $persona and id_acto = $Id_acto");
        $is_exist = current($is_exist);


        if(!empty($is_exist))
        {
                $isDelete = DB::delete("DELETE FROM `$table` WHERE Id_persona = $persona and id_acto = $Id_acto");

                if(!empty($isDelete))
                {
                    DB::update("UPDATE `Actos` SET `Num_asistentes`= `Num_asistentes` - 1 WHERE id_acto = $Id_acto");

                    $msg = "";
                    if(!empty($req->esPonente))
                    {
                        $msg = "Te has borrado como $table correctamente";
                    }
                    if(!empty($req->inscribirBorrar))
                    {
                         $msg = "Te has borrado correctamente del acto";
                    }
                }
                else
                {
                    if(!empty($req->esPonente))
                    {
                        $msg = "Ha habido algun fallo al borrarte como $table";
                    }
                    if(!empty($req->inscribirBorrar))
                    {
                         $msg = "Ha habido algun fallo al borrarte del acto";
                    }
                }
        }
        else
        {
            DB::insert("insert into $table ($colums) values ($values)");
            DB::update("UPDATE `Actos` SET `Num_asistentes`= `Num_asistentes` + 1 WHERE id_acto = $Id_acto");
        }

        return redirect("ponente")->with("msg",$msg);
    }

    function profile()
    {
        $persona = session("persona");
        $data =DB::Select(" 
                                    Select * from personas p 
                                    inner join usuarios u on u.Id_Persona = p.Id_persona  WHERE p.Id_persona = $persona");
        return view("user_profile")->with("data",current($data));
    }

    function update_profile(Request $req)
    {

        $req->validate([
            "Username" => "required",
            "Nombre" => "required",
            "Apellido1" => "required",
            "Apellido2" => "required",
            
        ]);
        $id = $req->id;
        $persona = session("persona");
        $Nombre = $req->Nombre;
        $Apellido1 =$req->Apellido1;
        $Apellido2 = $req->Apellido2;

        $Username = $req->Username;
        $Password = "";
        if(!empty($req->password))
        {
            $Password = Hash::make($req->password);
        }
    

        DB::update("UPDATE `personas` SET `Nombre`= '$Nombre',`Apellido1`='$Apellido1' , `Apellido2`='$Apellido2'   WHERE Id_persona  = $persona");

        if(!empty($Password))
        {

            DB::update("UPDATE `usuarios` SET `Username`='$Username' , `Password` = '$Password' WHERE Id_usuario  = $id");
            DB::update("UPDATE `users` SET `name`='$Username' , `password` = '$Password' WHERE id_usuario  = $id");
        }
        else
        {
           DB::update("UPDATE `usuarios` SET `Username`='$Username' WHERE Id_usuario  = $id"); 
           DB::update("UPDATE `users` SET `name`='$Username' WHERE id_usuario  = $id");
        }
        

        return redirect("/user-profile");
    }
}
