@extends('adminlte::page')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Productos</b>/Detalle Producto</h1>
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
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>
                <div class="card-body">

                        <div class="row">

                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="categoria">Categoria</label>
                                            <input type="text" class="form-control" value="{{$producto->categoria->nombre}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="codigo">Codigo</label>
                                            <input type="text" name="codigo" value="{{$producto->codigo}}" id="codigo" class="form-control" disabled>
                                            @error('codigo')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" value="{{$producto->nombre}}" id="nombre" class="form-control" disabled>
                                            @error('nombre')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="descripcion">Descripcion</label>
                                            <textarea type="text" name="descripcion" rows="2" cols="30"  id="descripcion" class="form-control" disabled>{{$producto->descripcion}}</textarea>
                                            @error('nombre')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock">Existencia</label>
                                            @if($producto->stock > 0)
                                                <input type="number" style="color: black;background-color: greenyellow;  text-align: center" name="stock" value="{{$producto->stock}}" id="stock" class="form-control" disabled>
                                            @else
                                                <input type="number" style="color: white;background-color: red; text-align: center" name="stock" value="{{$producto->stock}}" id="stock" class="form-control" disabled>
                                            @endif
                                                @error('stock')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="precio_compra">Precio Compra</label>
                                            <input type="text" name="precio_compra" value="{{number_format($producto->precio_compra,0,',','.')}}" id="precio_compra" class="form-control" disabled>
                                            @error('precio_compra')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="precio_venta">Precio venta</label>
                                            <input type="text" name="precio_venta" value="{{number_format($producto->precio_venta,0,',','.')}}" id="precio_venta" class="form-control" disabled>
                                            @error('precio_venta')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fecha_ingreso">Fecha ingreso</label>
                                            <input type="text" name="fecha_ingreso" value="{{ \Carbon\Carbon::parse($producto->fecha_ingreso)->format('d/m/Y h:i a') }}"  id="fecha_ingreso" class="form-control" disabled>
                                            @error('fecha_ingreso')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="imagen">Imagen del producto</label>
                                    <br>
                                    <center>
                                        <output id="list">
                                            <img class="img-circle" src="{{asset('storage/'.$producto->imagen)}}" width="80%" alt="sin imagen">
                                        </output>
                                    </center>
                                    <script>
                                        function archivo(evt){
                                            var files = evt.target.files;
                                            for (var i = 0, f; f = files[i]; i++){
                                                if (!f.type.match('image.*')){
                                                    continue;
                                                }
                                                var reader = new FileReader();
                                                reader.onload = (function (theFile) {
                                                    return function (e){
                                                        document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="',e.target.result, '" width="70%" title="', escape(theFile.name), '"/>' ].join('');
                                                    }
                                                })(f);
                                                reader.readAsDataURL(f);
                                            }
                                        }
                                        document.getElementById('file').addEventListener('change', archivo, false);
                                    </script>
                                </div>
                            </div>

                        </div>


                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a href="{{url('admin/productos')}}" class="btn btn-secondary"><i class="fas fa-w fa-arrow-left"></i> Volver</a>
                                </div>
                            </div>
                        </div>
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
            $('#precio_compra').on('input', function() {
                var precioc = $(this).val().replace(/\D/g, '');
                precioc = precioc.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
                $(this).val(precioc);
            });
            $('#precio_venta').on('input', function() {
                var preciov = $(this).val().replace(/\D/g, '');
                preciov = preciov.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
                $(this).val(preciov);
            });
        });

    </script>
@stop





