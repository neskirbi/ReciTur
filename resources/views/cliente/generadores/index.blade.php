<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>CSMX | Generadores</title>
  <style>
   
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  @include('toast.toasts')
  <div class="wrapper">
    <!-- Navbar -->
    @include('cliente.navigations.navigation')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('cliente.sidebars.sidebar')

    <!-- Content Wrapper -->
    <div class="content-wrapper">
      <!-- Content Header -->
      <div class="content-header"></div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Generadores</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="col-md-3">
                    <a href="{{url('generadores/create')}}">
                      <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fa fa-plus"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text" style="color:#000;">Generador</span>
                        </div>
                      </div>
                    </a>                    
                  </div>
                  @if(count($generadores))
                    <div class="row">
                      @foreach($generadores as $generador)
                        <div class="col-md-6"> <!-- 2 tarjetas por fila -->
                          <div class="card mb-4">
                            <!-- Badge de estatus en la esquina superior derecha -->
                            
                            <div class="card-body">
                              @if($generador->verificado == 0)
                                <small class="badge badge-warning float-right">
                                  <i class="fa fa-exclamation" aria-hidden="true"></i> Pendiente
                                </small>
                              @else
                                <small class="badge badge-success float-right">
                                  <i class="fa fa-check" aria-hidden="true"></i> Verificado
                                </small>
                              @endif
                              <h5 class="card-title">{{$generador->razonsocial}}</h5>
                              <p class="card-text">
                                <strong>RFC:</strong> {{$generador->rfc}}<br>
                                <strong>Persona:</strong> {{$generador->fisicaomoral}}<br>
                              </p>
                            </div>
                            <div class="card-footer">
                              <!-- Botones -->
                              <div class="mt-2">
                                <!-- Botón Ver -->
                                <a href="generadores/{{$generador->id}}" class="btn btn-info btn-sm btn-block">
                                  <i class="fa fa-eye" aria-hidden="true"></i> Ver
                                </a>
                                <!-- Botón Quitar (solo si no está verificado) -->
                                @if($generador->verificado == 0)
                                <hr>
                                  <form action="generadores/{{$generador->id}}" method="POST" class="d-inline">
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
                        </div>
                      @endforeach
                    </div>
                  @else
                    <p>No hay generadores registrados.</p>
                  @endif
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

    <!-- Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- Scripts -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <script src="dist/js/adminlte.js"></script>
  @include('cliente.generadores.modals.modalgenerador')
  @include('footer')
</body>
</html>