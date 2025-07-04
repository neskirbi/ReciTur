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
          <i class="fas fa-plus-circle me-2"></i> Agregar Nuevo Residuo
        </button>


        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header position-relative">
                <h3 class="card-title"><i class="fa fa-briefcase title-icon" aria-hidden="true"></i> Residuos </h3>

                


                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                
                <div class="row">
                  <div class="col-md-12" >
                    @if(count($residuos))
                    
                    
                        @php
                          $agrupados = $residuos->groupBy('categoria');
                        @endphp

                        @foreach($agrupados as $categoria => $items)
                          <div class="mb-4">
                            <!-- Encabezado de categoría -->
                            <h5 class="text-theme-primary border-bottom pb-1 mb-3">
                              <i class="fa fa-tag me-2"></i>{{ $categoria }}
                            </h5>

                            <ul class="list-group">
                              @foreach($items as $residuo)
                              <li class="list-group-item border-theme-primary mb-2">
                                <form method="POST" action="{{ route('residuos.update', $residuo->id) }}" class="residuo-form">
                                  @csrf
                                  @method('PUT')

                                  <div class="row">
                                    <!-- Categoría (renglón completo) -->
                                    <div class="col-md-12 mb-2">
                                      <label class="form-label small text-muted">Categoría</label>
                                      <input type="text" name="categoria" value="{{ $residuo->categoria }}" class="form-control form-control-sm">
                                    </div>

                                    <!-- Residuo (renglón completo) -->
                                    <div class="col-md-12 mb-2">
                                      <label class="form-label small text-muted">Nombre del residuo</label>
                                      <input type="text" name="residuo" value="{{ $residuo->residuo }}" class="form-control form-control-sm">
                                    </div>

                                    <!-- Precio -->
                                    <div class="col-md-4 mb-2">
                                      <label class="form-label small text-muted">Precio</label>
                                      <input type="number" step="0.01" name="precio" value="{{ $residuo->precio }}" class="form-control form-control-sm">
                                    </div>

                                    <!-- Unidades -->
                                    <div class="col-md-4 mb-2">
                                      <label class="form-label small text-muted">Unidades</label>
                                      <input type="text" name="unidades" value="{{ $residuo->unidades }}" class="form-control form-control-sm">
                                    </div>

                                    <!-- Botones -->
                                    <div class="col-md-4 d-flex align-items-end gap-2">
                                      <button type="submit" class="btn btn-sm btn-theme-primary flex-grow-1">
                                        <i class="fa fa-save"></i> Guardar
                                      </button>
                                      
                                      <button type="button" class="btn btn-sm btn-danger" onclick="confirmarEliminacion('{{ $residuo->id }}')">
                                        <i class="fa fa-trash"></i>
                                      </button>
                                    </div>
                                  </div>
                                </form>

                                <!-- Formulario oculto para eliminar -->
                                <form id="delete-form-{{ $residuo->id }}" action="{{ route('residuos.destroy', $residuo->id) }}" method="POST" style="display: none;">
                                  @csrf
                                  @method('DELETE')
                                </form>
                              </li>
                              @endforeach
                            </ul>
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
      <form method="POST" action="{{ route('residuos.store') }}" id="formNuevoResiduo">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <input type="text" class="form-control" id="categoria" name="categoria" required>
          </div>
          <div class="mb-3">
            <label for="residuo" class="form-label">Nombre del Residuo</label>
            <input type="text" class="form-control" id="residuo" name="residuo" required>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="precio" class="form-label">Precio</label>
              <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="unidades" class="form-label">Unidades</label>
              <input type="text" class="form-control" id="unidades" name="unidades" value="Kg" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-theme-primary">
            <i class="fas fa-save me-2"></i>Guardar Residuo
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


@include('administracion.footer')
</body>
</html>
