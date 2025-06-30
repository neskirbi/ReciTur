<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>Recitur | Recolecciones</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
@include('administracion.navbars.navbar')
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
      
  @include('administracion.sidebar')
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-trash-alt title-icon" aria-hidden="true"></i> Recolecciones</h3>

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
                
              
                <div class="row">
                  <div class="col-md-12" style="overflow-x:scroll;">
                    @if(count($recolecciones))
                    
                      
                        @foreach($recolecciones as $recoleccion)

                        <div class="card mb-4">
                            <!-- Badge de estatus en la esquina superior derecha -->
                           
                            <div class="card-body">
                              <small class="badge bg-theme-success float-right">
                                <i class="fa fa-check" aria-hidden="true"></i> Recolectado
                              </small>
                              <h5 class="card-title">{{$recoleccion->negocio}}</h5>
                              <p class="card-text">
                                <strong>{{$recoleccion->tiponegocio}}</strong> <br>
                              </p>
                            </div>
                            <div class="card-footer">
                              <!-- Botones -->
                              <div class="row">
                                <div class="col-md-3"></div>                              
                                <div class="col-md-3"></div>                              
                                <div class="col-md-3"></div>                              
                                <div class="col-md-3">
                                  <a href="{{url('Manifiesto')}}/{{$recoleccion->id}}" target="_blank" class="btn btn-theme-primary btn-block"><i class="fa fa-download" aria-hidden="true"></i> Manifiesto</a>                            
                                </div>                              
                              </div>
                            </div>
                          </div>
                        

                      
                        @endforeach
                        <div class="d-flex justify-content-center mt-4">
                      {{ $recolecciones->appends($_GET)->links('pagination::bootstrap-4') }}
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
   
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


@include('administracion.footer')
</body>
</html>
