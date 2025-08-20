<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>Recitur | Negocio</title>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  @include('toast.toasts')
  @include('administracion.navbars.navbar')
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
      
      @include('administracion.sidebar')
      <div class="container-fluid">

        <form method="POST" action="{{url('establecimientos')}}/{{$negocio->id}}" name="formnegocio" id="formnegocio" enctype="multipart/form-data">
          @csrf
          @method('PUT')
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
                        <select class="form-control" name="generador" id="generador" required>
                          <option value="{{$negocio->id_generador}}">{{$generador->razonsocial ?? '' }}</option>
                          @foreach($generadores as $generador)
                            <option value="{{$generador->id}}">{{$generador->razonsocial}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
               
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="negocio"><i class="fas fa-signature"></i> Nombre del Establecimiento</label>
                      <input type="text" class="form-control" name="negocio" id="negocio" value="{{$negocio->negocio}}" required>
                    </div>
                  </div>
                </div>

                <div class="row">
                    
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="giro"><i class="fas fa-store"></i> Giro del Establecimiento</label>
                      <select name="giro" id="giro" class="form-control" onchange="GetUnidadesClasificacion(this);"  required>
                        <option value="{{$negocio->giro}}">{{$negocio->giro}}</option>
                        @foreach($giros as $giro)
                        <option value="{{$giro->giro}}">{{$giro->giro}}</option>
                        @endforeach
                      </select>
                      
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cantidad"><i class="fa fa-list-ol"></i> <span name="unidades" id="unidades"> {{$negocio->unidades}}</span></label>
                      <input type="text" name="cantidad" id="cantidad" class="form-control" placeholder="" value="{{$negocio->cantidad}}" required>
                      
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="estimado"><i class="fas fa-trash-alt"></i> Estimación (Generación Diaria) </label>
                      <input type="number" step="0.01" min="0.0" name="estimado" class="form-control" id="estimado" placeholder="0.0" value="{{$negocio->estimado}}" required>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="calle"><i class="fas fa-road"></i> Calle</label>
                      <input type="text" class="form-control" name="calle" id="calle" value="{{$negocio->calle}}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="numeroext"><i class="fas fa-home"></i> Número Ext.</label>
                      <input type="text" class="form-control" name="numeroext" id="numeroext" value="{{$negocio->numeroext}}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="numeroint"><i class="fas fa-home"></i> Número Int.</label>
                      <input type="text" class="form-control" name="numeroint" id="numeroint" value="{{$negocio->numeroint}}" >
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="colonia"><i class="fas fa-map-marker-alt"></i> Colonia</label>
                      <input type="text" class="form-control" name="colonia" id="colonia" value="{{$negocio->colonia}}" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cp"><i class="fas fa-map-pin"></i> C.P.</label>
                      <input type="text" class="form-control" name="cp" id="cp" value="{{$negocio->cp}}" required>
                    </div>
                  </div>
                  
                </div>

                <div class="row">
                    
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="entidad"><i class="fas fa-flag"></i> Entidad Federativa</label>
                      <select class="form-control" name="entidad" id="entidad" onchange="MunicipiosApi(this,1);" required>
                        <option value="{{isset($entidad->id) ? $entidad->id :''}}">{{isset($entidad->entidad) ? $entidad->entidad : ''}}</option>
                        @foreach($entidades as $entidad)
                          <option value="{{$entidad->id}}">{{$entidad->entidad}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="municipio"><i class="fas fa-city"></i> Alcaldía/Municipio</label>
                      <select  class="form-control" name="municipio" id="municipio" aria-invalid="false" data-mun="municipio" >
                        <option value="{{isset($negocio->municipio) ? $negocio->municipio :''}}">{{isset($negocio->municipio) ? $negocio->municipio : ''}}</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <label for="map"><i class="fas fa-map-marked-alt"></i> Ubicación del Establecimiento</label>
                    <div name="map" id="map" style="height: 350px; width: 100%;"></div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="latitud"><i class="fas fa-latitude"></i> Latitud</label>
                      <input type="text" class="form-control" name="latitud" id="latitud" value="{{$negocio->latitud}}" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="longitud"><i class="fas fa-longitude"></i> Longitud</label>
                      <input type="text" class="form-control" name="longitud" id="longitud" value="{{$negocio->longitud}}" required>
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
                      <iframe name="inlineFrameExample" id="inlineFrameExample"
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
                      <input type="email" class="form-control" name="correo" id="correo" value="{{$negocio->correo}}" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="telefono"><i class="fas fa-phone"></i> Teléfono</label>
                      <input type="tel" class="form-control" name="telefono" id="telefono" value="{{$negocio->telefono}}" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="celular"><i class="fas fa-mobile-alt"></i> Celular</label>
                      <input type="tel" class="form-control" name="celular" id="celular" value="{{$negocio->celular}}" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" name="guardar" id="guardar" class="btn btn-theme-primary float-right">
    {!! $negocio->verificado == 0 ? '<i class="fas fa-check"></i> Validar y Guardar' : '<i class="fas fa-save"></i> Guardar' !!}
</button>
          </div>
        </div>
        </form>
      </div>
    </section>
  </div>


</div>

<!-- Scripts -->


<script>
    var markers = [];
    function initMap() {
        const myLatlng = { lat:  $('#latitud').val()*1, lng: $('#longitud').val()*1 };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 19,
          center: myLatlng,
        });
        const marker = new google.maps.Marker({
            position: myLatlng,
            map,
            title:$('#negocio').val()
        });
        markers.push(marker);
        
        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
          content: $('#negocio').val(),
          position: myLatlng,
        });
        infoWindow.open(map,marker);
        // Configure the click listener.
         
        map.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.
            infoWindow.close();
            DeleteMarkers();
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
              position: mapsMouseEvent.latLng,
            });
            var coordenadas=mapsMouseEvent.latLng.toJSON();
            $('#latitud').val(coordenadas.lat);
            $('#longitud').val(coordenadas.lng);
            const coorobra = { lat:  coordenadas.lat*1, lng: coordenadas.lng*1 };
            const marker = new google.maps.Marker({
            position: coorobra,
            map,
            title: "{{$negocio->negocio}}"
            });
             //Add marker to the array.
            markers.push(marker);
            infoWindow.setContent('La obra se localiza:<br>Latitud:'+coordenadas.lat+'<br>Longitud:'+coordenadas.lng);
          
            infoWindow.open(map,marker);
          
        });
    }

    
</script>

@include('MapsApi')
@include('administracion.footer')

</body>
</html>