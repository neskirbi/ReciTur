<!DOCTYPE html>
<html lang="en">
<head>
    @include('asociados.header')
    <title>CSMX | Recolectores</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    @include('toast.toasts')  
    <div class="wrapper">

        <!-- Navbar -->
        @include('asociados.navigations.navigation')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('asociados.sidebars.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Listado de Recolectores</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                               
                                                <th>Nombre</th>
                                                <th>Apellidos</th>
                                                <th>Licencia</th>
                                                <th>Teléfono</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recolectores as $index => $recolector)
                                            <tr>
                                                
                                                <td>{{ $recolector->nombres }}</td>
                                                <td>{{ $recolector->apellidos }}</td>
                                                <td>{{ $recolector->licencia }}</td>
                                                <td>{{ $recolector->telefono }}</td>
                                                <td>
                                                    <a class="btn btn-block btn-info" href="{{url('recolectores')}}/{{$recolector->id}}">
                                                        <i class="fa fa-eye"></i> Ver 
                                                    </a>
                                                </td>
                                               
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.js')}}"></script>
    
    <script>
        $(document).ready(function() {
            // Confirmación para eliminar
            $('.borrar').click(function() {
                if(confirm($(this).data('texto'))) {
                    window.location = $(this).data('url');
                }
            });
        });
    </script>
    
    @include('footer')
</body>
</html>