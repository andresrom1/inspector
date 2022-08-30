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
                            <span>{{ __('Usuarios') }}</span>
                            <a class="btn btn-outline-primary btn-sm" href="/usuarios/create" role="button">Nuevo usuario</a>
                        </div>
                    </div>

                   
                    
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                            
                        </div>
                    @endif

                    <table class="table table-hover table-bordered table-sm" id="usuarios-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Tipo</th> 
                                <th scope="col">Acciones</th>                               
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach($usuarios as $usuario)
                            <tr>
                                <th scope="row">{{$usuario->id}}</th>
                                <td>{{ $usuario-> name }}</td>
                                <td>{{ $usuario-> email }}</td>
                                <td>{{ $usuario-> type }}</td>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex">
                                            <div>
                                                <a href="/usuarios/{{ $usuario->id }}/edit"><span style="color:#e61c9b" class='bi bi-pencil-square'></span></a>
                                            </div>
                                            <div>
                                                <form name="borrar-{{ $usuario->id }}" id="borrar-{{ $usuario->id }}" action="/usuarios/{{ $usuario->id }}" method="post">

                                                    @method('DELETE')
                                                    @csrf
                                                    <span style="color:#e61c9b; cursor:pointer;" class='bi bi-trash' onclick="document.forms['borrar-{{ $usuario->id }}'].submit()"></span>

                                                </form>
                                                
                                            </div>
                                        </div>
                                    </div>
                                
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
    $('#usuarios-table').DataTable({
        responsive: true,
        autoWidth: false
    });
</script>
@endsection
