@extends('adminlte::page')


@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Usuarios</b>/Detalles del Usuario</h1>
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
            <div class="card card-outline card-info">
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="role">Rol</label>
                                    <input type="text" class="form-control" name="role" id="role" value="{{$usuario->roles->pluck('name')->implode(', ')}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Nombre del usuario</label>
                                    <input type="text" value="{{$usuario->name}}" name="name" id="name" class="form-control" disabled>
                                    @error('name')
                                    <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="correo">Correo Electronico</label>
                                    <input type="email" value="{{$usuario->email}}" name="correo" id="correo" class="form-control" disabled>
                                    @error('correo')
                                    <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="create">Fecha de Creacion</label>
                                    <input type="text" name="create" id="create" value="{{date_format($usuario->created_at,'d/m/Y h:i a')}}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="button-group">
                                    <a href="{{url('/admin/usuarios')}}" class="btn btn-secondary"><i class="fas fa-w fa-arrow-left"></i> Volver</a>
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
@stop

