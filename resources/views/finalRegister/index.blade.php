@extends('layouts.app')
@section('content')

<head>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
</head>
<div class="container">
    <div class="column-sm-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="#">
                    <div class="form-group ">
                        <label for="name" class="col-md-4 col-form-label ">Objeto jurídico</label>
                        <input type="text" id="name" name="name" class="form-control " placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="">Tipo de documento</label>
                        <select name="" id="" class="form-control">
                            <option value="">General</option>
                            <option value="">Específico</option>
                        </select>
                    </div>
                    <div class="form-group ">
                        <label for="reception" class="col-md-4 col-form-label">Fecha de firma</label>
                        <input type="date" id="reception" name="reception" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="objective" class="col-md-4 col-form-label">Objeto</label>
                        <textarea name="objective" id="objective" cols="30" rows="5" class="form-control"
                            placeholder="Describe el objetivo"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="agreementValidity" class="col-md-4 col-form-label">Vigencia</label>
                        <input type="date" id="agreementValidity" name="agreementValidity" class="form-control">
                        <input type="checkbox" name="validez" id="validez" value="Observación">
                        <label for="Observacion">Observacion</label>
                        <small>Al seleccionar "observación" se habilitará el text area de abajo</small>
                        <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
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
                        <label for="Sesion">Sesión</label>
                        <input type="date" name="" id="" class="form-control">
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
                            <input type="checkbox" name="checkbox" id="checkbox" value="Admin">
                            <li>Admin</li>

                        </div>

                        <div class="col-md-4">
                            <label for="dependence_id" class=" col-form-label">Asigne institución, dependencia o persona
                                que firma(titular)</label>
                            <select name="dependence_id" id="dependence_id"
                                placeholder="Selecciona la institucion asignado" class="form-control"
                                required="required">
                                <option value="">Dependencia</option>
                                <option value="">Institución</option>
                                <option value="">Persona</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <label for="file" class="col-md-8 col-form-label">Seleccione el archivo</label>
                            <input type="file" class="form-control-file" name="file" id="file">
                        </div>
                        <div class="form-group">
                            <label for="">Persona que firma</label>
                            <input type="text" class="form-control" placeholder="buscador">
                        </div>
                        <div class="form-group"><label for="">Institución</label> <input type="text" name="" id=""
                                class="form-control" placeholder="buscador"> </div>
                        <div class="form-group">
                            <label for="">Dependencia</label>
                            <input type="text" class="form-control" placeholder="buscador">
                        </div>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
        </div>
        <div class="form-group text-center" style="margin-top:5px">
            <a href="{{route ('home')}}" class="btn btn-secondary">Regresar</a>
            {!!Form::submit('Guardar',['class' => 'btn btn-primary'])!!}

        </div>

    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
$("#liable_user").select2({
    placeholder: "Select a Name",
    allowClear: true
});
$("#dependence_id").select2({
    placeholder: "Select a Name",
    allowClear: true
});





<
script src = "https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js" >
</script>
@endsection