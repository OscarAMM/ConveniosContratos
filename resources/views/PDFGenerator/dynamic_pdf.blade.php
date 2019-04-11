@extends('layouts.app')
@section('content')

<div class="row d-flex justify-content-center">
        <div class="col-md-10 ">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Recepción</th>
                        <th>Objetivo</th>
                        <th>Fecha de validez</th>
                        <th>Ámbito</th>
                    </tr>
                <tbody>
                    @foreach($custom_data as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->reception}}</td>
                        <td>{{$data->objective}}</td>
                        <td>{{$data->agreementValidity}}</td>
                        <td>{{$data->scope}}</td>
                        <td><a href="{{route('PDFDownload', $data ->id)}}" class="btn boton">Convertir PDF</a></td>
                    </tr>
                   @endforeach
                </tbody>
                </thead>
            </table>
        </div>
        @endsection