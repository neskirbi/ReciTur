<!DOCTYPE html>
<html lang="en">
<head>
  @include('asociados.header')
  <title>AMRCD | Municipios</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  @include('toast.toasts')
  <div class="wrapper">

    <!-- Navbar -->
    @include('asociados.navigations.navigation')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('asociados.sidebars.sidebar')

    <!-- Content Wrapper -->
    <div class="content-wrapper">
      <!-- Content Header -->
      <div class="content-header"></div>
      <!-- /.content-header -->

      <!-- Main Content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card card-primary card-outline card-outline-tabs">
                <!-- Card Header -->
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="nav-icon fa fa-recycle" aria-hidden="true"></i> Municipios
                  </h3>
                  <div class="card-tools">
                    <div class="btn-group">
                      <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right" style="width: 300px;">
                        <form class="px-4 py-3" action="{{ url('municipios') }}" method="GET">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-map"></i></span>
                            </div>
                            <input type="text" class="form-control" name="entidad" id="entidad" placeholder="Entidad" @if(isset($filtros->entidad)) value="{{ $filtros->entidad }}" @endif>
                          </div>

                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                            </div>
                            <input type="text" class="form-control" name="municipio" id="municipio" placeholder="Municipio" @if(isset($filtros->municipio)) value="{{ $filtros->municipio }}" @endif>
                          </div>

                          <div class="dropdown-divider"></div>
                          <button type="submit" class="btn btn-block btn-info">Aplicar</button>
                          <a href="{{ url('municipios') }}" class="btn btn-block btn-default">Limpiar</a>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->

                <!-- Card Body -->
                <div class="card-body">
                  @if(count($municipios))
                  <?php 
                  $entidad = '';
                  ?>
                    @foreach($municipios as $municipio)
                      @if($entidad != $municipio->entidad)
                      <div class="callout callout-info">
                        <h5>{{$municipio->entidad}}</h5>
                      </div>
                      <?php $entidad = $municipio->entidad;?>
                      @endif
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-12">
                                  <h5 class="card-title">
                                    <b>{{ strlen($municipio->municipio) < 81 ? $municipio->municipio : mb_substr($municipio->municipio, 0, 80, "UTF-8") . '...' }}</b>
                                  </h5>
                                </div>
                              </div>
                              <br><br>
                              <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3">
                                  
                                </div>
                                <div class="col-md-3">
                                  <a href="{{ url('administradoresasoc') }}/{{ $municipio->id }}" target="_blank" class="btn btn-block btn-info">
                                    <i class="fa fa-group" aria-hidden="true"></i> Administradores
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  @endif
                </div>
                <!-- /.card-body -->

                <!-- Card Footer -->
                <div class="card-footer">
                  {{ $municipios->appends($_GET)->links('pagination::bootstrap-4') }}
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Footer -->
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

  <!-- Scripts -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/chart.js/Chart.min.js"></script>
  <script src="plugins/sparklines/sparkline.js"></script>
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="dist/js/adminlte.js"></script>
</body>
</html>