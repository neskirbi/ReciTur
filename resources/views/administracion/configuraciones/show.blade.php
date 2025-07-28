<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>CSMX | Negocios</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('administracion.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('administracion.sidebars.sidebar')

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
            <form action="{{url('recoleccion')}}/{{$recoleccion->id}}" method="post">
              @csrf
              @method('PUT')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-file-text" aria-hidden="true"></i> Vehículo que transporta los residuos </h3>

               
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="bmatricula">Buscar Vehículo (Placa)</label>
                        <input required autocomplete="off" onkeyup="BuscarPlaca(this);" type="text" class="form-control" id="bmatricula" placeholder="Buscar Matrícula" aria-invalid="false" >
                        
                        
                        <div class="dropdown">
                            <div class="dropdown-menu" id="menu" aria-labelledby="dropdownMenuButton">                                
                            </div>
                        </div>
                        <input type="text" style="display:none;" name="id_vehiculo" class="form-control" id="id_vehiculo" aria-invalid="false" >
                    </div>
                  </div>
                    
                </div>
                
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="ramir">Ramir</label>
                        <input disabled required type="text" class="form-control" id="ramir" placeholder="Ramir" aria-invalid="false" >
                        
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="marca">Marca</label>
                        <input disabled required type="text" class="form-control" id="marca" placeholder="Marca" aria-invalid="false" >
                        
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="vehiculo">Vehículo</label>
                        <input disabled required type="text" class="form-control" id="vehiculo" placeholder="Vehículo" aria-invalid="false" >
                        
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="modelo">Modelo</label>
                        <input disabled type="text" class="form-control" id="modelo" placeholder="Modelo" aria-invalid="false" >
                        
                    </div>
                  </div>
                    
                </div>
                
              </div>
              <div class="card-footer">
                <button class="float-right btn btn-info">Guardar</button>
              </div>
              <!-- /.card-body -->
            </div>
            </form>
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
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);

 
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
</body>
</html>
