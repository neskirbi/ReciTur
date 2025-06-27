<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>Recitur | Negocio</title>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  @include('toast.toasts')
  @include('cliente.navbars.navbar')
<div class="wrapper">


  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
      &nbsp;
    </div>
    <!-- /.content-header -->

    <!-- Main Content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title"><i class="fa fa-briefcase title-icon" aria-hidden="true"></i> Negocio</h3>
          </div>
          <div class="card-body">
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
                      <input type="text" class="form-control" id="generador" value="{{$generador->razonsocial}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="negocio"><i class="fas fa-signature"></i> Nombre del Establecimiento</label>
                      <input type="text" class="form-control" id="negocio" value="{{$negocio->negocio}}" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nautorizacion"><i class="fas fa-file-alt"></i> # Autorización</label>
                      <input type="text" class="form-control" id="nautorizacion" value="{{$negocio->nautorizacion}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tiponegocio"><i class="fas fa-store"></i> Giro del Establecimiento</label>
                      <input type="text" class="form-control" id="tiponegocio" value="{{$negocio->tiponegocio}}" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="calle"><i class="fas fa-road"></i> Calle</label>
                      <input type="text" class="form-control" id="calle" value="{{$negocio->calle}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="numeroext"><i class="fas fa-home"></i> Número Ext.</label>
                      <input type="text" class="form-control" id="numeroext" value="{{$negocio->numeroext}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="numeroint"><i class="fas fa-home"></i> Número Int.</label>
                      <input type="text" class="form-control" id="numeroint" value="{{$negocio->numeroint}}" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="colonia"><i class="fas fa-map-marker-alt"></i> Colonia</label>
                      <input type="text" class="form-control" id="colonia" value="{{$negocio->colonia}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cp"><i class="fas fa-map-pin"></i> C.P.</label>
                      <input type="text" class="form-control" id="cp" value="{{$negocio->cp}}" readonly>
                    </div>
                  </div>
                  
                </div>

                <div class="row">
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="entidad"><i class="fas fa-flag"></i> Entidad Federativa</label>
                      <input type="text" class="form-control" id="entidad" value="{{$negocio->entidad}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="municipio"><i class="fas fa-city"></i> Alcaldía/Municipio</label>
                      <input type="text" class="form-control" id="municipio" value="{{$negocio->municipio}}" readonly>
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
                      <input type="text" class="form-control" id="latitud" value="{{$negocio->latitud}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="longitud"><i class="fas fa-longitude"></i> Longitud</label>
                      <input type="text" class="form-control" id="longitud" value="{{$negocio->longitud}}" readonly>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Documentación 
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-file-pdf"></i> Documentación</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="plan"><i class="fas fa-file-upload"></i> Plan de manejo (pdf)</label>
                      <iframe id="inlineFrameExample"
                        title="Plan de manejo"
                        width="100%"
                        height="200"
                        src="{{asset('documentos/clientes/negocios/plan').'/'.$negocio->id.'.pdf'.'?ver='.rand(0,10000)}}">
                      </iframe>
                      <a target="_blank" class="btn btn-default" href="{{asset('documentos/clientes/negocios/plan').'/'.$negocio->id.'.pdf'.'?ver='.rand(0,10000)}}">Ver</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>-->

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
                      <input type="email" class="form-control" id="correo" value="{{$negocio->correo}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="telefono"><i class="fas fa-phone"></i> Teléfono</label>
                      <input type="tel" class="form-control" id="telefono" value="{{$negocio->telefono}}" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="celular"><i class="fas fa-mobile-alt"></i> Celular</label>
                      <input type="tel" class="form-control" id="celular" value="{{$negocio->celular}}" readonly>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


</div>

<!-- Scripts -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
    var markers = [];
    function initMap() {
        const myLatlng = { lat: {{$negocio->latitud}}, lng: {{$negocio->longitud}} };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 15,
          center: myLatlng,
        });
        const marker = new google.maps.Marker({
          position: myLatlng,
          map,
          title: "{{$negocio->negocio}}"
        });
    }
</script>

@include('MapsApi')
@include('cliente.footer')

</body>
</html>