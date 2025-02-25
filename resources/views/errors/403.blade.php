@extends('adminlte::page')

@section('content_header')

@stop

@section('content')
    <div class="error-page">
        <h2 class="headline text-warning"> 403</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> ¡Ups! Página no encontrada.</h3>

            <p>
                No pudimos encontrar la página que buscabas.
                Mientras tanto,  <a href="{{url('/admin')}}">puedes regresar al panel de control</a>
            </p>

        </div>
        <!-- /.error-content -->
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

@stop
