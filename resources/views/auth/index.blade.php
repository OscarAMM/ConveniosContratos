@extends('layouts.app')

@section('content')


  <!--  <h2 class="font-weight-bold text-center"> USUARIOS
    <a href="{{ route('admin.index') }}" class ="btn btn-primary pull-right">Nuevo</a>
    </h2> -->
    @if(Auth::user()->hasRole('admin'))
     
    @include('auth.fragment.info')

    <div class="card">
            <div class="card-header">
                            {{Form::open(['route'=>'users.index','method'=>'GET','class'=>'form-inline'])}}
                            <h4 class="text-muted font-weight-bold" style="margin-right:150px">CONSULTA DE USUARIOS</h4>
                            <div class="form-group">
                                {{Form::text('id',null,['class'=>'form-control','placeholder'=>'ID'])}}
                            </div>
                            <div class="form-group">
                                {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre'])}}
                            </div>
                            <div class="form-group">
                                {{Form::text('email',null,['class'=>'form-control','placeholder'=>'Email'])}}
                            </div>
                           
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-search">BUSCAR</span>
                                </button>
                            </div>
                        {{Form::close()}}
                </div>
            </div>
    <div class= "card-body">
    <table class= "table ">
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
    
    {!!$users->render()!!}
    </div>
   
    </div>
    @else
    <div class="container">

            <h4>Acceso restringido</h4>
            <h6>Comuníquese con su administrador</h6>
    </div>
    @endif

@endsection