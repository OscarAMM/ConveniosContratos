@extends('layouts.app')

@section('content')
@if(!Auth::guest()&&Auth::user()->hasRole('admin'))

@include('auth.fragment.info')
@include('auth.fragment.error')

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<div class="container">
    <div class="column-sm-8">
        <div class="card">
            <div class="card-body">

                @include('agreements.fragment.error')
                {!!Form::model($agreements, ['route' =>['Agreement.update', $agreements->id],'method' =>'PUT']) !!}
                <div class="form-group ">
                    <label for="name" class="col-md-4 col-form-label ">Nombre de documento</label>
                    <input type="text" id="name" name="name" class="form-control " placeholder="Nombre"
                        value="{{$agreements->name}}">
                </div>
                <div class="form-group">
                    <label for="legalInstrument" class="col-auto col-form-label ">Instrumento jurídico</label>

                    <button type="button" class="btn btn-secondary col-auto" data-toggle="modal"
                        data-target="#exampleModal" data-whatever="@fat">...</button>
                    <input type="text" id="legalInstrument" name="legalInstrument" class="form-control "
                        placeholder="Ingrese instrumento" value="{{$agreements->legalInstrument}}">
                    <div id="instrumentList">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="reception" class="col-md-4 col-form-label">Recepción</label>
                    <input type="date" id="reception" name="reception" class="form-control"
                        value="{{$agreements->reception}}">
                </div>
                <div class="form-group ">
                    <label for="end_date" class="col-md-4 col-form-label">Fecha final de revisión</label>
                    <input type="date" id="end_date" name="end_date" class="form-control"
                        value="{{$agreements->end_date}}">
                </div>
                <div class="form-group">
                    <label for="objective" class="col-md-4 col-form-label">Objetivo</label>
                    <textarea name="objective" id="objective" cols="30" rows="5" class="form-control"
                        value="{{$agreements->objective}}">{{$agreements->objective}}</textarea>
                </div>
                <div class="form-group">
                    <label for="instrumentType" class="col-md-4 col-form-label">Tipo de documento</label>
                    <select name="instrumentType" id="instrumentType" class="form-control">
                    @if($agreements->instrumentType === "General")
                        <option>General</option>
                        <option>Específico</option>
                        <option>Otros</option>
                    @elseif($agreements->instrumentType === "Específico")
                    <option>Específico</option>
                    <option>General</option>
                    <option>Otros</option>
                    @elseif($agreements->instrumentType === "Otros")
                    <option>Otros</option>
                    <option>Específico</option>
                    <option>General</option>
                    
                    @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="scope" class="col-md-4 col-form-label">Ámbito</label>
                    <select name="scope" id="scope" class="form-control" value="{{$agreements->scope}}">
                        <option>Estatal</option>
                        <option>Nacional</option>
                        <option>Internacional</option>
                    </select>
                </div>
                
                    <div class="col-md-4">
                        <label for="user_id" class=" col-form-label">Asigne usuarios</label>
                        @foreach($users as $user)
                        @if($user->hasRole('admin')||$user->hasRole('revisor'))
                        <br>
                        <input type="checkbox" name="users[]" value="{{$user->id}}"
                            {{ $user ->hasAgreement($agreements->name)?'checked':'' }}> <label>{{$user->name}}</label>

                        @endif
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="people_id" class="col-md-8 col-form-label">Asigne suscrito</label>
                        <input type="text" id="people_id" name="people_id" class="form-control "
                            placeholder="ingrese suscrito" value="{{$people->id.' - '.$people->name}}">

                        <div id="peopleList">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="liable_user" class="col-md-8 col-form-label">Asigne responsable</label>
                        <input type="text" id="liable_user" name="liable_user" class="form-control "
                            placeholder="ingrese responsable"
                            value="{{$liableUser->id.' - '.$liableUser->name.' - '.$liableUser->email}}">
                        <div id="userList">
                        </div>
                    </div>
                
                <div class="form-group text-center" style="margin-top:5px">
                    <a href="{{route ('Agreement.index')}}" class="btn btn-secondary">Regresar</a>
                    <input type="submit" value="Guardar" class="btn btn-primary">
                </div>
                {{csrf_field()}}
                {!!Form::close()!!}
            </div>
        </div>

    </div>

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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
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


    $('#liable_user').keyup(function() {
        var query2 = $(this).val();
        if (query2 != '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('autocomplete.fetchUsers') }}",
                method: "POST",
                data: {
                    query: query2,
                    _token: _token
                },
                success: function(data2) {
                    $('#userList').fadeIn();
                    $('#userList').html(data2);
                }
            });
        }
    });

    jQuery('#userList').on('click', 'li', function() {
        $('#liable_user').val($(this).text());
        $('#userList').fadeOut();
    });

    $('#legalInstrument').keyup(function() {
        var query = $(this).val();
        if (query != '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('autocomplete.fetchInstruments') }}",
                method: "POST",
                data: {
                    query: query,
                    _token: _token
                },
                success: function(data) {
                    $('#instrumentList').fadeIn();
                    $('#instrumentList').html(data);
                }
            });
        }
    });

    jQuery('#instrumentList').on('click', 'li', function() {
        $('#legalInstrument').val($(this).text());
        $('#instrumentList').fadeOut();
    });


});
</script>