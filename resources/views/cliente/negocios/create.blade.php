<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>Recitur | Registro negocio</title>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  @include('toast.toasts')
  @include('cliente.navbars.navbar')
<div class="wrapper">

  <div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header"></div>
    <!-- /.content-header -->

    <!-- Main Content -->
    <section class="content">
      <div class="container-fluid">
      <form method="POST" action="{{url('negocios')}}" id="formnegocio" enctype="multipart/form-data">
            @csrf
              <!-- Datos del Establecimiento -->
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
                          <option value="">--Generador--</option>
                          @foreach($generadores as $generador)
                            <option value="{{$generador->id}}">{{$generador->razonsocial}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="negocio"><i class="fas fa-signature"></i> Nombre del Establecimiento</label>
                        <input type="text" name="negocio" class="form-control" id="negocio" placeholder="Nombre del Establecimiento" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="tiponegocio"><i class="fas fa-store"></i> Giro del Establecimiento</label>
                        <input type="text" name="tiponegocio" id="tiponegocio" class="form-control" placeholder="Giro del Establecimiento" required>
                        
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="calle"><i class="fas fa-road"></i> Calle</label>
                        <input type="text" name="calle" class="form-control" id="calle" placeholder="Calle" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="numeroext"><i class="fas fa-home"></i> Número Ext.</label>
                        <input type="text" name="numeroext" class="form-control" id="numeroext" placeholder="Número Ext." required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="numeroint"><i class="fas fa-home"></i> Número Int.</label>
                        <input type="text" name="numeroint" class="form-control" id="numeroint" placeholder="Número Int.">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="colonia"><i class="fas fa-map-marker-alt"></i> Colonia</label>
                        <input type="text" name="colonia" class="form-control" id="colonia" placeholder="Colonia" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="cp"><i class="fas fa-map-pin"></i> C.P.</label>
                        <input type="text" name="cp" class="form-control" id="cp" placeholder="C.P." required>
                      </div>
                    </div>
                    
                  </div>

                  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="entidad"><i class="fas fa-flag"></i> Entidad Federativa</label>
                        <select name="entidad" class="form-control" id="entidad" onchange="MunicipiosApi(this,2);" required>
                          <option value="">--Entidad Federativa--</option>
                          @foreach($entidades as $entidad)
                            <option value="{{$entidad->id}}">{{$entidad->entidad}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="municipio"><i class="fas fa-city"></i> Alcaldía/Municipio</label>
                        <select  name="municipio" class="form-control" id="municipio" aria-invalid="false" data-mun="municipio" >
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
                        <input type="text" name="latitud" class="form-control" id="latitud" placeholder="Latitud" readonly>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="longitud"><i class="fas fa-longitude"></i> Longitud</label>
                        <input type="text" name="longitud" class="form-control" id="longitud" placeholder="Longitud" readonly>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Documentación -->
              

              <!-- Datos del Contacto -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-id-card"></i> Datos del Contacto</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="correo"><i class="fas fa-envelope"></i> Correo Contacto</label>
                        <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="telefono"><i class="fas fa-phone"></i> Teléfono</label>
                        <input type="tel" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="celular"><i class="fas fa-mobile-alt"></i> Celular</label>
                        <input type="tel" name="celular" class="form-control" id="celular" placeholder="Celular" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                    <button type="submit" id="guardar" class="btn btn-theme-primary float-right"><i class="fas fa-save"></i> Guardar</button>
                </div>
              </div>
              
            </form>
      </div>
    </section>
  </div>

  <!-- Footer -->
  
</div>


<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
    var markers = [];
    function initMap() {
        const myLatlng = { lat:  20.248882446801847, lng: -101.45472227050904 };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 4,
          center: myLatlng,
        });
        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
          content: "Seleccione ubicación",
          position: myLatlng,
        });
        infoWindow.open(map);
        // Configure the click listener.
         
        map.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.
            infoWindow.close();
            DeleteMarkers()
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
              position: mapsMouseEvent.latLng,
            });
            var coordenadas=mapsMouseEvent.latLng.toJSON();
            $('#latitud').val(coordenadas.lat);
            $('#longitud').val(coordenadas.lng);
            const coornegocio = { lat:  coordenadas.lat*1, lng: coordenadas.lng*1 };
            const marker = new google.maps.Marker({
            position: coornegocio,
            map,
            title:$('#negocio').val()
            });
             //Add marker to the array.
            markers.push(marker);
            infoWindow.setContent('La negocio se localiza:<br>Latitud:'+coordenadas.lat+'<br>Longitud:'+coordenadas.lng);
          
            infoWindow.open(map,marker);
          
        });
    }
      
</script>

<!-- Scripts -->

@include('MapsApi')
@include('cliente.footers.footer')
</body>
</html>