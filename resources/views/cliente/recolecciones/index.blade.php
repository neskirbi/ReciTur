<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>Recitur | Recolecciones</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  @include('toast.toasts')
  @include('cliente.navbars.navbar')
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-trash-alt title-icon" aria-hidden="true"></i> Recolecciones</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Fila para exportación -->
                <div class="row mb-4">
                  <div class="col-md-12">
                    <div class="card bg-light">
                      <div class="card-body">
                        <h5 class="card-title"><i class="fa fa-file-excel text-success"></i> Exportar a Excel</h5>
                        <form action="{{ url('EstadoCuentaMesCliente') }}" method="GET" target="_blank" class="form-inline">
                          <div class="form-group mr-3">
                            <label for="anio" class="mr-2">Año:</label>
                            <select class="form-control" id="anio" name="anio" required>
                              @php
                                $currentYear = date('Y');
                                $startYear = 2021;
                              @endphp
                              @for($year = $currentYear; $year >= $startYear; $year--)
                                <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>
                                  {{ $year }}
                                </option>
                              @endfor
                            </select>
                          </div>
                          <div class="form-group mr-3">
                            <label for="mes" class="mr-2">Mes:</label>
                            <select class="form-control" id="mes" name="mes" required>
                              @php
                                $currentMonth = date('n');
                                $months = [
                                  1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                                  5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                                  9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                                ];
                              @endphp
                              @foreach($months as $key => $month)
                                <option value="{{ $key }}" {{ $key == $currentMonth ? 'selected' : '' }}>
                                  {{ $month }}
                                </option>
                              @endforeach
                            </select>
                          </div>
                          <button type="submit" class="btn btn-success">
                            <i class="fa fa-download"></i> Exportar
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-12">
                    @if(count($recolecciones))
                    <div class="table-responsive">
                      <table class="table table-hover text-nowrap">
                        <thead class="thead-light">
                          <tr>
                            <th>Establecimientos</th>
                            <th>Fecha Recolección</th>
                            <th>Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($recolecciones as $recoleccion)
                          <tr>
                            <td>{{$recoleccion->negocio}}</td>
                            <td>{{FechaFormateada($recoleccion->created_at)}}</td>
                            <td>
                              <a href="Manifiesto/{{$recoleccion->id}}" target="_blank" class="btn btn-theme-info">
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@include('cliente.footer')
</body>
</html>