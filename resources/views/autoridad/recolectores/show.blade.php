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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa fa-briefcase title-icon" aria-hidden="true"></i> Recolectores </h3>
                                </div>  
                                <div class="card-body">

                                    <form action="{{ url('autoridad/recolectores/'.$recolector->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="nombres" class="form-label fw-bold">Nombres</label>
                                                <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $recolector->nombres }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="apellidos" class="form-label fw-bold">Apellidos</label>
                                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $recolector->apellidos }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="telefono" class="form-label fw-bold">Teléfono</label>
                                                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $recolector->telefono }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="mail" class="form-label fw-bold">Correo electrónico</label>
                                                <input type="email" class="form-control" id="mail" value="{{ $recolector->mail }}" data-mail="{{ $recolector->mail }}" onkeyup="Cambio(this);" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="temp" class="form-label fw-bold">Contraseña temporal</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="temp" name="temp" value="{{ $recolector->temp ?? '' }}" readonly>
                                                    <button type="button" class="btn btn-outline-theme-warning"
                                                            onclick="GenerarTemp(this, '{{ $recolector->id }}', 'recolectores', '#temp')">
                                                        <i class="fa fa-key me-1"></i> Generar
                                                    </button>
                                                </div>
                                                <small class="text-muted">Se genera un token temporal para que el usuario restablezca su contraseña.</small>
                                            </div>
                                        </div>


                                        <div class="text-end">
                                            <a href="{{ url('autoridad/recolectores') }}" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit" class="btn btn-theme-primary">Guardar Cambios</button>
                                        </div>
                                    </form>

                                    
                                </div>         
                                
                            </div>
                        </div>
                    </div>
                        
                </div><!-- /.container-fluid -->
            </section>
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
    </script>

    @include('autoridad.footer')
</body>
</html>