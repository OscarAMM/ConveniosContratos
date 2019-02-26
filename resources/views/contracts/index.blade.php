@extends('layouts.app')
@section('content')

<div class="card-header text-muted text-center" style="margin-bottom:5px">
    <h3> Contratos </h3>
    <a href="{{route('Contract.create')}}" class="btn btn-success"
        style="margin-right:5px">Nuevo</a>
</div>
@endsection