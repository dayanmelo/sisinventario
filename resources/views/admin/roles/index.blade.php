@extends('adminlte::page')


@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Roles</b>/Listado de Roles</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="{{url('/admin/roles/create')}}" class="btn btn-sm btn-primary">
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
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover table-sm table-striped" id="mitabla">
                        <thead>
                        <tr>
                            <th style="text-align: center">N°</th>
                            <th>Rol</th>
                            <th style="text-align: center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $contador = 1;
                        ?>
                        @foreach($roles as $role)
                            <tr>
                                <td style="text-align: center">{{$contador++}}</td>
                                <td>{{$role->name}}</td>
                                <td style="text-align: center">
                                    <div class="btn-group">
                                        <a href="{{url('/admin/roles',$role->id)}}" class="btn btn-info"><i class="fas fa-w fa-eye"></i></a>
                                        <a href="{{url('/admin/roles/'.$role->id.'/asignar')}}" class="btn btn-primary"><i class="fas fa-user-check"></i></a>
                                        <a href="{{url('/admin/roles/'.$role->id.'/edit')}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="{{url('/admin/roles',$role->id)}}" method="post"
                                              onclick="preguntar{{$role->id}}(event)" id="miFormulario{{$role->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border-radius: 0px 5px 5px 0px" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <script>
                                            function preguntar{{$role->id}}(event){
                                                event.preventDefault();
                                                Swal.fire({
                                                    title: "¿Seguro desea eliminar este registro?",
                                                    showDenyButton: true,
                                                    confirmButtonText: "Eliminar",
                                                    denyButtonText: `Cancelar`,
                                                    denyButtonColor:'#f50430',
                                                }).then((result) => {
                                                    /* Read more about isConfirmed, isDenied below */
                                                    if (result.isConfirmed) {
                                                        var form = $('#miFormulario{{$role->id}}');
                                                        form.submit();
                                                        Swal.fire({
                                                            position: "center",
                                                            title: "Se elimino el rol exitosamente",
                                                            showConfirmButton: false,
                                                            timer: 1500
                                                        });
                                                    } else if (result.isDenied) {
                                                        Swal.fire({
                                                            position: "center",
                                                            title: "Se cancelo el proceso",
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
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
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

