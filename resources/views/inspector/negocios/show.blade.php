<!DOCTYPE html>
<html lang="en">
<head>
  @include('inspector.header')
  <title>Recitur | Negocio</title>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  @include('toast.toasts')
  @include('inspector.navbars.navbar')
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
      
      @include('inspector.sidebar')
      <div class="container-fluid">

        <!-- Contenedor principal con dos columnas -->
        <div class="row">
          <!-- Columna de 8 para datos del negocio -->
          <div class="col-md-8">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-briefcase title-icon" aria-hidden="true"></i> Información del Negocio</h3>
              </div>
              <div class="card-body">
                <!-- Información del establecimiento por renglones -->
                <div class="row mb-3">
                  <div class="col-md-6">
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-signature"></i> Nombre del Establecimiento:</label>
                      <span class="info-value">{{$negocio->negocio}}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-store"></i> Giro:</label>
                      <span class="info-value">{{$negocio->giro}}</span>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-6">
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-user-tie"></i> Generador:</label>
                      <span class="info-value">{{$generador->razonsocial ?? 'No disponible'}}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-chart-line"></i> Estimación Diaria:</label>
                      <span class="info-value">{{$negocio->estimado}} Kg</span>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-6">
                    <div class="info-row">
                      <label class="info-label"><i class="fa fa-list-ol"></i> Unidades:</label>
                      <span class="info-value">{{$negocio->cantidad}} {{$negocio->unidades}}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-info-circle"></i> Estado:</label>
                      <span class="info-value status-{{$negocio->verificado == 1 ? 'active' : 'inactive'}}">
                        {{$negocio->verificado == 1 ? 'Activo' : 'Pendiente'}}
                      </span>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-6">
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-road"></i> Dirección:</label>
                      <span class="info-value">{{$negocio->calle}} {{$negocio->numeroext}}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-map-marker-alt"></i> Colonia:</label>
                      <span class="info-value">{{$negocio->colonia}}</span>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-6">
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-city"></i> Municipio:</label>
                      <span class="info-value">{{$negocio->municipio}}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-flag"></i> Entidad:</label>
                      <span class="info-value">{{isset($entidad->entidad) ? $entidad->entidad : ''}}</span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-map-pin"></i> C.P.:</label>
                      <span class="info-value">{{$negocio->cp}}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-trash-alt"></i> Total Recolecciones:</label>
                      <span class="info-value">{{count($recolecciones)}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Columna de 4 para gráficas -->
          <div class="col-md-4">
            <!-- Gráfica de avance del mes -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-bar"></i> Avance del Mes</h3>
              </div>
              <div class="card-body">
                <div class="chart-container">
                  <canvas id="avanceChart" height="250"></canvas>
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
    // Gráfico de Recolección Diaria
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('recoleccionChart').getContext('2d');
        
        // Datos para el gráfico (estos vendrían del controlador)
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
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Recolección Diaria - Últimos 30 días'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cantidad (Kg)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Fecha'
                        }
                    }
                }
            }
        });

        // Gráfica de avance del mes - BARRAS VERTICALES
        var avanceCtx = document.getElementById('avanceChart').getContext('2d');
        var avanceChart = new Chart(avanceCtx, {
            type: 'bar',
            data: {
                labels: ['Meta', 'Actual'],
                datasets: [{
                    label: 'Kg Recolectados',
                    data: [500, 320], // Datos de ejemplo - Meta a la izquierda, Actual a la derecha
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)', // Azul para Meta
                        'rgba(23, 109, 74, 0.7)'   // Verde para Actual
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',   // Azul para Meta
                        'rgba(23, 109, 74, 1)'     // Verde para Actual
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                indexAxis: 'x', // Barras verticales
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cantidad (Kg)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Ocultamos la leyenda ya que los colores son evidentes
                    }
                }
            }
        });
    });
</script>

<style>
.info-row {
    display: flex;
    flex-direction: column;
    padding: 8px 0;
}

.info-label {
    font-weight: 600;
    color: #555;
    font-size: 13px;
    margin-bottom: 4px;
}

.info-label i {
    margin-right: 8px;
    width: 16px;
    text-align: center;
}

.info-value {
    color: #333;
    font-weight: 500;
    font-size: 14px;
}

.status-active {
    color: #28a745;
    font-weight: 600;
}

.status-inactive {
    color: #dc3545;
    font-weight: 600;
}

.chart-container {
    position: relative;
    height: 100%;
    width: 100%;
}
</style>

@include('inspector.footer')

</body>
</html>