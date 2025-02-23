@extends('adminlte::page')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Ventas</b>/Listado de Ventas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="{{url('/admin/ventas/create')}}" class="btn btn-sm btn-primary">
                        Crear nuevo
                    </a>
                </ol>
            </div>
        </div>
    </div>

    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <!--div class="card-header">
                    <h3 class="card-title"></h3>
                    <div class="card-tools">

                    </div>
                </div-->
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover table-sm table-striped" id="mitabla">
                        <thead>
                        <tr>
                            <th style="text-align: center">N°</th>
                            <th>Fecha de Venta</th>
                            <th>Cliente</th>
                            <th>Productos</th>
                            <th>Total</th>
                            <th style="text-align: center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $contador = 1;
                        ?>
                        @foreach($ventas as $venta)

                            <tr @if($venta->estado == '1') style="background-color: #fe4848;color: white" @endif>
                                <td style="text-align: center">{{$contador++}}</td>
                                <td>{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y h:i a') }}</td>
                                <td>
                                    {{$venta->cliente->nombre_cliente}}
                                </td>
                                <td style="text-align: center; vertical-align: middle">
                                    <button class="btn btn-info btn-sm"
                                            data-toggle="modal"
                                            data-target="#modal-productos-{{$venta->id}}"
                                            data-detalles='@json($venta->detallesventa)'>
                                        Ver Productos
                                    </button>
                                </td>


                                <td style=" text-align: center; vertical-align: middle">
                                    <b class="badge bg-success" style="font-size: 15px;">$ {{number_format($venta->precio_total,0,',','.')}}</b>
                                </td>
                                <td style="text-align: center">
                                    <div class="btn-group">
                                        @if($venta->estado == '0')
                                            <a href="{{url('/admin/ventas',$venta->id)}}" class="btn btn-info"><i class="fas fa-w fa-eye"></i></a>
                                            <a href="{{url('/admin/ventas/'.$venta->id.'/edit')}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="{{url('/admin/ventas',$venta->id)}}" method="post"
                                                  onclick="preguntar{{$venta->id}}(event)" id="miFormulario{{$venta->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border-radius: 0px 5px 5px 0px; "   class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        @else
                                            <a href="{{url('/admin/ventas',$venta->id)}}" class="btn btn-info"><i class="fas fa-w fa-eye"></i></a>
                                        @endif

                                        <script>
                                            function preguntar{{$venta->id}}(event){
                                                event.preventDefault();
                                                Swal.fire({
                                                    title: "¿Seguro desea anular esta venta?",
                                                    showDenyButton: true,
                                                    confirmButtonText: "Anular",
                                                    denyButtonText: `Cancelar`,
                                                    denyButtonColor:'#f50430',
                                                }).then((result) => {
                                                    /* Read more about isConfirmed, isDenied below */
                                                    if (result.isConfirmed) {
                                                        var form = $('#miFormulario{{$venta->id}}');
                                                        form.submit();
                                                        Swal.fire({
                                                            position: "center",
                                                            title: "Se anulo la Venta exitosamente",
                                                            showConfirmButton: false,
                                                            timer: 1500
                                                        });
                                                    } else if (result.isDenied) {
                                                        Swal.fire({
                                                            position: "center",
                                                            title: "Proceso Cancelado",
                                                            showConfirmButton: false,
                                                            timer: 1500
                                                        });
                                                    }
                                                });
                                            }
                                        </script>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            @foreach ($ventas as $venta)
                <div class="modal fade" id="modal-productos-{{ $venta->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title">Productos de la Compra <strong style="font-size: 20px" class="badge bg-primary">{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y h:i a') }}</strong></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Tabla de productos -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($venta->detallesventa as $detalle)
                                            <tr>
                                                <td>{{ $detalle->producto->codigo  }}</td>
                                                <td>{{ $detalle->producto->nombre  }}</td>
                                                <td>{{ $detalle->cantidad }}</td>
                                                <td>$ {{ number_format($detalle->precio_unitario, 0,',','.') }}</td>
                                                <td>$ {{ number_format($detalle->cantidad * $detalle->precio_unitario, 0,',','.') }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop

@section('css')
    <style>
        #example1_wrapper .dt-buttons{
            background-color: transparent;
            box-shadow: none;
            border: none;
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        #example1_wrapper .btn{
            color: #fff;
            border-radius: 4px;
            padding: 5px 15px;
            font-size: 14px;
        }

        .btn-danger {background-color: #dc3545;border: none;}
        .btn-success {background-color: #28a745;border: none;}
        .btn-info {background-color: #17a2b8; border: none;}
        .btn-warning {background-color: #ffc107; border: none;}
        .btn-default {background-color: #6e7176; border: none;}
    </style>
@stop

@section('js')





    <script>

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
