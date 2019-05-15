<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<div class="container">
    <div class="column-sm-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="#">
                    <div class="form-group ">
                        <label for="name" class="col-md-4 col-form-label ">Instrumento jurídico</label>
                        <input type="text" id="name" name="name" class="form-control " placeholder="Nombre">
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
                        <label for="legalInstrument" class="col-md-4 col-form-label">Tipo de instrumento</label>
                        <select name="legalInstrument" id="legalInstrument" class="form-control">
                            <option>Convenio</option>
                            <option>Contrato</option>
                            <option>Otros</option>
                        </select>
                    </div>
                    <div class="form-group ">
                        <label for="registerNumber" class="col-md-4 col-form-label ">Número de registro</label>
                        <input type="text" id="registerNumber" name="registerNumber" class="form-control " placeholder="ingrese número de registro">
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
                        <label for="hide" class="col-md-4 col-form-label">Estado</label>
                        <select name="hide" id="hide" class="form-control" required="required">
                            <option value="visible">Visible</option>
                            <option value="noVisible">No visible</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <label for="user_id" class=" col-form-label">Asigne usuarios</label>
                            @foreach($users as $user)
                            @if($user->hasRole('admin'))
                            <br>
                            <input type="checkbox" name="users[]" value="{{$user->id}}"> <label>{{$user->name}}</label>
                            @endif
                            @endforeach
                        </div>

                        <div class="col-md-4">
                            <label for="people_id" class="col-md-8 col-form-label">Asigne suscrito</label>
                            <input type="text" id="people_id" name="people_id" class="form-control " placeholder="ingrese suscrito">
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
                        <div class="col-md-4">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <label for="file" class="col-md-8 col-form-label">Seleccione el archivo</label>
                            <input type="file" class="form-control-file" name="file" id="file">
                        </div>
                        <div class="col-md-4">
                            <label for="liable_user" class="col-md-8 col-form-label">Asigne responsable</label>
                            <input type="text" id="liable_user" name="liable_user" class="form-control " placeholder="ingrese responsable">
                            <div id="userList">
                            </div>
                        </div>


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
<script>
$(document).ready(function(){

 $('#people_id').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocomplete.fetch') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
           $('#peopleList').fadeIn();  
                    $('#peopleList').html(data);
          }
         });
        }
    });

    $(document).on('click', 'li', function(){  
        $('#people_id').val($(this).text());  
        $('#peopleList').fadeOut();  
    });  

});
</script>
<script>
$(document).ready(function(){

 $('#liable_user').keyup(function(){ 
        var query2 = $(this).val();
        if(query2 != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocomplete.fetchUsers') }}",
          method:"POST",
          data:{query:query2, _token:_token},
          success:function(data2){
           $('#userList').fadeIn();  
                    $('#userList').html(data2);
          }
         });
        }
    });

    $(document).on('click', 'lo', function(){  
        $('#liable_user').val($(this).text());  
        $('#userList').fadeOut();  
    });  

});
</script>