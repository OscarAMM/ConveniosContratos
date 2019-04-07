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
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-muted">Documento Final</div>
            <div class="card-body">Este es el documento final.
                <p><a href="{{route('contract.download',$file->id)}}">{{$file->name}}</a></p>
            </div>

        </div>
    </div>
    <br>

</body>

</html>
@endsection