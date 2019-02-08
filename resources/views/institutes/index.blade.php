@extends('layouts.app')

@section('content')
<div class = "container">

    <h2 class="font-weight-bold text-center"> INSTITUCIONES
    <a href="{{route('Institute.create')}}" class ="btn btn-primary pull-right">Nuevo</a>
    </h2>
    
    <table class= "table">
        <thead class= "thead-dark">
        <tr>
            <th>Nombre</th>
            <th>Siglas</th>
            <th>País</th>
            <th colspan="3">&nbsp;</th>
        </tr>
        <tbody>
            @foreach($institutions as $institute)
            <tr>
                <td>{{$institute->name}}</td>
                <td>{{$institute->acronym}}</td>
                <td>{{$institute->country}}</td>
                <td>
                <a href="{{route('Institute.show', $institute ->id)}}" class="btn btn-success">Ver</a> </td>
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>
            @endforeach
        </tbody>
        </thead>
    </table>
    {!!$institutions->render()!!}
</div>

@endsection