@extends('adminlte::page')

@section('content_header')
    <h1><b>{{$empresa->nombre_empresa}}</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-info">
                <a href="{{url('/admin/roles')}}" class="info-box-icon">
                    <span class=""><i class="fas fa-id-card"></i></span>
                </a>

                <div class="info-box-content">
                    <span class="info-box-text">Roles</span>
                    <span class="info-box-number">{{$total_roles}}</span>


                    <span class="progress-description">
                  Roles Registrados
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
                <a href="{{url('/admin/usuarios')}}" class="info-box-icon">
                <span ><i class="fas fa-users"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Usuarios</span>
                    <span class="info-box-number">{{$total_usuarios}}</span>


                    <span class="progress-description">
                  Usuarios Registrados
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning">
                <a href="{{url('/admin/categorias')}}" class="info-box-icon">
                    <span ><i class="fas fa-tags"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Categorias</span>
                    <span class="info-box-number">{{$total_categorias}}</span>


                    <span class="progress-description">
                  Categorias Registradas
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-primary">
                <a href="{{url('/admin/productos')}}" class="info-box-icon">
                    <span ><i class="fas fa-clipboard"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Productos</span>
                    <span class="info-box-number">{{$total_productos}}</span>


                    <span class="progress-description">
                  Productos Registrados
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-12">
            <div class="info-box bg-info">
                <a href="{{url('/admin/roles')}}" class="info-box-icon">
                    <span class=""><i class="fas fa-id-card"></i></span>
                </a>

                <div class="info-box-content">
                    <span class="info-box-text">Roles</span>
                    <span class="info-box-number">{{$total_roles}}</span>


                    <span class="progress-description">
                  Roles Registrados
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

@stop
