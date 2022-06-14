<?php

namespace App\Http\Controllers;

use App\Models\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function autocomplete(Request $request){
        $term = $request->get('term');
        $querys = DB::table('funcionarios')->select('funcionarios.nombre')->where('id', 'LIKE', '%' .$term . '%')->limit(1)->get();
        $data = [];

        foreach ($querys as $query) {
            $query = (string)($query->nombre);
            $data[] = $query;
        }
        if ( empty($data[0]) == true ){
            $data[] = "";
        }
        return $data;
    }
}
