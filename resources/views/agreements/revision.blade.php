@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre del convenio</th>
                        <th scope="col">Revisión</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(Auth::user()->getAgreements as $agreemment)
                    {!!csrf_field()!!}
                    <tr>
                        <th scope="row">{{$agreemment->name}}</th>
                        <td><a href="#" class="btn btn-primary">Revisión</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
<!-- tabla de contratos-->
        <div class="col">
        <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre del contrato</th>
                        <th scope="col">Revisión</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(Auth::user()->getContracts as $contract)
                    {!!csrf_field()!!}
                    <tr>
                        <th scope="row">{{$contract->name}}</th>
                        <td><a href="#" class="btn btn-primary">Revisión</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>





@endsection