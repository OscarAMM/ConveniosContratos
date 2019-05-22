<div class="container">
    <div class="form-group">
        <small style="color:#D90101;">*</small>
        {!! Form::label('name','Nombre')!!}
        {!!Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Persona / Institución / Dependencia /
        Otro'])!!}
    </div>
    <div class="form-group">
        <small style="color:#D90101;">*</small>
        <label for="personType" class="col-form-label">Tipo</label>
        <select name="personType" id="personType" class="form-control">
            <option>Persona física</option>
            <option>Persona moral</option>
            <option>Institución</option>
            <option>Dependencia</option>
            <option>Otros</option>
        </select>

    </div>
    <div class="form-group">
        <small style="color:#D90101;">*</small>
        {!! Form::label('country','País')!!}
        {!!Form::text('country', null, ['class' => 'form-control', 'placeholder' =>'País'])!!}

    </div>
    <div class="form-group">
        <small>*</small>
        {!! Form::label('acronym','Siglas')!!}
        {!!Form::text('acronym', null, ['class' => 'form-control', 'placeholder' => 'Siglas'])!!}

    </div>
    <div class="form-group">
        <small>*</small>
        {!! Form::label('email','Correo')!!}
        {!!Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Correo'])!!}

    </div>

    <div class="form-group text-center">
        <a href="{{route('Person.index')}}" class="btn btn-secondary">Regresar</a> </h2>
        {!!Form::submit('Guardar',['class' => 'btn btn-primary'])!!}
    </div>
    <div class="row">
        <div class="col">
            <small style="color:#D90101;">* Obligatorio</small> <small>*Opcional</small>
        </div>
    </div>
    {{csrf_field()}}
</div>