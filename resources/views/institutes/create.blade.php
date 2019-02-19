@extends('layouts.app')

@section('content')
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

@endsection