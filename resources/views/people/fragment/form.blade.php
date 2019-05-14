<div class="container">
    <div class="form-group">

        {!! Form::label('name','Nombre')!!}
        {!!Form::text('name', null, ['class' => 'form-control'])!!}
    </div>

    
    <div class="form-group">
        <label for="personType" class="col-md-4 col-form-label">Tipo</label>
        <select name="personType" id="personType" class="form-control">
            <option>Persona física</option>
            <option>Persona moral</option>
            <option>Institución</option>
            <option>Dependencia</option>
            <option>Otros</option>
        </select>
    </div>
    <div class="form-group">
        {!! Form::label('country','País')!!}
        {!!Form::text('country', null, ['class' => 'form-control'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('acronym','Siglas')!!}
        {!!Form::text('acronym', null, ['class' => 'form-control'])!!}
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