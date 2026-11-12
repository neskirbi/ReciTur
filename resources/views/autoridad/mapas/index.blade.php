<!DOCTYPE html>
<html lang="en">
<head>
  @include('autoridad.header')
  <title>Recitur | Mapa</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')
@include('autoridad.navbars.navbar')
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
      
  @include('autoridad.sidebar')
      <div class="container-fluid">

        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header position-relative">
                <h3 class="card-title"><i class="fa fa-map title-icon" aria-hidden="true"></i> Mapa </h3>

                <div class="card-tools position-absolute end-0 top-0 mt-1 me-2" style="z-index: 2000;">
                  <div class="btn-group">
                    <button type="button" class="btn btn-outline-theme-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end p-3" style="width:300px;">
                      <form class="px-4 py-3" action="{{url('autoridad/mapa')}}" method="GET">
                        
                        <div class="form-group">
                          <label for="clasificacion"><i class="fas fa-list"></i> Clasificación</label>
                          <select class="form-control" name="clasificacion" id="clasificacion" required>
                            <option value="{{$filtros->clasificacion ?? '' }}">{{$filtros->clasificacion ?? '--Clasificación--' }}</option>
                            @foreach($clasificaciones as $clas)
                              <option value="{{$clas->clasificacion}}">{{$clas->clasificacion}}</option>
                            @endforeach
                          </select>
                        </div>
                      

                        <div class="dropdown-divider"></div>
                        <a href="{{url('autoridad/mapa')}}" class="btn-outline-theme-gray btn-sm">Limpiar</a>
                        <button type="submit" class="btn btn-outline-theme-info btn-sm float-end">Aplicar</button>
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
                            @if($neg->solicitud == 1)
                            <i class="fas fa-truck"></i>                            
                            <span class="badge status-badge {{ $neg->solicitud == 1 ? 'bg-warning' : 'bg-success' }}">
                               {{ $neg->solicitud == 1 ? 'Recolectar' : 'Recolectado' }}
                            </span>
                            @endif
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

@include('autoridad.footer')


<script>
    function initMap() {
        var negocios = @json($negocios);
        
        if (negocios.length === 0) {
            console.error('No hay negocios con coordenadas para mostrar');
            return;
        }
        
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: {lat: parseFloat(negocios[0].latitud), lng: parseFloat(negocios[0].longitud)}
        });
        
        var markers = [];
        var currentInfoWindow = null;
        
        var yellowIcon = {
            url: 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png',
            scaledSize: new google.maps.Size(32, 32)
        };
        
        var greenIcon = {
            url: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
            scaledSize: new google.maps.Size(32, 32)
        };
        
        negocios.forEach(function(negocio) {
            if (negocio.latitud && negocio.longitud) {
                var icon = (negocio.solicitud == 1) ? yellowIcon : greenIcon;
                
                var marker = new google.maps.Marker({
                    position: {lat: parseFloat(negocio.latitud), lng: parseFloat(negocio.longitud)},
                    map: map,
                    title: negocio.negocio,
                    icon: icon
                });
                
                var infoWindow = new google.maps.InfoWindow({
                    content: '<div><strong>' + negocio.negocio + '</strong><br>' +
                             'Estado: ' + (negocio.solicitud == 1 ? 'Pendiente' : 'Aprobado') + '<br>' 
                });
                
                marker.addListener('mouseover', function() {
                    if (currentInfoWindow) {
                        currentInfoWindow.close();
                    }
                    infoWindow.open(map, marker);
                    currentInfoWindow = infoWindow;
                });
                
                marker.addListener('click', function() {
                    window.open(url('autoridad/negocios') + '/' + negocio.id, '_blank');
                });
                
                markers.push(marker);
            }
        });
        
        if (markers.length > 1) {
            var bounds = new google.maps.LatLngBounds();
            markers.forEach(function(marker) {
                bounds.extend(marker.getPosition());
            });
            map.fitBounds(bounds);
        }
        
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
    
    function url(path, id = '') {
        var baseUrl = Url();
        return baseUrl + path + id;
    }
    
    document.addEventListener('DOMContentLoaded', function() {
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