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
    @if(!Auth::guest()&&Auth::user()->hasDocument($agreements->id))
    @include('auth.fragment.error')
    @include('auth.fragment.info')
    <div class="head">
        <h2 class="card card-header text-muted text-center">Revisión de: "{{$agreements->name}}"</h2>
    </div>
    <br>
    <!-- COMENTARIOS -->
    <div class="row-10 d-flex justify-content-left">
        <div class="col-8">
            <h3>Comentarios</h3>
            @foreach($agreements->getComments as $comment)
            @if($comment->status=='Entregado')
            <div class="card">
                <div class="card-header color-header text-muted">
                    <button data-toggle="collapse" href="#CollapseComments" role="button" aria-expanded="false"
                        aria-controls="CollapseComments" class="btn boton">{!!$comment->topic!!}</button>
                </div>
                <div class="collapse multi-collapse" id="CollapseComments">
                    <div class="card card-body">
                        <p>{!!$comment->comment!!}</p>
                        @foreach($comment->getFilesAgreements as $file)
                        <a href="{{route('agreement.download',$file->id)}}">{{$file->name}}</a>
                        @endforeach
                        <div>Realizado por: {{$comment->user}} a las {{$comment->created_at}}</div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        <br>
        <!-- formulario -->
        {!!Form::open( ['route' =>array('CommentAgreement.make', $agreements->id), 'files' =>true]) !!}
        {!! csrf_field()!!}
        <div class="col">
            <div class="form-group">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseForm"
                    aria-expanded="false" aria-controls="collapseForm">
                    Comentar
                </button>
                
                <a href="{{Route('UserRevision')}}" class="btn btn-secondary">Regresar</a>
            </div>
            <div class="collapse" id="collapseForm">
                <div class="form-group">
                    <div class="form-group">
                        <label for="subject">Asunto</label>
                        <input name="topic" id="topic" type="text" class="form-control "
                            placeholder="Escriba el asunto de revisión">
                    </div>
                    <div>
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
            <!--</form>-->
            {!!Form::close()!!}

        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-muted">Documento final</div>
            <div class="card-body">Este es el documento final.
                <p><a href="{{route('agreement.download',$file->id)}}">{{$file->name}}</a></p>
            </div>

        </div>
    </div>
    <br>
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