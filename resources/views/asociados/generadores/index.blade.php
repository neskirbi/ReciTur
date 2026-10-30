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
                                <!-- Botón Quitar (siempre visible) -->
                                <button type="button" class="btn btn-theme-danger text-white" style="width: 25%;" 
                                        onclick="confirmarEliminar('{{ $generador->id }}', '{{ $generador->razonsocial }}')">
                                  <i class="fa fa-times" aria-hidden="true"></i> Quitar
                                </button>
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

  <!-- Modal de Confirmación -->
  <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-theme-danger text-white">
          <h5 class="modal-title" id="modalEliminarLabel"><i class="fa fa-exclamation-triangle"></i> Confirmar eliminación</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>¿Estás seguro de que deseas eliminar el generador <strong id="nombreGenerador"></strong>?</p>
          <p class="text-muted small">Esta acción no se puede deshacer.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <form id="formEliminar" method="POST" class="m-0">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-theme-danger text-white">
              <i class="fa fa-trash"></i> Sí, eliminar
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  @include('asociados.footer')

  <!-- Script para manejar el modal -->
  <script>
    function confirmarEliminar(id, nombre) {
        // Cambiar la acción del formulario dinámicamente
        var url = "{{ url('asociados/generadores') }}/" + id;
        document.getElementById('formEliminar').action = url;
        
        // Poner el nombre en el modal
        document.getElementById('nombreGenerador').innerText = nombre;
        
        // Abrir el modal
        $('#modalEliminar').modal('show');
    }
  </script>
</body>
</html>