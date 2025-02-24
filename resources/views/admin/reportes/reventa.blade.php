<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            color: #333;
        }
        .table{
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }
        .table-bordered{
            border: 1px solid #000000;
        }
        .table-bordered th,
        .table-bordered td{
            border: 1px solid #000000;
        }
        .table-bordered thead th{
            border-bottom-width: 2px;
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.2;
            font-size: 100px;
            color: red;
            z-index: -1;
            white-space: nowrap;
            text-align: center;
            pointer-events: none;
        }

    </style>


    <title>Cierre</title>
</head>
<body>

@if($venta->estado == '1')
    <div class="watermark">ANULADA</div>
@endif

<table border="0" >
    <tr>
        <td width="40px" style="text-align: center">
            <img src="{{public_path('storage/'.$empresa->logo)}}" width="130px" alt="Logo"><br>
            <p>{{$empresa->nombre_empresa}}</p>
        </td>
        <td width="350px" style="text-align: center"><strong style="font-size: 30px">Venta</strong></td>
        <td width="200px" style="text-align: center; vertical-align: middle">
            <b>Fecha: </b>{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y h:i a') }}
        </td>
    </tr>
</table>
<br>
<table border="0" class="table table-bordered">
    <tr>
        <td colspan="4" style="vertical-align: middle;text-align: center;background-color: #40c4b6">Datos cliente</td>
    </tr>
    <tr>
        <td width="60px" style="text-align: center">Cliente</td>
        <td width="50px">{{$venta->cliente->nombre_cliente}}</td>
        <td width="60px" style="text-align: center">Celular</td>
        <td width="40px">{{$venta->cliente->telefono}}</td>
    </tr>
    <tr>
        <td width="60px" style="text-align: center">Direccion</td>
        <td width="50px">{{$venta->cliente->direccion}}</td>
        <td colspan="2"></td>
    </tr>
</table>
<br>
<table class="table table-bordered">
    <tr>
        <td colspan="5" style="vertical-align: middle;text-align: center;background-color: #40c4b6">Datos Venta</td>
    </tr>
    <tr>
        <th width="80px" style="background-color: #40c4b6">N°</th>
        <th width="150px" style="background-color: #40c4b6">Producto</th>
        <th width="70" style="background-color: #40c4b6">Cantidad</th>
        <th width="70" style="background-color: #40c4b6">Precio Unitario</th>
        <th width="90" style="background-color: #40c4b6">Subtotal</th>
    </tr>
    <tbody>
    <?php
    $cont = 1;
    ?>
    @foreach($venta->detallesventa as $detalle)
        <tr>
            <td style="text-align: center">{{$cont++}}</td>
            <td>{{$detalle->producto->nombre}}</td>
            <td style="text-align: center">{{$detalle->cantidad}}</td>
            <td style="text-align:center">$ {{number_format($detalle->precio_unitario,0,',','.')}}</td>
            <td style="text-align: center">$ {{number_format($detalle->precio_unitario * $detalle->cantidad,0,',','.')}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
</body>
</html>
