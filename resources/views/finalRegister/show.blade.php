@extends('layouts.app')

@section('content')
@if(!Auth::guest()&&(Auth::user()->hasRole('admin')||Auth::user()->hasRole('revisor')))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class=" text-center font-weight-bold text-muted">Documento: {{$documents->name}}</h4>
                </div>
                <div class="card-body">
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Número de registro</h5>
                        {{$documents->registerNumber}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Nombre</h5>
                        {{$documents->name}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Instrumento jurídico</h5>
                        {{$documents->legalInstrument}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Objetivo</h5>
                        {{$documents->objective}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Tipo de instrumento</h5>
                        {{$documents->instrumentType}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Observación</h5>
                        {{$documents->observation}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Fecha de firma</h5>
                        {{$documents->signature}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Fecha de inicio</h5>
                        {{$documents->start_date}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Fecha de fin</h5>
                        {{$documents->end_date}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Fecha de sesión</h5>
                        {{$documents->session}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Ámbito</h5>
                        {{$documents->scope}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Visibilidad del documento</h5>
                        @if($documents->hide)
                        <label for="visible">Visible</label>
                        @else
                        <label for="NoVisible">No Visible</label>
                        @endif
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Partes</h5>
                        @foreach($documents->getPeople as $person)
                        <ul> {{$person->name}}</ul>
                        @endforeach
                    </li>
                    
                    
                    @if(Auth::user()->hasRole('admin')||Auth::user()->hasDocument($documents->id))
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Archivos</h5>
                        @foreach($files as $file)
                        <ul>
                            <li>Fecha de creación: {{$file->created_at}}</li>
                            <a href="{{route('document.download',$file->id)}}">{{$file->name}}</a>
                        </ul>
                        @endforeach
                    </li>
                    @endif
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Estado</h5>
                        {{$documents->status}}
                    </li>
                    <li class="list-group-item text-center">
                        <ul>
                        <a href="{{route('FinalRegister.index')}}" class="btn btn-secondary">Regresar</a>
                        </ul>
                        <ul>
                        <form action="{{route('StoreFinal', $documents->id)}}" method="post">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-success">Imprimir</button>
                        </form>
                        </ul>
                    </li>
                </div>
                <div>
                </div>
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