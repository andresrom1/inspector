<?php

namespace App\Http\Controllers;

use App\Mail\InspeccionRealizada as MailInspeccionRealizada;
use App\Models\Inspeccion;
use Illuminate\Http\Request;
use \App\Models\Propuesta;
use \App\Models\Foto;
use  \App\Mail\InspeccionRealizada;

//use App\Notifications\InspeccionRealizada;
use App\Notifications\RealizarInspeccion;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;


class InspeccionController extends Controller
{
    protected $guarded = [];

    public function show(Inspeccion $inspeccion)
    {
        $fotos = Foto::where('inspeccion_id', $inspeccion->id)->get();
       
        return view('inspecciones.show', compact('inspeccion','fotos'));
    }

    public function create(Propuesta $propuesta)
    {
        $ppta = new Propuesta();
        $ppta = Propuesta::where('id',$propuesta->id)->first();
        $ppta -> estado = "Enviado";
        $ppta->save();

        $inspeccion = Inspeccion::where('propuesta_id',$propuesta->id)->first();
        $inspeccion->enviados_count++;
        $inspeccion->save();

        Notification::route('mail', $propuesta->tomador->email )
            ->notify(new RealizarInspeccion($propuesta));
        
    }

    public function enviarMailCia(Propuesta $propuesta)
    {
        /*
        Nacion
        Vis Red
        Colón
        LPS
        */
        switch ($propuesta->compania) {
            case "Nacion":
                $mailaddress="andresrom@gmail.com";
                break;
            case "Vis Red":
                $mailaddress="andresrom@gmail.com";
                break;
            case "Colón":
                $mailaddress="andresrom@gmail.com";
                break;
            case "LPS":
                $mailaddress="andresrom@gmail.com";
                break;
        }

        Mail::to($mailaddress)->send(new InspeccionRealizada($propuesta));

        $inspeccion = Inspeccion::where('propuesta_id', $propuesta->id)->first();
        $inspeccion->enviados_cia_count++;
        $inspeccion->save();

        //return(Notification::route('mail', $mailaddress )
            //->notify(new InspeccionRealizada($propuesta)));
    }

    
}
