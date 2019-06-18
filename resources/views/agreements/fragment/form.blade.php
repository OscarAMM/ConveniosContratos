<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<div class="container">
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h3>Agregar nuevo</h3>
            <hr style="border:2px solid #BF942D">
            <div class="form-group">
                <p>Se recomienda agregar <i>Nuevo instrumento</i> y <i>Nuevas Partes</i> antes de llenar el formulario,
                    para
                    evitar pérdidas de información al momento de llenar el formulario.</p>
                <button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#exampleModal"
                    data-whatever="@fat">Nuevo Instrumento</button>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#suscrito"
                    data-whatever="@fat">Nuevas partes</button>
            </div>

        </div>
        <div class="col-md-8 order-md-1">
            <h3>Formulario</h3>
            <hr style="border:2px solid #BF942D">
            <form method="POST" action="#">
                <div class="form-group">
                    <small style="color:#D90101;">*</small>
                    <label for="name" class="col-form-label">Nombre completo del documento </label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nombre del documento">
                </div>
                <div class="form-group">
                    <small style="color:#D90101;">*</small>
                    <label for="legalInstrument" class="col-form-label ">Instrumento jurídico</label>
                    <div class="form-group ">
                        <input type="text" id="legalInstrument" name="legalInstrument" class="form-control"
                            placeholder="Ingrese instrumento" autocomplete="off">

                    </div>
                    <div id="instrumentList">
                    </div>
                </div>
                <div class="form-group ">
                    <small style="color:#D90101;">*</small>
                    <label for="reception" class="col-form-label">Recepción</label>
                    <input type="date" id="reception" name="reception" class="form-control"
                        value={{Carbon\Carbon::now()}}>
                </div>
                <div class="form-group ">
                    <small style="color:#D90101;">*</small>
                    <label for="end_date" class="col-form-label">Fecha final de revisión</label>
                    <input type="date" id="end_date" name="end_date" class="form-control"
                        value={{Carbon\Carbon::now()->addWeekDays(5)}}>
                </div>
                <div class="form-group">
                    <small style="color:#D90101;">*</small>
                    <label for="objective" class=" col-form-label">Objetivo</label>
                    <textarea name="objective" id="objective" cols="30" rows="5" class="form-control"
                        placeholder="Describe el objetivo"></textarea>
                </div>
                <div class="form-group">
                    <small style="color:#D90101;">*</small>
                    <label for="instrumentType" class=" col-form-label">Tipo de instrumento</label>
                    <select name="instrumentType" id="instrumentType" class="form-control">
                        <option>Específico</option>
                        <option>General</option>
                        <option>Otros</option>
                    </select>
                </div>

                <div class="form-group">
                    <small style="color:#D90101;">*</small>
                    <label for="scope" class="col-form-label">Ámbito</label>
                    <select name="scope" id="scope" class="form-control">
                        <option>Estatal</option>
                        <option>Nacional</option>
                        <option>Internacional</option>
                    </select>
                </div>
                <div class="form-group">
                    <small style="color:#D90101;">*</small>
                    <label for="liable_user" class="col-form-label">Asigne Externos</label>
                    <input type="text" id="liable_user" name="liable_user" class="form-control "
                        placeholder="ingrese responsable externo">

                </div>
                <div class="form-check">
                    <small style="color:#D90101;">*</small>
                    <label for="user_id" class="col-form-label">Asigne Internos</label>
                    @foreach($users as $user)
                    @if($user->hasRole('admin')||$user->hasRole('revisor'))
                    <br>
                    <input type="checkbox" name="users[]" value="{{$user->id}}" class="form-check-input">
                    <label class="form-check-label">{{$user->name}}</label>
                    @endif
                    @endforeach
                </div>
                <from>
                    <label for="ListaPro" class="col-form-label">Asigne Partes</label>
                    <br>
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#myModal">Asignar</button>

                    <input type="hidden" id="ListaPro" name="ListaPro" value="" required />
                    <table id="TablaPro" class="table">
                        <thead>
                            <tr>
                                <th>Parte</th>

                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="ProSelected">
                            <!--Ingreso un id al tbody-->
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                </from>
                <div class="form-group">
                    <small>*</small>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <label for="file" class="col-form-label">Seleccione el archivo</label>
                    <input type="file" class="form-control-file" name="file" id="file">
                </div>
                {{csrf_field()}}
            </form>
            <div class="form-group text-center" style="margin-top:5px">
                <a href="{{route ('Agreement.index')}}" class="btn btn-secondary">Regresar</a>
                {!!Form::submit('Guardar',['class' => 'btn btn-primary'])!!}

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <small style="color:#D90101;">* Obligatorio</small> <small>*Opcional</small>
        </div>
    </div>
</div>
</div>
</div>
<!-- Modal for people-->
<div class="modal fade" id="myModal" role="dialog">

    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar Parte a la lista</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Parte</label>
                    <input type="text" id="pro_id" name="pro_id" data-width='100%' class="form-control col-md-11"
                        placeholder="ingrese suscrito">
                    <div id="proList">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!--Uso la funcion onclick para llamar a la funcion en javascript-->
                <button type="button" onclick="agregarProducto()" class="btn btn-default"
                    data-dismiss="modal">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!--   -->

<!--MODAL FOR THE LEGAL INSTRUMENT -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Instrumento jurídico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('newInstrument')}}">
                    <div class="form-group mb-2">
                        <small style="color:#D90101;">*</small>
                        <label for="legalInstrument">Instrumento jurídico</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Instrumento jurídico">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
                <div class="row">
                    <div class="col">
                        <small style="color:#D90101;">* Obligatorio</small> <small>*Opcional</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL FOR ASIGNED USERS -->
<div class="modal fade" id="suscrito" tabindex="-1" role="dialog" aria-labelledby="suscrito" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="suscrito">Suscrito</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('PersonModal')}}">
                    <div class="form-group mb-2">
                        <small style="color:#D90101;">*</small>
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del suscrito">

                    </div>
                    <div class="form-group mb-2">
                        <small style="color:#D90101;">*</small>
                        <label for="personType">Tipo</label>
                        <select name="personType" id="personType" class="form-control">
                            <option>Persona física</option>
                            <option>Persona moral</option>
                            <option>Institución</option>
                            <option>Dependencia</option>
                            <option>Otros</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <small style="color:#D90101;">*</small>
                        <label for="country">País</label>
                        <input type="text" class="form-control" id="country" name="country" placeholder="País">
                    </div>
                    <div class="form-group mb-2">
                        <small style="color:#897979">*</small>
                        <label for="acronym">Siglas</label>
                        <input type="text" class="form-control" id="acronym" name="acronym" placeholder="Siglas">

                    </div>
                    <div class="form-group mb-2">
                        <small style="color:#897979">*</small>
                        <label for="email">correo</label>
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="email del suscrito">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
                <div class="row">
                    <div class="col">
                        <small style="color:#D90101;">* Obligatorio</small> <small>*Opcional</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<script>
$.noConflict();
jQuery(document).ready(function() {
    $('#pro_id').keyup(function() {
        var query = $(this).val();
        if (query != '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('autocomplete.fetch') }}",
                method: "POST",
                data: {
                    query: query,
                    _token: _token
                },
                success: function(data) {
                    $('#proList').fadeIn();
                    $('#proList').html(data);
                }
            });
        }
    });

    jQuery('#proList').on('click', 'li', function() {
        $('#pro_id').val($(this).text());
        $('#proList').fadeOut();
    });

    $('#legalInstrument').keyup(function() {
        var query = $(this).val();
        if (query != '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('autocomplete.fetchInstruments') }}",
                method: "POST",
                data: {
                    query: query,
                    _token: _token
                },
                success: function(data) {
                    $('#instrumentList').fadeIn();
                    $('#instrumentList').html(data);
                }
            });
        }
    });

    jQuery('#instrumentList').on('click', 'li', function() {
        $('#legalInstrument').val($(this).text());
        $('#instrumentList').fadeOut();
    });





});
</script>
<script type="text/javascript">
// Refresca Producto: Refresco la Lista de Productos dentro de la Tabla
// Si es vacia deshabilito el boton guardar para obligar a seleccionar al menos un producto al usuario
// Sino habilito el boton Guardar para que pueda Guardar
function RefrescaProducto() {
    var ip = [];
    var i = 0;
    $('#guardar').attr('disabled', 'disabled'); //Deshabilito el Boton Guardar
    $('.item').each(function(index, element) {
        i++;
        ip.push({
            id_pro: $(this).text()
        });
    });
    // Si la lista de Productos no es vacia Habilito el Boton Guardar
    if (i > 0) {
        $('#guardar').removeAttr('disabled', 'disabled');
    }
    var ipt = JSON.stringify(ip); //Convierto la Lista de Productos a un JSON para procesarlo en tu controlador
    $('#ListaPro').val(encodeURIComponent(ipt));
}

function agregarProducto() {

    var sel = $('#pro_id').val(); //Capturo el Value del Producto
    var text = $('#pro_id').text(); //Capturo el Nombre del Producto- Texto dentro del Select
    var sptext = text.split();
    var newtr = '<tr class="item" value"' + sel + '" data-id="' + sel + '">';
    newtr = newtr + '<td class="iProduct" value"' + sel + '">' + sel + '</td>';
    newtr = newtr +
        '<td><button type="button" class="btn btn-danger btn-xs remove-item"><i class="fa fa-times"></i></button></td></tr>';

    $('#ProSelected').append(newtr); //Agrego el Producto al tbody de la Tabla con el id=ProSelected

    RefrescaProducto(); //Refresco Productos

    $('.remove-item').off().click(function(e) {
        $(this).parent('td').parent('tr').remove(); //En accion elimino el Producto de la Tabla
        if ($('#ProSelected tr.item').length == 0)
            $('#ProSelected .no-item').slideDown(300);
        RefrescaProducto();
    });
    $('.item').off().change(function(e) {
        RefrescaProducto();
    });
}
</script>