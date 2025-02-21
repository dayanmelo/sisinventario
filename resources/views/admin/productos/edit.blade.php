@extends('adminlte::page')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Productos</b>/Modificar Producto</h1>
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
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/productos',$producto->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="categoria">Categoria</label>
                                            <select name="categoria" id="categoria" class="form-control">
                                                @foreach($categorias as $categoria)
                                                    <option value="{{$categoria->id}}" {{$categoria->id == $producto->categoria_id ? 'selected' : ''}}>{{$categoria->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="codigo"><b>*</b>Codigo</label>
                                            <input type="text" name="codigo" value="{{$producto->codigo}}" id="codigo" class="form-control" required>
                                            @error('codigo')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre"><b>*</b>Nombre</label>
                                            <input type="text" name="nombre" value="{{$producto->nombre}}" id="nombre" class="form-control" required>
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
                                            <textarea type="text" name="descripcion" rows="2" cols="30"  id="descripcion" class="form-control">{{$producto->descripcion}}</textarea>
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
                                            <input type="number" name="stock" value="{{$producto->stock}}" id="stock" class="form-control">
                                            @error('stock')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="precio_compra">Precio Compra</label>
                                            <input type="text" name="precio_compra" value="{{$producto->precio_compra}}" id="precio_compra" class="form-control">
                                            @error('precio_compra')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="precio_venta">Precio venta</label>
                                            <input type="text" name="precio_venta" value="{{$producto->precio_venta}}" id="precio_venta" class="form-control">
                                            @error('precio_venta')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fecha_ingreso">Fecha ingreso</label>
                                            <input type="datetime-local" value="{{ $producto->fecha_ingreso }}" name="fecha_ingreso"  id="fecha_ingreso" class="form-control" >
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
                                    <input type="file" id="file" name="imagen" accept=".jpg, .jpeg, .png" class="form-control">
                                    @error('imagen')
                                    <small style="color: red">{{$message}}</small>
                                    @enderror
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
                                    <button type="submit" class="btn btn-outline-warning"><i class="fas fa-w fa-pen-square"></i> Modificar</button>
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

@stop





