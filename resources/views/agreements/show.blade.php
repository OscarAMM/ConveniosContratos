@extends('layouts.app')

@section('content')
@if(!Auth::guest()&&(Auth::user()->hasRole('admin')||Auth::user()->hasRole('revisor')))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2 class=" text-center font-weight-bold text-muted">Datos de "{{$agreements->name}}"</h2>
                </div>
                <div class="card-body">
                    <li class="list-group-item">
                        <h4 class="card-title font-weight-bold">Nombre</h4>
                        {{$agreements->name}}
                    </li>
                    <li class="list-group-item">
                        <h4 class="card-title font-weight-bold">Recepción</h4>
                        {{$agreements->reception}}
                    </li>
                    <li class="list-group-item">
                        <h4 class="card-title font-weight-bold">Fecha final de revisión</h4>
                        {{$agreements->end_date}}
                    </li>
                    <li class="list-group-item">
                        <h4 class="card-title font-weight-bold">Objetivo</h4>
                        {{$agreements->objective}}
                    </li>
                    <li class="list-group-item">
                        <h4 class="card-title font-weight-bold">Ámbito</h4>
                        {{$agreements->scope}}
                    </li>
                    <li class="list-group-item">
                        <h4 class="card-title font-weight-bold">Partes</h4>
                        @foreach($agreements->getPeople as $person)
                        <ul> {{$person->name}}</ul>
                        @endforeach
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Responsable externo</h5>
                        {{$agreements->liable_user}}
                    </li>
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Responsable(s) interno(s)</h5>
                        @foreach($users as $user)
                        <label for="name">Nombre</label>
                        <ul>{{$user->name}}
                        </ul>
                        <label for="email">Email</label>
                        <ul>{{$user->email}}</ul>
                        @endforeach
                    </li>
                    @if(Auth::user()->hasRole('admin')||Auth::user()->hasDocument($agreements->id))
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Archivos</h5>
                        @foreach($files as $file)
                        <ul>
                            <li>Fecha de creación: {{$file->created_at}}</li>
                            <a href="{{route('agreement.download',$file->id)}}">{{$file->name}}</a>
                        </ul>
                        @endforeach
                    </li>
                    @endif
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Estado</h5>
                        {{$agreements->status}}
                    </li>
                    <li class="list-group-item text-center">
                       <div class="btn-group">
                        <a href="{{route('Agreement.index')}}" class="btn btn-secondary">Regresar</a>
                        <form action="{{route('StoreDocs', $agreements->id)}}" method="post">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-success">Imprimir</button>
                        </form>
                        </div>
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