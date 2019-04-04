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
    <br>
    <div class="container">
        @include('auth.fragment.error')
        @include('auth.fragment.info')
        @foreach($agreements->getFiles as $file)
        @if(count($file->getComments) == 0)
                <div class="card card-body">  
                            <a href="{{route('agreement.download',$file->id)}}">{{$file->name}}</a>
                </div>
        @endif
        @endforeach
        @foreach($agreements->getComments as $comment)
        <div class="card">
            <div class="card-header color-header">
                <a data-toggle="collapse" href="#CollapseComments" role="button" aria-expanded="false"
                    aria-controls="CollapseComments">{{$comment->topic}}</a>
            </div>
            <div class="collapse multi-collapse" id="CollapseComments">
                <div class="card card-body">
                <li>Fecha de creación: {{$comment->created_at}}</li>
                    {{$comment->comment}}
                </div>
                @foreach($comment->getFilesAgreements as $file)
                <div class="card card-body">
                            
                            <a href="{{route('agreement.download',$file->id)}}">{{$file->name}}</a>
                </div>
                @endforeach
            </div>
            <div class="card-footer space">
                Comentario realizado por:
                {{$comment->user}}
            </div>
        </div>
        @endforeach

        
        {!!Form::open( ['route' =>array('CommentAgreement.make', $agreements->id), 'files' =>true]) !!}

            {!! csrf_field()!!}

            <div class="colum-sm-8">
                <div class="head">
                    <h2 class="card card-header text-muted text-center">Revisión de: "{{$agreements->name}}"</h2>
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <label for="subject">Asunto</label>
                        <input name="topic" id="topic" type="text" class="form-control"
                            placeholder="Escriba el asunto de revisión">
                    </div>
                    <div>
                        <label for="comment">Comentario</label>
                        <textarea name="comment" id="comment" cols="30" rows="10" class="form-control"
                            placeholder="Escriba la revisión"></textarea>
                    </div>
                    <div class="form-group">
                        <br>
                        <input type="file" name="fileForum" id="fileForum" class="btn boton">
                        <input type="submit" class="btn btn-success" value="Comentar">
                        <input type="button" value="Más Opciones" data-toggle="collapse" data-target="#collapseOptions"
                            aria-expanded="false" aria-controls="collapseOptions" class="btn btn-primary">

                    </div>
                    <div class="form-group">
                        <a href="{{Route('Revision')}}" class="btn btn-secondary">Regresar</a>
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
                        <input type="submit" class="btn btn-primary" value="Finalizar" name="finish2" id="Button"
                            onClick="alertbutton()">
                        <input type="button" value="Soy un boton de prueba" id="Button" onClick="alertbutton()">
                    </div>
                </div>
            </div>
        <!--</form>-->
        {!!Form::close()!!}
    </div>
</body>

</html>
@endsection