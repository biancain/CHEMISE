<?php

namespace App\Http\Controllers;

use App\Models\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function autocomplete(Request $request){
        $term = $request->get('term');
        $querys = DB::connection('sqlsrv')->select("SELECT TOP 1 Funcionario FROM BI.dbo.vw_staff where idUsuario like '%$term%'");
        $data = [];

        foreach ($querys as $query) {
            $query = (string)($query->Funcionario);
            $data[] = $query;
        }
        if ( empty($data[0]) == true ){
            $data[] = "";
        }
        return $data;
    }

    public function autocompleteProd(Request $request){
        $term = $request->get('term');
        $queryis = DB::connection("storage")->table('produtos')->select("SELECT descricao FROM storage.produtos WHERE Codigo LIKE '%$term%' LIMIT 1");
        $dat = [];

        foreach ($queryis as $query) {
            $query = (string)($query->descricao);
            $dat[] = $query;
        }
        if ( empty($dat[0]) == true ){
            $dat[] = "";
        }
        return $dat;
    }

}
