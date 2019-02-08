@extends('layouts.app')

@section('content')
<div class = "container">

    <h2 class="font-weight-bold text-center"> INSTITUCIONES
    <a href="{{route('Institute.create')}}" class ="btn btn-primary pull-right">Nuevo</a>
    </h2>
    @include('institutes.fragment.info')
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
                <td>
                <a href="{{route('Institute.edit', $institute ->id)}}" class="btn btn-warning">Editar</a></td>
                <td>
                <form action="{{route('Institute.destroy', $institute->id)}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name = "_method" value ="DELETE">
                    <button class = "btn btn-danger">Eliminar</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </thead>
    </table>
    {!!$institutions->render()!!}
</div>

@endsection