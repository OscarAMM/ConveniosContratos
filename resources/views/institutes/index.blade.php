@extends('layouts.app')

@section('content')
    @include('institutes.fragment.info')
    <div class="card">
            <div class="card-header">
            <h2 class="font-weight-bold text-center text-muted "> INSTITUCIONES <a href="{{route('Institute.create')}}" class ="btn btn-primary">Nuevo</a> </h2>
                            {{Form::open(['route'=>'Institute.index','method'=>'GET','class'=>'form-inline'])}}
                            <h4 class="text-muted font-weight-bold" style="margin-right:150px">CONSULTA DE INSTITUCIONES</h4>
                            <div class="form-group" style="margin-right:5px">
                                {{Form::text('id',null,['class'=>'form-control','placeholder'=>'ID'])}}
                            </div>
                            <div class="form-group" style ="margin-right:5px">
                                {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre'])}}
                            </div>
                            <div class="form-group" style="margin-right:5px">
                                {{Form::text('acronym',null,['class'=>'form-control','placeholder'=>'Siglas'])}}
                            </div>
                            <div class= "form-group" style="margin-right:5px">
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
                <input type="hidden" name = "_method" value ="DELETE">
                <button class = "btn btn-danger">Eliminar</button>
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    </thead>
</table>
{!!$institutions->render()!!}
</div>

@endsection
 
   