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

<body data-gr-c-s-loaded="true">
    @if(!Auth::guest()&&(Auth::user()->hasRole('admin')||Auth::user()->hasRole('revisor')))
    @include('auth.fragment.info')
    @include('auth.fragment.error')
    <div class="container">
        <div class="jumbotron" style="background-color:#0F3558;">
            <h1 class="text-muted">Documento</h1>
            <hr style="border:2px solid #BF942D">
            <p class="text-muted">Se desplegará una lista con todos los documentos registrados hasta el momento en el
                sistema.
            </p>
            <p class="text-muted"><i>Nota: Los archivos registrados en esta sección son ÚNICAMENTE para trabajar de
                    manera interna. No se desplegará ninguna información en vistas públicas o al usuario final.</i></p>
            {{Form::open(['route'=>'Agreement.index','method'=>'GET','class'=>'form-inline'])}}
            @if(!Auth::guest()&&(Auth::user()->hasRole('admin')))
            <p class="text-item-center"><a href="{{route('Agreement.create')}}" class="btn boton"
                    style="margin-right:5px">Nuevo</a>
                @endif
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                    aria-expanded="false" aria-controls="collapseExample" style="margin-right:15px">
                    Búsqueda
                </button>
            </p>
            <div class="collapse" id="collapseExample">
                <div class="card card-body" style="margin-bottom:5px; background-color:#BF942D;">
                    <!-- inicio form busqueda-->
                    <div class="form-row">
                        <div class="col" style="margin-right:5px">
                            <label for="name" class="col-form-label text-muted">Nombre</label>
                            {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre  del documento'])}}
                        </div>
                        <div class="col" style="margin-right:5px">
                            <label for="name" class="col-form-label text-muted">Instrumento jurídico</label>
                            {{Form::text('legalInstrument',null,['class'=>'form-control','placeholder'=>'Instrumento jurídico'])}}
                        </div>
                        <div class="col" style="margin-right:5px;">
                            <label for="name" class="col-form-label text-muted">Objetivo</label>
                            {{Form::text('objective', null, ['class'=>'form-control', 'placeholder'=>'Objetivo'])}}
                        </div>
                        <div class="col" style="margin-right:5px">
                            <label for="name" class="col-form-label text-muted">Tipo de instrumento</label>
                            <select name="instrumentType" id="instrumentType" class="form-control">
                                <option></option>
                                <option>General</option>
                                <option>Especifico</option>
                                <option>Otros</option>
                            </select>
                        </div>
                        <div class="col" style="margin-right:5px;">
                            <label for="name" class="col-form-label text-muted">Suscrito</label>
                            <input type="text" id="people_id" name="people_id" class="form-control "
                                placeholder="ingrese suscrito">
                            <div id="peopleList">
                            </div>
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


    <div class="row d-flex justify-content-center">
        <div class="col-md-10 ">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nombre completo</th>
                        <th>Instrumento jurídico</th>
                        <th>Tipo de instrumento</th>
                        <th>Recepción</th>
                        <th>Objetivo</th>
                        <th>Suscrito</th>
                        <th colspan="6">&nbsp;Opciones</th>
                    </tr>
                <tbody>
                    @foreach($agreements as $agreement)
                    <tr>
                        <td>{{$agreement->id}}</td>
                        <td>{{$agreement->name}}</td>
                        <td>{{$agreement->legalInstrument}}</td>
                        <td>{{$agreement->instrumentType}}</td>
                        <td>{{$agreement->reception}}</td>
                        <td>{{$agreement->objective}}</td>
                        <td>{{App\Person::find($agreement->people_id)->name}}</td>
                        <td>
                        <td><a href="{{route('Agreement.show', $agreement ->id)}}" class="btn botonAzul">Ver</a></td>
                        <td><a href="{{route('Forum.Agreement', $agreement->id)}}" class="btn boton ">Revisión</a></td>
                        </td>
                        @if(!Auth::guest()&&(Auth::user()->hasRole('admin')))
                        <td><a href="{{route('Agreement.edit', $agreement ->id)}}" class="btn botonAmarillo">Editar</a>
                        </td>
                        <td><a href="{{route('Register',$agreement->id)}}" class="btn btn-success">Registrar</a></td>
                        <td>
                            <form action="{{route('Agreement.destroy', $agreement->id)}}" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
                </thead>
            </table>
        </div>
        @else
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-muted">Acceso restringido</h2>
                </div>
                <div class="card-body">
                    <h4>EL Usuario no tiene acceso a esta área, comuníquese con su administrador si desea realizar algún
                        cambio.
                    </h4>
                </div>

            </div>
        </div>
        @endif
    </div>
</body>
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
{!!$agreements->render()!!}
@endsection