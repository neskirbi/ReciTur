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
          <div class="col-md-7">
            <div class="card card-default h-100"> <!-- Agregada clase h-100 -->
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-briefcase title-icon" aria-hidden="true"></i> Información del Negocio</h3>
              </div>
              <div class="card-body d-flex flex-column"> <!-- Agregadas clases para flex -->
                <!-- Información del establecimiento por renglones -->
                <div class="row mb-2 flex-grow-1"> <!-- Agregada clase flex-grow-1 -->
                  <div class="col-md-6">
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-signature"></i> Nombre del Establecimiento:</label>
                      <span class="info-value">{{$negocio->negocio}}</span>
                    </div>
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-user-tie"></i> Generador:</label>
                      <span class="info-value">{{$generador->razonsocial ?? 'No disponible'}}</span>
                    </div>
                    <div class="info-row">
                      <label class="info-label"><i class="fa fa-list-ol"></i> Unidades:</label>
                      <span class="info-value">{{$negocio->cantidad}} {{$negocio->unidades}}</span>
                    </div>
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-road"></i> Dirección:</label>
                      <span class="info-value">{{$negocio->calle}} {{$negocio->numeroext}}</span>
                    </div>
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-city"></i> Municipio:</label>
                      <span class="info-value">{{$negocio->municipio}}</span>
                    </div>
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-map-pin"></i> C.P.:</label>
                      <span class="info-value">{{$negocio->cp}}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-store"></i> Giro:</label>
                      <span class="info-value">{{$negocio->giro}}</span>
                    </div>
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-chart-line"></i> Estimación Diaria:</label>
                      <span class="info-value">{{$negocio->estimado}} Kg</span>
                    </div>
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-info-circle"></i> Estado:</label>
                      <span class="info-value status-{{$negocio->verificado == 1 ? 'active' : 'inactive'}}">
                        {{$negocio->verificado == 1 ? 'Activo' : 'Pendiente'}}
                      </span>
                    </div>
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-map-marker-alt"></i> Colonia:</label>
                      <span class="info-value">{{$negocio->colonia}}</span>
                    </div>
                    <div class="info-row">
                      <label class="info-label"><i class="fas fa-flag"></i> Entidad:</label>
                      <span class="info-value">{{isset($entidad->entidad) ? $entidad->entidad : ''}}</span>
                    </div>
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
          <div class="col-md-5">
            <!-- Gráfica de avance del mes -->
            <div class="card h-100"> <!-- Agregada clase h-100 -->
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-bar"></i> Avance del Mes</h3>
              </div>
              <div class="card-body d-flex align-items-center justify-content-center"> <!-- Agregadas clases flex -->
                <div class="chart-container w-100"> <!-- Agregada clase w-100 -->
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
                <div class="chart-container" >
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Variables globales para los gráficos
    let recoleccionChart = null;
    let avanceChart = null;

    // Función para inicializar los gráficos
    function inicializarGraficos() {
        // Gráfico de Recolección Diaria
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

        recoleccionChart = new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false, // Importante para que se ajuste al contenedor
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
        
        // Calcular datos para la gráfica de avance
        var estimadoDiario = {{$negocio->estimado ?? 0}};
        var diasEnMes = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).getDate();
        var metaMensual = estimadoDiario * diasEnMes;
        
        // Calcular total recolectado en el mes actual
        var totalRecolectadoMes = 0;
        <?php
        // Calcular total del mes actual desde PHP
        $mesActual = now()->format('Y-m');
        $totalMesActual = 0;
        foreach($recolecciones as $recoleccion) {
            if (strpos($recoleccion->created_at, $mesActual) === 0) {
                $totalMesActual += $recoleccion->cantidad_calculada;
            }
        }
        ?>
        totalRecolectadoMes = {{$totalMesActual}};

        avanceChart = new Chart(avanceCtx, {
            type: 'bar',
            data: {
                labels: ['Meta', 'Actual'],
                datasets: [{
                    label: 'Kg Recolectados',
                    data: [metaMensual, totalRecolectadoMes],
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
                maintainAspectRatio: false, // Importante para que se ajuste al contenedor
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
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw.toFixed(2) + ' Kg';
                            }
                        }
                    }
                }
            }
        });
    }

    // Función para redimensionar gráficos
    function redimensionarGraficos() {
        if (recoleccionChart) {
            recoleccionChart.resize();
        }
        if (avanceChart) {
            avanceChart.resize();
        }
    }

    // Inicializar gráficos cuando el DOM esté listo
    document.addEventListener('DOMContentLoaded', function() {
        inicializarGraficos();
        
        // Detectar cambios en el layout (cuando se abre/cierra la barra lateral)
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                    // Esperar un poco para que el cambio de layout se complete
                    setTimeout(redimensionarGraficos, 300);
                }
            });
        });
        
        // Observar cambios en el body para detectar cambios de clase
        observer.observe(document.body, {
            attributes: true,
            attributeFilter: ['class']
        });

        // También redimensionar cuando cambia el tamaño de la ventana
        window.addEventListener('resize', function() {
            redimensionarGraficos();
        });

        // Detectar clic en el botón de toggle de la barra lateral (si existe)
        $('[data-widget="pushmenu"]').on('click', function() {
            setTimeout(redimensionarGraficos, 300);
        });
    });
</script>

<style>
.info-row {
    display: flex;
    flex-direction: column;
    padding: 4px 0; /* Reducido de 8px a 4px */
    min-height: 32px; /* Altura mínima consistente */
}

.info-label {
    font-weight: 600;
    color: #555;
    font-size: 12px; /* Reducido de 13px a 12px */
    margin-bottom: 2px; /* Reducido de 4px a 2px */
}

.info-label i {
    margin-right: 6px; /* Reducido de 8px a 6px */
    width: 14px; /* Reducido de 16px a 14px */
    text-align: center;
    font-size: 12px; /* Tamaño de icono reducido */
}

.info-value {
    color: #333;
    font-weight: 500;
    font-size: 13px; /* Reducido de 14px a 13px */
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
    min-height: 300px; /* Altura mínima para el gráfico de recolección */
}

/* Estilos adicionales para compactar más la sección */
.card-body {
    padding: 12px; /* Reducido del padding por defecto */
}

/* Asegurar que ambas cards tengan la misma altura */
.row {
    align-items: stretch; /* Hace que las columnas tengan la misma altura */
}

.card.h-100 {
    height: 100% !important;
}

/* Ajustes específicos para la gráfica */
#avanceChart {
    max-height: 250px;
    width: 100% !important;
}

/* Para el gráfico de recolección diaria */
#recoleccionChart {
    width: 100% !important;
}
</style>

@include('inspector.footer')

</body>
</html>