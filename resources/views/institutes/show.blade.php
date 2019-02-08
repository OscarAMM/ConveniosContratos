@extends('layouts.app')

@section('content')
<div class="container">
<div class= "row justify-content-center">
<div class ="col-md-10">
<div class="card">
<div class="card-header text-muted">
    <h3 class= "font-weight-bold text-center">Institución</h3>
    </div>
    <div class="card-body">
        <li class= "list-group-item">
        <h6 class="font-weight-bold">Nombre:</h6>
         {{$institutions ->name}}</li>
        <li class= "list-group-item">
        <h6 class="font-weight-bold">Siglas</h6>
        {{$institutions ->acronym}}</li>
        <li class= "list-group-item">
        <h6 class="font-weight-bold">País</h6>
        {{$institutions ->country}}</li>
    </ul>
    <div>
    <a href="{{route('Institute.index')}}" class="btn btn-info text-center">Regresar</a>
    </div>
    
</div>

</div>
</div>
</div>
</div>
    


@endsection