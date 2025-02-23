@extends('adminlte::page')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Compras</b>/Detalle de la Compra</h1>
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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <a href="{{url('/admin/compras')}}" rel="noopener" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                    </div>

                    <div class="card-tools">
                        <button type="button" class="btn btn-primary " style="margin-right: 5px;">
                            <i class="fas fa-download"></i> Generate PDF
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
            </div>
            <!--div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Note:</h5>
                This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
            </div-->


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">

                        <h4>
                            <i class="fas fa-globe"></i> {{ $empresa->nombre_empresa }}
                            <small class="float-right">Fecha: {{ \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y h:i a') }}</small>
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        De
                        <address>
                            <strong>{{$compra->proveedor->nombre}}</strong><br>
                            {{$compra->proveedor->empresa}}<br>
                            {{$compra->proveedor->direccion}}<br>
                            Telefono: {{$compra->proveedor->telefono}}<br>
                            Correo: {{$compra->proveedor->correo}}
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        Para
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
                        <b class="badge bg-warning" style="font-size: 20px">Total: $ {{number_format($compra->precio_compra,0,',','.')}}</b><br>
                        <br>
                        <b>Comprobante:</b> {{$compra->comprobante}}<br>
                        <b>Fecha:</b> {{ \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y h:i a') }}<br>
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
                                <th>Precio Compra</th>
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
                        <p class="lead">Monto Adecuado {{ \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y') }}</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody><tr>
                                    <th style="width:50%">Total:</th>
                                    <td>${{number_format($compra->precio_compra,0,',','.')}}</td>
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
                        <!--button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
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
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

@stop

