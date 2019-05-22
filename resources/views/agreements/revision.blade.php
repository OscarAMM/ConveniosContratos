@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css\proyect.css')}}">
    <title>Document</title>
</head>

<body>
    <div class="gradientLogin">
        <img src="{{asset('images\Edificio_Central.jpg')}}" alt="Edificio-Central">
    </div>
    @if(!Auth::guest()&&(Auth::user()->hasRole('admin')||Auth::user()->hasRole('revisor')))
    @include('auth.fragment.info')
    @include('auth.fragment.error')
    <div class="container">
        <div class="row ">
            <div class="col">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre del documento</th>
                            <th>Estatus - Tiempo de revisión</th>
                            <th>Revisión</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->getAgreements as $agreemment)
                        {!!csrf_field()!!}
                        @if($agreemment->status=='Revisión')
                        <tr>
                            <th scope="row">{{$agreemment->name}}</th>
                            <th scope="row">
                                @php
                                $user = \Auth::user();
                                foreach($agreemment->getComments as $comment){
                                $value = ends_with($comment->user,$user->email );
                                if($value){
                                echo "Revisado - Tiempo transcurrido: ";
                                }
                                }
                                $dt= Carbon\Carbon::now()->subDays(1)->diffForHumans($agreemment->end_date);

                                echo $dt." de concluir el periodo de revisión";
                                @endphp
                            </th>
                            <td><a href="{{route('Forum.Agreement', $agreemment->id)}}" class="btn boton ">Revisión</a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
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