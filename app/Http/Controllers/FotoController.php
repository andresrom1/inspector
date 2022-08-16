<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Foto;
use App\Models\Inspeccion;
use Illuminate\Support\Facades\File;
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

        $random = Str::random(25);
        $filename = $random . "." . $request->file('file')->getClientOriginalExtension();
        $filename_thumb = $random . "_thumb." . $request->file('file')->getClientOriginalExtension();
        $path = storage_path() . '\app\public\inspecciones/';
        $url = Storage::url('inspecciones/');
        $inspeccion_id = $inspeccion->id;
        
        Image::make($request->file('file'))
           ->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();})
            ->save($path . $filename);

        Image::make($request->file('file'))
            ->fit(250, 250)
            ->save($path . $filename_thumb);

        Foto::create([
            'url'=>$url.$filename,
            'url_thumb'=>$url.$filename_thumb,
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

    public function destroy(Foto $foto)
    {
        
        File::delete([
            public_path($foto->url),
            public_path($foto->url_thumb),
        ]);
        
        $foto->delete();

        return redirect()->back();
    }
}
