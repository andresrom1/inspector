@extends('layouts.app')

@section('csssearch')   

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="d-flex align-center">
                        <div>
                            <span>{{ __('Propuestas') }}</span>
                            <a class="btn btn-outline-primary btn-sm" href="/propuestas/create" role="button">Nueva propuesta</a>
                        </div>
                    </div>

                   
                    
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                            
                        </div>
                    @endif

                    <table class="table table-hover table-bordered table-sm" id="propuestas-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Compañía</th>
                                <th scope="col">Nro. Ppta | Pza</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Dominio</th>
                                <th scope="col">Tomador</th>
                                <th scope="col">Creado</th>
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
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex">
                                            <div>
                                                {{ $propuesta->tomador->name }} | {{ $propuesta->tomador->email }}
                                            </div>
                                            
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <a href="/propuestas/{{ $propuesta->id }}/edit"><span style="color:#e61c9b" class='bi bi-pencil-square'></span></a>
                                            </div>
                                            <div>
                                                <form name="borrar" action="/propuestas/{{ $propuesta->id }}" method="post">

                                                    @method('DELETE')
                                                    @csrf
                                                    
                                                    <span style="color:#e61c9b; cursor:pointer;" class='bi bi-trash' onclick="borrar.submit()"></span>
                                                
                                                </form>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @inject('dt', 'App\Http\Controllers\PropuestaController')
                                    {{ $dt->getFecha($propuesta) }}</td>
                                <td>
                                    
                                    <div class="d-flex justify-content-center">        
                                        <mail-tomador class="pe-1" propuesta-id="{{ $propuesta->id }}" enviados="{{ $propuesta->inspeccion->enviados_count }}"></mail-tomador>
                                        <mail-cia class="pe-1" 
                                            propuesta-id="{{ $propuesta->id }}" 
                                            enviados="{{ $propuesta->inspeccion->enviados_cia_count }}" 
                                            cantArchivos="{{ \App\Http\Controllers\PropuestaController::fotosCount($propuesta)}}"></mail-cia>
            
                                    </div>
                                </td>
                                <td>
                                    
                                    <a class="btn btn-outline-info btn-sm" href="/inspecciones/{{$propuesta->inspeccion->id}}" role="button">Ver
                                        <span class="badge text-bg-info">{{ \App\Http\Controllers\PropuestaController::fotosCount($propuesta)}} adj.</span>
                                    </a>
                                </td>
                            </tr>
                            
                            @endforeach
                        </tbody>

                    </table>
                    
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jssearch')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>

<script>
    $('#propuestas-table').DataTable({
        responsive: true,
        autoWidth: false
    });
</script>
@endsection
