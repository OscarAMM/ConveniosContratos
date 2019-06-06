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
<!-----------------------------------------WELCOME MESSAGE WITH FUNCTIONS----------------------------------------->
<div class="container">
    <div class="jumbotron" style="background-color:#0F3558;">
        <h1 class="text-muted">Convenios</h1>
        <hr style="border:2px solid #BF942D">
        <h3 class="text-muted">Bievenido a la búsqueda de convenios.</h3>
        <p class="text-muted">Realiza búsqueda del convenio utilizando los criterios de búsqueda.
        <i>Nota:Podrás realizar una búsqueda más precisa si se llenan todos los campos. </i></p>
        {{Form::open(['route'=>'FinalRegister.index','method'=>'GET','class'=>'form-inline'])}}
        
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
                        {{Form::text('signature',null,['class' => 'form-control', 'placeholder'=>'Fecha firma'])}}
                    </div>
                    <div class="col-label-form" style="margin-right:5px;">
                        <label for="end_date" class="col-form-label text-muted">Fecha Fin</label>
                        {{Form::text('end_date',null,['class' => 'form-control', 'placeholder'=>'Fecha fin'])}}
                    </div>
                    <div class="col-label-form" style="margin-right:5px;">
                        <label for="session" class="col-form-label text-muted">Fecha Sesión</label>
                        {{Form::text('session',null,['class' => 'form-control', 'placeholder'=>'Fecha sesión'])}}
                    </div>
                    <div class="col-label-form" style="margin-right:5px;">
                        <label for="people_id" class=" col-form-label text-muted">Partes</label>
                        <input type="text" id="people_id" name="people_id" class="form-control"
                            placeholder="ingrese las partes">
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
<div class="row d-flex justify-content-center">
    <div class="col-md-10">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                    aria-controls="nav-home" aria-selected="true">Todos</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                    aria-controls="nav-profile" aria-selected="false">Vigentes</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                    aria-controls="nav-contact" aria-selected="false">No vigentes</a>
            </div>
        </nav>

        <!--TODOS---------------->
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Num. Registro</th>
                            <th>Nombre completo</th>
                            <th>Instrumento jurídico</th>
                            <th>Tipo de instrumento</th>
                            <th>Objetivo</th>
                            <th>Fecha de firma</th>
                            <th>Fecha de fin</th>
                            <th>Fecha de sesión</th>
                            <th>Partes</th>
                            <th colspan="3">&nbsp; Opciones</th>
                        </tr>
                    <tbody>

                        <!-----------------------------FOREACH SEARCH ------------------------------->
                        @foreach($documents as $document)
                        @if($document->hide&&$document->status=='Finalizado')
                         <tr>
                            <td>{{$document->registerNumber}}</td>
                            <td>{{$document->name}}</td>
                            <td>{{$document->legalInstrument}}</td>
                            <td>{{$document->instrumentType}}</td>
                            <td>{{$document->objective}}</td>
                            <td>{{$document->signature}}</td>
                            <td>{{$document->end_date}}</td>
                            <td>{{$document->session}}</td>

                            <td>@foreach($document->getPeople as $person){{$person->name.'; '}}@endforeach</td>
                            <td><a href="{{route('finalpublic.show', $document->id)}}" class="btn botonAzul">Ver</a>
                            </td>
                            </td>
                            @endif
                            </tr>
                            @endif
                            @endforeach
                    </tbody>
                    </thead>
                </table>
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
                            <th>Fecha de firma</th>
                            <th>Fecha de fin</th>
                            <th>Fecha de sesión</th>
                            <th>Partes</th>
                            <th colspan="3">&nbsp; Opciones</th>
                        </tr>
                    <tbody>

                        <!-----------------------------FOREACH SEARCH ------------------------------->
                        @foreach($documents as $document)
                        @if($document->hide&&$document->status=='Finalizado')
                        @if($document->end_date<=Carbon\Carbon::now()) <tr>
                            <td>{{$document->registerNumber}}</td>
                            <td>{{$document->name}}</td>
                            <td>{{$document->legalInstrument}}</td>
                            <td>{{$document->instrumentType}}</td>
                            <td>{{$document->objective}}</td>
                            <td>{{$document->signature}}</td>
                            <td>{{$document->end_date}}</td>
                            <td>{{$document->session}}</td>

                            <td>@foreach($document->getPeople as $person){{$person->name.'; '}}@endforeach</td>
                            <td><a href="{{route('finalpublic.show', $document->id)}}" class="btn botonAzul">Ver</a>
                            </td>
                            </td>
                            </tr>
                            @endif
                            @endif
                            @endforeach
                    </tbody>
                    </thead>
                </table>

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
                    <th>Fecha de firma</th>
                    <th>Fecha de fin</th>
                    <th>Fecha de sesión</th>
                    <th>Partes</th>
                    <th colspan="3">&nbsp; Opciones</th>
                </tr>
            <tbody>

                <!-----------------------------FOREACH SEARCH ------------------------------->
                @foreach($documents as $document)
                @if($document->hide&&$document->status=='Finalizado')
                @if($document->end_date>=Carbon\Carbon::now()) <tr>
                    <td>{{$document->registerNumber}}</td>
                    <td>{{$document->name}}</td>
                    <td>{{$document->legalInstrument}}</td>
                    <td>{{$document->instrumentType}}</td>
                    <td>{{$document->objective}}</td>
                    <td>{{$document->signature}}</td>
                    <td>{{$document->end_date}}</td>
                    <td>{{$document->session}}</td>

                    <td>@foreach($document->getPeople as $person){{$person->name.'; '}}@endforeach</td>
                    <td><a href="{{route('FinalRegister.show', $document->id)}}" class="btn botonAzul">Ver</a></td>
                    </td>
                   
                    </tr>
                    @endif
                    @endif
                    @endforeach
            </tbody>
            </thead>
        </table>
            </div>
        </div>

    </div>
</div>
</div>
<!--------------------------------SCRIPTS FOR THE SEARCH --------------------------->
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
{!!$documents->render()!!}
@endsection