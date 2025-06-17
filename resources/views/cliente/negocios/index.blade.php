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
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-industry" aria-hidden="true"></i> Negocio </h3>

                <!--<div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>-->
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">  
                <div class="col-md-3">
                  <a href="{{url('negocios/create')}}">
                    <div class="info-box">
                      <span class="info-box-icon bg-info"><i class="fa fa-plus"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text" style="color:#000;">Negocio</span>
                      </div>
                    </div>
                  </a>                    
                </div>

                <div class="row">
                  <div class="col-md-12" style="overflow-x:scroll;">
                    @if(count($negocios))

                    @foreach($negocios as $negocio)
                          <div class="card mb-4">
                            <!-- Badge de estatus en la esquina superior derecha -->
                           
                            <div class="card-body">
                              @if($negocio->verificado == 0)
                                <small class="badge badge-warning float-right">
                                  <i class="fa fa-exclamation" aria-hidden="true"></i> Pendiente
                                </small>
                              @else
                                <small class="badge badge-success float-right">
                                  <i class="fa fa-check" aria-hidden="true"></i> Verificado
                                </small>
                              @endif
                              <h5 class="card-title">{{$negocio->razonsocial}}</h5>
                              <p class="card-text">
                                <strong>{{$negocio->negocio}}</strong> <br>
                              </p>
                            </div>
                            <div class="card-footer">
                              <!-- Botones -->
                              <div class="mt-2">
                                <!-- Botón Ver -->
                                <a href="negocios/{{$negocio->id}}" class="btn btn-info btn-sm btn-block">
                                  <i class="fa fa-eye" aria-hidden="true"></i> Ver
                                </a>
                                <!-- Botón Quitar (solo si no está verificado) -->
                                @if($negocio->verificado == 0)
                                <hr>
                                  <form action="negocios/{{$negocio->id}}" method="POST" class="d-inline">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button id="borrar" class="borrar btn btn-danger btn-sm btn-block btn-quitar" data-texto="¿Deseas quitar este generador?">
                                      <i class="fa fa-times" aria-hidden="true"></i> Quitar
                                    </button>
                                  </form>
                                @endif
                              </div>
                            </div>
                          </div>
                      @endforeach
                    
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
