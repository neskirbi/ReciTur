<!DOCTYPE html>
<html lang="en">
<head>
  @include('autoridad.header')
  <title>Recitur | Negocio</title>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  @include('toast.toasts')
  @include('autoridad.navbars.navbar')
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
      
      @include('autoridad.sidebar')
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
                      <label><i class="fas fa-user-tie"></i> Generador</label>
                      <input type="text" class="form-control" value="{{$generador->razonsocial ?? ''}}" readonly>
                    </div>
                  </div>
               
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><i class="fas fa-signature"></i> Nombre del Establecimiento</label>
                      <input type="text" class="form-control" value="{{$negocio->negocio}}" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                    
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><i class="fas fa-store"></i> Giro del Establecimiento</label>
                      <input type="text" class="form-control" value="{{$negocio->giro}}" readonly>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label><i class="fa fa-list-ol"></i> Cantidad ({{$negocio->unidades}})</label>
                      <input type="text" class="form-control" value="{{$negocio->cantidad}}" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><i class="fas fa-trash-alt"></i> Estimación (Generación Diaria) Kg </label>
                      <input type="text" class="form-control" value="{{$negocio->estimado}}" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><i class="fas fa-road"></i> Calle</label>
                      <input type="text" class="form-control" value="{{$negocio->calle}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label><i class="fas fa-home"></i> Número Ext.</label>
                      <input type="text" class="form-control" value="{{$negocio->numeroext}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label><i class="fas fa-home"></i> Número Int.</label>
                      <input type="text" class="form-control" value="{{$negocio->numeroint}}" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><i class="fas fa-map-marker-alt"></i> Colonia</label>
                      <input type="text" class="form-control" value="{{$negocio->colonia}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><i class="fas fa-map-pin"></i> C.P.</label>
                      <input type="text" class="form-control" value="{{$negocio->cp}}" readonly>
                    </div>
                  </div>
                  
                </div>

                <div class="row">
                    
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><i class="fas fa-flag"></i> Entidad Federativa</label>
                      <input type="text" class="form-control" value="{{$negocio->entidad}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><i class="fas fa-city"></i> Alcaldía/Municipio</label>
                      <input type="text" class="form-control" value="{{$negocio->municipio}}" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <label><i class="fas fa-map-marked-alt"></i> Ubicación del Establecimiento</label>
                    <div name="map" id="map" style="height: 350px; width: 100%;"></div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><i class="fas fa-latitude"></i> Latitud</label>
                      <input type="text" class="form-control" name="latitud" id="latitud" value="{{$negocio->latitud}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><i class="fas fa-longitude"></i> Longitud</label>
                      <input type="text" class="form-control" name="longitud" id="longitud" value="{{$negocio->longitud}}" readonly>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Datos del Contacto -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-id-card"></i> Datos del Contacto</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><i class="fas fa-user"></i> Contacto</label>
                      <input type="text" class="form-control" value="{{$negocio->contacto}}" readonly>
                    </div>
                  </div>              
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><i class="fas fa-envelope"></i> Correo Contacto</label>
                      <input type="text" class="form-control" value="{{$negocio->correo}}" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><i class="fas fa-phone"></i> Teléfono</label>
                      <input type="text" class="form-control" value="{{$negocio->telefono}}" readonly>
                    </div>
                  </div>
                
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><i class="fas fa-mobile-alt"></i> Celular</label>
                      <input type="text" class="form-control" value="{{$negocio->celular}}" readonly>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <br>

        <!-- Gráfico de Recolección Diaria -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-line title-icon"></i> Gráfico de Recolección Diaria</h3>
              </div>
              <div class="card-body">
                <div class="chart-container">
                  <canvas id="recoleccionChart" height="100"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-trash-alt title-icon" aria-hidden="true"></i> Recolecciones</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    @if(count($recolecciones))
                    <div class="table-responsive">
                      <table class="table table-hover text-nowrap">
                        <thead class="thead-light">
                          <tr>
                            <th>Establecimiento</th>
                            <th>Fecha Recolección</th>
                            <th>Residuo</th>
                            <th>Cantidad</th>
                            <th>Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($recolecciones as $recoleccion)
                          <tr>
                            <td>{{$recoleccion->negocio}}</td>
                            <td>{{FechaFormateada($recoleccion->created_at)}}</td>
                            <td>
                              @if(isset($recoleccion->residuo) && $recoleccion->residuo)
                                {{$recoleccion->residuo}}
                              @else
                                <span class="text-muted">No especificado</span>
                              @endif
                            </td>
                            <td>
                              {{number_format($recoleccion->cantidad_calculada, 2)}} {{$recoleccion->unidades ?? 'Kg'}}
                            </td>
                            <td>
                              <a href="{{url('Manifiesto')}}/{{$recoleccion->id}}" target="_blank" class="btn btn-theme-info">
                                <i class="fa fa-download"></i> Manifiesto
                              </a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    @else
                    <div class="alert alert-info" role="alert">
                      <i class="fa fa-info-circle mr-2"></i>No hay recolecciones para mostrar.
                    </div>
                    @endif
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
  </div>


</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function initMap() {
        const myLatlng = { lat:  $('#latitud').val()*1, lng: $('#longitud').val()*1 };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 19,
          center: myLatlng,
        });
        const marker = new google.maps.Marker({
            position: myLatlng,
            map,
            title: '{{$negocio->negocio}}'
        });
        
        let infoWindow = new google.maps.InfoWindow({
          content: '{{$negocio->negocio}}',
          position: myLatlng,
        });
        infoWindow.open(map,marker);
    }

    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('recoleccionChart').getContext('2d');
        
        var chartData = {
            labels: {!! json_encode($chartLabels ?? []) !!},
            datasets: [{
                label: 'Cantidad Recolectada',
                data: {!! json_encode($chartData ?? []) !!},
                backgroundColor: 'rgba(23, 109, 74, 0.2)',
                borderColor: 'rgba(23, 109, 74, 1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }]
        };

        var recoleccionChart = new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Recolección Diaria - Últimos 30 días' }
                },
                scales: {
                    y: { beginAtZero: true, title: { display: true, text: 'Cantidad (Kg)' } },
                    x: { title: { display: true, text: 'Fecha' } }
                }
            }
        });
    });
</script>

@include('MapsApi')
@include('autoridad.footer')

</body>
</html>