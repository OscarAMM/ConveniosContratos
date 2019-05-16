<!-- Default form contact -->
<form class="text-center border border-light p-5" method="POST">

    <p class="h4 mb-4">Instrumento jurídico</p>

    <!-- Name -->
    <input type="text" id="name" class="form-control mb-4" placeholder="name">


    <div class="form-group text-center" style="margin-top:5px">
        <a href="{{route ('LegalInstrument.index')}}" class="btn btn-secondary">Regresar</a>
        {!!Form::submit('Guardar',['class' => 'btn btn-primary'])!!}

    </div>

</form>
<!-- Default form contact -->