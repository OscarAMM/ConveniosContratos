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
    </div>
</div>
@endif
@endsection