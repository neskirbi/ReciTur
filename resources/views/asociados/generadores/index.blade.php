<!DOCTYPE html>
<html lang="en">
<head>
  @include('asociados.header')
  <title>{{GetSiglas(0)}} | Generadores</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('asociados.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('asociados.sidebars.sidebar')

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
                <h3 class="card-title">Generadores</h3>

                <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width:300px;">
                      <form class="px-4 py-3" action="{{url('generador')}}" method="GET">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-building"></i></span>
                          </div>
                          <input type="text" class="form-control" name="generador" id="generador" placeholder="Generador" @if(isset($filtros->generador)) value="{{$filtros->generador}}" @endif >
                        </div>

                        <div class="dropdown-divider"></div>
                        <a href="generador" class="btn btn-default btn-sm">Limpiar</a>
                        <button type="submit" class="btn btn-info btn-sm float-right">Aplicar</button>
                        
                      </form>
                      
                    </div>
                  </div>                 
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
                
                @if(count($generadores))
               
                  
                    @foreach($generadores as $generador)

                    <div class="row">
                      <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-12">
                                  <h5 class="card-title" title="{{$generador->razonsocial}}"><b>{{strlen($generador->razonsocial)<81 ? $generador->razonsocial : mb_substr($generador->razonsocial,0,80,"UTF-8").'...'}}</b></h5>
                                  @if($generador->verificado==0)
                                    <small class="badge badge-warning float-right"><i class="fa fa-exclamation" aria-hidden="true"></i> Pendiente</small>
                                  @else
                                    <small class="badge badge-success float-right"><i class="fa fa-check" aria-hidden="true"></i>  Verificado</small>
                                  @endif

                                  <br><h5 class="card-title" title="{{$generador->rfc}}"> <b>RFC:</b> {{$generador->rfc}}</h5>

                                  <br><h5 class="card-title" title="{{$generador->mail}}"> <b>Correo:</b> {{$generador->mail}}</h5>

                                  
                                
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">                           
                                <br>
                                </div>
                              </div>
                              
                              
                              <div class="row">
                                                        
                                <div class="col-md-3" >
                                  <a href="generador/{{$generador->id}}" class="btn btn-info btn-block" ><i class="fa fa-eye" aria-hidden="true"></i> Revisar</a>
                                </div>   

                                <div class="col-md-3" > 
                              
                                </div> 
                                <div class="col-md-3" >                       
                                </div>        

                                <div class="col-md-3" >
                                  <a href="{{url('BorrarGenerador')}}/{{$generador->id}}" class="btn btn-danger btn-block borrar" data-texto="Desea borrar el generador?" ><i class="fa fa-times" aria-hidden="true"></i> Borrar</a>
                                  
                                </div>

                              
                              
                              
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>




                      
                    @endforeach
                  
                @endif
              </div>
              <div class="card-footer">
              {{ $generadores->appends($_GET)->links('pagination::bootstrap-4') }}
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
@include('cliente.generadores.modals.modalgenerador')
@include('asociados.footer')
</body>
</html>
