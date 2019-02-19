
@extends('layouts.app')

@section('content')
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

@endsection