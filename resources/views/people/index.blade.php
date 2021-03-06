@extends('layouts.app')
@section('content')
@if(!Auth::guest()&&Auth::user()->hasRole('admin'))
@include('people.fragment.info')
<div class="container">
    <div class="jumbotron" style="background-color:#0F3558;">
        <h1 class="text-muted">Parte</h1>
        <hr style="border:2px solid #BF942D">
        <p class="text-muted">Se desplegará una lista con todas las Partes registradas hasta el momento en el sistema.
        </p>
        {{Form::open(['route'=>'Person.index','method'=>'GET','class'=>'form-inline'])}}
        <p class="text-item-center"><a href="{{route('Person.create')}}" class="btn boton"
                style="margin-right:5px">Nuevo</a>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample" style="margin-right:15px">
                Búsqueda
            </button></p>
        <div class="collapse " id="collapseExample">
            <div class="card card-body" style="margin-bottom:5px; background-color:#BF942D;">
                <!-- inicio form busqueda-->
                <div class="form-row">
                    <div class="col">
                        <label for="name" class="col-form-label text-muted"><strong>Nombre</strong> </label>
                        {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre'])}}
                    </div>
                    <div class="col">
                        <label for="personType" class="col-form-label text-muted"><strong>Tipo de suscrito</strong>
                        </label>
                        <select name="personType" id="personType" class="form-control">
                            <option>
                            <option>
                            <option>Persona física</option>
                            <option>Persona moral</option>
                            <option>Institución</option>
                            <option>Dependencia</option>
                            <option>Otros</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="country" class="col-form-label text-muted"><strong>País</strong> </label>
                        {{Form::text('country',null,['class'=>'form-control','placeholder'=>'País'])}}
                    </div>
                    <div class="col">
                        <label for="email" class="col-form-label text-muted"><strong>Correo</strong> </label>
                        {{Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'Correo'])}}
                    </div>
                    <div class="col">
                        <label for="acronym" class="col-form-label text-muted"><strong>Siglas</strong> </label>
                        {{Form::text('acronym', null, ['class'=>'form-control', 'placeholder'=>'Siglas'])}}
                    </div>

                </div>
                <div>
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-search">Buscar</span>
                    </button>
                </div>
            </div>

            {{Form::close()}}
        </div>
    </div>
</div>

<div class="row d-flex justify-content-center">
    <div class="col-md-10">
        <table class="table  table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Tipo de persona</th>
                    <th>País</th>
                    <th>Correo</th>

                    <th colspan="3">&nbsp;</th>
                </tr>
            <tbody>
                @foreach($people as $person)
                <tr>
                    <td>{{$person->id}}</td>
                    <td>{{$person->name}}</td>
                    <td>{{$person->personType}}</td>
                    <td>{{$person->country}}</td>
                    <td>{{$person->email}}</td>
                    <td>
                        <a href="{{route('Person.show', $person->id)}}" class="btn botonAzul">Ver</a> </td>
                    <td>
                        <a href="{{route('Person.edit', $person->id)}}" class="btn botonAmarillo">Editar</a></td>
                    <td>
                        <form action="{{route('Person.destroy', $person->id)}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger"
                                onClick="return confirm('¿Seguro que quiere eliminar?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </thead>
        </table>
        {!!$people->appends([
        'name'=>$name,'country'=>$country,'personType'=>$personType,'email'=>$email,'acronym'=>$acronym])->links()!!}

    </div>
</div>

</div>
@else
<!------------SECOND PAGE - DENIED PAGE ---------------------------------------->
<div class="container">
    <div class="jumbotron" style="background-color:#0F3558;">
        <h1 class="text-muted"><strong>¡ACCESO RESTRINGIDO!</strong> </h1>
        <hr style="border:2px solid #BF942D">
        <h4 class="text-muted">¡El usuario NO tiene permiso! Si desea realizar algo,
            contacte a
            su administrador.</h4>
    </div>
</div>
@endif
@endsection