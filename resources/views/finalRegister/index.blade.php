@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css\proyect.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <title>Index</title>
</head>
@if(!Auth::guest() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('revisor')))
@include('auth.fragment.info')
@include('auth.fragment.error')
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
        @if(!Auth::guest() && (Auth::user()->hasRole('admin') ))
        <p>
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">

                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Documentos
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                        <form action="{{route('StoreAll')}}" method="post">
                            <input type="hidden" id="name" name="name" value="{{$name}}">
                            <input type="hidden" id="countries" name="countries" value="{{$countries}}">
                            <input type="hidden" id="scope" name="scope" value="{{$scope}}">
                            <input type="hidden" id="legalInstrument" name="legalInstrument"
                                value="{{$legalInstrument}}">
                            <input type="hidden" id="instrumentType" name="instrumentType" value="{{$instrumentType}}">
                            <input type="hidden" id="objective" name="objective" value="{{$objective}}">
                            <input type="hidden" id="signature" name="signature" value="{{$signature}}">
                            <input type="hidden" id="end_date" name="end_date" value="{{$end_date}}">
                            <input type="hidden" id="session" name="session" value="{{$session}}">
                            <input type="hidden" id="people" name="people" value="{{$people}}">

                            {{csrf_field()}}
                            <button type="submit" class="dropdown-item">Todos</button>
                        </form>
                        <form action="{{route('StoreV')}}" method="post">
                            <input type="hidden" id="name" name="name" value="{{$name}}">
                            <input type="hidden" id="countries" name="countries" value="{{$countries}}">
                            <input type="hidden" id="scope" name="scope" value="{{$scope}}">
                            <input type="hidden" id="legalInstrument" name="legalInstrument"
                                value="{{$legalInstrument}}">
                            <input type="hidden" id="instrumentType" name="instrumentType" value="{{$instrumentType}}">
                            <input type="hidden" id="objective" name="objective" value="{{$objective}}">
                            <input type="hidden" id="signature" name="signature" value="{{$signature}}">
                            <input type="hidden" id="end_date" name="end_date" value="{{$end_date}}">
                            <input type="hidden" id="session" name="session" value="{{$session}}">
                            <input type="hidden" id="people" name="people" value="{{$people}}">
                            {{csrf_field()}}
                            <button type="submit" class="dropdown-item">Vigentes</button>
                        </form>
                        <form action="{{route('StoreNV')}}" method="post">
                            <input type="hidden" id="name" name="name" value="{{$name}}">
                            <input type="hidden" id="countries" name="countries" value="{{$countries}}">
                            <input type="hidden" id="scope" name="scope" value="{{$scope}}">
                            <input type="hidden" id="legalInstrument" name="legalInstrument"
                                value="{{$legalInstrument}}">
                            <input type="hidden" id="instrumentType" name="instrumentType" value="{{$instrumentType}}">
                            <input type="hidden" id="objective" name="objective" value="{{$objective}}">
                            <input type="hidden" id="signature" name="signature" value="{{$signature}}">
                            <input type="hidden" id="end_date" name="end_date" value="{{$end_date}}">
                            <input type="hidden" id="session" name="session" value="{{$session}}">
                            <input type="hidden" id="people" name="people" value="{{$people}}">
                            {{csrf_field()}}
                            <button type="submit" class="dropdown-item">No vigentes</button>
                        </form>
                        <form action="{{route('StoreOthers')}}" method="post">
                            <input type="hidden" id="name" name="name" value="{{$name}}">
                            <input type="hidden" id="countries" name="countries" value="{{$countries}}">
                            <input type="hidden" id="scope" name="scope" value="{{$scope}}">
                            <input type="hidden" id="legalInstrument" name="legalInstrument"
                                value="{{$legalInstrument}}">
                            <input type="hidden" id="instrumentType" name="instrumentType" value="{{$instrumentType}}">
                            <input type="hidden" id="objective" name="objective" value="{{$objective}}">
                            <input type="hidden" id="signature" name="signature" value="{{$signature}}">
                            <input type="hidden" id="end_date" name="end_date" value="{{$end_date}}">
                            <input type="hidden" id="session" name="session" value="{{$session}}">
                            <input type="hidden" id="people" name="people" value="{{$people}}">
                            {{csrf_field()}}
                            <button type="submit" class="dropdown-item">Otros</button>
                        </form>
                    </div>

                </div>

            </div>
        </p>
        @endif
        {{Form::open(['route'=>'FinalRegister.index','method'=>'GET','class'=>'form-inline'])}}
        @if(!Auth::guest() && (Auth::user()->hasRole('admin') ))
        <div class="btn-group" role="group">
            <p class="text-item-center"><a href="{{route('FinalRegister.create')}}" class="btn boton"
                    style="margin-right:5px">Nuevo</a>
                @endif
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                    aria-expanded="false" aria-controls="collapseExample" style="margin-right:15px">
                    Búsqueda
                </button>
            </p>
        </div>
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
                        <label for="countries" class="col-form-label text-muted">País</label>
                        {{Form::text('countries',null,['class'=>'form-control','placeholder'=>'Nombre  del país'])}}
                    </div>
                    <div class="col-label-form" style="margin-right:5px">
                        <label for="scope" class="col-form-label text-muted">Ámbito</label>
                        {{Form::text('scope',null,['class'=>'form-control','placeholder'=>'Ámbito'])}}
                    </div>
                    <div class="col-label-form" style="margin-right:5px">
                        <label for="name" class="col-form-label text-muted">Instrumento jurídico</label>
                        {{Form::text('legalInstrument',null,['class'=>'form-control','placeholder'=>'Instrumento jurídico'])}}
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
                        <label for="name" class="col-form-label text-muted">Objetivo</label>
                        {{Form::text('objective', null, ['class'=>'form-control', 'placeholder'=>'Objetivo'])}}
                    </div>
                    <div class="col-label-form" style="margin-right:5px;">
                        <label for="signature" class="col-form-label text-muted">Fecha Firma</label>
                        {{Form::text('signature',null,['class' => 'form-control', 'placeholder'=>'aaaa-mm-dd'])}}
                    </div>
                    <div class="col-label-form" style="margin-right:5px;">
                        <label for="end_date" class="col-form-label text-muted">Fecha Fin</label>
                        {{Form::text('end_date',null,['class' => 'form-control', 'placeholder'=>'aaaa-mm-dd'])}}
                    </div>
                    <div class="col-label-form" style="margin-right:5px;">
                        <label for="session" class="col-form-label text-muted">Fecha Sesión</label>
                        {{Form::text('session',null,['class' => 'form-control', 'placeholder'=>'aaaa-mm-dd'])}}
                    </div>
                    <div class="col-label-form" style="margin-right:5px;">
                        <label for="people_id" class=" col-form-label text-muted">Partes</label>
                        <input type="text" id="people_id" name="people_id" class="form-control"
                            placeholder="ingrese la parte" autocomplete="off">
                        <div id="peopleList">
                        </div>
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
<div class="container">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                aria-controls="nav-home" aria-selected="true">Todos</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                aria-controls="nav-profile" aria-selected="false">Vigentes</a>
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                aria-controls="nav-contact" aria-selected="false">No vigentes</a>
            <a class="nav-item nav-link" id="nav-others-tab" data-toggle="tab" href="#nav-others" role="tab"
                aria-controls="nav-others" aria-selected="false">Otros</a>
        </div>
    </nav>
    <div class="table responsive ">

        <!--TODOS---------------->
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Num. Registro</th>
                            <th scope="col">Nombre completo</th>
                            <th scope="col">Instrumento jurídico</th>
                            <th scope="col">Tipo de instrumento</th>
                            <th scope="col">Objetivo</th>
                            <th scope="col">Ámbito</th>
                            <th scope="col">Fecha de firma</th>
                            <th scope="col">Fecha de fin</th>
                            <th scope="col">Fecha de sesión</th>
                            <th scope="col">Partes</th>
                            <th colspan="3" scope="col">&nbsp; Opciones</th>
                        </tr>
                    <tbody>

                        <!-----------------------------FOREACH SEARCH ------------------------------->
                        @foreach($documents as $document)
                        <tr>
                            <td>{{$document->registerNumber}}</td>
                            <td>{{$document->name}}</td>
                            <td>{{$document->legalInstrument}}</td>
                            <td>{{$document->instrumentType}}</td>
                            <td>{{$document->objective}}</td>
                            <td>{{$document->scope}}</td>
                            <td>{{$document->signature}}</td>
                            <td>{{$document->end_date}}</td>
                            <td>{{$document->session}}</td>

                            <td>@foreach($document->getPeople as
                                $person){{$person->name.' - '.$person->country.'; '}}@endforeach</td>
                            <td><a href="{{route('FinalRegister.show', $document->id)}}" class="btn botonAzul">Ver</a>

                            </td>
                            <td> @if(!Auth::guest()&&(Auth::user()->hasRole('admin')))

                                <a href="{{route('FinalRegister.edit', $document->id)}}"
                                    class="btn botonAmarillo">Editar</a>

                            </td>

                            <td>
                                <form action="{{route('FinalRegister.destroy', $document->id)}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger"
                                        onClick="return confirm('¿Seguro que quiere eliminar este documento?');">X</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                    
                    </thead>
                    
                </table>
                {!!$documents->appends([
'name'=>$name,'countries'=>$countries,'scope'=>$scope,
'legalInstrument'=>$legalInstrument,'instrumentType'=>$instrumentType,
'objective'=>$objective,'end_date'=>$end_date,'people_id'=>$people,
'signature' => $signature,'session'=>$session])->links()!!}
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <!---------------VIGENTES------------------------>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Num. Registro</th>
                            <th>Nombre completo</th>
                            <th>Instrumento jurídico</th>
                            <th>Tipo de instrumento</th>
                            <th>Objetivo</th>
                            <th>Ámbito</th>
                            <th>Fecha de firma</th>
                            <th>Fecha de fin</th>
                            <th>Fecha de sesión</th>
                            <th>Partes</th>
                            <th colspan="3">&nbsp; Opciones</th>
                        </tr>
                    <tbody>

                        <!-----------------------------FOREACH SEARCH ------------------------------->
                        @foreach($documents2 as $document)
                        @if($document->observation=='') <tr>
                            <td>{{$document->registerNumber}}</td>
                            <td>{{$document->name}}</td>
                            <td>{{$document->legalInstrument}}</td>
                            <td>{{$document->instrumentType}}</td>
                            <td>{{$document->objective}}</td>
                            <td>{{$document->scope}}</td>
                            <td>{{$document->signature}}</td>
                            <td>{{$document->end_date}}</td>
                            <td>{{$document->session}}</td>

                            <td>@foreach($document->getPeople as
                                $person){{$person->name.' - '.$person->country.'; '}}@endforeach</td>
                            <td><a href="{{route('FinalRegister.show', $document->id)}}" class="btn botonAzul">Ver</a>
                            </td>
                            </td>
                            @if(!Auth::guest()&&(Auth::user()->hasRole('admin')))
                            <td><a href="{{route('FinalRegister.edit', $document->id)}}"
                                    class="btn botonAmarillo">Editar</a>
                            </td>
                            <td>
                                <form action="{{route('FinalRegister.destroy', $document->id)}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger"
                                        onClick="return confirm('¿Seguro que quiere eliminar este documento?');">x</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    </thead>
                </table>
                {!!$documents2->appends([
'name'=>$name,'countries'=>$countries,'scope'=>$scope,
'legalInstrument'=>$legalInstrument,'instrumentType'=>$instrumentType,
'objective'=>$objective,'end_date'=>$end_date,'people_id'=>$people,
'signature' => $signature,'session'=>$session])->links()!!}
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <!------------------ NO VIGENTES --------------------->
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Num. Registro</th>
                            <th>Nombre completo</th>
                            <th>Instrumento jurídico</th>
                            <th>Tipo de instrumento</th>
                            <th>Objetivo</th>
                            <th>Ámbito</th>
                            <th>Fecha de firma</th>
                            <th>Fecha de fin</th>
                            <th>Fecha de sesión</th>
                            <th>Partes</th>
                            <th colspan="3">&nbsp; Opciones</th>
                        </tr>
                    <tbody>

                        <!-----------------------------FOREACH SEARCH ------------------------------->
                        @foreach($documents3 as $document)
                        @if($document->observation=='') <tr>
                            <td>{{$document->registerNumber}}</td>
                            <td>{{$document->name}}</td>
                            <td>{{$document->legalInstrument}}</td>
                            <td>{{$document->instrumentType}}</td>
                            <td>{{$document->objective}}</td>
                            <td>{{$document->scope}}</td>
                            <td>{{$document->signature}}</td>
                            <td>{{$document->end_date}}</td>
                            <td>{{$document->session}}</td>

                            <td>@foreach($document->getPeople as
                                $person){{$person->name.' - '.$person->country.'; '}}@endforeach</td>
                            <td><a href="{{route('FinalRegister.show', $document->id)}}" class="btn botonAzul">Ver</a>
                            </td>
                            </td>
                            @if(!Auth::guest()&&(Auth::user()->hasRole('admin')))
                            <td><a href="{{route('FinalRegister.edit', $document->id)}}"
                                    class="btn botonAmarillo">Editar</a>
                            </td>
                            <td>
                                <form action="{{route('FinalRegister.destroy', $document->id)}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger"
                                        onClick="return confirm('¿Seguro que quiere eliminar este documento?');">X</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    </thead>
                </table>
                {!!$documents3->appends([
'name'=>$name,'countries'=>$countries,'scope'=>$scope,
'legalInstrument'=>$legalInstrument,'instrumentType'=>$instrumentType,
'objective'=>$objective,'end_date'=>$end_date,'people_id'=>$people,
'signature' => $signature,'session'=>$session])->links()!!}
            </div>
            <div class="tab-pane fade" id="nav-others" role="tabpanel" aria-labelledby="nav-others-tab">
                <!------------------ NO VIGENTES --------------------->
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Num. Registro</th>
                            <th>Nombre completo</th>
                            <th>Instrumento jurídico</th>
                            <th>Tipo de instrumento</th>
                            <th>Objetivo</th>
                            <th>Ámbito</th>
                            <th>Fecha de firma</th>
                            <th>Fecha de fin</th>
                            <th>Fecha de sesión</th>
                            <th>Partes</th>
                            <th colspan="3">&nbsp; Opciones</th>
                        </tr>
                    <tbody>

                        <!-----------------------------FOREACH SEARCH ------------------------------->
                        @foreach($documents4 as $document)
                        @if(!empty($document->observation)) <tr>
                            <td>{{$document->registerNumber}}</td>
                            <td>{{$document->name}}</td>
                            <td>{{$document->legalInstrument}}</td>
                            <td>{{$document->instrumentType}}</td>
                            <td>{{$document->objective}}</td>
                            <td>{{$document->scope}}</td>
                            <td>{{$document->signature}}</td>
                            <td>{{$document->end_date}}</td>
                            <td>{{$document->session}}</td>

                            <td>@foreach($document->getPeople as
                                $person){{$person->name.' - '.$person->country.'; '}}@endforeach</td>
                            <td><a href="{{route('FinalRegister.show', $document->id)}}" class="btn botonAzul">Ver</a>
                            </td>
                            </td>
                            @if(!Auth::guest()&&(Auth::user()->hasRole('admin')))
                            <td><a href="{{route('FinalRegister.edit', $document->id)}}"
                                    class="btn botonAmarillo">Editar</a>
                            </td>
                            <td>
                                <form action="{{route('FinalRegister.destroy', $document->id)}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger"
                                        onClick="return confirm('¿Seguro que quiere eliminar este documento?');">X</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    </thead>
                </table>
                {!!$documents4->appends([
'name'=>$name,'countries'=>$countries,'scope'=>$scope,
'legalInstrument'=>$legalInstrument,'instrumentType'=>$instrumentType,
'objective'=>$objective,'end_date'=>$end_date,'people_id'=>$people,
'signature' => $signature,'session'=>$session])->links()!!}
            </div>
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
<script>
$.noConflict();
jQuery(document).ready(function() {

    $('#people_id').keyup(function() {
        var query = $(this).val();
        if (query != '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('autocomplete.fetch') }}",
                method: "POST",
                data: {
                    query: query,
                    _token: _token
                },
                success: function(data) {
                    $('#peopleList').fadeIn();
                    $('#peopleList').html(data);
                }
            });
        }
    });
    jQuery('#peopleList').on('click', 'li', function() {
        $('#people_id').val($(this).text());
        $('#peopleList').fadeOut();
    });
});
</script>

</html>

@endsection