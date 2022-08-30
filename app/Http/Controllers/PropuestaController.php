<?php

namespace App\Http\Controllers;

use App\Models\Propuesta;
use App\Models\Tomador;
use App\Models\Inspeccion;
use App\Models\Foto;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

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
            'email'=> 'required|email',
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

    public function fotosCount(Propuesta $propuesta)
    {
        $inspeccion = Inspeccion::where('propuesta_id', $propuesta->id)->firstOrFail();        
        
        $p= Foto::where('inspeccion_id', $inspeccion->id)->count();
        
        return $p;
    }

    public function edit(Propuesta $propuesta)
    {
        $tomador = Tomador::where('id',$propuesta->tomador_id)->firstOrFail();
        return view('propuestas.edit',compact('propuesta','tomador'));
    }

    public function update(Propuesta $propuesta)
    {
        
        $data = request()->validate([
            'compania' => 'required',
            'tipo' => 'required',
            'propuesta' => 'required',
            'dominio' => 'required',
            'tomador' => 'required',
            'email' => 'required'
        ]);
        
        
        //$propuesta = Propuesta::where('id', request('id'))->firstOrFail();
        
        $propuesta -> compania = request('compania');
        $propuesta -> tipo = request('tipo');
        $propuesta -> dominio = request('dominio');
        $propuesta -> numero_propuesta = request('propuesta');
        $propuesta->update();
        

        $tomador = Tomador::where('id',$propuesta->tomador_id)->firstOrFail(); 
        $tomador-> name = request('tomador');
        $tomador-> email = request('email');
        $tomador->update();

        

        return redirect('/home');
    }

    public function destroy(Propuesta $propuesta)
    {
       

        $inspeccion = Inspeccion::where('propuesta_id', $propuesta->id)->firstOrFail(); 

        $fotos = Foto::where('inspeccion_id', $inspeccion->id)->get();

        foreach($fotos as $foto){
            
            File::delete([
                public_path($foto->url),
                public_path($foto->url_thumb),
            ]);
            
            $foto->delete();
        }

        $inspeccion->delete();
        $propuesta->delete();

        return redirect('/home');
    }

    public function getFecha(Propuesta $propuesta)
    {
        return Carbon::parse($propuesta->created_at)->format('d/m/Y');
    }

    
       
}
