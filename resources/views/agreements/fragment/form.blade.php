<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    
</head>
<div class="container">
    <div class="column-sm-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="#" > 
                    <div class="form-group ">
                        <label for="name" class="col-md-4 col-form-label ">Nombre de convenio</label>
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
                        <label for="agreementValidity" class="col-md-4 col-form-label">Fecha de fin</label>
                        <input type="date" id="agreementValidity" name="agreementValidity" class="form-control">
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
                            <label for="dependence_id" class=" col-form-label">Asigne Dependencia</label>
                            <select name="dependence_id" id="dependence_id"
                                placeholder="Selecciona la institucion asignado" class="form-control"
                                required="required">
                                <!--Integrar for each -->
                                @foreach($dependences as $dependence)
                                <option value="{{$dependence->id}}">{{$dependence->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <label for="file" class="col-md-8 col-form-label">Seleccione el archivo</label>
                            <input type="file" class="form-control-file" name="file" id="file">
                        </div>
                        <div class="col-md-4">
                            <label for="response_id" class=" col-form-label">Asigne responsable</label>
                            <select name="response_id" id="response_id"
                                placeholder="Selecciona el responsable asignado" class="form-control"
                                required="required">
                                <!--Integrar for each -->
                                @foreach($users as $user)
                                @if($user->hasRole('user'))
                                <option value="{{$user->id}}">{{$user->email}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        
                            <script type="text/javascript">
                            
                                $("#response_id").select2({
                                        placeholder: "Select a Name",
                                        allowClear: true
                                    });
                                    $("#dependence_id").select2({
                                        placeholder: "Select a Name",
                                        allowClear: true
                                    });
                            </script>
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