@extends('layouts.app')
@section('content')
@if(Auth::user()->hasRole('admin'))

@include('auth.fragment.info')}

<div class="card-header text-muted text-center" style="margin-bottom:5px">
    <h3> Contratos </h3>
    <a href="{{route('Contract.create')}}" class="btn btn-success"
        style="margin-right:5px">Nuevo</a>
</div>
@else
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="text-muted">Acceso restringido</h2>
        </div>
        <div class="card-body">
            <h4>EL Usuario no tiene acceso a esta área, comuníquese con su administrador si desea realizar algún cambio.
            </h4>
        </div>

    </div>
</div>
@endif
@endsection