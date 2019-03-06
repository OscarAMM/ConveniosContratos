@extends('layouts.app')

@section('content')
@if(Auth::user()->hasRole('admin'))

<div class="container">
    <div class="column-sm-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="#" enctype="multipart/form-data">
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
                                @foreach($institutes as $institute)
                                <option value="{{$institute->id}}">{{$institute->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <label for="file" class="col-md-8 col-form-label">Seleccione el archivo</label>
                            <input type="file" class="form-control-file" name="file" id="file">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="form-group text-center" style="margin-top:5px">
            <a href="{{route ('Contract.index')}}" class="btn btn-secondary">Regresar</a>
            {!!Form::submit('Guardar',['class' => 'btn btn-primary'])!!}
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