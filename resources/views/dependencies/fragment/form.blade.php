<div class="container">
    <div class="form-group">
        <label for="name">{{_('Nombre de la dependencia')}}</label>
        <input type="text" name="name" id="name" required="required" class="form-control">
        <!-- {!! Form::label('name','Nombre de la Dependencia')!!}
    {!!Form::text('name', null, ['class' => 'form-control'])!!} -->
    </div>

    <div class="form-group">
        <label for="acronym">{{_('Siglas')}}</label>
        <input type="text" name="acronym" id="acronym" required="required" class="form-control">
        <!--  {!! Form::label('acronym','Siglas de la Dependencia')!!}
        {!!Form::text('acronym', null, ['class' => 'form-control'])!!} -->
    </div>

    <div class="form-group">
        <label for="country">{{_('País')}}</label>
        <input type="text" name="country" id="country" required="required" class="form-control">
        <!-- {!! Form::label('country','País')!!}
        {!!Form::text('country', null, ['class' => 'form-control'])!!} -->
    </div>

    <div class="form-group">
        <label class="form-group">{{ __('Institucion') }}</label>
        <select name="institute_id" id="institute_id" class="form-control" required="required">
            @foreach($institutes as $institute)
            <option value="{{$institute->id}}">{{$institute->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group text-center">
        <a href="{{route('Dependence.index')}}" class="btn btn-secondary">Regresar</a> </h2>
        {!!Form::submit('Guardar',['class' => 'btn btn-primary'])!!}
    </div>
</div>