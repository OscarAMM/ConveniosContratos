@extends('layouts.app')

@section('content')
<div class="container">
<div class= "row justify-content-center">
<div class ="col-md-10">
<div class="card">
    <div class="card-header">
    <h4 class= " text-center font-weight-bold text-muted">DEPENDENCIA</h4>
    </div>
    <div class="card-body">
        <li class= "list-group-item">
        <h5 class="card-title font-weight-bold">Nombre:</h5>
         {{$dependence ->name}}</li>
        <li class= "list-group-item">
        <h5 class="card-title font-weight-bold">Siglas</h5>
        {{$dependence ->acronym}}</li>
        <li class= "list-group-item">
        <h5 class="card-title font-weight-bold">País</h5>
        {{$dependence ->country}}</li>
        <li class="list-group-item text-center">
        <a href="{{route('Dependence.index')}}" class="btn btn-secondary">Regresar</a>
    <a href="{{route('Dependence.edit', $dependence->id)}}" class="btn btn-primary"> Editar</a></li>
    </ul>
    </div>
    <div>
    
    </div>
</div>
</div>
</div>
</div>
@endsection