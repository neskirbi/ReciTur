<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>Recitrash | Negocio</title>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
  @include('administracion.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('administracion.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-store"></i> Negocio</h3>            
                </div>
                <!-- /.card-header -->
                <form method="POST" action="{{url('establecimientos')}}/{{$negocio->id}}" id="formnegocio" enctype="multipart/form-data">
                @csrf     
                @method('put')               
                    <div class="card-body">  

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-building"></i> Datos del Establecimiento</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label for="generador"><i class="fas fa-user-tie"></i> Generador</label>
                                            <select class="form-control" name="generador" id="generador" required>
                                            <option value="{{isset($generador->id) ? $generador->id : ''}}">{{isset($generador->razonsocial) ? $generador->razonsocial : ''}}</option>
                                                @foreach($generadores as $generador)
                                                <option value="{{$generador->id}}" {{ $negocio->generador_id == $generador->id ? 'selected' : '' }}>{{$generador->razonsocial}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="negocio"><i class="fas fa-signature"></i> Nombre del Establecimiento</label>
                                            <input type="text" name="negocio" class="form-control" id="negocio" placeholder="Nombre del Establecimiento" value="{{ $negocio->negocio }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tiponegocio"><i class="fas fa-store"></i> Giro del Establecimiento</label>
                                            <input type="text" name="tiponegocio" id="tiponegocio" class="form-control" placeholder="Giro del Establecimiento" value="{{ $negocio->tiponegocio }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="calle"><i class="fas fa-road"></i> Calle</label>
                                            <input type="text" name="calle" class="form-control" id="calle" placeholder="Calle" value="{{ $negocio->calle }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="numeroext"><i class="fas fa-home"></i> Número Ext.</label>
                                            <input type="text" name="numeroext" class="form-control" id="numeroext" placeholder="Número Ext." value="{{ $negocio->numeroext }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="numeroint"><i class="fas fa-home"></i> Número Int.</label>
                                            <input type="text" name="numeroint" class="form-control" id="numeroint" placeholder="Número Int." value="{{ $negocio->numeroint }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="colonia"><i class="fas fa-map-marker-alt"></i> Colonia</label>
                                            <input type="text" name="colonia" class="form-control" id="colonia" placeholder="Colonia" value="{{ $negocio->colonia }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cp"><i class="fas fa-map-pin"></i> C.P.</label>
                                            <input type="text" name="cp" class="form-control" id="cp" placeholder="C.P." value="{{ $negocio->cp }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entidad"><i class="fas fa-flag"></i> Entidad Federativa</label>
                                            <select name="entidad" class="form-control" id="entidad" onchange="MunicipiosApi(this,2);" required>
                                            <option value="{{$entidad->id}}">{{$entidad->entidad}}</option>
                                                @foreach($entidades as $entidad)
                                                <option value="{{$entidad->id}}" {{ $negocio->entidad_id == $entidad->id ? 'selected' : '' }}>{{$entidad->entidad}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="municipio"><i class="fas fa-city"></i> Alcaldía/Municipio</label>
                                            <select name="municipio" class="form-control" id="municipio" required>
                                                <option value="{{$negocio->id_municipio}}">{{$municipio->municipio}}</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="map"><i class="fas fa-map-marked-alt"></i> Ubicación del Establecimiento</label>
                                        <div id="map" style="height: 350px; width: 100%;"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="latitud"><i class="fas fa-latitude"></i> Latitud</label>
                                            <input type="text" name="latitud" class="form-control" id="latitud" placeholder="Latitud" value="{{ $negocio->latitud }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="longitud"><i class="fas fa-longitude"></i> Longitud</label>
                                            <input type="text" name="longitud" class="form-control" id="longitud" placeholder="Longitud" value="{{ $negocio->longitud }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                       
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-id-card"></i> Datos del Contacto</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="correo"><i class="fas fa-envelope"></i> Correo Contacto</label>
                                            <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo" value="{{ $negocio->correo }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono"><i class="fas fa-phone"></i> Teléfono</label>
                                            <input type="tel" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" value="{{ $negocio->telefono }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="celular"><i class="fas fa-mobile-alt"></i> Celular</label>
                                            <input type="tel" name="celular" class="form-control" id="celular" placeholder="Celular" value="{{ $negocio->celular }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="guardar" class="btn btn-info float-right"><i class="fas fa-save"></i> Guardar</button>
                            </div>
                        </div>
                    </div><!--End body-->
                </form>
            </div>
            <br>          
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
    var markers = [];
    function initMap() {
        const myLatlng = { lat:  {{ $negocio->latitud ?? 20.248882446801847 }}, lng: {{ $negocio->longitud ?? -101.45472227050904 }} };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 15,
          center: myLatlng,
        });
        const marker = new google.maps.Marker({
            position: myLatlng,
            map,
            title: $('#negocio').val()
        });
        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
          content: "Ubicación actual",
          position: myLatlng,
        });
        infoWindow.open(map, marker);
        // Configure the click listener.
        map.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.
            infoWindow.close();
            DeleteMarkers();
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
              position: mapsMouseEvent.latLng,
            });
            var coordenadas = mapsMouseEvent.latLng.toJSON();
            $('#latitud').val(coordenadas.lat);
            $('#longitud').val(coordenadas.lng);
            const coornegocio = { lat: coordenadas.lat, lng: coordenadas.lng };
            const marker = new google.maps.Marker({
                position: coornegocio,
                map,
                title: $('#negocio').val()
            });
            // Add marker to the array.
            markers.push(marker);
            infoWindow.setContent('Nueva ubicación:<br>Latitud:' + coordenadas.lat + '<br>Longitud:' + coordenadas.lng);
            infoWindow.open(map, marker);
        });
    }
</script>

@include('MapsApi')

@include('footer')
</body>
</html>