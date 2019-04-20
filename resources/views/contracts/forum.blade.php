@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css\proyect.css')}}">
    <script type="text/javascript" src="{{asset('js\disable.js')}}"></script>
    <title>Forum Revision</title>
</head>

<body>
    @include('auth.fragment.error')
    @include('auth.fragment.info')
    <div class="head">
        <h2 class="card card-header text-muted text-center">Revisión de: "{{$contracts->name}}"</h2>
    </div>
    <br>
    <!-- COMENTARIOS -->

    <div class="row-10 d-flex justify-content-left">
        <div class="col-8">
            <h3>Comentarios</h3>
            @foreach($contracts->getComments as $comment)
            <div class="card">
                <div class="card-header color-header text-muted">
                    <button data-toggle="collapse" href="#CollapseComments" role="button" aria-expanded="false"
                        aria-controls="CollapseComments" class="btn boton">{{$comment->topic}}</button>
                </div>
                <div class="collapse multi-collapse" id="CollapseComments">
                    <div class="card card-body">
                        <p>{!!$comment->comment!!}</p>
                        @foreach($comment->getFilesContracts as $file)
                        <a href="{{route('contract.download',$file->id)}}">{{$file->name}}</a>
                        @endforeach
                        <div>Realizado por: {{$comment->user}} a las  {{$comment->created_at}}</div>
                    </div>
                </div>
                <!-- <div class="card-footer">
                    Comentario realizado por:
                    {{$comment->user}}
                </div>-->
            </div>
            @endforeach
        </div>
        <br>
        <!-- formulario -->
        {!!Form::open( ['route' =>array('CommentContract.make', $contracts->id), 'files' =>true]) !!}
        {!! csrf_field()!!}
        <div class="col">
            <div class="form-group">
                <a href="{{Route('NotifyContract.users', $contracts->id)}}" class="btn btn-success">Notificar</a>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseForm"
                    aria-expanded="false" aria-controls="collapseForm">
                    Comentar
                </button>
                <input type="button" value="Finalizar" data-toggle="collapse" data-target="#collapseOptions"
                    aria-expanded="false" aria-controls="collapseOptions" class="btn btn-primary">
                <a href="{{Route('Revision')}}" class="btn btn-secondary">Regresar</a>
            </div>
            <div class="collapse" id="collapseForm">
                <div class="form-group">
                    <div class="form-group">
                        <label for="subject">Asunto</label>
                        <input name="topic" id="topic" type="text" class="form-control"
                            placeholder="Escriba el asunto de revisión">
                    </div>
                    <div>
                        <label for="comment">Comentario</label>
                        <textarea name="comment" id="comment" cols="30" rows="10" class="form-control ckeditor"
                            placeholder="Escriba la revisión"></textarea>
                    </div>
                    <div class="form-group">
                        <br>
                        <input type="file" name="fileForum" id="fileForum" >
                        <input type="submit" class="btn botonAzul" value="Comentar">
                    </div>
                    <br>
                </div>
            </div>
            <!--</form>-->
            {!!Form::close()!!}
            {!!Form::open( ['route' =>array('FinallyContract.notify', $contracts->id)]) !!}
            <div class="collapse" id="collapseOptions">
                <div class="card card-body">
                    <h3>¡Atención!</h3>
                    <p>Al seleccionar la opción finalizar, se estará mandando un mensaje al usuario
                        correspondiente para notificar que está listo para que revise el último documento
                        agregado</p>
                    <p>Si no está seguro de haber finalizado, no seleccione "Finalizar"</p>
                    <input type="submit" class="btn btn-primary" value="Finalizar"
                        onClick="return confirm('¿Seguro que quiere finalizar?');">
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    @foreach($contracts->getFiles as $file)
    @if(count($file->getComments) == 0)
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-muted">Documento original</div>
            <div class="card-body">Este es el documento original, es decir, un respaldo en caso de que se hagan
                demasiadas modificaciones
                <p><a href="{{route('contract.download',$file->id)}}">{{$file->name}}</a></p>
            </div>

        </div>
    </div>
    <br>
    @endif
    @endforeach
</body>

</html>
@endsection