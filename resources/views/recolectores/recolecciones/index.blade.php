<!DOCTYPE html>
<html lang="en">
<head>
  @include('recolectores.header')
  <title>Recitur | Recolecciones</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  @include('toast.toasts')
  @include('recolectores.navbars.navbar')
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-trash-alt title-icon" aria-hidden="true"></i> Recolecciones</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    @if(count($recolecciones))
                    <div class="table-responsive">
                      <table class="table table-hover text-nowrap">
                        <thead class="thead-light">
                          <tr>
                            <th>Establecimientos</th>
                            <th>Día</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($recolecciones as $recoleccion)
                          <tr>
                            <td>{{$recoleccion->negocio}}</td>
                            <td>{{FechaFormateadaTiempo($recoleccion->created_at)}}</td>
                           
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    @else
                    <div class="alert alert-info" role="alert">
                      <i class="fa fa-info-circle mr-2"></i>No hay recolecciones para mostrar.
                    </div>
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
  

@include('recolectores.footer')
</body>
</html>