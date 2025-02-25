@extends('adminlte::page')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Cierres</b>/Crear Cierre</h1>
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
                    <form action="{{url('/admin/cierres/create')}}" id="form_cierre" method="post">
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
                                                            <div class="modal-body  table-responsive">
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
                                            <th>Precio Compra</th>
                                            <th>Precio Venta</th>
                                            <th>Total</th>
                                            <th>Ganancia</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $cont = 1;
                                            $total = 0;
                                            $costo = 0;
                                            $ganancias = 0;
                                            ?>
                                        @foreach($tmp_cierres as $tmp_cierre)

                                            <tr>
                                                <td style="text-align: center">{{$cont++}}</td>
                                                <td>{{$tmp_cierre->producto->codigo}}</td>
                                                <td>{{$tmp_cierre->producto->nombre}}</td>
                                                <td style="text-align: center;vertical-align: middle">{{$tmp_cierre->cantidad}}</td>
                                                <td>
                                                    <input type="number" class="form-control" id="precio_compra" name="precio_compra[]" value="{{$tmp_cierre->producto->precio_compra}}">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" id="precio_venta" name="precio_venta[]" value="{{$tmp_cierre->producto->precio_venta}}">
                                                </td>
                                                <td id="subtotal" style="text-align: center; vertical-align: middle"></td>
                                                <td id="subganancia" style="text-align: center; vertical-align: middle"></td>
                                                <td style="text-align: center">
                                                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{$tmp_cierre->id}}"><i class="far fa-times-circle"></i></button>
                                                </td>
                                            </tr>
                                            @php
                                                $total += $costo;
                                            @endphp
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fecha">Fecha de Cierre</label>
                                            <input type="datetime-local" class="form-control" value="{{old('fecha')}}" id="fecha" name="fecha">
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ganancia">Ganancia</label>
                                            <input type="text" style="background-color: yellow; color: black;text-align: center;font-size: 20px" class="form-control" id="ganancia" name="ganancia" readonly>
                                            @error('ganancia')
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
                                            <a href="{{url('admin/cierres')}}" class="btn btn-secondary btn-block"><i class="fas fa-w fa-arrow-left"></i> Volver</a>
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

        $(document).ready(function() {
            // Función para calcular el subtotal de una fila
            function calcularSubtotal(row) {
                var cantidad = parseFloat(row.find('td:nth-child(4)').text());
                var precioCompra = parseFloat(row.find('input[name="precio_compra[]"]').val());
                var precioVenta = parseFloat(row.find('input[name="precio_venta[]"]').val());
                var subtotal = cantidad * precioVenta;
                var subganancia = (precioVenta - precioCompra) * cantidad;
                row.find('td#subtotal').text(subtotal); // Elimino toFixed(2)
                row.find('td#subganancia').text(subganancia); // Elimino toFixed(2)

                // Retorno un objeto con ambos valores
                return {
                    subtotal: subtotal,
                    subganancia: subganancia
                };
            }

            // Función para guardar los precios en localStorage
            function guardarPreciosEnLocalStorage() {
                var precios = {};
                $('#tmp tbody tr').each(function() {
                    var id = $(this).find('.delete-btn').data('id');
                    var preciocompra = $(this).find('input[name="precio_compra[]"]').val();
                    var precioventa = $(this).find('input[name="precio_venta[]"]').val();
                    // Guarda tanto precio de compra como de venta en un solo objeto
                    precios[id] = {
                        compra: preciocompra,
                        venta: precioventa
                    };
                });
                localStorage.setItem('precios', JSON.stringify(precios));
            }

            // Función para cargar los precios desde localStorage
            function cargarPreciosDesdeLocalStorage() {
                var preciosGuardados = localStorage.getItem('precios');
                if (preciosGuardados) {
                    var precios = JSON.parse(preciosGuardados);
                    $('#tmp tbody tr').each(function() {
                        var id = $(this).find('.delete-btn').data('id');
                        if (precios[id]) {
                            // Carga ambos precios en sus respectivos campos
                            $(this).find('input[name="precio_compra[]"]').val(precios[id].compra);
                            $(this).find('input[name="precio_venta[]"]').val(precios[id].venta);

                            // Recalcular el subtotal al cargar los precios
                            calcularSubtotal($(this));
                        }
                    });
                }
            }


            // Función para recalcular el total general y la ganancia, y mostrarlos en el footer
            function recalcularTotalGeneral() {
                var totalGeneral = 0;
                var totalGanancia = 0;

                $('#tmp tbody tr').each(function() {
                    var resultado = calcularSubtotal($(this));
                    totalGeneral += resultado.subtotal;
                    totalGanancia += resultado.subganancia;
                });

                // Mostrar el total general en el footer
                $('#tmp tfoot td.total-general b').text(totalGeneral);

                // Mostrar la ganancia total en el footer
                $('#tmp tfoot td.total-ganancia b').text(totalGanancia);

                // Actualizar el input con el id "total"
                $('#total').val(totalGeneral);
                $('#ganancia').val(totalGanancia);
            }


            // Evento al presionar "Enter" en el input "precio_compra"
            $('#tmp tbody').on('keypress', 'input[name="precio_compra[]"], input[name="precio_venta[]"]', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    var row = $(this).closest('tr');
                    var precioVenta = row.find('input[name="precio_venta[]"]').val();

                    // Verifica si el precio de venta está vacío o es cero
                    if (precioVenta === '' || parseFloat(precioVenta) <= 0) {
                        row.find('input[name="precio_venta[]"]').focus();
                    } else {
                        calcularSubtotal(row);
                        guardarPreciosEnLocalStorage();
                        recalcularTotalGeneral();
                    }
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


        $('.delete-btn').click(function () {
            var id= $(this).data('id');
            if (id){
                $.ajax({
                    url:"{{url('/admin/cierres/create/tmp')}}/"+id,
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

        $('#form_cierre').on('keypress', function (e) {
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
                        url:"{{route('admin.cierres.tmp_cierres')}}",
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






