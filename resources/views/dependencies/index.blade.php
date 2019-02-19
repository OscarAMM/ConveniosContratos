@extends('layouts.app')

@section('content')
<h2 class="font-weight-bold text-center "> DEPENDENCIAS <a href="{{route('Dependence.create')}}" class ="btn btn-primary">Nuevo</a> </h2>
    @include('dependencies.fragment.info')
    <div class="card">
            <div class="card-header">
                            {{Form::open(['route'=>'Dependence.index','method'=>'GET','class'=>'form-inline'])}}
                            <h4 class="text-muted font-weight-bold" style="margin-right:150px">CONSULTA DE DEPENDENCIAS</h4>
                            <div class="form-group">
                                {{Form::text('id',null,['class'=>'form-control','placeholder'=>'ID'])}}
                            </div>
                            <div class="form-group">
                                {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre'])}}
                            </div>
                            <div class="form-group">
                                {{Form::text('acronym',null,['class'=>'form-control','placeholder'=>'Siglas'])}}
                            </div>
                            <div class= "form-group">
                                {{Form::text('country',null,['class' =>'form-control','placeholder'=>'Pais'])}}
                            </div>
                           
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-search">BUSCAR</span>
                                </button>
                            </div>
                        {{Form::close()}}
                </div>
            </div>

<table class= "table">
    <thead class= "thead-dark">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Siglas</th>
        <th>País</th>
        <th colspan="3">&nbsp;</th>
    </tr>
    <tbody>
        @foreach($dependence as $dependence)
        <tr>
            <td>{{$dependence->id}}</td>
            <td>{{$dependence->name}}</td>
            <td>{{$dependence->acronym}}</td>
            <td>{{$dependence->country}}</td>
            <td>
            <a href="{{route('Dependence.show', $dependence ->id)}}" class="btn btn-success">Ver</a> </td>
            <td>
            <a href="{{route('Dependence.edit', $dependence ->id)}}" class="btn btn-warning">Editar</a></td>
            <td>
            <form action="{{route('Dependence.destroy', $dependence->id)}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name = "_method" value ="DELETE">
                <button class = "btn btn-danger">Eliminar</button>
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    </thead>
</table>

</div>

@endsection
 
   