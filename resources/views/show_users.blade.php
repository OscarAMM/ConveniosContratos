@extends('layouts.app')

@section('content')
<div class="card" >
  <div  style= "padding: 70px" >
  <h4>Datos:<h4>

    @if(Auth::user()->hasRole('admin'))
        <blockquote class="blockquote mb-0">
        <pre>       {{ $user->name }}</pre>
        <pre>       {{ $user->email }}</pre>
        <div>
        <h4>Rol:<h4>

        </div>
        <pre>       {{$rol}}</pre>
        </blockquote>

    @else
        <p>Usuario no autorizado</p>
        
    @endif
    
  </div>
</div>
@endsection