@extends('layouts.app')
@section('content')
<div class="card-header">
    <h2 class="text-center font-weight-bold text-muted">Revisión general del documento</h2>
</div>

<form method="Post" action="">
    {!!csrf_field()!!}
    <input type="hidden" name="document_id" value="#" required>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Nombre de Convenio</th>
                <th colspan="4">&nbsp;</th>
            </tr>
        </thead>
        <tbody>@foreach(Auth::user()->getAgreements as $agreemment)
            <tr>
                <td>{{$agreemment->name}}</td>
                <td><a href="#" class="btn btn-primary">Revisar</a></td>
            </tr>@endforeach</tbody>

    </table>
</form>
@endsection


<li></li>