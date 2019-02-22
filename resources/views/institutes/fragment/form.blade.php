<div class="container">
    <div class="form-group">
        <label for="name">{{_('Nombre de la institución')}}</label>
        <input type="text" name="name" id="name" required="required" class="form-control">
        <!--{!! Form::label('name','Nombre de la Institucion')!!}
    {!!Form::text('name', null, ['class' => 'form-control'])!!} -->
    </div>

    <div class="form-group">
        <label for="acronym">{{_('Siglas')}}</label>
        <input type="text" name="acronym" id="acronym" required="required" class="form-control">
        <!--{!! Form::label('acronym','Siglas de la Institucion')!!}
    {!!Form::text('acronym', null, ['class' => 'form-control'])!!} -->
    </div>

    <div class="form-group">
        <label for="country">{{_('País')}}</label>
        <input type="text" name="country" id="country" required="required" class="form-control">
        <!--{!! Form::label('country','País')!!}
    {!!Form::text('country', null, ['class' => 'form-control'])!!}-->
    </div>

    <div class="form-group text-center">
        <a href="{{route('Institute.index')}}" class="btn btn-secondary">Regresar</a> </h2>
        {!!Form::submit('Guardar',['class' => 'btn btn-primary'])!!}
    </div>
</div>