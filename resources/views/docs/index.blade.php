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
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

            <form action="{{route('StoreReports')}}" method="post">
                <input type="hidden" id="session" name="session" value="{{$session}}">
                <input type="hidden" id="start_signature" name="start_signature" value="{{$start_signature}}">
                <input type="hidden" id="end_signature" name="end_signature" value="{{$end_signature}}">
                {{csrf_field()}}
                <button type="submit" class="btn btn-secondary">Imprimir Conteo</button>
            </form>
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Documentos
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                    <form action="{{route('StoreReportsGeneral')}}" method="post">
                        <input type="hidden" id="session" name="session" value="{{$session}}">
                        <input type="hidden" id="start_signature" name="start_signature" value="{{$start_signature}}">
                        <input type="hidden" id="end_signature" name="end_signature" value="{{$end_signature}}">
                        {{csrf_field()}}
                        <button type="submit" class="dropdown-item">Documentos Generales</button>
                    </form>
                    <form action="{{route('StoreReportsSpecific')}}" method="post">
                        <input type="hidden" id="session" name="session" value="{{$session}}">
                        <input type="hidden" id="start_signature" name="start_signature" value="{{$start_signature}}">
                        <input type="hidden" id="end_signature" name="end_signature" value="{{$end_signature}}">
                        {{csrf_field()}}
                        <button type="submit" class="dropdown-item">Documentos Específicos</button>
                    </form>
                    <form action="{{route('StoreReportsOthers')}}" method="post">
                        <input type="hidden" id="session" name="session" value="{{$session}}">
                        <input type="hidden" id="start_signature" name="start_signature" value="{{$start_signature}}">
                        <input type="hidden" id="end_signature" name="end_signature" value="{{$end_signature}}">
                        {{csrf_field()}}
                        <button type="submit" class="dropdown-item">Otros Documentos</button>
                    </form>
                </div>
            </div>
        </div>
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
                <th>Generales</th>
                <th>Especificos</th>
                <th>Otros</th>
                <th>Total</th>


            </tr>
        <tbody>
            <tr>
                <td>{{$IGeneral}}</td>
                <td>{{$ISpecific}}</td>
                <td>{{$IOthers}}</td>
                <td>{{$ITotal}}</td>
            </tr>
        </tbody>
        </thead>
    </table>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Ámbito</th>
                <th scope="col">General</th>
                <th scope="col">Específico</th>
                <th scope="col">Otros</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Estatal</th>
                <td>{{$scopeE}}</td>
                <td>{{$scopeES}}</td>
                <td>{{$scopeEO}}</td>
            </tr>
            <tr>
                <th scope="row">Nacional</th>
                <td>{{$scopeN}}</td>
                <td>{{$scopeNS}}</td>
                <td>{{$scopeNO}}</td>
            </tr>
            <tr>
                <th scope="row">Internacional</th>
                <td>{{$scopeI}}</td>
                <td>{{$scopeIS}}</td>
                <td>{{$scopeIO}}</td>
            </tr>
            <tr>
                <th scope="row">Total:</th>
                <td>{{$scopeT}}</td>
                <td>{{$scopeTS}}</td>
                <td>{{$scopeTO}}</td>
            </tr>
        </tbody>
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
{!!$docs->appends(['start_signature'=>$start_signature,'end_signature'=>$end_signature,'signature' => $signature,'session'=>$session])->links()!!}
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