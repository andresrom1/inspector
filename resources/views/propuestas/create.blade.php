@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Crear Propuesta') }}</div>

                
                <div class="card-body">

                <form action="/propuestas" method="post">
                    
                    @csrf
                                      
                    <div class="form-group">                        
                        <label for="compania">Compañía | Broker</label>
                        <select name ="compania" class="form-control" id="compania">
                                                      
                            <option value="Nacion" {{ old('compania') == 'Nacion' ? 'selected="selected"' : '' }}>Nacion</option>
                            <option value="Vis Red" {{ old('compania') == 'Vis Red' ? 'selected="selected"' : '' }}>Vis Red</option>
                            <option value="Colon" {{ old('compania') == 'Colon' ? 'selected="selected"' : '' }}>Colon</option>
                            <option value="LPS" {{ old('compania') == 'LPS' ? 'selected="selected"' : '' }}>LPS</option>
                        </select>
                    </div>

                    <div class="form-group pt-3">
                        <label for="tipo">Tipo</label>
                        <select name="tipo" class="form-control" id="tipo">

                            <option value="Auto" {{ old('tipo') == 'Auto' ? 'selected="selected"' : '' }}>Auto</option>
                            <option value="Moto" {{ old('tipo') == 'Moto' ? 'selected="selected"' : '' }}>Moto</option>
                            
                        </select>
                    </div>
                    <div class="form-group pt-3">
                        <label for="propuesta">Número de propuesta | póliza</label>
                        <input  name="propuesta" 
                                type="text" 
                                class="form-control" 
                                id="propuesta" 
                                value="{{ old('propuesta') }}"
                                onkeyup="this.value = this.value.toUpperCase();"
                                placeholder="Ingrese el número de propuesta">

                        @error ('propuesta') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group pt-3">
                        <label for="dominio">Dominio</label>
                        <input  name="dominio" 
                                type="text" 
                                class="form-control" 
                                id="dominio" 
                                value="{{ old('dominio') }}"
                                onkeyup="this.value = this.value.toUpperCase();"
                                placeholder="Ingrese el dominio del vehículo">

                        @error ('dominio') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="form-group pt-3">
                        <label for="tomador">Nombre del Tomador</label>
                        <input  name="tomador" 
                                type="text" class="form-control" 
                                id="tomador" 
                                value="{{ old('tomador') }}"
                                onkeyup="this.value = this.value.toUpperCase();"
                                placeholder="Ingrese el nombre del tomador">

                        @error ('tomador') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    
                    <div class="form-group pt-3">
                        <label for="email">Email del Tomador</label>
                        <input  name="email" 
                                type="email" 
                                value="{{ old('email') }}"
                                class="form-control" 
                                id="email" 
                                placeholder="Ingrese el email del tomador">

                        @error ('email') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class ="pt-3">
                        <button type="submit" class="btn btn-primary pt-">Crear Propuesta</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection