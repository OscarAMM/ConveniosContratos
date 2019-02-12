@extends('layouts.app')

@section('content')
<div class="container">
<div class = "column-sm-8">
    <h2 class ="text-right">
        <a href="{{route('Institute.index')}}" class="btn btn-secondary pull-center">Regresar</a>
    </h2>

    <div class ="card">
    <div class="card-header">
    <h3 class="text-muted text-center">AGREGAR NUEVA INSTITUCIÓN</h3>
    </div>
    <div class="card-body">
    {!!Form::open( ['route' =>'Institute.store']) !!}
        @include('institutes.fragment.form')
    {!!Form::close()!!}
    </div>
    </div>
</div>
</div>

@endsection