@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class=" text-center font-weight-bold text-muted">Convenio</h4>
                </div>
                <div class="card-body">
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Nombre</h5>
                        {{$agreements->name}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Recepción</h5>
                        {{$agreements->reception}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Objetivo</h5>
                        {{$agreements->objective}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Convenio válido hasta..</h5>
                        {{$agreements->agreementValidity}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Ámbito</h5>
                        {{$agreements->scope}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Dependencia perteneciente</h5>
                        {{$dependences->name}}
                    </li>
                    
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Archivos</h5>
                        
                        <ul>
                            <a href="{{route('agreement.download',$file->id)}}">{{$file->name}}</a>
                        </ul>
                        
                    </li>
                    
                    <li class="list-group-item text-center">
                        <a href="{{route('public.index')}}" class="btn btn-secondary">Regresar</a>
                        </ul>
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection