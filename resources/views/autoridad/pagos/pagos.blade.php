<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>CSMX | Pagos</title>

  
</head>

<style>
  .boxpago{
    -webkit-box-shadow: 1px 2px 57px -15px rgba(0,0,0,0.75);
    -moz-box-shadow: 1px 2px 57px -15px rgba(0,0,0,0.75);
    box-shadow: 1px 2px 57px -15px rgba(0,0,0,0.75);
    border:1px #ccc solid; 
    border-radius:15px; 
    width:100%;
    padding:10px; 
    text-align:center;
  }

  .boxtransfer{
    border:1px #ccc solid; 
    border-radius:15px;
    padding:10px; 
    text-align:center;
    display:inline-block;
    cursor:pointer;

  }

</style>
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
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-6">
            <!-- small box -->
            
            <div class="small-box bg-info">
            
              <div class="inner">
                <h3>$ {{number_format($pago->montot==null?0:$pago->montot,2)}}</h3>
                <p>Pagos</p>
              </div>
              <div class="icon">
                <i class="fas fa-money"></i>
              </div>
              <a href="#" class="small-box-footer"><!--Detalle <i class="fas fa-arrow-circle-right">-->&nbsp;</i></a>
            </div>
          </div>
          
          <!-- ./col -->
          <div class="col-md-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>$ {{number_format($consumo,2)}}</h3>
                <p>Consumo</p>
              </div>
              <div class="icon">
              <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"><!--Detalle <i class="fas fa-arrow-circle-right">-->&nbsp;</i></a>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#pagos" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="true"><i class="nav-icon fa fa-money" aria-hidden="true"></i> Pagos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#saldos" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="true"><i class="nav-icon fa fa-dollar" aria-hidden="true"></i> Saldos</a>
                    </li>
                    
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">                       
                  <div class="tab-pane fade active show" id="pagos" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab" style="overflow-x:scroll;">
                    @if(TipoPlanta()==2)
                    <div class="row">
                      <div class="col-md-12">
                        <a class="btn btn-info" data-toggle="modal" data-target="#modalpago">
                          <i class="fa fa-plus" aria-hidden="true"></i> Pago                    
                        </a>  
                      </div>                             
                    </div>
                    @endif
                    <br>
                    @if(count($pagos))
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                        <th>Obra</th>
                        <th>Monto</th>
                        <th>Referencia</th>
                        <th>Fecha</th>
                        <th>Estatus</th>
                        <th colspan="2">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                    
                        @foreach($pagos as $pago)
                        <tr>
                        <td title="{{$pago->obra}}">{{strlen($pago->obra) > 40 ? substr($pago->obra,0,40) : $pago->obra}}</td>
                          <td>$ {{number_format($pago->monto,2)}}</td>
                          <td>{{$pago->referencia}}</td>
                          <td>{{FechaFormateada($pago->created_at)}}<br> {{$pago->hora}}</td>
                          <td>
                            @if($pago->status==0)
                              <small style="cursor:pointer;" onclick="alert('Detalle: {{$pago->detalle}}');" title="{{$pago->detalle}}" class="badge badge-danger"><i class="fa fa-times" aria-hidden="true"></i> Cancelado</small>
                            @elseif($pago->status==1)
                              <small class="badge badge-warning"><i class="fa fa-check" aria-hidden="true"></i> Pendiente</small>
                            @elseif($pago->status==2)
                              <small class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i> Verificado</small>
                            @endif
                          </td>
                            
                          <td>
                            @if($pago->status!=2)
                              <form action="VerificarPago/{{$pago->id}}" method="POST">
                              @csrf
                                <button class="btn btn-success btn-sm confirmarclick" data-texto="¿Desea verificar el pago?" type="submite">
                                  <i class="fa fa-check" aria-hidden="true"></i> Validar
                                </button>
                              </form>
                            @endif
                          </td>  
                          <td>
                            @if($pago->status!=0)
                            <button class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modalcancelarpago" data-id="{{$pago->id}}" data-nombre="{{$pago->obra}}" data-monto="$ {{number_format($pago->monto)}}" onclick="PrepararCancelacion(this,'CancelarPago');">
                              <i class="fa fa-times" aria-hidden="true"></i> Cancelar
                            </button>  
                            @endif
                          </td>          

                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                    @endif
                  
                  </div>
                  <div class="tab-pane fade" id="saldos" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab" style="overflow-x:scroll;">
                 
                  @if(count($clientegastos))
                  
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                      <th>Obra</th>
                      <th>Pagos</th>
                      <th>Reciclaje</th>
                      <th>Pedidos</th>
                      <th>Saldo</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($clientegastos as $clientegasto)
                     
                      <tr>
                        <td title="{{$clientegasto->nombre}}">{{strlen($clientegasto->nombre)> 40 ? mb_substr($clientegasto->nombre,0,39,"UTF-8") : $clientegasto->nombre}}</td>
                        <td>$ {{number_format($clientegasto->pagos==null?0:$clientegasto->pagos,2)}}</td>
                        <td>$ {{number_format($clientegasto->reciclaje==null?0:$clientegasto->reciclaje,2)}}</td>
                        <td>$ {{number_format($clientegasto->pedidos==null?0:$clientegasto->pedidos,2)}}</td>
                        @if($clientegasto->pagos-($clientegasto->reciclaje+$clientegasto->pedidos)<0)
                        <td><small class="badge badge-danger float-right"><i class="fa fa-dollar"></i> {{number_format($clientegasto->pagos-($clientegasto->reciclaje+$clientegasto->pedidos),2)}}</small></td>
                        @else                        
                        <td><small class="badge badge-info float-right"><i class="fa fa-dollar"></i> {{number_format($clientegasto->pagos-($clientegasto->reciclaje+$clientegasto->pedidos),2)}}</small></td>
                        @endif
                      </tr>
                      @endforeach
                     
                    </tbody>
                  </table>
                  @endif
                  </div>
                </div>
              </div>
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
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);

 
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="dist/js/adminlte.js"></script>
<script>
    GraficaPagos(HtmltoJson('{{($pagos_fecha)}}'));
</script>
@include('administracion.pagos.modals.modalcancelarpago')

@include('administracion.pagos.modals.modalpago')

@include('administracion.footer')
</body>
</html>
