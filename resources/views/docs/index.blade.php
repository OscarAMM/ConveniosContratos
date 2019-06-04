@extends('layouts.app')
@section ('content')
@if(!Auth::guest() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('revisor')))
<div class="container">
    <div class="jumbotron" style="background-color:#0F3558;">
        <h1 class="text-muted">Reportes</h1>
        <hr style="border:2px solid #BF942D">
        <h3 class="text-muted">¡Bienvenido a reportes {{Auth::user()->name}}!</h3>
        <p class="text-muted">Esta sección se genera los reportes para las sesiones, cabe resaltar que se debe
            introducir la fecha de <strong>SESIÓN</strong> para filtrar y recuperar toda la información correspondiente
            a la fecha asignada.</p>

        {{Form::open(['route'=>'Index','method'=>'GET','class'=>'form-inline'])}}
        @if(!Auth::guest() && (Auth::user()->hasRole('admin') ))
        <p class="text-item-center"><a href="{{route('FinalRegister.create')}}" class="btn boton"
                style="margin-right:5px">Nuevo</a>
            @endif
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample" style="margin-right:15px">
                Búsqueda
            </button>
        </p>
        <!------------------------------------- SEARCH FORM ---------------------------------------------------->
        <div class="collapse" id="collapseExample">
            <div class="card card-body" style="margin-bottom:5px; background-color:#BF942D;">
                <!-- inicio form busqueda-->
                <div class="form-row">
                    <div class="col-label-form" style="margin-right:5px">
                        <label for="name" class="col-form-label text-muted">Nombre</label>
                        {{Form::text('session',null,['class'=>'form-control','placeholder'=>'Fecha de sesión'])}}
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-search">Buscar</span>
                        </button></div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Documento</th>
                <th> Estatales</th>
                <th> Nacionales</th>
                <th> Internacionales</th>

            </tr>
        <tbody>
            <tr>
            <td>@foreach($docs as $doc)
            <td>{{$doc->scope}}</td>
            @endforeach
            </td>
                <td>Convenios</td>
                <td>{{$scopeE}}</td>
                <td>{{$scopeN}}</td>
                <td>{{$scopeI}}</td>
            </tr>
        </tbody>
        </thead>
    </table>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Convenios</th>
                <th>Generales</th>
                <th>Especificos</th>
            </tr>
        <tbody>
            <tr>
                <td>Convenios</td>
                <td>{{$IGeneral}}</td>
                <td>{{$ISpecific}}</td>
            </tr>
        </tbody>
        </thead>
    </table>
</div>
@else
@endif
@endsection