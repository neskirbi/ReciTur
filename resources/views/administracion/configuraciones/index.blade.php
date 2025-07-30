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
        <!-- Botón para agregar nueva clasificación -->
        

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header position-relative">
                <h3 class="card-title"><i class="fa fa-cogs title-icon" aria-hidden="true"></i> Configuración</h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <!-- Pestañas -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active btn-outline-theme-primary" id="negocio-tab" data-bs-toggle="tab" data-bs-target="#negocio" type="button" role="tab">
                                Clasificaciones
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link btn-outline-theme-primary" id="pestania2-tab" data-bs-toggle="tab" data-bs-target="#pestania2" type="button" role="tab">
                                Centro de Acopio
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link btn-outline-theme-primary" id="pestania3-tab" data-bs-toggle="tab" data-bs-target="#pestania3" type="button" role="tab">
                                Info. Adicional
                            </button>
                        </li>
                    </ul>

                    <!-- Contenido de las pestañas -->
                    <div class="tab-content p-3 border border-top-0 rounded-bottom" id="myTabContent">
                        <!-- Pestaña 1: Tipo de Negocio -->
                        <div class="tab-pane fade show active" id="negocio" role="tabpanel">
                          <button type="button" class="btn btn-theme-primary mb-3" data-bs-toggle="modal" data-bs-target="#nuevaClasificacionModal">
                            <i class="fas fa-plus-circle me-2"></i> Agregar Nueva Clasificación
                          </button>
                            <h4 class="text-theme-primary mb-4">Clasificaciones registradas</h4>
                            
                            @if(count($clas))
                            <ul class="list-group">
                                @foreach($clas as $cla)
                                <li class="list-group-item border-theme-primary mb-2">
                                    <form method="POST" action="{{ url('ActualizarClasificaciones') }}/{{$cla->id}}" class="clasificacion-form">
                                        @csrf
                                        <div class="row">
                                            <!-- Giro -->
                                            <div class="col-md-3 mb-2">
                                                <label class="form-label small text-muted">Giro</label>
                                                <input type="text" name="giro" value="{{$cla->giro}}" class="form-control form-control-sm">
                                            </div>
                                            
                                            <!-- Clasificación -->
                                            <div class="col-md-3 mb-2">
                                                <label class="form-label small text-muted">Clasificación</label>
                                                <input type="text" name="clasificacion" value="{{$cla->clasificacion}}" class="form-control form-control-sm">
                                            </div>
                                            
                                            <!-- Unidades -->
                                            <div class="col-md-2 mb-2">
                                                <label class="form-label small text-muted">Unidades</label>
                                                <input type="text" name="unidades" value="{{$cla->unidades}}" class="form-control form-control-sm" maxlength="20">
                                            </div>
                                            
                                            <!-- Rango De -->
                                            <div class="col-md-2 mb-2">
                                                <label class="form-label small text-muted">De</label>
                                                <input type="number" name="de" value="{{$cla->de}}" class="form-control form-control-sm">
                                            </div>
                                            
                                            <!-- Rango A -->
                                            <div class="col-md-2 mb-2">
                                                <label class="form-label small text-muted">A</label>
                                                <input type="number" name="a" value="{{$cla->a}}" class="form-control form-control-sm">
                                            </div>
                                            
                                            <!-- Botones -->
                                            <div class="col-md-12 d-flex align-items-end gap-2">
                                                <button type="submit" class="btn btn-sm btn-theme-primary flex-grow-1">
                                                    <i class="fa fa-save"></i> Actualizar
                                                </button>
                                                
                                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmarEliminacion('{{ $cla->id }}')">
                                                    <i class="fa fa-trash"></i> Eliminar
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                    <!-- Formulario oculto para eliminar -->
                                    <form id="delete-form-{{ $cla->id }}" action="{{ url('EliminarClasificaciones') }}/{{$cla->id}}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <div class="alert alert-info">
                                No hay clasificaciones registradas aún.
                            </div>
                            @endif
                        </div>

                        <!-- Otras pestañas (mantenidas igual) -->
                        <!-- Pestaña 2: Centro de Acopio -->
                        <!-- Pestaña 2: Centro de Acopio -->
                        <div class="tab-pane fade" id="pestania2" role="tabpanel">
                            <h4 class="text-theme-primary mb-4">Registro de Recepción de Residuos</h4>
                            
                            <form id="centroAcopioForm" class="needs-validation" 
      action="{{ isset($centro) ? url('ActualizarCentro/' . $centro->id) : url('GuardarCentro') }}" method="post">
                              @csrf
                              
                              <!-- Si estamos editando, usa método PUT -->
                            
                              <div class="row mb-3">
                                  <div class="col-md-6">
                                      <label for="nombreEmpresa" class="form-label">NOMBRE DE LA EMPRESA DESTINATARIA:</label>
                                      <input type="text" class="form-control" id="nombreEmpresa" name="nombreEmpresa" 
                                            value="{{ $centro->nombreEmpresa ?? '' }}" required>
                                      <div class="invalid-feedback">
                                          Por favor ingrese el nombre de la empresa
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <label for="autorizacionRamir" class="form-label">AUTORIZACIÓN RAMIR:</label>
                                      <input type="text" class="form-control" id="autorizacionRamir" name="autorizacionRamir" 
                                            value="{{ $centro->autorizacionRamir ?? '' }}" required>
                                  </div>
                              </div>
                              
                              <div class="row mb-3">
                                  <div class="col-md-12">
                                      <label for="domicilioFiscal" class="form-label">DOMICILIO FISCAL:</label>
                                      <input type="text" class="form-control" id="domicilioFiscal" name="domicilioFiscal" 
                                            value="{{ $centro->domicilioFiscal ?? '' }}" required>
                                      <div class="invalid-feedback">
                                          Por favor ingrese el domicilio fiscal
                                      </div>
                                  </div>
                              </div>

                              <div class="row mb-3">
                                  <div class="col-md-6">
                                      <label for="telefono" class="form-label">TELÉFONO:</label>
                                      <input type="tel" class="form-control" id="telefono" name="telefono" 
                                            value="{{ $centro->telefono ?? '' }}" required>
                                  </div>
                              </div>
                              
                              <div class="row mb-3">
                                  <div class="col-md-6">
                                      <label for="nombreReceptor" class="form-label">NOMBRE DEL RECEPTOR:</label>
                                      <input type="text" class="form-control" id="nombreReceptor" name="nombreReceptor" 
                                            value="{{ $centro->nombreReceptor ?? '' }}" required>
                                      <div class="invalid-feedback">
                                          Por favor ingrese el nombre del receptor
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <label for="cargoReceptor" class="form-label">CARGO:</label>
                                      <input type="text" class="form-control" id="cargoReceptor" name="cargoReceptor" 
                                            value="{{ $centro->cargoReceptor }}" required>
                                  </div>
                              </div>
                              
                              <div class="d-flex justify-content-end gap-2">
                                  <button type="submit" class="btn btn-theme-primary">
                                      <i class="fas fa-save me-2"></i>{{ isset($centro) ? 'Actualizar' : 'Guardar' }} 
                                  </button>
                              </div>
                          </form>
                        </div>



                        <div class="tab-pane fade" id="pestania3" role="tabpanel">
                            <div class="feature-card">
                                <div class="card-icon">
                                    <i class="bi bi-graph-up"></i>
                                </div>
                                <h4 class="card-title text-theme-primary">Pestaña 3</h4>
                                <p>Contenido de ejemplo para la tercera pestaña</p>
                            </div>
                        </div>
                    </div>
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
  <footer class="main-footer"></footer>
</div>
<!-- ./wrapper -->

<!-- Modal para agregar nueva clasificación -->
<div class="modal fade" id="nuevaClasificacionModal" tabindex="-1" aria-labelledby="nuevaClasificacionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-theme-info text-white">
        <h5 class="modal-title" id="nuevaClasificacionModalLabel">Registrar Nueva Clasificación</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="{{ url('GuardarClasificaciones') }}" id="formNuevaClasificacion">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="giro" class="form-label">Giro</label>
              <input type="text" class="form-control" id="giro" name="giro" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="clasificacion" class="form-label">Clasificación</label>
              <input type="text" class="form-control" id="clasificacion" name="clasificacion" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="unidades" class="form-label">Unidades</label>
              <input type="text" class="form-control" id="unidades" name="unidades" maxlength="20">
            </div>
            <div class="col-md-4 mb-3">
              <label for="de" class="form-label">De</label>
              <input type="number" class="form-control" id="de" name="de" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="a" class="form-label">A</label>
              <input type="number" class="form-control" id="a" name="a" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-theme-primary">
            <i class="fas fa-save me-2"></i>Guardar Clasificación
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function confirmarEliminacion(id) {
  if (confirm('¿Estás seguro que deseas eliminar esta clasificación?\nEsta acción no se puede deshacer.')) {
    document.getElementById('delete-form-' + id).submit();
  }
}
</script>

@include('administracion.footer')
</body>
</html>