@extends('layouts.app')

@section('content')
@if(Auth::user()->hasRole('admin'))
<div class="container">
<div class = "column-sm-8">
    <div class ="card">
    <div class="card-header">
    <h3 class="text-muted text-center">AGREGAR NUEVA INSTITUCIÓN</h3>
    </div>
    <div class="card-body">
    @include('institutes.fragment.error')
    <!--Se agrega el formulario que se encuentra en fragment-->
    {!!Form::open( ['route' =>'Institute.store']) !!}
        @include('institutes.fragment.form')
    {!!Form::close()!!}
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