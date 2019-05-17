<div class="container">
    <form action="#" method="POST" class="form-inline">
        <div class="form-group mb-2">
            <label for="legalInstrument">Instrumento jurídico</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Instrumento jurídico">
        </div>
        {!!Form::submit('Guardar',['class' => 'btn btn-primary'])!!}
    </form>
</div>