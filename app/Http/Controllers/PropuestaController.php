<?php

namespace App\Http\Controllers;

use App\Models\Propuesta;
use App\Models\Tomador;
use App\Models\Inspeccion;
use Illuminate\Http\Request;

use App\Notifications\RealizarInspeccion;
use Illuminate\Support\Facades\Notification;



class PropuestaController extends Controller
{
    public function create()
    {
        return view('propuestas.create');
    }

    public function store()
    {
        $data = request()->validate([
            'dominio' => 'required',
            'tomador' => 'required',
            'email'=> 'required | email',
        ]);

        

       
        $propuesta = new Propuesta();
        
        $tomador2= new Tomador();
        
        $usr2 = new Tomador();
        
        $tomador2-> name = request('tomador');
        $tomador2-> email = request('email');

        $usr2 = Tomador::where('email', $tomador2->email)->first();
        
        if($usr2){
                      
        }else{

            $tomador2 -> save();

        } 


        $usr2 = Tomador::where('email',request('email'))->first();
        $inspeccion = Inspeccion::where('propuesta_id',request('id'))->first();

        $propuesta -> compania = request('compania');
        $propuesta -> tipo = request('tipo');
        $propuesta -> dominio = request('dominio');
        $propuesta -> numero_propuesta = request('propuesta');
        $propuesta -> user_id = auth()->user()->id;
        //$propuesta -> inspeccion_id = $inspeccion->id;
        $propuesta -> estado = "Pendiente";
        $propuesta -> tomador_id = $usr2->id;

        $propuesta -> save();
               
        $inspeccion = New Inspeccion();
        $inspeccion-> propuesta_id= $propuesta->id;
        $inspeccion-> save();



        return redirect('/home');        
    }

       
}
