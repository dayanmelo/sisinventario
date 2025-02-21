@extends('adminlte::page')


@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Productos</b>/Listado de Productos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="{{url('/admin/productos/create')}}" class="btn btn-sm btn-primary">
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
                            <th>Imagen</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Descripcion</th>
                            <th>Existencia</th>
                            <th style="text-align: center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $contador = 1;
                        ?>
                        @foreach($productos as $producto)
                            <tr>
                                <td style="text-align: center">{{$contador++}}</td>
                                <td>
                                    <img src="{{asset('storage/'.$producto->imagen)}}" alt="sin imagen" class="img-circle" width="50px">
                                </td>
                                <td>{{$producto->codigo}}</td>
                                <td>{{$producto->nombre}}</td>
                                <td>{{$producto->categoria->nombre}}</td>
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
                                <td style="text-align: center">
                                    <div class="btn-group">
                                        <a href="{{url('/admin/productos',$producto->id)}}" class="btn btn-info"><i class="fas fa-w fa-eye"></i></a>
                                        <a href="{{url('/admin/productos/'.$producto->id.'/edit')}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="{{url('/admin/productos',$producto->id)}}" method="post"
                                              onclick="preguntar{{$producto->id}}(event)" id="miFormulario{{$producto->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border-radius: 0px 5px 5px 0px" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <script>
                                            function preguntar{{$producto->id}}(event){
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
                                                        var form = $('#miFormulario{{$producto->id}}');
                                                        form.submit();
                                                        Swal.fire({
                                                            position: "center",
                                                            title: "Se elimino el producto exitosamente",
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


