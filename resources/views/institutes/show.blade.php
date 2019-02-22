@extends('layouts.app')

@section('content')
@if(Auth::user()->hasRole('admin'))
<div class="container">
<div class= "row justify-content-center">
<div class ="col-md-10">
<div class="card">
    <div class="card-header">
    <h4 class= " text-center font-weight-bold text-muted">INSTITUCIÓN</h4>
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
        <li class="list-group-item text-center">
        <a href="{{route('Institute.index')}}" class="btn btn-secondary">Regresar</a>
    <a href="{{route('Institute.edit', $institutions->id)}}" class="btn btn-primary"> Editar</a></li>
    </ul>
    </div>
    <div>
    
    </div>
</div>
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
            <h4>EL Usuario no tiene acceso a esta área, comuníquese con su administrador si desea realizar algún cambio.
            </h4>
        </div>

    </div>
</div>

@endif 
@endsection