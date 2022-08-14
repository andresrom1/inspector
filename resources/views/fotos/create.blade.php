@extends('layouts.tomadoresapp')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Subir fotos') }}</div>
                <div class="card-body">
                <div class="d-flex flex-wrap">
                    
                        <div class="col-2">
                            <form action="/inspecciones/{{$inspeccion->id}}/fotos" style="background-image: url('/storage/img/frente.PNG')" method="POST" class="dropzone" id="dropzone-form">
                            
                        </form>
                        </div>
                    

                    
                        <div class="col-2">
                            <form action="/inspecciones/{{$inspeccion->id}}/fotos" style="background-image: url('/storage/img/izquierda.PNG')" method="POST" class="dropzone" id="dropzone-form">
                            
                        </form>
                        </div>
                    
                    
                    
                        <div class="col-2">
                            <form action="/inspecciones/{{$inspeccion->id}}/fotos" style="background-image: url('/storage/img/atras.PNG')" method="POST" class="dropzone" id="dropzone-form">
                            
                        </form>
                        </div>
                    
                    
                    
                        <div class="col-2">
                            <form action="/inspecciones/{{$inspeccion->id}}/fotos" style="background-image: url('/storage/img/derecha.PNG')" method="POST" class="dropzone" id="dropzone-form">
                            
                        </form>
                        </div>
                    
                    
                    
                        <div class="col-2">
                            <form action="/inspecciones/{{$inspeccion->id}}/fotos" style="background-image: url('/storage/img/auxilio.PNG')" method="POST" class="dropzone" id="dropzone-form">
                            
                        </form>
                        </div>
                    
                    
                    
                        <div class="col-2">
                            <form action="/inspecciones/{{$inspeccion->id}}/fotos" style="background-image: url('/storage/img/cedula.PNG')" method="POST" class="dropzone" id="dropzone-form">
                            
                        </form>
                        </div>
                    
                </div></div>
                <div class="card-footer ">
                    <div class="d-flex justify-content-end">
                        <a href="https://prudensseguros.com.ar" class="btn btn-success">Listo</a>
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

            dictDefaultMessage:"", //Arrastre una imagen al recuadro para subirla

            acceptedFiles: "image/*",

            maxFiles: 1,
        };
    </script>
@endsection