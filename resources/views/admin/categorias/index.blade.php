@extends('adminlte::page')


@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Categorias</b>/Listado de Categorias</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="{{url('/admin/categorias/create')}}" class="btn btn-sm btn-primary">
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
        <div class="col-md-8">
            <div class="card card-outline card-primary">
                <div class="card-body">
                    <table class="table table-bordered table-hover table-sm table-striped" id="mitabla">
                        <thead>
                        <tr>
                            <th style="text-align: center">N°</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th style="text-align: center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $contador = 1;
                        ?>
                        @foreach($categorias as $categoria)
                            <tr>
                                <td style="text-align: center">{{$contador++}}</td>
                                <td>{{$categoria->nombre}}</td>
                                <td>{{$categoria->descripcion}}</td>
                                <td style="text-align: center">
                                    <div class="btn-group">
                                        <a href="{{url('/admin/categorias',$categoria->id)}}" class="btn btn-info"><i class="fas fa-w fa-eye"></i></a>
                                        <a href="{{url('/admin/categorias/'.$categoria->id.'/edit')}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="{{url('/admin/categorias',$categoria->id)}}" method="post"
                                              onclick="preguntar{{$categoria->id}}(event)" id="miFormulario{{$categoria->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border-radius: 0px 5px 5px 0px" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <script>
                                            function preguntar{{$categoria->id}}(event){
                                                event.preventDefault();
                                                Swal.fire({
                                                    title: "¿Seguro desea eliminar este registro?",
                                                    text: "Si elimina esta categoria, todo producto asociado a ella se eliminara",
                                                    showDenyButton: true,
                                                    confirmButtonText: "Eliminar",
                                                    denyButtonText: `Cancelar`,
                                                    denyButtonColor:'#f50430',
                                                }).then((result) => {
                                                    /* Read more about isConfirmed, isDenied below */
                                                    if (result.isConfirmed) {
                                                       verficar();

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

                                            async function verficar(){
                                                const { value: password } = await Swal.fire({
                                                    title: "Ingrese la contraseña del usuario",
                                                    input: "password",
                                                    inputLabel: "Contraseña",
                                                    inputPlaceholder: "ingrese contraseña",
                                                    inputAttributes: {
                                                        maxlength: "10",
                                                        autocapitalize: "off",
                                                        autocorrect: "off"
                                                    }
                                                });
                                                if (password) {
                                                    // Enviar la contraseña ingresada al backend para validarla
                                                    fetch("{{ route('admin.usuarios.verificar', ['id' => $usuario->id]) }}", {
                                                        method: "POST",
                                                        headers: {
                                                            "Content-Type": "application/json",
                                                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                                        },
                                                        body: JSON.stringify({ password: password })
                                                    })
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            if (data.success) {
                                                                var form = $('#miFormulario{{$categoria->id}}');
                                                                form.submit();
                                                                Swal.fire("Se elimino la categoria exitosamente", "", "success");
                                                            } else {
                                                                Swal.fire("Contraseña Incorrecta", "Comuniquese con el administrador para verificar contraseña ", "error");
                                                            }
                                                        });
                                                }
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

