@extends('layouts.app')



@section('content')
@if(Auth::user()->hasRole('admin'))

<div class="container">
    <div class= "row justify-content-center">
        <div class ="col-md-10">
            <div class="card">
                <div class="card-header text-muted">
                <h3 class= "card-title text-center font-weight-bold">Usuario</h3>
                </div>
                    <div class="card-body">
                        <li class= "list-group-item">
                        <h5 class="card-title font-weight-bold">Nombre:</h5>
                        {{$user ->name}}</li>
                        <li class= "list-group-item">
                        <h5 class="card-title font-weight-bold">Email</h5>
                        {{$user ->email}}</li>
                        <li class= "list-group-item">
                        <h5 class="card-title font-weight-bold">Rol</h5>
                        {{$rol}}</li>
                        <br>
                        <a href="{{route('users.index')}}" class="btn btn-secondary">Regresar</a>
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
            <h4>Acceso restringido</h4>
            <h6>Comuníquese con su administrador</h6>
    </div>
@endif

@endsection
