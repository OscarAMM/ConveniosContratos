@extends('layouts.public')
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

        {{Form::open(['route'=>'public','method'=>'GET','class'=>'form-inline'])}}

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




                    <div class="col-label-form" style="margin-right:5px;">

                    </div>
                    <div class="col-label-form" style="margin-right:5px">
                        <label for="countries" class="col-form-label text-muted">Nombre</label>
                        {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre'])}}
                    </div>
                    <div class="col-label-form" style="margin-right:5px;">
                        <label for="people_id" class=" col-form-label text-muted">Partes</label>
                        <input type="text" id="people_id" name="people_id" class="form-control"
                            placeholder="ingrese la parte" autocomplete="off">
                        <div id="peopleList">
                        </div>
                    </div>
                    <div class="col-label-form" style="margin-right:5px">
                        <label for="countries" class="col-form-label text-muted">País</label>
                        {{Form::text('countries',null,['class'=>'form-control','placeholder'=>'Nombre  del país'])}}
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
                            <th>Objetivo</th>
                            <th>Fecha de firma</th>
                            <th>Fecha de fin</th>
                            <th>Partes</th>
                            <th colspan="3">&nbsp; Opciones</th>
                        </tr>
                    <tbody>

                        <!-----------------------------FOREACH SEARCH ------------------------------->

                        @foreach($documents as $document)
                        @if($document->hide)
                        <tr>
                            <td>{{$document->registerNumber}}</td>
                            <td>{{$document->name}}</td>
                            <td>{{$document->objective}}</td>
                            <td>{{$document->signature}}</td>
                            <td>{{$document->end_date}}</td>
                            <td>@foreach($document->getPeople as $person){{$person->name.'; '}}@endforeach</td>
                            <td><a href="{{route('publicShow', $document->id)}}" class="btn botonAzul">Ver</a>
                            </td>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    </thead>
                </table>
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