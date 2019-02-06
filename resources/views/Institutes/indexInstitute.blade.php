@extends('layouts.app')
@section('content')
<div class = "container">
    <div class = "row justify-content-center">
    <div class = "col-md-10">
    <div class = "card">
    <div class = "card-header">
        <H4 class= "text-muted"> INSTITUTOS</H4>
    </div>
    <div class= "card-body">
        @if (session('status'))
         <div class="alert alert-success" role="alert">
            {{ session('status') }}
         </div>
        @endif
        <div class = "blockquote">{{(Auth::user()->name)}}
                        <h6>Administrador maestro</h6> </div>
                        <!-- INICIO DE OPCIONES -->
                        <div class="row">
                        <div class="col-sm-6">
                        <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">REGISTRO DE INSTITUCIONES</h5>
                            <p class="card-text">Se registran los datos de las instituciones Y dependencias participantes                    </p>
                            <a href="{{action('InstituteController@registerInstitute')}}" class="btn btn-primary">REGISTRAR</a>
                        </div>
                        </div>
                        </div>
                        <!--CONSULTA-->
                        <div class="col-sm-6">
                        <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">CONSULTA DE INSTITUCIONES</h5>
                            <p class="card-text">Se realiza una consulta sobre todos las intituciones registradas</p>
                            <a href="{{action ('InstituteController@consult')}}" class="btn btn-primary">CONSULTAR</a>
                        </div>
                        </div>
                        </div>
                        </div>
                         <!--EDICION-->
                         <div class="row">
                        <div class="col-sm-6">
                        <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">EDITAR INSTITUCIONES</h5>
                            <p class="card-text">Se editan los datos de las instituciones Y dependencias participantes                    </p>
                            <a href="#" class="btn btn-primary">EDITAR</a>
                        </div>
                        </div>
                        </div>
                        <!--ELIMINACION-->
                        <div class="col-sm-6">
                        <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">ELIMINAR INSTITUCIONES</h5>
                            <p class="card-text">Se eliminan las instituciones Y dependencias participantes                    </p>
                            <a href="#" class="btn btn-primary">ELIMINAR</a>
                         </div>
                         </div>
                         </div>
                        </div>
                       
        </div>
    </div>
</div>
@endsection
