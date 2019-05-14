
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
                        <label for="name" class="col-md-4 col-form-label ">Nombre de contrato</label>
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
                        <label for="contractValidity" class="col-md-4 col-form-label">Fecha de fin</label>
                        <input type="date" id="contractValidity" name="contractValidity" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="scope" class="col-md-4 col-form-label">Ámbito</label>
                        <select name="scope" id="scope" class="form-control">
                            <option>Estatal</option>
                            <option>Nacional</option>
                            <option>Internacional</option>
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
                            <label for="institute_id" class=" col-form-label">Asigne Institucion</label>
                            <select name="institute_id" id="institute_id"
                                placeholder="Selecciona la institucion asignado" class="form-control"
                                required="required">
                                <!--Integrar for each -->
                                
                            </select>
                            <input type="text" name="institute_name" id="institute_name" class="form-control input-lg" placeholder="Ingrese nombre de la institución" />
                        </div>
                        <div class="col-md-4">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <label for="file" class="col-md-8 col-form-label">Seleccione el archivo</label>
                            <input type="file" class="form-control-file" name="file" id="file">
                        </div>

                        <div class="form-group">
                            <label for="liable" class=" col-form-label">Asigne responsable</label>
                            <select name="liable" id="liable" placeholder="Selecciona el responsable asignado"
                                class="form-control" required="required">  
                            </select>
                            <input type="text" name="user_name" id="user_name" class="form-control input-lg" placeholder="Ingrese nombre" />

                        </div>
                        <div class="form-group">
                        </div>

                        

                    </div>
                    {{csrf_field()}}

                </form>
                <div class="form-group text-center" style="margin-top:5px">
                    <a href="{{route ('Contract.index')}}" class="btn btn-secondary">Regresar</a>
                    {!!Form::submit('Guardar',['class' => 'btn btn-primary'])!!}

                </div>
            </div>
        </div>

    </div>

</div>
<script>
$(document).ready(function(){

 $('#user_name').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocomplete.fetch') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
           $('#liable').fadeIn();  
                    $('#liable').html(data);
          }
         });
        }
    });

    $(document).on('click', 'option', function(){  
        $('#user_name').val($(this).text());  
        $('#liable').fadeOut();  
    });  

});
</script>
<script>
$(document).ready(function(){

 $('#institute_name').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocomplete.fetchInstitute') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
           $('#institute_id').fadeIn();  
                    $('#institute_id').html(data);
          }
         });
        }
    });

    $(document).on('click', 'option', function(){  
        $('#institute_name').val($(this).text());  
        $('#institute_id').fadeOut();  
    });  

});
</script>