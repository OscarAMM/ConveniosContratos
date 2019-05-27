@extends('layouts.app')
@section('content')
@if(!Auth::guest() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('revisor')))
<div class="container">
    <div class="jumbotron" style="background-color:#0F3558;">
        <h1 class="text-muted">Registro final</h1>
        <hr style="border:2px solid #BF942D">
        <h3 class="text-muted">¡Bienvenido al registro final {{Auth::user()->name}}!</h3>
        <p class="text-muted">Esta sección es para cargar todos los documentos que han sido <strong>APROBADOS</strong> y
            <strong>FIRMADOS</strong>.</p>
        <p class="text-muted"> <i> <strong>NOTA:</strong> Esta sección tendrá relación con el apartado de vistas
                públicas, por lo que se pide que verifiquen el
                documento que será visible para el público general. </i></p>
        @if(!Auth::guest() && (Auth::user()->hasRole('admin') ))
        <p class="text-item-center"><a href="{{route('FinalRegister.create')}}" class="btn boton" style="margin-right:5px">Nuevo</a>
            @endif
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample" style="margin-right:15px">
                Búsqueda
            </button>
        </p>
        <!-- AQUI VA EL FORMULARIO DE BÚSQUEDA -->
    </div>

    <!-- TABLA DE DOCUMENTOS -->
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre completo</th>
                        <th>Instrumento jurídico</th>
                        <th>Tipo de instrumento</th>
                        <th>Fecha de firma</th>
                        <th>Fecha vigencia</th>
                        <th>suscrito</th>
                        <th colspan="3">&nbsp; Opciones</th>
                    </tr>
                <tbody>
                    <tr>
                        <!--FALTA EL FOREACH Y LOS VALORES -->
                        <td></td>
                    </tr>
                </tbody>
                </thead>
            </table>
        </div>
    </div>

</div>
@else
<div class="container">
    <div class="jumbotron" style="background-color:#0F3558;">
        <h1 class="text-muted"><strong>¡ACCESO RESTRINGIDO!</strong> </h1>
        <hr style="border:2px solid #BF942D">
        <h4 class="text-muted">¡El usuario {{Auth::user()->name}} NO tiene permiso! Si desea realizar algo, contacte a su administrador.</h4>
    </div>
</div>
@endif
@endsection