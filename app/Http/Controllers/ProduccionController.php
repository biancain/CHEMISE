<?php

namespace App\Http\Controllers;
use App\Models\Produccion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
class ProduccionController extends Controller
{
    protected function index(){
        $funcionarios = DB::table('funcionarios')
            ->select('funcionarios.*')
            ->get();
        date_default_timezone_set("America/New_York");
        $hora = date('h:i');
        $dic = array();
        foreach ($funcionarios as $funcionario) {
            $dic[$funcionario->{'id'}] = $funcionario->{'nombre'};
        }
        $producciones = DB::table('produccion')
            ->select('produccion.*')
            ->get();

        //$trabajos = DB::select('select trabajo from produccion.produccion p order by id desc limit 1');
        return view('chemise', [
            'funcionarios' => $funcionarios,
            'hora' => $hora,
            'dic' => $dic,
            'producciones' => $producciones
        ]);
    }

    public function test(Request $request){
        date_default_timezone_set("America/New_York");
        $name = $request->get('name');
        $producto = $request->get('producto');
        $linea = $request->get('linea');
        $trabajo1 = (int)$request->get('trabajo1');
        //$retrabajo1 = (int)$request->get('retrabajo1');
        $hora_entrada = date("06:00");

        $hora_actual = date("H:i");

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
                        $sw = 1;
                    }
                }
                if ($hora_actual <= $hora_entrada){
                    $menor = $hora_actual;
                }
            }
            return $mayor;
        }


        function cargarTrabajo($hora_actual, $mayor, $trabajo1, $name, $producto, $linea){
            $ultimoRegistro = DB::select('select * from produccion.produccion p order by id desc limit 1');
            $corte = $ultimoRegistro[0]->{'corte'};
            $id = $ultimoRegistro[0]->{'id'};
            if ($corte == 0){
                if ($hora_actual <= $mayor){
                    DB::update("UPDATE produccion.produccion SET nombre=?, producto=?, linea=?, corte=?, trabajo=?, hora_seg=? WHERE id=?", [$name, $producto, $linea, 0, $trabajo1, $hora_actual, $id]);
                }
            }
        }

        function cargarRetrabajo($hora_actual, $mayor, $retrabajo1, $name, $producto, $linea){
            $ultimoRegistro = DB::select('select * from produccion.produccion p order by id desc limit 1');
            $corte = $ultimoRegistro[0]->{'corte'};
            $id = $ultimoRegistro[0]->{'id'};
            if ($corte == 0){
                if ($hora_actual <= $mayor){
                    DB::update("UPDATE produccion.produccion SET nombre=?, producto=?, linea=?, corte=?, retrabajo=?, hora_seg=? WHERE id=?", [$name, $producto, $linea, 0, $retrabajo1, $hora_actual, $id]);
                }
            }
        }

        $mayor = control($hora_actual);
        if ($trabajo1 == true){
            cargarTrabajo($hora_actual, $mayor, $trabajo1, $name, $producto, $linea);
        }else{
            $retrabajo1 = (int)$request->get('retrabajo1');
            cargarRetrabajo($hora_actual, $mayor, $retrabajo1,$name, $producto, $linea);
        }

    }


    // $results = DB::select('select * from users where id = :id', ['id' => 1]);
    // DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);
    // DB::update('update users set votes = 100 where name = ?', ['John']);
    public function update(Request $request){
        $dft = new DateTimeZone("America/New_York");
        $cortes = [new DateTime("07:20", $dft),
        new DateTime("08:35", $dft),
        new DateTime("09:35", $dft),
        new DateTime("10:35", $dft),
        new DateTime("11:35", $dft),
        new DateTime("12:05", $dft),
        new DateTime("13:55", $dft),
        new DateTime("14:55", $dft),
        new DateTime("15:55", $dft),
        new DateTime("17:00", $dft)
        ];
        $hora = new DateTime('now', $dft);
        $ultimoRegistro = DB::select('select * from produccion.produccion p order by id desc limit 1');
        $corte = $ultimoRegistro[0]->{'corte'};

        dd($cortes);
        if ($corte == 0){
            for ($i=0; $i < 9; $i++){
                if($ultimoGuardado >= $cortes[$i]){
                    dd($ultimoGuardado);
                };
            }
            // if ($hora >= $quinto && $hora < $sexto){
            //     echo "update";
            //     // DB::update('UPDATE produccion.produccion SET nombre='', producto='', linea=0, corte=0, trabajo=0, retrabajo=0, hora_corte='' WHERE id=0;');
            // }else{
            //     $corte = 1;
            // }
        }else{
            echo "insert";
            // DB::insert('insert into produccion.produccion (id, nombre, producto, linea, trabajo, retrabjo) values (?, ?)', [1, 'Dayle']);
        }

        // $term = $request->get('term');
        // $querys = DB::table('funcionarios')->select('funcionarios.nombre')->where('id', 'LIKE', '%' .$term . '%')->limit(1)->get();
        // $data = [];

        // foreach ($querys as $query) {
        //     $query = (string)($query->nombre);
        //     $data[] = $query;
        // }
        // if ( empty($data[0]) == true ){
        //     $data[] = "";
        // }
        // return $data;
    }
    public function insert(Request $request){
        date_default_timezone_set("America/New_York");
        $trabajo1 = (int)$request->get('trabajo1');
        $retrabajo1 = (int)$request->get('retrabajo1');

        $hora_corte = date("Y-m-d H:i:s");

        $hora_actual = date("H:i");

        $horario = date("17:00");

        function insert(){
            $ultimoRegistro = DB::select('select * from produccion.produccion p order by id desc limit 1');
            $id = $ultimoRegistro[0]->{'id'};
            DB::update("UPDATE produccion.produccion SET corte=? WHERE id=?", [1, $id]);
        }

        insert();

        DB::insert('INSERT into produccion.produccion (corte, trabajo, retrabajo, hora_corte, hora_seg) values (?, ?, ?, ?, ?)', [0, 0, 0, $hora_corte, $hora_actual]);

    }
}