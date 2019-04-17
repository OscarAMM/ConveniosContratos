<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PDF</title>
</head>

<body>
    <div class="card">
        <div class="card-header text-muted text-center" style="">
            <h1>Sistema de contratos y convenios</h1>
        </div>
        <div class="card-body">
            <h2>Oficina del Abogado General de la Universidad Autónoma de Yucatán</h2>
        </div>
        <hr>
    </div>
    <div>
        <p>El presente documento tiene como finalidad listar el número de contratos que se han realizado a lo largo del
            semestre</p>
    </div>
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
    <div>
        <footer>Dirección: Calle 57 No. 491 A x 60 y 62 Col. Centro, C.P. 97000 Teléfono/Fax: +52 (999) 930-0900
            Extensión:
            1151
        </footer>
    </div>

</body>


</html>