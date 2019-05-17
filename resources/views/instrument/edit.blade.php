@extends('layouts.app')
@section('content')
@if(Auth::user()->hasRole('admin'))
<div class="container">
    <div class="column-sm-8">
        <h2 class="text-right">
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="text-muted text-center">Editar Instrumento jurídico</h3>
        </div>
        <div class="card-body">

            {!!Form::model($instrument, ['route' =>['LegalInstrument.update', $instrument->id],'method' =>'PUT']) !!}

            <div class="form-group mb-2">
                <label for="legalInstrument">Instrumento jurídico</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Instrumento jurídico" value ="{{$instrument->name}}">
            </div>
            {!!Form::submit('Guardar',['class' => 'btn btn-primary'])!!}

            {!!Form::close()!!}
        </div>
    </div>
    {{csrf_field()}}
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