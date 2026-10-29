<!DOCTYPE html>
<html lang="en">
<head>
  @include('asociados.header')
  <title>{{GetSiglas(2)}} | Generadores</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')
@include('asociados.navbar')

  <div class="wrapper">
   
    <!-- Content Wrapper -->
    <div class="content-wrapper">
      <!-- Content Header -->
      <div class="content-header">&nbsp;</div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        
  @include('asociados.sidebar')
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
                 
                </div>
                  @if(count($generadores))
                    <div class="row">
                      @foreach($generadores as $generador)
                        <div class="col-12"> <!-- 1 tarjeta por fila -->
                          <div class="card mb-4">
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
                              <div class="d-flex" style="gap: .5rem;">
                                <!-- Botón Ver -->
                                <a href="{{ route('generadores.show', $generador->id) }}" class="btn btn-theme-success text-white" style="width: 25%;">
                                  <i class="fa fa-eye" aria-hidden="true"></i> Ver
                                </a>
                                <!-- Botón Quitar (solo si no está verificado) -->
                                @if($generador->verificado == 0)
                                  <form action="{{ route('generadores.destroy', $generador->id) }}" method="POST" class="m-0" style="width: 25%;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button id="borrar" class="borrar btn btn-theme-danger btn-quitar w-100" data-texto="¿Deseas quitar este generador?">
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

 
  @include('asociados.footer')
</body>
</html>