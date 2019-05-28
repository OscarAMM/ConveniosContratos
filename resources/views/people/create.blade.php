@extends('layouts.app')

@section('content')
@if(Auth::user()->hasRole('admin'))
<div class="container">
    <div class="column-sm-8">
        <div class="card">
            <div class="card-header">
                <h3 class="text-muted text-center">Parte</h3>
            </div>
            <div class="card-body">
                @include('people.fragment.info')
                @include('people.fragment.error')
                <!--Se agrega el formulario que se encuentra en fragment-->
                {!!Form::open( ['route' =>'Person.store']) !!}
                @include('people.fragment.form')
                {!!Form::close()!!}
            </div>
        </div>
        {{csrf_field()}}
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