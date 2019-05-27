@extends('layouts.app')
@section('content')
@if(!Auth::guest()&&Auth::user()->hasRole('admin'))
<div class="container">
    <div class="column-sm-8">
        <div class="card">
            <div class="card-header">
                <h3 class="text-muted text-center"> Registro final </h3>
            </div>
            <div class="card-body">
                @include('auth.fragment.error')
                @include('auth.fragment.info')
                {!!Form::open( ['route' =>'FinalRegister.store', 'files' =>true]) !!}
                @include('finalregister.fragment.form')
                {{csrf_field()}}
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

