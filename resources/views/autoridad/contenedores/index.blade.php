<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>Recitur | Catálogo</title>

  
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
        <!-- Botón para abrir el modal -->
        <button type="button" class="btn btn-theme-primary mb-3" data-bs-toggle="modal" data-bs-target="#nuevoResiduoModal">
          <i class="fas fa-plus-circle me-2"></i> Agregar Nuevo Contenedor
        </button>


        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header position-relative">
                <h3 class="card-title"><i class="fa fa-trash-alt title-icon" aria-hidden="true"></i> Contenedor </h3>

                


                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                
                <div class="row">
                  <div class="col-md-12" >
                    @if(count($contenedores))
                    
                    
                     <ul class="list-group">
                              @foreach($contenedores as $contenedor)
                              <li class="list-group-item border-theme-primary mb-2">
                                <form method="POST" action="{{ route('contenedores.update', $contenedor->id) }}" class="residuo-form">
                                  @csrf
                                  @method('PUT')

                                  <div class="row">
                                    <!-- Categoría (renglón completo) -->
                                    <div class="col-md-6">
                                      <label class="form-label small text-muted">Contenedor</label>
                                      <input type="text" name="contenedor" value="{{ $contenedor->contenedor }}" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-4">
                                      <label class="form-label small text-muted">Multiplicador</label>
                                      <input type="number" step="1" min="0" name="multiplicador" value="{{ $contenedor->multiplicador }}" class="form-control form-control-sm">
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <!-- Botones -->
                                    <div class="col-md-4 d-flex align-items-end gap-2">
                                      <button type="submit" class="btn btn-sm btn-theme-primary flex-grow-1">
                                        <i class="fa fa-save"></i> Guardar
                                      </button>
                                      
                                      <button type="button" class="btn btn-sm btn-danger" onclick="confirmarEliminacion('{{ $contenedor->id }}')">
                                        <i class="fa fa-trash"></i>
                                      </button>
                                    </div>
                                  </div>
                                </form>

                                <!-- Formulario oculto para eliminar -->
                                <form id="delete-form-{{ $contenedor->id }}" action="{{ route('contenedores.destroy', $contenedor->id) }}" method="POST" style="display: none;">
                                  @csrf
                                  @method('DELETE')
                                </form>
                              </li>
                              @endforeach
                            </ul>


                   
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
<script>
function confirmarEliminacion(id) {
  if (confirm('¿Estás seguro que deseas eliminar este residuo?\nEsta acción no se puede deshacer.')) {
    document.getElementById('delete-form-' + id).submit();
  }
}
</script>

<!-- Modal para agregar nuevo residuo -->
<div class="modal fade" id="nuevoResiduoModal" tabindex="-1" aria-labelledby="nuevoResiduoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-theme-info text-white">
        <h5 class="modal-title" id="nuevoResiduoModalLabel">Registrar Nuevo Residuo</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="{{ route('contenedores.store') }}" id="formNuevoResiduo">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="mb-3">
              <label for="contenedor" class="form-label">Contenedor</label>
              <input type="text" class="form-control" id="contenedor" name="contenedor" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <label class="form-label small text-muted">Multiplicador</label>
              <input type="number" step="1" min="0" name="multiplicador" value="{{ $contenedor->multiplicador }}" class="form-control form-control-sm">
            </div>
          
          </div>
          

          
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-theme-primary">
            <i class="fas fa-save me-2"></i>Guardar Contenedor
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


@include('administracion.footer')
</body>
</html>
