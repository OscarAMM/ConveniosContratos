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
        @if(!Auth::guest() && (Auth::user()->hasRole('admin') ))
        <form action="{{route('StoreReports')}}" method="post">
        <input type="hidden" id="session" name="session" value="{{$session}}">
        <input type="hidden" id="start_signature" name="start_signature" value="{{$start_signature}}">
        <input type="hidden" id="end_signature" name="end_signature" value="{{$end_signature}}">

        <input type="hidden" id="scopeE" name="scopeE" value="{{$scopeE}}">
        <input type="hidden" id="scopeN" name="scopeN" value="{{$scopeN}}">
        <input type="hidden" id="scopeI" name="scopeI" value="{{$scopeI}}">
        <input type="hidden" id="IGeneral" name="IGeneral" value="{{$IGeneral}}">
        <input type="hidden" id="ISpecific" name="ISpecific" value="{{$ISpecific}}">
        <input type="hidden" id="IOthers" name="IOthers" value="{{$IOthers}}">

            {{csrf_field()}}
            <button type="submit" class="btn btn-success">Imprimir</button>
        </form>
        @endif
        <br>
        {{Form::open(['route'=>'Index','method'=>'GET','class'=>'form-inline'])}}
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
                        <label for="session" class="col-form-label text-muted">Sesión</label>
                        {{Form::text('session',null,['class'=>'form-control','placeholder'=>'Fecha de sesión'])}}
                    </div>
                    <div class="col-label-form" style="margin-right:5px">
                        <label for="start_signature" class="col-form-label text-muted">Desde</label>
                        {{Form::date('start_signature',null,['class'=>'form-control','placeholder'=>'Fecha de firma'])}}
                    </div>
                    <div class="col-label-form" style="margin-right:5px">
                        <label for="end_signature" class="col-form-label text-muted">Hasta</label>
                        {{Form::date('end_signature',null,['class'=>'form-control','placeholder'=>'Fecha de firma'])}}
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
                <th> Estatales</th>
                <th> Nacionales</th>
                <th> Internacionales</th>
            </tr>
        <tbody>
            <tr>
                <!--<td>@foreach($docs as $doc)
            <td>{{$doc->scope}}</td>
            @endforeach
            </td>-->
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
                <th>Generales</th>
                <th>Especificos</th>
                <th>Otros</th>

            </tr>
        <tbody>
            <tr>
                <td>{{$IGeneral}}</td>
                <td>{{$ISpecific}}</td>
                <td>{{$IOthers}}</td>

            </tr>
        </tbody>
        </thead>
    </table>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th> Número de registro</th>
                <th> Nombre</th>
                <th> Fecha Firma</th>
                <th> Fecha Sesión</th>
                <th> Ámbito</th>
                <th> Tipo de instrumento</th>

            </tr>
        <tbody>
            @foreach($docs as $doc)
            <tr>
                <td>{{$doc->registerNumber}}</td>
                <td>{{$doc->name}}</td>
                <td>{{$doc->signature}}</td>
                <td>{{$doc->session}}</td>
                <td>{{$doc->scope}}</td>
                <td>{{$doc->instrumentType}}</td>

            </tr>
            @endforeach
        </tbody>
        </thead>
    </table>
</div>
@else
@endif
@endsection