@extends('layouts.app')

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
                    <div><img src="/storage/img/indicaciones.PNG"></div>
                    
                    <div class="d-flex">
                        <form action="/inspecciones/{{$inspeccion->id}}/fotos" method="POST" class="dropzone" id="dropzone-form">
                            <img src="/storage/img/FRENTE.PNG" alt="">
                        </form>

                        <form action="/inspecciones/{{$inspeccion->id}}/fotos" method="POST" class="dropzone" id="dropzone-form">
                        <img src="/storage/img/FRENTE.PNG" alt=""></form>

                        <form action="/inspecciones/{{$inspeccion->id}}/fotos" method="POST" class="dropzone" id="dropzone-form">
                        <img src="/storage/img/FRENTE.PNG" alt=""></form>

                        <form action="/inspecciones/{{$inspeccion->id}}/fotos" method="POST" class="dropzone" id="dropzone-form">
                        <img src="/storage/img/FRENTE.PNG" alt=""></form>

                        <form action="/inspecciones/{{$inspeccion->id}}/fotos" method="POST" class="dropzone" id="dropzone-form">
                        <img src="/storage/img/FRENTE.PNG" alt="" c></form>

                        <form action="/inspecciones/{{$inspeccion->id}}/fotos" method="POST" class="dropzone" id="dropzone-form">
                        <img src="/storage/img/FRENTE.PNG" alt=""></form>
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

            //dictDefaultMessage:"Arrastre una imagen al recuadro para subirla",

            acceptedFiles: "image/*",

            maxFiles: 1,
        };
    </script>
@endsection