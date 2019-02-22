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
    @include('institutes.fragment.info')
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