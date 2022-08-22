<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Propuesta;

class SearchController extends Controller
{
    public function autocomplete(Request $request)
    {
        $term = $request ->get('term');
        $query= Propuesta::where('dominio', 'LIKE', '%' . $term . '%')->get();

        $data = [];

        foreach ($query as $q){
            $data[] =[
                'label' => $q->dominio
            ];
        }

        return $data;

    }

    public function search(Request $request)
    {
        
        $data = request()->validate([
            'terms' => '',
        ]);



        $propuestas = Propuesta::where('dominio', 'like', '%' . $data['terms'] . '%')->get();
        
        return view('/home', compact('propuestas'));
        
    }


}
