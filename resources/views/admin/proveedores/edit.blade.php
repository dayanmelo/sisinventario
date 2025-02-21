@extends('adminlte::page')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Proveedores</b>/Modificar Proveedor</h1>
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
                    <form action="{{url('/admin/proveedores',$proveedor->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="empresa">Empresa</label>
                                    <input type="text" name="empresa" value="{{$proveedor->empresa}}" id="empresa" class="form-control"  required autofocus>
                                    @error('empresa')
                                    <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="direccion">Direccion de la Empresa</label>
                                    <input type="text" name="direccion" value="{{$proveedor->direccion}}" id="direccion" class="form-control" required>
                                    @error('direccion')
                                    <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefono">Telefono de la Empresa</label>
                                    <input type="text" name="telefono" value="{{$proveedor->telefono}}" id="telefono" class="form-control">
                                    @error('telefono')
                                    <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre">Nombre del proveedor</label>
                                    <input type="text" name="nombre" value="{{$proveedor->nombre}}" id="nombre" class="form-control"  required>
                                    @error('nombre')
                                    <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="celular">Celular del proveedor</label>
                                    <input type="text" name="celular" value="{{$proveedor->celular}}" id="celular" class="form-control" required>
                                    @error('celular')
                                    <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="correo">Correo de la Empresa</label>
                                    <input type="email" name="correo" value="{{$proveedor->correo}}" id="correo" class="form-control" required>
                                    @error('correo')
                                    <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a href="{{url('admin/proveedores')}}" class="btn btn-secondary"><i class="fas fa-w fa-arrow-left"></i> Volver</a>
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





