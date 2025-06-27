<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>Recitur | Generadores</title>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
   @include('toast.toasts')
    @include('cliente.navbars.navbar')

  <div class="wrapper">
   
    <!-- Content Wrapper -->
    <div class="content-wrapper">
      <!-- Content Header -->
      <div class="content-header">&nbsp;</div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"> <i class="fa fa-industry title-icon" aria-hidden="true"></i> Generadores</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                <div class="d-flex justify-content-end mb-3">
                  <a href="{{ route('generadores.create') }}" class="btn btn-theme-success">
                    <i class="bi bi-plus-circle"></i> Agregar Generador
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
                                <small class="badge bg-theme-warning float-right">
                                  <i class="fa fa-exclamation" aria-hidden="true"></i> Pendiente
                                </small>
                              @else
                                <small class="badge bg-theme-success float-right">
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
                                <a href="generadores/{{$generador->id}}" class="btn btn-theme-success  btn-block text-white">
                                  <i class="fa fa-eye" aria-hidden="true"></i> Ver
                                </a>
                                <!-- Botón Quitar (solo si no está verificado) -->
                                @if($generador->verificado == 0)
                                <hr>
                                  <form action="generadores/{{$generador->id}}" method="POST" class="d-inline">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button id="borrar" class="borrar btn btn-theme-danger btn-block btn-quitar" data-texto="¿Deseas quitar este generador?">
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

    
  </div>
  <!-- ./wrapper -->

 
  @include('cliente.footer')
</body>
</html>