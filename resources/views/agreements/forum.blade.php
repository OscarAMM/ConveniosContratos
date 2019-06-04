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
    @if(!Auth::guest() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('revisor')))
    @include('auth.fragment.error')
    @include('auth.fragment.info')
    <div class="container">
        <div class="jumbotron text-center text-muted" style="background-color: #0F3558">
            <h1>Revisión de: "{{$agreements->name}}"</h1>
            <hr style="border:2px solid #BF942D">
            <h3>¡Bienvenido al foro {{Auth::user()->name}}!</h3>
            <p>Aquí podrás estar comentando revisiones con los otros usuarios. Recuerda que puedes agregar archivos de
                tipo: <i>Foto, PDF, DOCX, EXCEL, PPT</i></p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h3>Opciones</h3>
                <hr style="border:2px solid #BF942D">
                {!!Form::open( ['route' =>array('CommentAgreement.make', $agreements->id), 'files' =>true]) !!}
                <div class="form-group">
                    <a href="{{Route('Revision')}}" class="btn btn-secondary">Regresar</a>
                    @if(Auth::user()->hasDocument($agreements->id))
                    <button class="btn boton" type="button" data-toggle="collapse" data-target="#collapseForm"
                        aria-expanded="false" aria-controls="collapseForm">
                        Comentar
                    </button>
                    <a href="{{Route('NotifyAgreement.users', $agreements->id)}}" class="btn boton">Notificar</a>
                    <input type="button" value="Finalizar" data-toggle="collapse" data-target="#collapseOptions"
                        aria-expanded="false" aria-controls="collapseOptions" class="btn btn-primary">
                    @endif
                </div>
                <div class="collapse" id="collapseForm">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="subject">Asunto</label>
                            <input name="topic" id="topic" type="text" class="form-control "
                                placeholder="Escriba el asunto de revisión">
                        </div>
                        <div class="form-group">
                            <label for="comment">Comentario</label>
                            <textarea name="comment" id="comment" cols="30" rows="10" class="form-control ckeditor"
                                placeholder="Escriba la revisión"></textarea>
                        </div>
                        <div class="form-group">
                            <br>
                            <input type="file" name="fileForum" id="fileForum">
                            <input type="submit" class="btn botonAzul" value="Comentar">
                        </div>
                        <br>
                    </div>
                </div>
                {!!Form::close()!!}
                {!!Form::open( ['route' =>array('FinallyAgreement.notify', $agreements->id)]) !!}
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

            <div class="col-md-8 order-md-1">
                <h3>Comentarios</h3>
                <hr style="border:2px solid #BF942D">
                @foreach($agreements->getComments as $comment)
                <div>
                    <div class="card-header">
                        <h5 style="color:white">Asunto:{!!$comment->topic!!}</h5>
                        <form action="{{route('Comment.destroy', $comment->id)}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger"
                                onClick="return confirm('¿Seguro que desea eliminar este comentario? No se deshacer la acción.'">X</button>
                        </form>
                    </div>
                    <div class="card card-body">
                        <p>{!!$comment->comment!!}</p>
                        @foreach($comment->getFilesAgreements as $file)
                        <a href="{{route('agreement.download',$file->id)}}">{{$file->name}}</a>
                        @endforeach
                        <p>Realizado por: {{$comment->user}} a las {{$comment->created_at}}</p>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-8 order-md-1">
            @foreach($agreements->getFiles as $file)
            @if(count($file->getComments) == 0)
            <div class="card-header text-muted">Documento original</div>
            <div class="card card-body">Documento original.
                <p><a href="{{route('agreement.download',$file->id)}}">{{$file->name}}</a></p>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    @else
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="text-muted">Acceso restringido</h2>
            </div>
            <div class="card-body">
                <h4>EL Usuario no tiene acceso a esta área, comuníquese con su administrador si desea realizar algún
                    cambio.
                </h4>
            </div>

        </div>
    </div>
    @endif
</body>

</html>
@endsection