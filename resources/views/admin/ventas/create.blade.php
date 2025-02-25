@extends('adminlte::page')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Ventas</b>/Crear Venta</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">

                </ol>
            </div>
        </div>
    </div>

    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-body">
                    <form action="{{url('/admin/ventas/create')}}" id="form_venta" method="post">
                        @csrf
                        <div class="row">

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad</label>
                                            <input type="number" style="text-align: center; background-color: #a8ff80; color: black" name="cantidad" value="1" id="cantidad" class="form-control"  required autofocus>
                                            @error('cantidad')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="codigo">Codigo</label>
                                        <div class="input-group">
                                            <input type="text" name="codigo" id="codigo" class="form-control">
                                            <div class="input-group-append">
                                                <button type="button" class="input-group-text bg-success" data-toggle="modal" data-target="#modal-lg">
                                                    <i class="fas fa-search"></i>
                                                </button>

                                                <!-- /.modal -->

                                                <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Listado de Productos</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body table-responsive">
                                                                <table class="table table-bordered table-hover table-sm table-striped" id="mitabla">
                                                                    <thead>
                                                                    <tr>
                                                                        <th style="text-align: center">N°</th>
                                                                        <th>Accion</th>
                                                                        <th>Imagen</th>
                                                                        <th>Codigo</th>
                                                                        <th>Nombre</th>
                                                                        <th>Descripcion</th>
                                                                        <th>Existencia</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $contador = 1;
                                                                        ?>
                                                                    @foreach($productos as $producto)
                                                                        <tr>
                                                                            <td style="text-align: center">{{$contador++}}</td>
                                                                            <td style="text-align: center; vertical-align: middle">
                                                                                <button type="button" class="btn btn-info seleccionar-btn" data-codigo="{{$producto->codigo}}" ><i class="fas fa-w fa-check"></i></button>
                                                                            </td>
                                                                            <td>
                                                                                <img src="{{asset('storage/'.$producto->imagen)}}" alt="sin imagen" class="img-circle" width="50px">
                                                                            </td>
                                                                            <td>{{$producto->codigo}}</td>
                                                                            <td>{{$producto->nombre}}</td>
                                                                            <td>{{$producto->descripcion}}</td>
                                                                            <td>
                                                                                <center>
                                                                                    @if($producto->stock > 0)
                                                                                        <span class="badge bg-success" style="font-size: 15px">{{$producto->stock}}</span>
                                                                                    @else
                                                                                        <span class="badge bg-danger" style="font-size: 15px">{{$producto->stock}}</span>
                                                                                    @endif
                                                                                </center>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach

                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>

                                                <!-- /.Final modal -->
                                            </div>
                                            <div class="input-group-append">
                                                <a href="{{url('admin/productos/create')}}" class="input-group-text bg-primary"><i class="fas fa-plus"></i></a>
                                            </div>
                                        </div>
                                        @error('codigo')
                                        <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <table class="table table-sm table-striped table-bordered" id="tmp">
                                        <thead>
                                        <tr style="background-color: #b6b3b3">
                                            <th>N°</th>
                                            <th>Codigo</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $cont = 1;
                                            $total = 0;
                                            $costo = 0;
                                            ?>
                                        @foreach($tmp_ventas as $tmp_venta)

                                            <tr>
                                                <td style="text-align: center">{{$cont++}}</td>
                                                <td>{{$tmp_venta->producto->codigo}}</td>
                                                <td>{{$tmp_venta->producto->nombre}}</td>
                                                <td style="text-align: center;vertical-align: middle">{{$tmp_venta->cantidad}}</td>
                                                <td>
                                                    <input type="number" class="form-control" id="precio_venta" name="precio_venta[]" value="{{$tmp_venta->producto->precio_venta}}">
                                                </td>
                                                <td id="subtotal" style="text-align: center; vertical-align: middle"></td>
                                                <td style="text-align: center">
                                                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{$tmp_venta->id}}"><i class="far fa-times-circle"></i></button>
                                                </td>
                                            </tr>
                                            @php
                                                $total += $costo;
                                            @endphp
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="5" style="text-align: right;background-color: #b6b3b3;color: black"><b>Total</b></td>
                                            <td style="text-align: center">
                                                <b>{{$total}}</b>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="cliente">Cliente</label>
                                        <div class="input-group">
                                            <input type="hidden" name="cliente_id" id="cliente_id">
                                            <input type="text" name="cliente" id="cliente" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <button type="button" class="input-group-text bg-success" data-toggle="modal" data-target="#modal-lg2">
                                                    <i class="fas fa-user-plus"></i>
                                                </button>

                                                <!-- /.modal -->

                                                <div class="modal fade" id="modal-lg2" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Listado de Clientes</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body table-responsive">
                                                                <table class="table table-bordered table-hover table-sm table-striped " id="mitabla2">
                                                                    <thead>
                                                                    <tr>
                                                                        <th style="text-align: center">N°</th>
                                                                        <th style="text-align: center">Accion</th>
                                                                        <th>Nombre</th>
                                                                        <th>Cedula</th>
                                                                        <th>Celular</th>
                                                                        <th>Direccion</th>
                                                                        <th>Correo</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $contador = 1;
                                                                        ?>
                                                                    @foreach($clientes as $cliente)
                                                                        <tr>
                                                                            <td style="text-align: center">{{$contador++}}</td>
                                                                            <td style="text-align: center; vertical-align: middle">
                                                                                <button type="button" class="btn btn-info seleccionar2-btn" data-cliente="{{$cliente->nombre_cliente}}" data-id="{{$cliente->id}}"><i class="fas fa-w fa-check"></i></button>
                                                                            </td>
                                                                            <td>{{$cliente->nombre_cliente}}</td>
                                                                            <td>{{$cliente->cedula}}</td>
                                                                            <td>{{$cliente->telefono}}</td>
                                                                            <td>{{$cliente->direccion}}</td>
                                                                            <td>{{$cliente->correo}}</td>
                                                                        </tr>
                                                                    @endforeach

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>

                                                <!-- /.Final modal -->

                                            </div>
                                            <div class="input-group-append">
                                                <button type="button" class="input-group-text bg-primary" data-toggle="modal" data-target="#modal-lgR">
                                                    <i class="fas fa-plus"></i>
                                                </button>

                                                <!-- /.modal -->

                                                <div class="modal fade" id="modal-lgR" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Crear Cliente</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{url('/admin/clientes/create')}}" method="post">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="nombre">Nombre</label>
                                                                                <input type="text" value="{{old('nombre')}}" id="nombre" class="form-control" autofocus>
                                                                                @error('nombre')
                                                                                <small style="color: red;">{{$message}}</small>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="cedula">Cedula</label>
                                                                                <input type="text" value="{{old('cedula')}}" id="cedula" class="form-control">
                                                                                @error('cedula')
                                                                                <small style="color: red;">{{$message}}</small>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="celular">Celular</label>
                                                                                <input type="text"  value="{{old('celular')}}" id="celular" class="form-control">
                                                                                @error('celular')
                                                                                <small style="color: red;">{{$message}}</small>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="direccion">Dirección</label>
                                                                                <input type="text" value="{{old('direccion')}}" id="direccion" class="form-control" >
                                                                                @error('direccion')
                                                                                <small style="color: red;">{{$message}}</small>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="correo">Correo</label>
                                                                                <input type="email" value="{{old('correo')}}" id="correo" class="form-control" >
                                                                                @error('correo')
                                                                                <small style="color: red;">{{$message}}</small>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                        <button type="button" onclick="guardar_cliente()" class="btn btn-outline-success"><i class="fas fa-w fa-check"></i> Guardar</button>

                                                                    </div>

                                                                </form>
                                                            </div>

                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>

                                                <!-- /.Final modal -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="fecha">Fecha de venta</label>
                                            <input type="datetime-local" class="form-control" value="{{old('fecha',date('Y-m-d H:i:s'))}}" id="fecha" name="fecha">
                                            @error('fecha')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="total">Total</label>
                                            <input type="text" style="background-color: yellow; color: black;text-align: center;font-size: 20px" class="form-control" id="total" name="total" readonly>
                                            @error('total')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-outline-success btn-block"><i class="fas fa-w fa-check"></i> Guardar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <a href="{{url('admin/ventas')}}" class="btn btn-secondary btn-block"><i class="fas fa-w fa-arrow-left"></i> Volver</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>

        function guardar_cliente() {
            const data = {
                nombre:$('#nombre').val(),
                cedula:$('#cedula').val(),
                celular:$('#celular').val(),
                direccion:$('#direccion').val(),
                correo:$('#correo').val(),
                _token:'{{csrf_token()}}',
            };
            $.ajax({
               url:'{{route("admin.ventas.cliente.store")}}',
                type:'POST',
                data: data,
                success:function (response) {
                   $('#modal-lgR').modal('hide');
                    location.reload();
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        position: "center",
                        title: "No fue posible registrar al cliente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }

        $(document).ready(function() {
            // Función para calcular el subtotal de una fila
            function calcularSubtotal(row) {
                var cantidad = parseFloat(row.find('td:nth-child(4)').text());
                var precioUnitario = parseFloat(row.find('input[name="precio_venta[]"]').val());
                var subtotal = cantidad * precioUnitario;
                row.find('td#subtotal').text(subtotal); // Elimino toFixed(2)
                return subtotal;
            }

            // Función para guardar los precios en localStorage
            function guardarPreciosEnLocalStorage() {
                var precios = {};
                $('#tmp tbody tr').each(function() {
                    var id = $(this).find('.delete-btn').data('id');
                    var precio = $(this).find('input[name="precio_venta[]"]').val();
                    precios[id] = precio;
                });
                localStorage.setItem('precios_venta', JSON.stringify(precios));
            }

            // Función para cargar los precios desde localStorage
            function cargarPreciosDesdeLocalStorage() {
                var preciosGuardados = localStorage.getItem('precios_venta');
                if (preciosGuardados) {
                    var precios = JSON.parse(preciosGuardados);
                    $('#tmp tbody tr').each(function() {
                        var id = $(this).find('.delete-btn').data('id');
                        if (precios[id]) {
                            $(this).find('input[name="precio_venta[]"]').val(precios[id]);
                            calcularSubtotal($(this)); // Recalcular el subtotal al cargar el precio
                        }
                    });
                }
            }

            // Función para recalcular el total general y mostrarlo en el footer
            function recalcularTotalGeneral() {
                var totalGeneral = 0;
                $('#tmp tbody tr').each(function() {
                    totalGeneral += calcularSubtotal($(this));
                });
                $('#tmp tfoot td:last b').text(totalGeneral); // Elimino toFixed(2)

                // Actualizar el input con el id "total"
                $('#total').val(totalGeneral);
            }

            // Evento al presionar "Enter" en el input "precio_compra"
            $('#tmp tbody').on('keypress', 'input[name="precio_venta[]"]', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    var row = $(this).closest('tr');
                    calcularSubtotal(row);
                    guardarPreciosEnLocalStorage();
                    recalcularTotalGeneral();
                }
            });

            // Cargar los precios desde localStorage al cargar la página
            cargarPreciosDesdeLocalStorage();

            // Recalcular el total general al cargar la página
            recalcularTotalGeneral();
        });


        $('.seleccionar-btn').click(function () {
            var codigo_producto = $(this).data('codigo');
            $('#codigo').val(codigo_producto);
            $('#modal-lg').modal('hide');
            $('#modal-lg').on('hidden.bs.modal',function () {
                $('#codigo').focus();
            })
        });

        $('.seleccionar2-btn').click(function () {
            var cliente = $(this).data('cliente');
            var id = $(this).data('id');
            $('#cliente').val(cliente);
            $('#cliente_id').val(id);
            $('#modal-lg2').modal('hide');
        });

        $('.delete-btn').click(function () {
            var id= $(this).data('id');
            if (id){
                $.ajax({
                    url:"{{url('/admin/ventas/create/tmp')}}/"+id,
                    type:'POST',
                    data:{
                        _token:'{{csrf_token()}}',
                        _method:'DELETE',
                    },
                    success:function (response) {
                        if (response.success){
                            location.reload();
                        }else {
                            Swal.fire({
                                position: "center",
                                title: "Error",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error:function (error) {
                        alert(error);
                    }
                });
            }
        });
        $('#codigo').focus();

        $('#form_venta').on('keypress', function (e) {
            if (e.keyCode === 13){
                e.preventDefault();
            }
        });
        $('#codigo').on('keyup',function (e) {
            if (e.which === 13){
                var codigo = $(this).val();
                var cantidad = $('#cantidad').val();

                if (codigo.length > 0){
                    $.ajax({
                        url:"{{route('admin.ventas.tmp_ventas')}}",
                        method:'POST',
                        data:{
                            _token:'{{csrf_token()}}',
                            codigo: codigo,
                            cantidad: cantidad,
                        },
                        success:function (response) {
                            if (response.success){
                                location.reload();
                            }else {
                                Swal.fire({
                                    position: "center",
                                    title: "Producto no exisistente",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error:function (error) {
                            alert(error);
                        }
                    });
                }
            }

        });

    </script>
    <script>

        $('#mitabla2').DataTable({
            "pageLength":10,
            "language":{
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas ",
                "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total Entradas)",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loandingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador",
                "zeroRecords": "Sin Resultados Encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior",
                },
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            buttons: [
                {text: '<i class="fas fa-copy"></i> COPIAR', extend: 'copy', className: 'btn btn-default'},
                {text: '<i class="fas fa-file-pdf"></i> PDF', extend: 'pdf', className: 'btn btn-danger'},
                {text: '<i class="fas fa-file-excel"></i> EXCEL', extend: 'excel', className: 'btn btn-success'},
                {text: '<i class="fas fa-print"></i> IMPRIMIR', extend: 'print', className: 'btn btn-warning'}
            ]
        }).buttons().container().appendTo('#example1_wrapper .row:eq(0)');


        $('#mitabla').DataTable({
            "pageLength":10,
            "language":{
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas ",
                "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total Entradas)",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loandingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador",
                "zeroRecords": "Sin Resultados Encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior",
                },
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            buttons: [
                {text: '<i class="fas fa-copy"></i> COPIAR', extend: 'copy', className: 'btn btn-default'},
                {text: '<i class="fas fa-file-pdf"></i> PDF', extend: 'pdf', className: 'btn btn-danger'},
                {text: '<i class="fas fa-file-excel"></i> EXCEL', extend: 'excel', className: 'btn btn-success'},
                {text: '<i class="fas fa-print"></i> IMPRIMIR', extend: 'print', className: 'btn btn-warning'}
            ]
        }).buttons().container().appendTo('#example1_wrapper .row:eq(0)');

    </script>
@stop





