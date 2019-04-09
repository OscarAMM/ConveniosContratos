@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('css\proyect.css')}}">
@if(Auth::user()->hasRole('admin'))
@include('auth.fragment.info')

<div class="card-header text-muted text-center" style="margin-bottom:5px;">
    <h2> Contratos </h2>
</div>
<div class="row-10 d-flex justify-content-center">
    {{Form::open(['route'=>'Contract.index','method'=>'GET','class'=>'form-inline'])}}
    <p class="text-item-center"><a href="{{route('Contract.create')}}" class="btn boton"
            style="margin-right:5px">Nuevo</a>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
            aria-expanded="false" aria-controls="collapseExample" style="margin-right:15px">
            Búsqueda
        </button></p>
    <div class="collapse" id="collapseExample">
        <div class=" card card-body " style="margin-bottom:5px">
            <!-- inicio form busqueda-->
            <div class="form-row">
                <div class="col" style="margin-right:5px">
                    {{Form::text('id',null,['class'=>'form-control','placeholder'=>'ID'])}}
                </div>
                <div class="col" style="margin-right:5px">
                    {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre'])}}
                </div>
                <div class="col" style="margin-right:5px">
                    {{Form::date('reception',null,['class'=>'form-control','placeholder'=>'Recepción'])}}
                </div>
                <div>
                    {{Form::text('scope',null,['class'=>'form-control','placeholder'=>'Ámbito'])}}
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-search">Buscar</span>
                    </button>
                </div>
            </div>
        </div>
        {{Form::close()}}
    </div>
</div>
<div class="row d-flex justify-content-center">
    <div class="col-md-10">
        <table class="table  table-striped table-bordered">
            <thead class="thead-dark ckeditor">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Recepción</th>
                    <th>Objetivo</th>
                    <th>Contrato válido</th>
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
                        <a href="{{route('Contract.show', $contract ->id)}}" class="btn botonAzul">Ver</a> </td>
                    <td>
                        <a href="{{route('Contract.edit', $contract ->id)}}" class="btn botonAmarillo">Editar</a></td>
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