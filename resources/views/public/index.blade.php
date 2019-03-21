@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('css\proyect.css')}}">

@include('auth.fragment.info')

<div class="card-header text-muted text-center" style="margin-bottom:5px">
    <h2> Convenios </h2>
</div>
{{Form::open(['route'=>'Agreement.index','method'=>'GET','class'=>'form-inline'])}}
<p class="text-item-center"><!--<a href="{{route('Agreement.create')}}" class="btn btn-success"
        style="margin-right:5px">Nuevo</a>-->
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
        aria-expanded="false" aria-controls="collapseExample" style="margin-right:15px">
        Búsqueda
    </button></p>
<div class="collapse" id="collapseExample">
    <div class=" card card-body " style="margin-bottom:5px">
        <!-- inicio form busqueda-->
        <div class="form-row">
            <div class="col" style="margin-right:5px">
                {{Form::text('id',null,['class'=>'form-control','placeholder'=>'ID'])}}
            </div>
            <div class="col" style="margin-right:5px">
                {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre'])}}
            </div>
            <div class="col" style="margin-right:5px">
                {{Form::date('reception',null,['class'=>'form-control','placeholder'=>'Recepción'])}}
            </div>
            <div>
                {{Form::text('scope',null,['class'=>'form-control','placeholder'=>'Ámbito'])}}
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search">Buscar</span>
                </button>
            </div>
        </div>
    </div>
    {{Form::close()}}
</div>

<table class="table  table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Recepción</th>
            <th>Objetivo</th>
            <th>Fecha de validez</th>
            <th>Ámbito</th>
            <th colspan="4">&nbsp;</th>
        </tr>
    <tbody>
        @foreach($agreements as $agreement)
        @if($agreement->hide)
        <tr>
            <td>{{$agreement->id}}</td>
            <td>{{$agreement->name}}</td>
            <td>{{$agreement->reception}}</td>
            <td>{{$agreement->objective}}</td>
            <td>{{$agreement->agreementValidity}}</td>
            <td>{{$agreement->scope}}</td>
            <td>
                <a href="{{route('public.show', $agreement ->id)}}" class="btn btn-info">Ver</a>
            </td>
        
        </tr>
        @endif
        @endforeach
    </tbody>
    </thead>
</table>

@endsection