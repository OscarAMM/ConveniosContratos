<div class= "container">
<div class="form-group">
    {!! Form::label('name','Nombre de la Dependencia')!!}
    {!!Form::text('name', null, ['class' => 'form-control'])!!}
</div>

<div class="form-group">
    {!! Form::label('acronym','Siglas de la Dependencia')!!}
    {!!Form::text('acronym', null, ['class' => 'form-control'])!!}
</div>

<div class="form-group">
    {!! Form::label('country','País')!!}
    {!!Form::text('country', null, ['class' => 'form-control'])!!}
</div>

<div class="form-group text-center">
    <a href="{{route('Dependence.index')}}" class="btn btn-secondary">Regresar</a> </h2>
    {!!Form::submit('GUARDAR',['class' => 'btn btn-primary'])!!}
</div>
</div>
