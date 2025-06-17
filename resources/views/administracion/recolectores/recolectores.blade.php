<!DOCTYPE html>
<html lang="en">
<head>
    @include('administracion.header')
    <title>CSMX | Recolectores</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    @include('toast.toasts')  
    <div class="wrapper">

        <!-- Navbar -->
        @include('administracion.navigations.navigation')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('administracion.sidebars.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header"></div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <section class="col-lg-12 connectedSortable ui-sortable">
                        
                        @if(count($recolectores))
                            <div class="callout callout-success">
                                <h5>Recolectores</h5>
                            </div>
                        @endif
                        
                        @foreach($recolectores as $recolector)
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Recolector</h3>
                                            <div class="card-tools">
                                                <div class="btn-group dropleft">
                                                    <button class="btn btn-default" type="button" id="menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="menu">
                                                        <a class="dropdown-item borrar" href="{{url('BorrarRecolector').'/'.ArchivoPorNombre('documentos/transportistas/recolectores/inefrente',$recolector->id)}}" data-texto="¿Deseas quitar a {{$recolector->nombres}} {{$recolector->apellidos}} de la planta?">
                                                            <i class="fa fa-trash" aria-hidden="true"></i> Quitar
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                        
                                        <form action="{{url('recolectores').'/'.ArchivoPorNombre('documentos/transportistas/recolectores/inefrente',$recolector->id)}}" id="{{$recolector->id}}" method="post">
                                            @csrf
                                            <input name="_method" type="hidden" value="PUT">
                                            <div class="card-body">
                                                
                                                <!-- Sección 3: Datos del Chofer -->
                                                <div class="form-section">
                                                    <div class="form-section-title">
                                                        <i class="fas fa-user mr-2"></i>Datos del Chofer
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nombres" class="required-field">Nombre(s)</label>
                                                                <input type="text" name="nombres" class="form-control" id="nombres" 
                                                                       placeholder="Nombre(s) del chofer" maxlength="150" required>
                                                            </div>                     
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="apellidos" class="required-field">Apellidos</label>
                                                                <input type="text" name="apellidos" class="form-control" id="apellidos" 
                                                                       placeholder="Apellidos del chofer" maxlength="150" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="licencia" class="required-field">Tipo de licencia</label>
                                                                <select class="form-control" id="licencia" name="licencia" required>
                                                                    <option value="">-- Seleccione tipo de licencia --</option>
                                                                    <option value="A">A - Motocicletas</option>
                                                                    <option value="B">B - Automóviles</option>
                                                                    <option value="C">C - Camiones ligeros</option>
                                                                    <option value="D">D - Camiones pesados</option>
                                                                    <option value="E">E - Remolques</option>
                                                                    <option value="F">F - Transporte de pasajeros</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Documentos -->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="rfc">INE Frente</label>
                                                                <div class="input-group">
                                                                    
                                                                </div>
                                                                
                                                                <iframe id="inlineFrameExample"
                                                                    title="identificación"
                                                                    width="100%"
                                                                    height="200"
                                                                    src="{{asset('documentos/transportistas/recolectores/inefrente').'/'.ArchivoPorNombre('documentos/transportistas/recolectores/inefrente',$recolector->id).'?ver='.rand(0,10000)}}">
                                                                </iframe>                      
                                                                <a target="_blank" class="btn btn-default" href="{{asset('documentos/transportistas/recolectores/inefrente').'/'.ArchivoPorNombre('documentos/transportistas/recolectores/inefrente',$recolector->id)}}">Ver</a>
                                                            </div>
                                                        </div>  

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="rfc">INE Reverso</label>
                                                                <div class="input-group">
                                                                    
                                                                </div>
                                                                
                                                                <iframe id="inlineFrameExample"
                                                                    title="identificación"
                                                                    width="100%"
                                                                    height="200"
                                                                    src="{{asset('documentos/transportistas/recolectores/inereverso').'/'.ArchivoPorNombre('documentos/transportistas/recolectores/inefrente',$recolector->id).'?ver='.rand(0,10000)}}">
                                                                </iframe>                      
                                                                <a target="_blank" class="btn btn-default" href="{{asset('documentos/transportistas/recolectores/inereverso').'/'.ArchivoPorNombre('documentos/transportistas/recolectores/inefrente',$recolector->id)}}">Ver</a>
                                                            </div>
                                                        </div>  
                                                        
                                                    </div>
                                                </div>
                                                
                                                <!-- Sección 4: Verificación y Seguridad - Teléfono y Contraseña en la misma fila -->
                                                <div class="form-section">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="telefono_chofer" class="required-field">Teléfono del recolector</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">+52</span>
                                                                    </div>
                                                                    <input type="tel" name="telefono" class="form-control" id="telefono" 
                                                                           placeholder="Ingrese teléfono móvil" maxlength="10" pattern="[0-9]{10}" required>
                                                                </div>
                                                                <small class="form-text text-muted">10 dígitos sin espacios ni guiones</small>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        
                                        @if(Auth::guard('administradores')->user()->principal==1)
                                            <div class="card-footer">
                                                <button type="submit" class='btn btn-info float-right' onclick="Submite('{{$recolector->id}}',this);" data-texto="¿Actualizar información para {{$recolector->recolector}}?">Guardar</button>
                                            </div>  
                                        @endif      
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </section>       
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App, funcion de sidebar -->
    <script src="{{asset('dist/js/adminlte.js')}}"></script>
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
    @include('footer')
</body>
</html>