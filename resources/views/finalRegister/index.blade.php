@extends('layouts.app')
@section('content')
@if(!Auth::guest() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('revisor')))
<!-----------------------------------------WELCOME MESSAGE WITH FUNCTIONS----------------------------------------->
<div class="container">
    <div class="jumbotron" style="background-color:#0F3558;">
        <h1 class="text-muted">Registro final</h1>
        <hr style="border:2px solid #BF942D">
        <h3 class="text-muted">¡Bienvenido al registro final {{Auth::user()->name}}!</h3>
        <p class="text-muted">Esta sección es para cargar todos los documentos que han sido <strong>APROBADOS</strong> y
            <strong>FIRMADOS</strong>.</p>
        <p class="text-muted"> <i> <strong>NOTA:</strong> Esta sección tendrá relación con el apartado de vistas
                públicas, por lo que se pide que verifiquen el
                documento que será visible para el público general. </i></p>
        {{Form::open(['route'=>'FinalRegister.index','method'=>'GET','class'=>'form-inline'])}}
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
                        {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre  del documento'])}}
                    </div>
                    <div class="col-label-form" style="margin-right:5px">
                        <label for="name" class="col-form-label text-muted">Instrumento jurídico</label>
                        {{Form::text('legalInstrument',null,['class'=>'form-control','placeholder'=>'Instrumento jurídico'])}}
                    </div>
                    <div class="col-label-form" style="margin-right:5px;">
                        <label for="name" class="col-form-label text-muted">Objetivo</label>
                        {{Form::text('legalInstrument', null, ['class'=>'form-control', 'placeholder'=>'legalInstrument'])}}
                    </div>
                    <div class="col-label-form" style="margin-right:5px">
                        <label for="name" class="col-form-label text-muted">Tipo de instrumento</label>
                        <select name="instrumentType" id="instrumentType" class="form-control">
                            <option></option>
                            <option>General</option>
                            <option>Especifico</option>
                            <option>Otros</option>
                        </select>
                    </div>
                    <div class="col-label-form" style="margin-right:5px;">
                        <label for="name" class="col-form-label text-muted">Fecha Recepción</label>
                        {{Form::text('signature',null,['class' => 'form-control', 'placeholder'=>'Fecha firma'])}}
                    </div>
                    <div class="col-label-form" style="margin-right:5px;">
                        <label for="name" class="col-form-label text-muted">Fecha Recepción</label>
                        {{Form::text('end_date',null,['class' => 'form-control', 'placeholder'=>'Fecha fin'])}}
                    </div>
                    <div class="col-label-form" style="margin-right:5px;">
                        <label for="name" class="col-form-label text-muted">Fecha Recepción</label>
                        {{Form::text('people_id',null,['class' => 'form-control', 'placeholder'=>'Partes'])}}
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
</div>
<!-------------------------------------------- DOCUMENTS TABLE --------------------------------------------->
<div class="row d-flex justify-content-center">
    <div class="col-md-10">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>id</th>
                    <th>Nombre completo</th>
                    <th>Instrumento jurídico</th>
                    <th>Tipo de instrumento</th>
                    <th>Fecha de firma</th>
                    <th>Fecha de fin</th>
                    <th>Partes</th>
                    <th colspan="3">&nbsp; Opciones</th>
                </tr>
            <tbody>
                <tr>
                    <!-----------------------------FOREACH SEARCH ------------------------------->
                    @foreach($documents as $document)
                    <td>{{$document->id}}</td>
                    <td>{{$document->name}}</td>
                    <td>{{$document->legalInstrument}}</td>
                    <td>{{$document->instrumentType}}</td>
                    <td>{{$document->signature}}</td>
                    <td>{{$document->end_date}}</td>
                    <td>@foreach($document->getPeople as $person){{$person->name.'; '}}@endforeach</td>
                    <td><a href="{{route('FinalRegister.show', $document->id)}}" class="btn botonAzul">Ver</a></td>
                        </td>
                        @if(!Auth::guest()&&(Auth::user()->hasRole('admin')))
                        <td><a href="{{route('FinalRegister.edit', $document->id)}}" class="btn botonAmarillo">Editar</a>
                        </td>
                        <td>
                            <form action="{{route('FinalRegister.destroy', $document->id)}}" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                        @endif
                    @endforeach
                </tr>
            </tbody>
            </thead>
        </table>
    </div>
</div>

</div>
@else
<!------------SECOND PAGE - DENIED PAGE ---------------------------------------->
<div class="container">
    <div class="jumbotron" style="background-color:#0F3558;">
        <h1 class="text-muted"><strong>¡ACCESO RESTRINGIDO!</strong> </h1>
        <hr style="border:2px solid #BF942D">
        <h4 class="text-muted">¡El usuario {{Auth::user()->name}} NO tiene permiso! Si desea realizar algo,
            contacte a
            su administrador.</h4>
    </div>
</div>
@endif
@endsection