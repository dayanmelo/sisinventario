@extends('adminlte::page')

@section('content_header')
    <h1><b>Configuraciones</b>/Modificar</h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{-- Card Box --}}
            <div class="card card-outline card-success">

                {{-- Card Body --}}
                <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                    <form action="{{url('/admin/configuracion',$empresa->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Logo</label>
                                    <input type="file" id="file" name="logo" accept=".jpg, .jpeg, .png" class="form-control" >
                                    @error('logo')
                                    <small style="color: red">{{$message}}</small>
                                    @enderror
                                    <br>
                                    <center><output id="list"><img src="{{asset('storage/'.$empresa->logo)}}" width="80%" alt="Logo"></output></center>
                                    <script>
                                        function archivo(evt){
                                            var files = evt.target.files;
                                            for (var i = 0, f; f = files[i]; i++){
                                                if (!f.type.match('image.*')){
                                                    continue;
                                                }
                                                var reader = new FileReader();
                                                reader.onload = (function (theFile) {
                                                    return function (e){
                                                        document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="',e.target.result, '" width="70%" title="', escape(theFile.name), '"/>' ].join('');
                                                    }
                                                })(f);
                                                reader.readAsDataURL(f);
                                            }
                                        }
                                        document.getElementById('file').addEventListener('change', archivo, false);
                                    </script>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="pais">País</label>
                                            <select name="pais" id="pais" class="form-control" required>

                                                @foreach($paises as $paise)
                                                    <option value="{{$paise->id}}" {{$empresa->pais == $paise->id ? 'selected' : ''}} > {{$paise->name}} </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="departamento">Departamento</label>
                                            <select name="departamento" id="departamento2" class="form-control">
                                                @foreach($departamentos as $departamento)
                                                    <option value="{{$departamento->id}}" {{$empresa->departamento == $departamento->id ? 'selected' : ''}} > {{$departamento->name}} </option>
                                                @endforeach
                                            </select>
                                            <div id="res_pais"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="ciudad">Ciudad</label>
                                            <select name="ciudad" id="ciudad2" class="form-control">
                                                @foreach($ciudades as $ciudade)
                                                    <option value="{{$ciudade->id}}" {{$empresa->ciudad == $ciudade->id ? 'selected' : ''}} > {{$ciudade->name}} </option>
                                                @endforeach
                                            </select>
                                            <div id="res_departamento"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="codigo_postal">Codigo Postal</label>
                                            <select name="codigo_postal" id="codigo_postal" class="form-control" required>
                                                @foreach($paises as $paise)
                                                    <option value="{{$paise->phone_code}}" {{$empresa->codigo_postal == $paise->phone_code ? 'selected' : ''}} >{{$paise->name}} - {{$paise->phone_code}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre_empresa">Nombre de la Empresa</label>
                                            <input type="text" value="{{$empresa->nombre_empresa}}" name="nombre_empresa" id="nombre_empresa" class="form-control" required>
                                            @error('nombre_empresa')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tipo_empresa">Tipo de la Empresa</label>
                                            <input type="text" value="{{$empresa->tipo_empresa}}" name="tipo_empresa" id="tipo_empresa" class="form-control" required>
                                            @error('tipo_empresa')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="telefono">Telefono</label>
                                            <input type="number" value="{{$empresa->telefono}}" name="telefono" id="telefono" class="form-control" required>
                                            @error('telefono')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="correo">Correo Electronico</label>
                                            <input type="email" value="{{$empresa->correo}}" name="correo" id="correo" class="form-control" >
                                            @error('correo')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="moneda">Tipo de la Moneda</label>
                                            <select name="moneda" id="moneda" class="form-control" required>
                                                @foreach($monedas as $moneda)
                                                    <option value="{{$moneda->country_id}}" {{$empresa->moneda == $moneda->country_id ? 'selected' : ''}} >{{$moneda->name}} - {{$moneda->code}} - {{$moneda->symbol_native}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label>
                                            <input id="direccion" value="{{$empresa->direccion}}" class="form-control" name="direccion" type="text" placeholder="Buscar..." required>
                                            @error('direccion')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-5" >
                                        <a href="{{url('/admin')}}" class="btn btn-secondary "><i class="fas fa-w fa-arrow-left"></i> Volver</a>
                                        <button type="submit" class="btn btn-success "><i class="fas fa-w fa-pencil-alt"></i> Modificar</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>

                {{-- Card Footer --}}
                @hasSection('auth_footer')
                    <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
                        @yield('auth_footer')
                    </div>
                @endif

            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        $('#pais').on('change',function () {
            //alert('Hola');
            var id_pais = $('#pais').val();
            if (id_pais){
                $.ajax({
                    url:"{{url('/crear-empresa/departamento')}}"+'/'+id_pais,
                    type:"GET",
                    success: function (data){
                        $('#departamento2').css('display', 'none');
                        $('#res_pais').html(data);

                    }
                })
            }else {
                alert('debe seleccionar un pais');
            }
        });
    </script>
    <script>
        $(document).on('change','#departamento',function () {
            var id_departamento = $(this).val();
            //alert(id_departamento);
            if (id_departamento){
                $.ajax({
                    url:"{{url('/crear-empresa/ciudades')}}"+'/'+id_departamento,
                    type:"GET",
                    success: function (data){
                        $('#ciudad2').css('display','none');
                        $('#res_departamento').html(data);
                    }
                })
            }else {
                alert('debe seleccionar un departamento');
            }
        });
    </script>
@stop
