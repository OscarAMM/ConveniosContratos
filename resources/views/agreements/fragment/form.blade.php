<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<div class="container">
    <div class="column-sm-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="#">
                    <div class="form-group">
                        <label for="name" class="col-md-4 col-form-label">Nombre completo del documento </label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Nombre del documento">
                    </div>

                    <div class="form-group">
                        <label for="legalInstrument" class="col-auto col-form-label ">Instrumento jurídico</label>

                        <button type="button" class="btn btn-secondary col-auto" data-toggle="modal"
                            data-target="#exampleModal" data-whatever="@fat">...</button>
                        <input type="text" id="legalInstrument" name="legalInstrument" class="form-control "
                            placeholder="Ingrese instrumento">
                        <div id="instrumentList">
                        </div>
                    </div>


                    <div class="form-group ">
                        <label for="reception" class="col-md-4 col-form-label">Recepción</label>
                        <input type="date" id="reception" name="reception" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="objective" class="col-md-4 col-form-label">Objetivo</label>
                        <textarea name="objective" id="objective" cols="30" rows="5" class="form-control"
                            placeholder="Describe el objetivo"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="instrumentType" class="col-md-4 col-form-label">Tipo de documento</label>
                        <select name="instrumentType" id="instrumentType" class="form-control">
                            <option>Específico</option>
                            <option>General</option>
                            <option>Otros</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="scope" class="col-md-4 col-form-label">Ámbito</label>
                        <select name="scope" id="scope" class="form-control">
                            <option>Estatal</option>
                            <option>Nacional</option>
                            <option>Internacional</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="people_id" class="col-auto col-form-label">Asigne suscrito</label>
                        <button type="button" class="btn btn-secondary col-auto" data-toggle="modal"
                            data-target="#suscrito" data-whatever="@fat">...</button>
                        <input type="text" id="people_id" name="people_id" class="form-control "
                            placeholder="ingrese suscrito">
                        <!--<select name="people_id" id="people_id"
                                placeholder="Selecciona la institucion asignado" class="form-control"
                                required="required">
                                @foreach($people as $person)
                                <option value="{{$person->id}}">{{$person->name}}</option>
                                @endforeach
                            </select>-->
                        <div id="peopleList">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="liable_user" class="col-md-8 col-form-label">Asigne responsable</label>
                        <input type="text" id="liable_user" name="liable_user" class="form-control "
                            placeholder="ingrese responsable">
                        <div id="userList">
                        </div>
                    </div>
                    <div class="form-check">
                        <label for="user_id" class="form-check-label">Asigne usuarios</label>
                        @foreach($users as $user)
                        @if($user->hasRole('admin')||$user->hasRole('revisor'))
                        <br>
                        <input type="checkbox" name="users[]" value="{{$user->id}}" class="form-check-input">
                        <label class="form-check-label">{{$user->name}}</label>
                        @endif
                        @endforeach
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <label for="file" class="col-md-8 col-form-label">Seleccione el archivo</label>
                        <input type="file" class="form-control-file" name="file" id="file">
                    </div>


                    {{csrf_field()}}
                </form>
            </div>
        </div>
        <div class="form-group text-center" style="margin-top:5px">
            <a href="{{route ('Agreement.index')}}" class="btn btn-secondary">Regresar</a>
            {!!Form::submit('Guardar',['class' => 'btn btn-primary'])!!}

        </div>

    </div>
</div>
</div>
<!--MODAL FOR THE LEGAL INSTRUMENT -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Instrumento jurídico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('newInstrument')}}">
                    <div class="form-group mb-2">
                        <label for="legalInstrument">Instrumento jurídico</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Instrumento jurídico">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL FOR ASIGNED USERS -->
<div class="modal fade" id="suscrito" tabindex="-1" role="dialog" aria-labelledby="suscrito" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="suscrito">Suscrito</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('PersonModal')}}">
                    <div class="form-group mb-2">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del suscrito">
                    </div>
                    <div class="form-group mb-2">
                        <label for="personType">Tipo</label>
                        <select name="personType" id="personType" class="form-control">
                            <option>Persona física</option>
                            <option>Persona moral</option>
                            <option>Institución</option>
                            <option>Dependencia</option>
                            <option>Otros</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="country">País</label>
                        <input type="text" class="form-control" id="country" name="country" placeholder="País">
                    </div>
                    <div class="form-group mb-2">
                        <label for="acronym">Siglas</label>
                        <input type="text" class="form-control" id="acronym" name="acronym" placeholder="Siglas">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">correo</label>
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="email del suscrito">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- SCRIPTS -->
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