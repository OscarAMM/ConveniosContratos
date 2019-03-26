@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css\proyect.css')}}">
    <title>Forum Revision</title>
</head>

<body>
    <br>
    <form action="#" method="POST">
        {!! csrf_field()!!}
        <div class="container">
            <div class="colum-sm-8">
                <div class="head">
                    <h2 class="card card-header text-muted text-center">Revisión</h2>
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <label for="subject">Asunto</label>
                        <input type="text" class="form-control" placeholder="Escriba el asunto de revisión">
                    </div>
                    <div>
                        <label for="comment">Comentario</label>
                        <textarea name="comment" id="comment" cols="30" rows="10" class="form-control"
                            placeholder="Escriba la revisión"></textarea>
                    </div>
                    <div class="form-group">
                        <br>
                        <a href="{{Route('Revision')}}" class="btn btn-secondary">Regresar</a>
                        <input type="submit" class="btn btn-success" value="Comentar">
                        <input type="button" value="Más Opciones" data-toggle="collapse" data-target="#collapseOptions"
                            aria-expanded="false" aria-controls="collapseOptions" class="btn btn-primary">

                    </div>

                    <div class="collapse multi-collapse" id="collapseOptions">
                        <div class="card card-body">
                            <h3>¡Atención!</h3>
                            <p>Al seleccionar la opción finalizar, se estará mandando un mensaje al usuario
                                correspondiente para notificar que está listo para que revise el último documento
                                agregado</p>
                            <p>Si no está seguro de haber finalizado, no seleccione "Finalizar"</p>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary" value="Finalizar" disabled>
                        <input type="file" name="file" id="file" class="btn boton">
                    </div>

                </div>

            </div>

        </div>


    </form>
</body>

</html>
@endsection