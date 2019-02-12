@extends('layouts.app')

@section('content')
<div class = "container">

    <h2 class="font-weight-bold text-center"> USUARIOS
    <a href="{{ route('admin.index') }}" class ="btn btn-primary pull-right">Nuevo</a>
    </h2>
    @include('auth.fragment.info')
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>
                        Busqueda de usuarios
                        {{Form::open(['route'=>'users.index','method'=>'GET','class'=>'form-inline pull-right'])}}
                            <div class="form-group">
                                {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre'])}}
                            </div>
                            <div class="form-group">
                                {{Form::text('email',null,['class'=>'form-control','placeholder'=>'Email'])}}
                            </div>
                            <div class="form-group">
                                {{Form::text('id',null,['class'=>'form-control','placeholder'=>'ID'])}}
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                        {{Form::close()}}
                    </h1>
                </div>
            </div>
        </div>

    <div class="col-md-8">

    <table class= "table table-hover table-striped ">
        <thead class= "thead-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th colspan="3">&nbsp;</th>
        </tr>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                <a href="{{route('users.show', $user ->id)}}" class="btn btn-success">Ver</a> </td>
                <td>
                <a href="{{route('users.edit', $user ->id)}}" class="btn btn-warning">Editar</a></td>
                <td>
                <form action="{{route('users.destroy', $user->id)}}" method="POST">
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
    {!!$users->render()!!}
</div>

@endsection