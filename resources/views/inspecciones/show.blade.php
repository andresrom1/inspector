@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Fotos de la inspeccion #{{$inspeccion->propuesta->id}} | {{ $inspeccion->propuesta->dominio }} | {{ $inspeccion->propuesta->tomador->name }}</div>
                    
                    <div class="card-body d-flex flex-wrap">
                    
                    @foreach($fotos as $foto)
                        <div class="col-md-3 p-1"><a href="{{ $foto->url }}">

                            <div class="card">

                                <div class="card-body">

                                    <img class="card-img-top" src="{{ asset($foto->url_thumb) }}" alt="">

                                    <div class="card-footer pt-3">

                                        <form action="/fotos/{{ $foto ->id }}" method="post">

                                            @method('DELETE')
                                            @csrf
                                            <button class="small btn btn-outline-danger">Eliminar</button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="/home" class="btn btn-success">Volver</a>
                        </div>
                        
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // Note that the name "myDropzone" is the camelized
        // id of the form.
        Dropzone.options.dropzoneForm = {
            // Configuration options go here
            headers:{
                'X-csrf-token': "{{csrf_token()}}"
            },
            
            addRemoveLinks: 'true',

            dictDefaultMessage:"Arrastre una imagen al recuadro para subirla",

            acceptedFiles: "image/*",

            maxFiles: 8,
        };
    </script>
@endsection