<div class= "container">
<div class="form-group">
    {!! Form::label('name','Nombre de la Institucion')!!}
    {!!Form::text('name', null, ['class' => 'form-control'])!!}
</div>

<div class="form-group">
    {!! Form::label('acronym','Siglas de la Institucion')!!}
    {!!Form::text('acronym', null, ['class' => 'form-control'])!!}
</div>

<div class="form-group">
    {!! Form::label('country','País')!!}
    {!!Form::text('country', null, ['class' => 'form-control'])!!}
</div>

<div class="form-group">
    {!!Form::submit('GUARDAR',['class' => 'btn btn-primary'])!!}
</div>
</div>
