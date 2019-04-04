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
    <br>
    <div class="container">
        <div class="row ">
            <div class="col">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre del convenio</th>
                            <th>Revisión</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->getAgreements as $agreemment)
                        {!!csrf_field()!!}
                        <tr>
                            <th scope="row">{{$agreemment->name}}</th>
                            <td><a href="{{route('Forum.Agreement', $agreemment->id)}}"
                                    class="btn btn-primary ">Revisión</a></td>
                        </tr>
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
                            <th>Revisión</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->getContracts as $contract)
                        {!!csrf_field()!!}
                        <tr>
                            <th scope="row">{{$contract->name}}</th>
                            <td><a href="{{route('Forum.Contract', $contract->id)}}"
                                    class="btn btn-primary">Revisión</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

@endsection