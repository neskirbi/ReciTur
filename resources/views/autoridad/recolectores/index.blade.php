<!DOCTYPE html>
<html lang="en">
<head>
    @include('autoridad.header')
    <title>Recitur | Recolectores</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')
@include('autoridad.navbars.navbar')
    <div class="wrapper">

        <div class="content-wrapper">
            <div class="content-header">&nbsp;</div>

            <section class="content">
                
            @include('autoridad.sidebar')
                <div class="container-fluid">
                    <button type="button" class="btn btn-theme-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalNuevoRecolector">
                        <i class="fas fa-plus-circle me-2"></i> Agregar Nuevo Recolector
                    </button>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa fa-briefcase title-icon" aria-hidden="true"></i> Recolectores </h3>
                                    <div class="card-tools position-absolute end-0 top-0 mt-1 me-2" style="z-index: 2000;">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-theme-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end p-3" style="width:300px;">
                                            <form class="px-4 py-3" action="{{url('autoridad/recolectores')}}" method="GET">
                                                <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control" name="recolector" id="recolector" placeholder="Recolector" @if(isset($filtros->recolector)) value="{{$filtros->recolector}}" @endif>
                                                </div>
                                                <div class="dropdown-divider"></div>
                                                <a href="{{url('autoridad/recolectores')}}" class="btn btn-theme-outline-gray ">Limpiar</a>
                                                <button type="submit" class="btn btn-outline-theme-primary  float-end">Aplicar</button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>  
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($recolectores as $recolector)
                                        <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                            <div class="recolector-card h-100">
                                                <div class="recolector-card__header">
                                                    <div class="recolector-avatar">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                                <div class="recolector-card__body">
                                                    <h6 class="recolector-card__name"
                                                        title="{{$recolector->nombres}} {{$recolector->apellidos}}">
                                                        {{$recolector->nombres}} {{$recolector->apellidos}}
                                                    </h6>
                                                    <span class="recolector-card__badge">
                                                        <i class="fa fa-circle me-1"></i> Activo
                                                    </span>
                                                </div>
                                                <div class="recolector-card__actions">
                                                    <a href="{{ url('autoridad/recolectores') }}/{{$recolector->id }}"
                                                       class="btn btn-sm btn-outline-theme-success recolector-card__btn">
                                                        <i class="fa fa-eye me-1"></i> Ver
                                                    </a>
                                                    <button type="button"
                                                            class="btn btn-sm btn-outline-theme-danger recolector-card__btn btn-eliminar-recolector"
                                                            data-id="{{ $recolector->id }}"
                                                            data-nombre="{{ $recolector->nombres }} {{ $recolector->apellidos }}">
                                                        <i class="fa fa-trash me-1"></i> Eliminar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="d-flex justify-content-center mt-4">
                                        {{ $recolectores->appends($_GET)->links('pagination::bootstrap-4') }}
                                        </div>

                            
                                    </div>
                                </div>         
                                
                            </div>
                        </div>
                    </div>
                        
                </div><!-- /.container-fluid -->
            </section>
        </div>
        
    </div>

    <!-- Modal Nuevo Recolector -->
    <div class="modal fade" id="modalNuevoRecolector" tabindex="-1" aria-labelledby="modalNuevoRecolectorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ url('autoridad/recolectores') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-theme-primary text-white">
                        <h5 class="modal-title" id="modalNuevoRecolectorLabel"><i class="fa fa-user-plus me-2"></i> Nuevo Recolector</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nombres" class="form-label fw-bold">Nombres</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellidos" class="form-label fw-bold">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label fw-bold">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="mb-3">
                            <label for="mail" class="form-label fw-bold">Correo electrónico</label>
                            <input type="email" class="form-control" id="mail" name="mail" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-theme-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar Recolector -->
    <div class="modal fade" id="modalEliminarRecolector" tabindex="-1" aria-labelledby="modalEliminarRecolectorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-theme-danger text-white">
                    <h5 class="modal-title" id="modalEliminarRecolectorLabel">
                        <i class="fa fa-exclamation-triangle me-2"></i> Confirmar eliminación
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">¿Está seguro que desea eliminar al recolector:</p>
                    <p class="fw-bold text-theme-danger mb-0" id="nombreRecolectorEliminar"></p>
                    <p class="text-muted mt-2 mb-0"><small>Esta acción no se puede deshacer.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-theme-gray" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-theme-danger" id="btnConfirmarEliminarRecolector">
                        <i class="fa fa-trash me-1"></i> Sí, eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var recolectorIdEliminar = null;
            var modalEliminar = new bootstrap.Modal(document.getElementById('modalEliminarRecolector'));

            $(document).on('click', '.btn-eliminar-recolector', function () {
                recolectorIdEliminar = $(this).data('id');
                $('#nombreRecolectorEliminar').text($(this).data('nombre'));
                modalEliminar.show();
            });

            $('#btnConfirmarEliminarRecolector').on('click', function () {
                if (!recolectorIdEliminar) return;

                var $btn = $(this);
                $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Eliminando...');

                $.ajax({
                    url: "{{ url('autoridad/recolectores') }}/" + recolectorIdEliminar,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: "{{ csrf_token() }}"
                    },
                    success: function () {
                        modalEliminar.hide();
                        location.reload();
                    },
                    error: function () {
                        $btn.prop('disabled', false).html('<i class="fa fa-trash me-1"></i> Sí, eliminar');
                        alert('Ocurrió un error al eliminar el recolector. Intente nuevamente.');
                    }
                });
            });

            document.getElementById('modalEliminarRecolector').addEventListener('hidden.bs.modal', function () {
                recolectorIdEliminar = null;
                $('#btnConfirmarEliminarRecolector')
                    .prop('disabled', false)
                    .html('<i class="fa fa-trash me-1"></i> Sí, eliminar');
            });
        });
    </script>
    @include('autoridad.footer')
</body>
</html>