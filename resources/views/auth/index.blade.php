@extends('layouts.app')

@section('content')


<!--  <h2 class="font-weight-bold text-center"> USUARIOS
    <a href="{{ route('admin.index') }}" class ="btn btn-primary pull-right">Nuevo</a>
    </h2> -->
@if(Auth::user()->hasRole('admin'))
<link rel="stylesheet" href="{{asset('css\proyect.css')}}">
@include('auth.fragment.info')
<div class="container">

    <div class="jumbotron" style="background-color:#0F3558;">
        <h1 class="text-muted">Usuario</h1>
        <hr style="border:2px solid #BF942D">
        <p class="text-muted">Se desplegará una lista con todas los usuarios registrados hasta el momento en el
            sistema.
        </p>
        <small class="text-muted">Nota: La lista está compuesta de los usuarios normales y los administradores. </small>
        {{Form::open(['route'=>'users.index','method'=>'GET','class'=>'form-inline'])}}
    <p class="text-item-center"><a href="{{route('admin.index')}}" class="btn boton" style="margin-right:5px">Nuevo</a>
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
                    {{Form::text('email',null,['class'=>'form-control','placeholder'=>'Email'])}}
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
</div>

<div class="row  d-flex justify-content-center">
    <div class="col-md-10">
        <table class="table  table-striped table-bordered">
            <thead class="thead-dark">
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
                        <a href="{{route('users.show', $user ->id)}}" class="btn botonAzul">Ver</a> </td>
                    <td>
                        <a href="{{route('users.edit', $user ->id)}}" class="btn botonAmarillo">Editar</a></td>
                    <td>
                        <form action="{{route('users.destroy', $user->id)}}" method="POST">
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
{!!$users->render()!!}
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