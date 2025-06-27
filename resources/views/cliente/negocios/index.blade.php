<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>Recitur | Negocios</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  @include('toast.toasts')
  @include('cliente.navbars.navbar')
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-briefcase title-icon" aria-hidden="true"></i> Negocios </h3>

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
                <div class="d-flex justify-content-end mb-3">
                  <a href="{{url('negocios/create')}}" class="btn btn-theme-success">
                    <i class="bi bi-plus-circle"></i> Agregar Negocio
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
                                <a href="negocios/{{$negocio->id}}" class="btn btn-theme-success btn-sm btn-block">
                                  <i class="fa fa-eye" aria-hidden="true"></i> Ver
                                </a>
                                <!-- Botón Quitar (solo si no está verificado) -->
                                @if($negocio->verificado == 0)
                                <hr>
                                  <form action="negocios/{{$negocio->id}}" method="POST" class="d-inline">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button id="borrar" class="borrar btn btn-theme-danger btn-sm btn-block btn-quitar" data-texto="¿Deseas quitar este generador?">
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
 
  @include('cliente.footer')

 


</body>
</html>
