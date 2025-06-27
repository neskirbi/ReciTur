<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>Recitur | Negocios</title>

  
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
              <div class="card-header position-relative">
                <h3 class="card-title"><i class="fa fa-briefcase title-icon" aria-hidden="true"></i> Negocios </h3>

                <div class="card-tools position-absolute end-0 top-0 mt-1 me-2" style="z-index: 2000;">
                  <div class="btn-group">
                    <button type="button" class="btn btn-outline-theme-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end p-3" style="width:300px;">
                      <form class="px-4 py-3" action="{{url('establecimientos')}}" method="GET">
                        <div class="input-group mb-3">
                          <span class="input-group-text"><i class="far fa-building"></i></span>
                          <input type="text" class="form-control" name="negocio" id="negocio" placeholder="Establecimiento" @if(isset($filtros->negocio)) value="{{$filtros->negocio}}" @endif>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="{{url('establecimientos')}}" class="btn btn-default btn-sm">Limpiar</a>
                        <button type="submit" class="btn btn-info btn-sm float-end">Aplicar</button>
                      </form>
                    </div>
                  </div>
                </div>


                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <div class="row">
                  <div class="col-md-12" >
                    @if(count($negocios))
                    
                    
                        @foreach($negocios as $negocio)
                        <div class="card mb-4">
                            <!-- Badge de estatus en la esquina superior derecha -->
                           
                            <div class="card-body">
                              @if($negocio->verificado == 0)
                                <small class="badge bg-theme-warning float-right">
                                  <i class="fa fa-exclamation" aria-hidden="true"></i> Pendiente
                                </small>
                              @else
                                <small class="badge bg-theme-success float-right">
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
                                <a href="establecimientos/{{$negocio->id}}" class="btn btn-theme-success btn-block">
                                  <i class="fa fa-eye" aria-hidden="true"></i> Ver
                                </a>
                                <!-- Botón Quitar (solo si no está verificado) -->
                                
                                @if(file_exists('documentos/clientes/contratos/'.$negocio->id.'.pdf'))
                                  <hr>
                                  <a href="documentos/clientes/contratos/{{$negocio->id}}.pdf" target="_blank" class="btn btn-theme-info btn-block" >Contrato <i class="fa fa-download" aria-hidden="true"></i></a>                                 
                                @endif

                                @if($negocio->verificado==1)
                                <hr>
                                  <a href="cedula/{{$negocio->id}}" target="_blank" class="btn btn-theme-primary btn-block"><i class="fa fa-print" aria-hidden="true"></i> Cédula QR</a>
                                @endif
                              </div>
                            </div>
                          </div>
                        
                        @endforeach
                    <div class="d-flex justify-content-center mt-4">
                      {{ $negocios->appends($_GET)->links('pagination::bootstrap-4') }}
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
 
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('administracion.footer')
</body>
</html>
