@extends('adminlte::page')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Ventas</b>/Detalle de la Venta</h1>
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{url('/admin/ventas')}}" rel="noopener" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                        </div>

                        <div class="card-tools">
                            <a href="{{url('/admin/reportes/reventa',$venta->id)}}" target="_blank" style="margin-right: 5px;" class="btn btn-primary">
                                <i class="fas fa-download"></i> Generar PDF
                            </a>

                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                </div>


                <!-- Main content -->
                <div class="invoice p-3 mb-3">



                    <!-- title row -->
                    <div class="row">

                        @if($venta->estado == '1')
                            <div class="ribbon-wrapper ribbon-xl">
                                <div class="ribbon bg-danger text-xl">
                                    Anulada
                                </div>
                            </div>
                        @endif

                        <div class="col-12">

                            <h4>
                                <i class="fas fa-globe"></i> {{ $empresa->nombre_empresa }}
                                <small class="float-right">Fecha: {{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y h:i a') }}</small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            De
                            <address>
                                <strong>{{$empresa->nombre_empresa}}</strong><br>
                                {{$empresa->direccion}}<br>
                                {{$pais->name . ',' .$departamento->name}}<br>
                                Celular: {{$empresa->telefono}}<br>
                                Correo: {{$empresa->correo}}
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Para
                            <address>
                                <strong>{{$venta->cliente->nombre_cliente}}</strong><br>
                                {{$venta->cliente->cedula}}<br>
                                {{$venta->cliente->direccion}}<br>
                                Telefono: {{$venta->cliente->telefono}}<br>
                                Correo: {{$venta->cliente->correo}}
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b style="font-size: 20px">Total: $ {{number_format($venta->precio_total,0,',','.')}}</b><br>
                            <br>
                            <b>Fecha:</b> {{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y h:i a') }}<br>
                            <!--b>Account:</b> 968-34567 -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Venta</th>
                                    <th>Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($detalles as $detalle)
                                    <tr>
                                        <td>{{$detalle->producto->codigo}}</td>
                                        <td>{{$detalle->producto->nombre}}</td>
                                        <td>{{$detalle->cantidad}}</td>
                                        <td>${{number_format($detalle->precio_unitario,0,',','.')}}</td>
                                        <td>${{number_format(floor($detalle->cantidad) * floor($detalle->precio_unitario),0,',','.')}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-6">

                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <p class="lead">Monto Adecuado {{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody><tr>
                                        <th style="width:50%">Total:</th>
                                        <td>${{number_format($venta->precio_total,0,',','.')}}</td>
                                    </tr>

                                    </tbody></table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                            <!--a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                            <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                Payment
                            </button>
                            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-download"></i> Generate PDF
                            </button-->
                        </div>
                    </div>
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

@stop

