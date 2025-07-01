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
                                        <div class="col-md-2 mb-3">
                                            <div class="card text-center shadow-sm h-100">
                                                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                                    <i class="fa fa-user card-icon mb-2" style="font-size: 3rem;"></i>
                                                    
                                                    <!-- Contenedor con alto fijo y texto recortado -->
                                                    <div class="fw-bold text-truncate text-center" 
                                                        style="font-size: 15px; max-width: 100%; height: 2.5em; overflow: hidden;"
                                                        title="{{$recolector->nombres}} {{$recolector->apellidos}}">
                                                        {{$recolector->nombres}} {{$recolector->apellidos}}
                                                        
                                                    </div>

                                                    <div class="mt-2 w-100 d-flex justify-content-end">
                                                        <a href="{{ url('recolectores') }}/{{$recolector->id }}" 
                                                        target="_blank" class="btn btn-sm btn-outline-theme-success btn-block">
                                                        Ver
                                                        </a>
                                                    </div>
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
    @include('administracion.footer')
</body>
</html>