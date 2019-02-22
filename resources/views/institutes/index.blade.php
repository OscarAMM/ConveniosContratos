@extends('layouts.app')

@section('content')
@if(Auth::user()->hasRole('admin'))
@include('institutes.fragment.info')
<div class="card-header text-muted text-center" style="margin-bottom:5px">
    <h3> Instituciones </h3>
</div>
{{Form::open(['route'=>'Institute.index','method'=>'GET','class'=>'form-inline'])}}
<p class="text-item-center"><a href="{{route('Institute.create')}}" class="btn btn-success"
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
                {{Form::text('acronym',null,['class'=>'form-control','placeholder'=>'Siglas'])}}
            </div>
            <div class="col" style="margin-right:5px">
                {{Form::text('country',null,['class' =>'form-control','placeholder'=>'Pais'])}}
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
            <th>ID</th>
            <th>Nombre</th>
            <th>Siglas</th>
            <th>País</th>
            <th colspan="3">&nbsp;</th>
        </tr>
    <tbody>
        @foreach($institutions as $institute)
        <tr>
            <td>{{$institute->id}}</td>
            <td>{{$institute->name}}</td>
            <td>{{$institute->acronym}}</td>
            <td>{{$institute->country}}</td>
            <td>
                <a href="{{route('Institute.show', $institute ->id)}}" class="btn btn-success">Ver</a> </td>
            <td>
                <a href="{{route('Institute.edit', $institute ->id)}}" class="btn btn-warning">Editar</a></td>
            <td>
                <form action="{{route('Institute.destroy', $institute->id)}}" method="POST">
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
{!!$institutions->render()!!}
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