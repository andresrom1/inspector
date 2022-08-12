@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Propuestas') }}
                    <a class="btn btn-outline-primary btn-sm" href="/propuestas/create" role="button">Nueva propuesta</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                            
                        </div>
                    @endif

                    <table class="table table-hover table-bordered table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Compañía</th>
                                <th scope="col">Nro. Ppta | Pza</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Dominio</th>
                                <th scope="col">Tomador</th>
                                <!-- <th scope="col">Estado</th>-->
                                <th scope="col">Enviar email <span class="badge text-bg-success">Cant. Envíos</span></th>
                                <th scope="col">Adjuntos</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach($propuestas as $propuesta)
                            <tr>
                                <th scope="row">{{$propuesta->id}}</th>
                                <td>{{ $propuesta-> compania }}</td>
                                <td>{{ $propuesta-> numero_propuesta}}</td>
                                <td>{{ $propuesta-> tipo }}</td>
                                <td>
                                    <div class="d-flex justify-content-between pe-3">
                                        <div>{{ $propuesta-> dominio }}</div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex justify-content-between  pe-3">
                                        <div>
                                            {{ $propuesta->tomador->name }} | {{ $propuesta->tomador->email }}
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-outline-primary btn-sm">Editar</button>
                                        </div>
                                    </div>
                                </td>
                                <!-- <td>{{ $propuesta->estado }}</td>-->
                                <td>
                                    
                                    <div class="d-flex justify-content-center">        
                                        <mail-tomador class="pe-1" propuesta-id="{{ $propuesta->id }}" enviados="{{ $propuesta->inspeccion->enviados_count }}"></mail-tomador>
                                        <mail-cia class="pe-1" propuesta-id="{{ $propuesta->id }}" enviados="{{ $propuesta->inspeccion->enviados_cia_count }}"></mail-cia>
            
                                    </div>
                                </td>
                                <td>
                                    
                                    <a class="btn btn-outline-info btn-sm" href="/inspecciones/{{$propuesta->inspeccion->id}}" role="button">Ver
                                        <span class="badge text-bg-info">{{ \App\Http\Controllers\PropuestaController::fotosCount($propuesta)}}</span>
                                    </a>
                                </td>
                            </tr>
                            
                            @endforeach

                                                        
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
