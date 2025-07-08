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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa fa-briefcase title-icon" aria-hidden="true"></i> Recolectores </h3>
                                    <div class="card-tools position-absolute end-0 top-0 mt-1 me-2" style="z-index: 2000;">
                                        
                                    </div>
                                    
                                </div>  
                                <div class="card-body">

                                    <form action="{{ url('recolectores' ) }}" method="POST">
                                        @csrf

                                    

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="nombres" class="form-label fw-bold">Nombres</label>
                                                <input type="text" class="form-control" id="nombres" name="nombres" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="apellidos" class="form-label fw-bold">Apellidos</label>
                                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            
                                            <div class="col-md-6">
                                                <label for="telefono" class="form-label fw-bold">Teléfono</label>
                                                <input type="text" class="form-control" id="telefono" name="telefono" value="" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="mail" class="form-label fw-bold">Correo electrónico</label>
                                                <input type="email" class="form-control" id="mail" name="mail" value="" data-mail="" onkeyup="Cambio(this);" required>

                                            </div>
                                            <div class="col-md-6">
                                                <label for="pass" class="form-label fw-bold">Nueva Contraseña</label>
                                                <input type="text" class="form-control" id="pass" name="pass" value="" required>
                                            </div>
                                        </div>


                                        <div class="text-end">
                                            <a href="{{ route('recolectores.index') }}" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit" class="btn btn-theme-primary">Guardar</button>
                                        </div>
                                    </form>

                                    
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

   
    @include('administracion.footer')
</body>
</html>