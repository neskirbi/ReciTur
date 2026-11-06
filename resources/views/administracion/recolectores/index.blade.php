<!DOCTYPE html>
<html lang="en">
<head>
    @include('administracion.header')
    <title>Recitur | Recolectores</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')
@include('administracion.navbars.navbar')
    <div class="wrapper">

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">&nbsp;</div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                
            @include('administracion.sidebar')
                <div class="container-fluid">
                    <a href="{{url('recolectores/create')}}" class="btn btn-theme-primary mb-3">
                        <i class="fas fa-plus-circle me-2"></i> Agregar Nuevo Recolector
                    </a>
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
                                            <form class="px-4 py-3" action="{{url('recolectores')}}" method="GET">
                                                <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control" name="recolector" id="recolector" placeholder="Recolector" @if(isset($filtros->recolector)) value="{{$filtros->recolector}}" @endif>
                                                </div>
                                                <div class="dropdown-divider"></div>
                                                <a href="{{url('recolectores')}}" class="btn btn-theme-outline-gray ">Limpiar</a>
                                                <button type="submit" class="btn btn-outline-theme-primary  float-end">Aplicar</button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>  
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($recolectores as $recolector)
                                        <div class="col-md-4 col-lg-3 col-xl-2 mb-4">
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
                                                    <a href="{{ url('recolectores') }}/{{$recolector->id }}"
                                                       class="btn btn-sm btn-outline-theme-success recolector-card__btn">
                                                        Ver
                                                    </a>
                                                    <button type="button"
                                                            class="btn btn-sm btn-outline-theme-danger recolector-card__btn btn-eliminar-recolector"
                                                            data-id="{{ $recolector->id }}"
                                                            data-nombre="{{ $recolector->nombres }} {{ $recolector->apellidos }}">
                                                        Eliminar
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
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        
      
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- Modal de confirmación para eliminar recolector -->
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
        function Cambio(_this){
            _this=$(_this);
            if(_this.val()==_this.data('mail')){
                _this.removeAttr('name');
            }else{            
                _this.attr('name','mail');
            }
        }

        $(document).ready(function () {
            var recolectorIdEliminar = null;
            var modalEliminar = new bootstrap.Modal(document.getElementById('modalEliminarRecolector'));

            // Abrir modal al hacer clic en "Eliminar"
            $(document).on('click', '.btn-eliminar-recolector', function () {
                recolectorIdEliminar = $(this).data('id');
                $('#nombreRecolectorEliminar').text($(this).data('nombre'));
                modalEliminar.show();
            });

            // Confirmar eliminación
            $('#btnConfirmarEliminarRecolector').on('click', function () {
                if (!recolectorIdEliminar) return;

                var $btn = $(this);
                $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Eliminando...');

                $.ajax({
                    url: "{{ url('recolectores') }}/" + recolectorIdEliminar,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        modalEliminar.hide();
                        location.reload();
                    },
                    error: function (xhr) {
                        $btn.prop('disabled', false).html('<i class="fa fa-trash me-1"></i> Sí, eliminar');
                        alert('Ocurrió un error al eliminar el recolector. Intente nuevamente.');
                    }
                });
            });

            // Resetear el botón al cerrar el modal
            document.getElementById('modalEliminarRecolector').addEventListener('hidden.bs.modal', function () {
                recolectorIdEliminar = null;
                $('#btnConfirmarEliminarRecolector')
                    .prop('disabled', false)
                    .html('<i class="fa fa-trash me-1"></i> Sí, eliminar');
            });
        });
    </script>
    @include('administracion.footer')
</body>
</html>