@extends('layouts.app')

@section('content')
<div class="container">
<div class= "row justify-content-center">
<div class ="col-md-10">
<div class="card">
    <div class="card-header text-muted">
    <h3 class= "card-title text-center font-weight-bold">Institución</h3>
    </div>
    <div class="card-body">
        <li class= "list-group-item">
        <h5 class="card-title font-weight-bold">Nombre:</h5>
         {{$institutions ->name}}</li>
        <li class= "list-group-item">
        <h5 class="card-title font-weight-bold">Siglas</h5>
        {{$institutions ->acronym}}</li>
        <li class= "list-group-item">
        <h5 class="card-title font-weight-bold">País</h5>
        {{$institutions ->country}}</li>
        <li class="list-group-item"><a href="{{route('Institute.index')}}" class="btn btn-info pull-center">Regresar</a>
    <a href="{{route('Institute.edit', $institutions->id)}}" class="btn btn-warning"> Editar</a></li>
    </ul>
    </div>
    <div>
    
    </div>
</div>
</div>
</div>
</div>
    


@endsection