<?php

namespace App\Http\Controllers;

use App\Models\Produccion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;


class Prueba extends Controller
{
    public function prueba(Request $request){
        date_default_timezone_set("America/New_York");
        $hora_actual = date("H:i");
        $hora_entrada = date("07:20");
        //Funcion control del corte
        function control($hora_actual){
            $hor = DB::select('select id, horario from produccion.horario_corte hc');
            $hora_entrada = date("07:20");
            $sw = 0;
            for($i = 0; $i < 10; $i++){
                $tra = $hor[$i]->{'horario'};
                $IDtra = $hor[$i]->{'id'};
                if ($hora_actual >= $tra){
                    $menor = $tra;
                    DB::update("UPDATE produccion.horario_corte SET cont = ? WHERE id=?", [0, $IDtra]);
                }else{
                    if($sw == 0 ){
                        $mayor = $tra;
                        $sw =1;
                    }
                }
                if ($hora_actual <= $hora_entrada){
                    $menor = $hora_actual;
                }
            }
            return $mayor;
        }

         //Otra funcion no se de que pero voy a crear
         function cargar($hora_actual, $mayor){
            $ultimoRegistro = DB::select('select id, corte from produccion.produccion p order by id desc limit 1');
            $corte = $ultimoRegistro[0]->{'corte'};
            $id = $ultimoRegistro[0]->{'id'};
            if ($corte == 0){
                if ($hora_actual <= $mayor){
                    var_dump("cargar", $mayor);
                }
            }
        }

        function insert($mayor){
            $menor = $mayor;
            $ultimoRegistro = DB::select('select * from jws.security_user');
            $id = $ultimoRegistro[0]->{'id'};
            DB::update("UPDATE produccion.produccion SET corte=? WHERE id=?", [1, $id]);
            $corte = $ultimoRegistro[0]->{'corte'};
            if($corte == 1){
               DB::insert('INSERT into produccion.produccion (nombre, corte) values (?, ?)', ['Bianca', 0]);
            }
        }

        $mayor = control($hora_actual);
        $hor = DB::select('select * from produccion.horario_corte hc');
        $cont = $hor[0]->{'cont'};
        for($i = 0; $i < 10; $i++){
            $tra = $hor[$i]->{'horario'};
            $IDtra = $hor[$i]->{'id'};
            $cont = $hor[$i]->{'cont'};
            if ($cont == 0){
                $menor = $tra;
            }
        }
    }
}