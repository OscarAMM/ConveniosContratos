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
        <img src="{{asset('images\Edificio_Central.jpg')}}" alt="Edificio-Central" >
    </div>
    @include('auth.fragment.info')
    @include('auth.fragment.error')
    <div class="container">
        <div class="row ">
            <div class="col">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre del convenio</th>
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
                            $dt= Carbon\Carbon::now()->diffForHumans($agreemment->end_date);
                            echo $dt." de concluir el periodo de revisión";
                            @endphp
                            </th>
                            <td><a href="{{route('Forum.Agreement', $agreemment->id)}}"
                                    class="btn boton ">Revisión</a></td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- tabla de contratos-->
            <div class=" col">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre del contrato</th>
                            <th>Tiempo de revisión</th>
                            <th>Revisión</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->getContracts as $contract)
                        {!!csrf_field()!!}
                        @if($contract->status=='Revisión')
                        <tr>
                            <th scope="row">{{$contract->name}}</th>
                            <th scope="row">
                            @php
                            $user = \Auth::user();
                            foreach($contract->getComments as $comment){
                            $value = ends_with($comment->user,$user->email );
                            if($value){
                                echo "Revisado - Tiempo transcurrido: ";
                            }
                            }
                            $dt= Carbon\Carbon::now()->diffForHumans($contract->end_date);
                            echo $dt." de concluir el periodo de revisión";
                            @endphp
                            </th>
                            <td><a href="{{route('Forum.Contract', $contract->id)}}"
                                    class="btn boton">Revisión</a></td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

@endsection