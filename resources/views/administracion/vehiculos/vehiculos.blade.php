<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>{{GetSiglas(2)}} | Vehículos</title>

  
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
        <div class="row" >
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"><i class="nav-icon fa fa-truck" aria-hidden="true"></i> Vehículos</h3>
                <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width:300px;">
                      <form class="px-4 py-3" action="{{url('vehiculos')}}" method="GET">
                        
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-truck"></i></span>
                          </div>
                          <input type="text" class="form-control" name="matricula" id="matricula" placeholder="Matrícula" @if(isset($filtros->matricula)) value="{{$filtros->matricula}}" @endif >
                        </div>

                        <div class="dropdown-divider"></div>
                        <a href="{{url('vehiculos')}}" class="btn btn-default btn-sm">Limpiar</a>
                        <button type="submit" class="btn btn-info btn-sm float-right">Aplicar</button>
                        
                      </form>
                      
                    </div>
                  </div>                 
                </div>
              </div>
              <div class="card-body">

                <div class="col-md-3">
                  <a href="{{url('vehiculos/create')}}">
                    <div class="info-box">
                      <span class="info-box-icon bg-info"><i class="fa fa-plus"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text" style="color:#000;">Vehículo</span>
                      </div>
                    </div>
                  </a>                    
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
                            <a href="vehiculos/{{$vehiculo->id}}" target="_blank" class="float-right" ><i class="link" aria-hidden="true"></i> Editar</a>
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
@include('administracion.footer')
</body>
</html>
