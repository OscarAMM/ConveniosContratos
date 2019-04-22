@extends('layouts.app')
@section('content')
<div class="text-muted card-header text-center">
<h2>Reporte final</h2>
</div>
<br>
<div class="row d-flex justify-content-center">
    <div class="col-md-10 ">
        <table class="table table-striped table-bordered">
           <!-- <thead class="thead-dark">
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
                    <td><a href="{{route('PDFDownload')}}" class="btn boton">Convertir PDF</a></td> -
                </tr>
                @endforeach
            </tbody>
            </thead> -->
        </table>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Documento</th>
                    <th> Estatales</th>
                    <th> Nacionales</th>
                    <th> Internacionales</th>
                   
                </tr>
            <tbody>
                <tr>
                    <td>Convenios</td>
                    <td>{{$custom_agreement1}}</td>
                    <td>{{$custom_agreement2}}</td>
                    <td>{{$custom_agreement3}}</td>
                  <!--  <td><a href="{{route('PDFDownload')}}" class="btn boton">Convertir PDF</a></td>-->
                </tr>
                <tr>
                    <td>Contrato</td>
                    <td>{{$custom_contract1}}</td>
                    <td>{{$custom_contract2}}</td>
                    <td>{{$custom_contract3}}</td>
                </tr>
            </tbody>
            </thead>
        </table>
        <a href="{{route('PDFDownload')}}" class="btn boton">Converir PDF</a>
    </div>
    @endsection