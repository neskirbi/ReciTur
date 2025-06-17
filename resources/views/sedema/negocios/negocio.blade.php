<!DOCTYPE html>
<html lang="en">
<head>
  @include('sedema.header')
  <title>CSMX | Negocio</title>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('sedema.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('sedema.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">


        <div class="row">
          <div class="col-md-12" >
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Obra</h3>
                <div class="card-tools">
                  
                </div>
              </div>
              <div class="card-body">
                <div class="row" >
                    <div class="col-md-12">
                        <h4><i class="far fa-user"></i> {{$negocio->razonsocial}} </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5><i class="far fa-building"></i> {{$negocio->negocio}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h6><i class="fa fa-recycle"></i> {{$planta->planta}}</h6>
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-md-12">
                        <b>{{$negocio->nautorizacion}}</b>
                    </div> 
                </div>
                <div class="row">                    
                    <div class="col-md-12">
                        {{$negocio->superficie}} {{$negocio->superunidades}}
                    </div> 
                </div>
                <b>Dirección</b>
                <div class="row">                    
                    <div class="col-md-12">
                        {{$negocio->calle}} {{$negocio->numeroext}} {{$negocio->numeroint}}
                    </div> 
                </div>

                <div class="row">                    
                    <div class="col-md-12">
                        {{$negocio->colonia}}
                    </div> 
                </div>

                <div class="row">                    
                    <div class="col-md-12">
                        {{$negocio->municipio}}, {{$negocio->entidad}}
                    </div> 
                </div>
                <div class="row">                    
                    <div class="col-md-12">
                        Inicio: {{FechaFormateada($negocio->fechainicio)}}
                    </div> 
                </div>
                <div class="row">                    
                    <div class="col-md-12">
                        Fin: {{FechaFormateada($negocio->fechafin)}}
                    </div> 
                </div>
                <script>
                  /**
                   * Aqui por que agarro el id de la obra en el foreach
                   */
                    $(document).ready(function(){
                        AvanceEntregasSedema('{{$negocio->id}}');
                    });
                    
                </script>
                    
               
              </div>
            </div> 

            






          </div>
          
        </div>

        
        
            <div class="row">
            <div class="col-12">
                <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Desglose</h3>                
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="overflow-x:scroll;">
                    
                    
                    <table class="table table-hover text-nowrap" id="obras">
                    <thead>
                        <tr>
                        <th>Residuo</th>
                        <th>Cantidad</th>
                        <th>Fecha de Recolección</th>
                        <th>Manifiesto</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach($recolecciones as $recoleccion)
                        <tr>
                        <td title="{{$recoleccion->re}}">
                            {{$recoleccion->residuo}}
                        </td>  
                        <td>
                            {{$recoleccion->cantidad}} {{$recoleccion->unidades}}
                        </td>
                                
                        <td>
                            {{FechaFormateada($recoleccion->created_at)}}
                        </td>
                        <td>
                            @if($recoleccion->matriculat!='')
                                <a href="{{url('Manifiesto')}}/{{$recoleccion->id}}" target="_blank" class="btn btn-info "><i class="fa fa-download" aria-hidden="true"></i> Manifiesto</a>
                            @endif
                        </td>
                       
                        
                        
                        </tr>
                        @endforeach
                        
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            </div>      
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
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
    var markers = [];
    function initMap() {
        const myLatlng = { lat:  $('#latitud').val()*1, lng: $('#longitud').val()*1 };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 19,
          center: myLatlng,
        });
        const marker = new google.maps.Marker({
            position: myLatlng,
            map,
            title:$('#negocio').val()
        });
        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
          content: "Seleccione ubicación",
          position: myLatlng,
        });
        infoWindow.open(map,marker);
        // Configure the click listener.
         
        map.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.
            infoWindow.close();
            DeleteMarkers()
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
              position: mapsMouseEvent.latLng,
            });
            var coordenadas=mapsMouseEvent.latLng.toJSON();
            $('#latitud').val(coordenadas.lat);
            $('#longitud').val(coordenadas.lng);
            const coornegocio = { lat:  coordenadas.lat*1, lng: coordenadas.lng*1 };
            const marker = new google.maps.Marker({
            position: coornegocio,
            map,
            title:$('#negocio').val()
            });
             //Add marker to the array.
            markers.push(marker);
            infoWindow.setContent('La negocio se localiza:<br>Latitud:'+coordenadas.lat+'<br>Longitud:'+coordenadas.lng);
          
            infoWindow.open(map,marker);
          
        });
    }
      
</script>

@include('MapsApi')


@include('footer')
</body>
</html>
