<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Foto;
use App\Models\Inspeccion;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class FotoController extends Controller
{
    protected $guarded =[];

    public function index()
    {
        $fotos = Foto::all();
        //dd($fotos);
        return view('fotos.index',compact('fotos'));
    }

    public function create(Inspeccion $inspeccion)
    {
        
        
        return view('fotos.create',compact('inspeccion'));
    }

    public function store(Request $request, Inspeccion $inspeccion)
    {   
        
        $request->validate([
            'file'=> 'required|image',
        ]);

        $filename = Str::random(25) . "." . $request->file('file')->getClientOriginalExtension();
        $path = storage_path() . '\app\public\inspecciones/' . $filename;
        $url = Storage::url('inspecciones/'.$filename);
        $inspeccion_id = $inspeccion->id;
        
        Image::make($request->file('file'))
           ->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();})
            ->save($path);

        Foto::create([
            'url'=>$url,
            'inspeccion_id'=>$inspeccion_id,
        ]);

        // TO-DO
        // Cambiar el estado de la propuesta
    }

    public function fotosCount(Inspeccion $inspeccion)
    {
        $inspeccion = Inspeccion::where('id', $inspeccion->id)->count();

        return $inspeccion;

    }
}
