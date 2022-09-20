@extends('layouts.app')

@section('csssearch')   

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css"> -->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css"/>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (\Session::has('destroy'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ \Session::get('destroy') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
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
                                <th scope="col">Estado</th>
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
                                                <form name="borrar" id="borrar-{{ $propuesta->id }}" action="/propuestas/{{ $propuesta->id }}" method="post">

                                                    @method('DELETE')
                                                    @csrf

                                                    <span style="color:#e61c9b; cursor:pointer;" class='bi bi-trash' onclick="document.forms['borrar-{{ $propuesta->id }}'].submit()"></span>
                                                    

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
                                    <div class="d-flex justify-content-center">
                                        @if ($propuesta->estado =="enviado")
                                            <!-- <span style="color: red" class='bi bi-person-badge-fill'></span> -->
                                            <span>enviado</span>
                                        @endif
                                        @if ($propuesta->estado =="pendiente")
                                            <!-- <span style="color: yellow" class='bi bi-shield-fill-exclamation'></span> -->
                                            <span>pendiente</span>
                                        @endif
                                        @if ($propuesta->estado =="aceptado")
                                            <!-- <span style="color: green" class='bi bi-patch-check-fill'></span> -->
                                            <span>aceptado</span>
                                        @endif
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
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('jssearch')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
<!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script> -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>


<script>
    $('#propuestas-table').DataTable({
        searchPanes:{
            show: true,
            cascadePanes: true,
            initCollapsed: true,
            orderable: false,

            dtOpts: {
                searching: true,
                info: true,
                
                
            },
            columns: [1,3,8],
        },
        
        dom: 'Plfrtip',
        
        
        responsive: true,
        autoWidth: false
    });
</script>
@endsection
