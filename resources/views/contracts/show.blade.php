@extends('layouts.app')

@section('content')
@if(Auth::user()->hasRole('admin'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class=" text-center font-weight-bold text-muted">CONTRATO</h4>
                </div>
                <div class="card-body">
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Nombre</h5>
                        {{$contracts->name}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Recepción</h5>
                        {{$contracts->reception}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Objetivo</h5>
                      {{$contracts->objective}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Contrato válido hasta..</h5>
                      {{$contracts->contractValidity}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Ámbito</h5>
                      {{$contracts->scope}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Institucion perteneciente</h5>
                        {{$institutes->name}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Usuario asignado</h5>
                        {{$users->name}}
                    </li>
                    <li class="list-group-item text-center">
                        <a href="{{route('Contract.index')}}" class="btn btn-secondary">Regresar</a>
                        <a href="{{route('Contract.edit'), $contract->id}}">Editar</a>
                    </ul>
                </div>
                <div>

                </div>
            </div>
        </div>
    </div>
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