
@extends('layouts.app')

@section('content')
@if(Auth::user()->hasRole('admin'))
<div class="container">
<div class = "column-sm-8">
    <h2 class="text-right">
    </div>
    <div class ="card">
    <div class="card-header">
    <h3 class="text-muted text-center">EDITAR INSTITUCIÓN</h3>
    </div>
    <div class="card-body">
    @include('institutes.fragment.error')
    {!!Form::model($institute, ['route' =>['Institute.update', $institute->id],'method' =>'PUT']) !!}
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