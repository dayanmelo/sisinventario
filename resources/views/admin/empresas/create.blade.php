@extends('adminlte::master')

@php
    $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home');

    if (config('adminlte.use_route_url', false)) {
        $dashboard_url = $dashboard_url ? route($dashboard_url) : '';
    } else {
        $dashboard_url = $dashboard_url ? url($dashboard_url) : '';
    }

    $bodyClasses = ($auth_type ?? 'login') . '-page';

    if (! empty(config('adminlte.layout_dark_mode', null))) {
        $bodyClasses .= ' dark-mode';
    }
@endphp

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body'){{ $bodyClasses }}@stop

@section('body')
    <div class="container">

        {{-- Logo --}}
        <div class="{{ $auth_type ?? 'login' }}-logo">
            <a href="{{ $dashboard_url }}">

                {{-- Logo Image --}}
                @if (config('adminlte.auth_logo.enabled', false))
                    <img src="{{ asset(config('adminlte.auth_logo.img.path')) }}"
                         alt="{{ config('adminlte.auth_logo.img.alt') }}"
                         @if (config('adminlte.auth_logo.img.class', null))
                             class="{{ config('adminlte.auth_logo.img.class') }}"
                         @endif
                         @if (config('adminlte.auth_logo.img.width', null))
                             width="{{ config('adminlte.auth_logo.img.width') }}"
                         @endif
                         @if (config('adminlte.auth_logo.img.height', null))
                             height="{{ config('adminlte.auth_logo.img.height') }}"
                        @endif>
                @else
                    <img src="{{ asset(config('adminlte.logo_img')) }}"
                         alt="{{ config('adminlte.logo_img_alt') }}" height="50">
                @endif

                {{-- Logo Label --}}
                {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}

            </a>
        </div>

        <div class="row">
            <div class="col-md-12">
                {{-- Card Box --}}
                <div class="card {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}">

                    {{-- Card Header --}}
                    <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                        <h3 class="card-title float-none text-center">
                            <b>Registro de una nueva empresa</b>
                        </h3>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                        <form action="{{url('crear-empresa/create')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Logo</label>
                                        <input type="file" id="file" name="logo" accept=".jpg, .jpeg, .png" class="form-control" required>
                                        @error('logo')
                                        <small style="color: red">{{$message}}</small>
                                        @enderror
                                        <br>
                                        <center><output id="list"></output></center>
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
                                                        <option value="{{$paise->id}}">{{$paise->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="departamento">Departamento</label>
                                                <div id="res_pais"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="ciudad">Ciudad</label>
                                                <div id="res_departamento"></div>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="codigo_postal">Codigo Postal</label>
                                                <select name="codigo_postal" id="codigo_postal" class="form-control" required>
                                                    @foreach($paises as $paise)
                                                        <option value="{{$paise->phone_code}}">{{$paise->name}} - {{$paise->phone_code}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nombre_empresa">Nombre de la Empresa</label>
                                                <input type="text" value="{{old('nombre_empresa')}}" name="nombre_empresa" id="nombre_empresa" class="form-control" required>
                                                @error('nombre_empresa')
                                                <small style="color: red">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tipo_empresa">Tipo de la Empresa</label>
                                                <input type="text" value="{{old('tipo_empresa')}}" name="tipo_empresa" id="tipo_empresa" class="form-control" required>
                                                @error('tipo_empresa')
                                                <small style="color: red">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="telefono">Telefono</label>
                                                <input type="number" value="{{old('telefono')}}" name="telefono" id="telefono" class="form-control" required>
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
                                                <input type="email" value="{{old('correo')}}" name="correo" id="correo" class="form-control" >
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
                                                        <option value="{{$moneda->symbol_native}}">{{$moneda->name}} - {{$moneda->code}} - {{$moneda->symbol_native}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="direccion">Dirección</label>
                                                <input id="pac-input" value="{{old('direccion')}}" class="form-control" name="direccion" type="text" placeholder="Buscar..." required>
                                                @error('direccion')
                                                <small style="color: red">{{$message}}</small>
                                                @enderror
                                                <br>
                                                <div id="map" style="width: 100%;height: 400px"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4" >
                                    <button type="submit" class="btn btn-lg btn-primary btn-block">Guardar</button>
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



    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_KEY')}}&libraries=places&callback=initAutocomplete"
            async defer></script>
    <script>
        // This example adds a search box to a map, using the Google Place Autocomplete
        // feature. People can enter geographical searches. The search box will return a
        // pick list containing a mix of places and predicted search terms.

        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

        function initAutocomplete() {
            var map = new google.maps.Map(document.getElementById('map'), {
                // Coordenadas de Monterrey, N.L., México
                center: {lat: 4.570868, lng:-74.297333}, //{lat: -33.8688, lng: 151.2195},
                zoom: 13,
                mapTypeId: 'roadmap'
            });

            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input); // determina la posicion

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });

            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                /*
                 * Para fines de minimizar las adecuaciones debido a que es este una demostración de adaptación mínima de código, se reemplaza forEach por some.
                 */
                // places.forEach(function(place) {
                places.some(function(place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };

                    // Create a marker for each place.
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                    // some interrumpe su ejecución en cuanto devuelve un valor verdadero (true)
                    return true;
                });
                map.fitBounds(bounds);
            });
        }
    </script>
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
                        $('#res_departamento').html(data);
                    }
                })
            }else {
                alert('debe seleccionar un departamento');
            }
        });
    </script>
@stop
