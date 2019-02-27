@extends('layouts.app')
@section('content')
@if(Auth::user()->hasRole('admin'))

@include('auth.fragment.info')

<div class="card-header text-muted text-center" style="margin-bottom:5px">
    <h3> Contratos </h3>
    <a href="{{route('Contract.create')}}" class="btn btn-success" style="margin-right:5px">Nuevo</a>
</div>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Recepción</th>
            <th>Objectivo</th>
            <th>Contrato Valid</th>
            <th>Ámbito</th>
            <th colspan="3">&nbsp;</th> 
        </tr>
    <tbody>
        @foreach($contracts as $contract)
        <tr>
            <td>{{$contract->id}}</td>
            <td>{{$contract->name}}</td>
            <td>{{$contract->reception}}</td>
            <td>{{$contract->objective}}</td>
            <td>{{$contract->contractValidity}}</td>
            <td>{{$contract->scope}}</td>
            <td>
                <a href="{{route('Contract.show', $contract ->id)}}" class="btn btn-info">Ver</a> </td>
            <td>
                <a href="{{route('Contract.edit', $contract ->id)}}" class="btn btn-warning">Editar</a></td>
            <td>
                <form action="{{route('Contract.destroy', $contract->id)}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    </thead>
</table>
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