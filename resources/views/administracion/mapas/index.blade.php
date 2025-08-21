<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>Recitur | Negocios</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')
@include('administracion.navbars.navbar')
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     &nbsp;
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      
  @include('administracion.sidebar')
      <div class="container-fluid">

        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header position-relative">
                <h3 class="card-title"><i class="fa fa-briefcase title-icon" aria-hidden="true"></i> Negocios </h3>

                <div class="card-tools position-absolute end-0 top-0 mt-1 me-2" style="z-index: 2000;">
                  <div class="btn-group">
                    <button type="button" class="btn btn-outline-theme-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end p-3" style="width:300px;">
                      <form class="px-4 py-3" action="{{url('establecimientos')}}" method="GET">
                        <div class="input-group mb-3">
                          <span class="input-group-text"><i class="far fa-building"></i></span>
                          <input type="text" class="form-control" name="negocio" id="negocio" placeholder="Establecimiento" @if(isset($filtros->negocio)) value="{{$filtros->negocio}}" @endif>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="{{url('establecimientos')}}" class="btn btn-default btn-sm">Limpiar</a>
                        <button type="submit" class="btn btn-info btn-sm float-end">Aplicar</button>
                      </form>
                    </div>
                  </div>
                </div>


                
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div class="row">
                  <div class="col-md-12">
                    <label for="map"><i class="fas fa-map-marked-alt"></i> Mapa General </label>
                    <div id="map" style="height: 350px; width: 100%;"></div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="row" id="businessList">
                      @foreach($negocios2 as $neg)
                      <div class="col-md-12 mb-3">
                        <div class="card business-card {{ $neg->solicitud == 1 ? 'pending' : 'approved' }}">
                          <div class="card-body">
                            <h5 class="card-title">{{ $neg->negocio }}</h5>
                            <p class="card-text mb-1">
                              <i class="fas fa-tag"></i> {{ $neg->clasificacion }}
                            </p>
                            
                            <span class="badge status-badge {{ $neg->solicitud == 1 ? 'bg-warning' : 'bg-success' }}">
                              {{ $neg->solicitud == 1 ? 'Recolectar' : 'Recolectado' }}
                            </span>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                      {{ $negocios2->appends($_GET)->links('pagination::bootstrap-4') }}
                    </div>
                   
                  </div>
                </div>
                
                
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('administracion.footer')


<script>
    function initMap() {
        // Obtener los datos de negocios desde PHP
        var negocios = @json($negocion);
        
        // Verificar si tenemos negocios con coordenadas
        if (negocios.length === 0) {
            console.error('No hay negocios con coordenadas para mostrar');
            return;
        }
        
        // Crear el mapa centrado en el primer negocio
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: {lat: parseFloat(negocios[0].latitud), lng: parseFloat(negocios[0].longitud)}
        });
        
        // Crear un array para almacenar los marcadores
        var markers = [];
        
        // Definir los iconos para diferentes estados de solicitud
        var yellowIcon = {
            url: 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png',
            scaledSize: new google.maps.Size(32, 32)
        };
        
        var greenIcon = {
            url: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
            scaledSize: new google.maps.Size(32, 32)
        };
        
        // Crear un marcador para cada negocio
        negocios.forEach(function(negocio) {
            // Verificar que las coordenadas sean válidas
            if (negocio.latitud && negocio.longitud) {
                // Determinar el color del marcador según el estado de solicitud
                var icon = (negocio.solicitud == 1) ? yellowIcon : greenIcon;
                
                var marker = new google.maps.Marker({
                    position: {lat: parseFloat(negocio.latitud), lng: parseFloat(negocio.longitud)},
                    map: map,
                    title: negocio.negocio,
                    icon: icon
                });
                
                // Agregar información en un popup al hacer clic
                var infoWindow = new google.maps.InfoWindow({
                    content: '<div><strong>' + negocio.negocio + '</strong><br>' +
                             'Estado: ' + (negocio.solicitud == 1 ? 'Pendiente' : 'Aprobado') + '</div>'
                });
                
                marker.addListener('click', function() {
                    infoWindow.open(map, marker);
                });
                
                markers.push(marker);
            }
        });
        
        // Si hay múltiples marcadores, ajustar la vista para mostrarlos todos
        if (markers.length > 1) {
            var bounds = new google.maps.LatLngBounds();
            markers.forEach(function(marker) {
                bounds.extend(marker.getPosition());
            });
            map.fitBounds(bounds);
        }
        
        // Agregar leyenda al mapa
        var legend = document.createElement('div');
        legend.id = 'legend';
        legend.style.backgroundColor = 'white';
        legend.style.padding = '10px';
        legend.style.borderRadius = '5px';
        legend.style.boxShadow = '0 2px 6px rgba(0,0,0,0.3)';
        legend.innerHTML = '<div style="font-weight: bold; margin-bottom: 5px;">Leyenda:</div>' +
                           '<div><img src="http://maps.google.com/mapfiles/ms/icons/yellow-dot.png" height="16" width="16"> Solicitud de Recoleccion</div>';
        
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(legend);
    }
    
    // Inicializar el mapa cuando la página esté cargada
    document.addEventListener('DOMContentLoaded', function() {
        // Verificar si Google Maps está cargado
        if (typeof google !== 'undefined') {
            initMap();
        } else {
            console.error('Google Maps no se ha cargado correctamente');
        }
    });
</script>

@include('MapsApi')
</body>
</html>
