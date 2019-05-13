<div class="container">
    <div class="form-group">

        {!! Form::label('name','Nombre')!!}
        {!!Form::text('name', null, ['class' => 'form-control'])!!}
    </div>

    <div class="form-group">

        {!! Form::label('personType','Tipo de persona')!!}
        {!!Form::text('personType', null, ['class' => 'form-control'])!!}
        <small>Persona moral o física. </small>
    </div>

    <div class="form-group">
        {!! Form::label('country','País')!!}
        {!!Form::text('country', null, ['class' => 'form-control'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('email','Correo')!!}
        {!!Form::text('email', null, ['class' => 'form-control'])!!}
    </div>
    <div class="form-group text-center">
        <a href="{{route('Person.index')}}" class="btn btn-secondary">Regresar</a> </h2>
        {!!Form::submit('Guardar',['class' => 'btn btn-primary'])!!}
    </div>
    {{csrf_field()}}
</div>