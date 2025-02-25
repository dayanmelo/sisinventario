@extends('adminlte::page')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Categorias</b>/Modificar Categoria</h1>
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
        <div class="col-md-8">
            <div class="card card-outline card-warning">
                <div class="card-body">
                    <form action="{{url('/admin/categorias',$categoria->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre de la Categoria</label>
                                    <input type="text" name="nombre" value="{{$categoria->nombre}}" id="nombre" class="form-control"  required>
                                    @error('name')
                                    <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Descripción de la Categoria</label>
                                    <input type="text" name="descripcion" value="{{$categoria->descripcion}}" id="descripcion" class="form-control" required>
                                    @error('descripcion')
                                    <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a href="{{url('admin/categorias')}}" class="btn btn-secondary"><i class="fas fa-w fa-arrow-left"></i> Volver</a>
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



