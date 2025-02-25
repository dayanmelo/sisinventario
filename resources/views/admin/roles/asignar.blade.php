@extends('adminlte::page')


@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Asignar</b>/Permisos y Roles</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-center">
                    <h1><b>{{$rol->name}}</b></h1>
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
                <div class="card-body">
                    <form action="{{url('/admin/roles/asignar',$rol->id)}}" method="post">
                        @csrf
                        @method('PUT')

                        @foreach($permisos as $modulo => $grupoPermisos)
                            <div class="col-md-4">
                                <h3>{{$modulo}}</h3>
                                @foreach($grupoPermisos as $permiso)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input"
                                               value="{{$permiso->id}}" {{$rol->hasPermissionTo($permiso->name) ? 'checked' : ''}} name="permisos[]" id="">
                                        <label for="" class="form-check-label">{{$permiso->name}}</label>
                                    </div>
                                @endforeach
                                <hr>
                            </div>
                        @endforeach

                        <br>
                        <hr>

                        <div class="card-footer">
                            <a href="{{url('/admin/roles')}}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                            <button type="submit" class="btn btn-outline-success"><i class="fas fa-check"></i> Guardar</button>
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


