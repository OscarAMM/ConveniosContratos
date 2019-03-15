@extends('layouts.app')
@section('content')
@if(Auth::user()->hasRole('admin'))

@include('auth.fragment.info')

<div class="card-header text-muted text-center" style="margin-bottom:5px">
    <h3> Convenios </h3>
</div>
{{Form::open(['route'=>'Agreement.index','method'=>'GET','class'=>'form-inline'])}}
<p class="text-item-center"><a href="{{route('Agreement.create')}}" class="btn btn-success"
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

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Recepción</th>
            <th>Objetivo</th>
            <th>Fecha de validez</th>
            <th>Ámbito</th>
            <th colspan="4">&nbsp;</th>
        </tr>
    <tbody>
        @foreach($agreements as $agreement)
        <tr>
            <td>{{$agreement->id}}</td>
            <td>{{$agreement->name}}</td>
            <td>{{$agreement->reception}}</td>
            <td>{{$agreement->objective}}</td>
            <td>{{$agreement->agreementValidity}}</td>
            <td>{{$agreement->scope}}</td>
            <td>
                <a href="{{route('Agreement.show', $agreement ->id)}}" class="btn btn-info">Ver</a> </td>
            <td>
                <a href="{{route('Agreement.edit', $agreement ->id)}}" class="btn btn-warning">Editar</a></td>
            <td>
                <form action="{{route('Agreement.destroy', $agreement->id)}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger">Eliminar</button>
                </form>
            </td>
            <td>
                <a href="{{route('Revision')}}" class="btn btn-success">Revisión</a></td>
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