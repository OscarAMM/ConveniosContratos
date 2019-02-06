@extends('layouts.app')

@section('content')
    <div class="container">
    <h2>INSTITUCIONES</h2>
    @foreach($institutes as $institute)
        <li>{{$institute -> nombre}} </li>
        <li> {{$institute -> pais}}
    @endforeach
    </div>
@endsection