<!DOCTYPE html>
<html lang="en">
<head>
  @include('transportistas.header')
  <title>CSMX | Vehículos</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('transportistas.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('transportistas.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row" >
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"><i class="nav-icon fa fa-truck" aria-hidden="true"></i> Vehículos</h3>
              </div>
              <div class="card-body">
                <div class="p-2">
                  <a href="vehiculo/create" class="btn btn-primary"><span><i class="fa fa-plus" aria-hidden="true"></i></span> Vehículo</a>
                </div>
                <div class="row">
                  @foreach($vehiculos as $vehiculo) 
                  
                  <div class="col-md-3">           
                    <div class="card">
                      <img src="{{asset('images/iconos/vehiculo.png')}}" class="card-img-top" alt="...">
                      <div class="card-body">
                        
                        <font style="font-size:15px; ">{{$vehiculo->vehiculo}}</font><br>
                        <font style="font-size:13px; ">{{$vehiculo->matricula}}</font><br>
                        <br>
                        <div class="row" > 
                          <div class="col-md-6"> 
                            <!---a href="" class="link" ><i class="link" aria-hidden="true"></i> Ver</a> --->
                          </div>

                          <div class="col-md-6">
                            <a href="vehiculo/{{$vehiculo->id}}" class="float-right" ><i class="link" aria-hidden="true"></i> Editar</a>
                          </div>  

                        </div>
                      </div>  
                    </div>
                  </div>
                  @endforeach
                </div>
                
                
              </div>
              <div class="card-footer">
                {{ $vehiculos->appends($_GET)->links('pagination::bootstrap-4') }}
              </div>
            </div>
          </div>
        </div>
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
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>

<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>

<script>
  
</script>
@include('transportistas.footer')
</body>
</html>
