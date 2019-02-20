
@extends('layouts.app')

@section('content')
@if(Auth::user()->hasRole('admin'))

<div class="container">
<div class = "column-sm-8">
    <h2 class="text-right">
    </div>
    <div class ="card">
    <div class="card-header">
    <h3 class="text-muted text-center">EDITAR DEPENDENCIA</h3>
    </div>
    <div class="card-body">
    @include('dependencies.fragment.error')
    {!!Form::model($dependence, ['route' =>['Dependence.update', $dependence->id],'method' =>'PUT']) !!}
        @include('dependencies.fragment.form')
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