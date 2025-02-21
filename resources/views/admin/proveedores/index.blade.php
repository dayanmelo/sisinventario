@extends('adminlte::page')


@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Proveedores</b>/Listado de Proveedores</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="{{url('/admin/proveedores/create')}}" class="btn btn-sm btn-primary">
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
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div class="card-tools">

                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover table-sm table-striped" id="mitabla">
                        <thead>
                        <tr>
                            <th style="text-align: center">N°</th>
                            <th>Empresa</th>
                            <th>Direccion Empresa</th>
                            <th>Nombre Proveedor</th>
                            <th>Celular Proveedor</th>
                            <th>Correo Empresa</th>
                            <th style="text-align: center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $contador = 1;
                        ?>
                        @foreach($proveedores as $proveedore)
                            <tr>
                                <td style="text-align: center">{{$contador++}}</td>
                                <td>
                                    {{$proveedore->empresa}}
                                </td>
                                <td>{{$proveedore->direccion}}</td>
                                <td>{{$proveedore->nombre}}</td>
                                <td>
                                    <a href="https://Wa.me/{{$empresa->codigo_postal.$proveedore->celular}}" target="_blank" class="btn btn-success"><i class="fas fa-w fa-mobile"></i> {{$proveedore->celular}}</a>
                                </td>
                                <td>{{$proveedore->correo}}</td>
                                <td style="text-align: center">
                                    <div class="btn-group">
                                        <a href="{{url('/admin/proveedores',$proveedore->id)}}" class="btn btn-info"><i class="fas fa-w fa-eye"></i></a>
                                        <a href="{{url('/admin/proveedores/'.$proveedore->id.'/edit')}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="{{url('/admin/proveedores',$proveedore->id)}}" method="post"
                                              onclick="preguntar{{$proveedore->id}}(event)" id="miFormulario{{$proveedore->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border-radius: 0px 5px 5px 0px" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <script>
                                            function preguntar{{$proveedore->id}}(event){
                                                event.preventDefault();
                                                Swal.fire({
                                                    title: "¿Seguro desea eliminar este registro?",
                                                    showDenyButton: true,
                                                    confirmButtonText: "Eliminar",
                                                    denyButtonText: `No,Eliminar`,
                                                    denyButtonColor:'#f50430',
                                                }).then((result) => {
                                                    /* Read more about isConfirmed, isDenied below */
                                                    if (result.isConfirmed) {
                                                        var form = $('#miFormulario{{$proveedore->id}}');
                                                        form.submit();
                                                        Swal.fire({
                                                            position: "center",
                                                            title: "Se elimino el proveedor exitosamente",
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


