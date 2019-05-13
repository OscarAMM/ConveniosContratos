@extends('layouts.app')

@section('content')
@if(Auth::user()->hasRole('admin'))

@include('auth.fragment.info')
@include('auth.fragment.error')
<div class="container">
    <div class="column-sm-8">
        <div class="card">
            <div class="card-body">

                @include('agreements.fragment.error')
                {!!Form::model($agreements, ['route' =>['Agreement.update', $agreements->id],'method' =>'PUT']) !!}
                <div class="form-group ">
                    <label for="name" class="col-md-4 col-form-label ">Nombre de convenio</label>
                    <input type="text" id="name" name="name" class="form-control " placeholder="Nombre"
                        value="{{$agreements->name}}">
                </div>
                <div class="form-group ">
                    <label for="reception" class="col-md-4 col-form-label">Recepción</label>
                    <input type="date" id="reception" name="reception" class="form-control"
                        value="{{$agreements->reception}}">
                </div>
                <div class="form-group">
                    <label for="objective" class="col-md-4 col-form-label">Objetivo</label>
                    <textarea name="objective" id="objective" cols="30" rows="5" class="form-control"
                        value="{{$agreements->objective}}">{{$agreements->objective}}</textarea>
                </div>
                <div class="form-group">
                    <label for="agreementValidity" class="col-md-4 col-form-label">Fecha de fin</label>
                    <input type="date" id="agreementValidity" name="agreementValidity" class="form-control"
                        value="{{$agreements->agreementValidity}}">
                </div>
                <div class="form-group">
                    <label for="scope" class="col-md-4 col-form-label">Ámbito</label>
                    <select name="scope" id="scope" class="form-control" value="{{$agreements->scope}}">
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
                        <input type="checkbox" name="users[]" value="{{$user->id}}"
                            {{ $user ->hasAgreement($agreements->name)?'checked':'' }}> <label>{{$user->name}}</label>

                        @endif
                        @endforeach
                    </div>
                    <div class="col-md-4">
                        <label for="dependence_id" class=" col-form-label">Asigne la dependencia</label>
                        <select name="dependence_id" id="dependence_id" placeholder="Selecciona la dependencia asignado"
                            class="form-control" required="required">
                            <!--Integrar for each -->
                            @foreach($dependences as $dependence)
                            <option value="{{$dependence->id}}">{{$dependence->name}}</option>
                            @endforeach
                        </select>
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