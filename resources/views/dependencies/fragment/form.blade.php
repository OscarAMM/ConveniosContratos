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

<div class="form-group row">
                        <label for="rol" class="col-md-4 col-form-label text-md-right">{{ __('Institucion') }}</label>
                            <div class="col-md-6">
                            <select name="institute_id" id="institute_id" class="form-control"  required="required">
                               @foreach($institutes as $institute)
                                    <option value="{{$institute->id}}">{{$institute->name}}</option> 
                               @endforeach
                            </select>
                            </div>
</div>
<div class="form-group text-center">
    <a href="{{route('Dependence.index')}}" class="btn btn-secondary">Regresar</a> </h2>
    {!!Form::submit('GUARDAR',['class' => 'btn btn-primary'])!!}
</div>
</div>
