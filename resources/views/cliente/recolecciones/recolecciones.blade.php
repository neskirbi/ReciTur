<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>CSMX | Negocios</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
  @include('cliente.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('cliente.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header"></div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-bars mr-2"></i>Recolecciones</h3>
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
                            <th>Establecimientos</th>
                            <th>Tipo</th>                    
                            <th>Residuo</th>                  
                            <th>Cantidad</th>
                            <th>Día</th>
                            <th>Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($recolecciones as $recoleccion)
                          <tr>
                            <td>{{$recoleccion->negocio}}</td>
                            <td>{{$recoleccion->tiponegocio}}</td>
                            <td>{{$recoleccion->residuo}}</td>
                            <td>{{$recoleccion->contenedor.' '.$recoleccion->cantidad}}</td>
                            <td>{{FechaFormateada($recoleccion->created_at)}}</td>
                            <td>
                              <a href="Manifiesto/{{$recoleccion->id}}" target="_blank" class="btn btn-info btn-sm">
                                <i class="fa fa-download mr-1"></i>Manifiesto
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

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="dist/js/adminlte.js"></script>
</body>
</html>