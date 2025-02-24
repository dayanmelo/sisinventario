@extends('adminlte::page')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Cierres</b>/Detalle del Cierre</h1>
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
                            <a href="{{url('/admin/cierres')}}" rel="noopener" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
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


                <!-- Main content -->
                <div class="invoice p-3 mb-3">



                    <!-- title row -->
                    <div class="row">


                        <div class="col-12">

                            <h4>
                                <i class="fas fa-globe"></i> {{ $empresa->nombre_empresa }}
                                <small class="float-right">Fecha: {{ \Carbon\Carbon::parse($cierre->fecha)->format('d/m/Y h:i a') }}</small>
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

                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b class="badge badge-warning" style="font-size: 20px">Total: $ {{number_format($cierre->precio_total,0,',','.')}}</b><br>
                            <br>
                            <b class="badge badge-warning" style="font-size: 20px">Ganancia: $ {{number_format($cierre->ganancia,0,',','.')}}</b><br>
                            <br>
                            <b>Fecha:</b> {{ \Carbon\Carbon::parse($cierre->fecha)->format('d/m/Y h:i a') }}<br>
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
                                    <th>Precio Venta</th>
                                    <th>Subtotal</th>
                                    <th>Ganancia</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($detalles as $detalle)
                                    <tr>
                                        <td>{{$detalle->producto->codigo}}</td>
                                        <td>{{$detalle->producto->nombre}}</td>
                                        <td>{{$detalle->cantidad}}</td>
                                        <td>${{number_format($detalle->precio_compra,0,',','.')}}</td>
                                        <td>${{number_format($detalle->precio_venta,0,',','.')}}</td>
                                        <td>${{number_format(floor($detalle->cantidad) * floor($detalle->precio_venta),0,',','.')}}</td>
                                        <td>${{number_format(($detalle->precio_venta - $detalle->precio_compra) * $detalle->cantidad),0,',','.'}}</td>
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
                            <p class="lead">Monto Adecuado {{ \Carbon\Carbon::parse($cierre->fecha)->format('d/m/Y') }}</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th style="width:50%">Total:</th>
                                        <td>${{number_format($cierre->precio_total,0,',','.')}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Ganancia:</th>
                                        <td>${{number_format($cierre->ganancia,0,',','.')}}</td>
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


