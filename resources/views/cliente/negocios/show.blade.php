<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>Recitur | Negocio</title>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  @include('toast.toasts')
  @include('cliente.navbars.navbar')
<div class="wrapper">


  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
      &nbsp;
    </div>
    <!-- /.content-header -->

    <!-- Main Content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title"><i class="fa fa-briefcase title-icon" aria-hidden="true"></i> Negocio</h3>
          </div>
          <div class="card-body">
            <!-- Datos del Establecimiento -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-building"></i> Datos del Establecimiento</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="generador"><i class="fas fa-user-tie"></i> Generador</label>
                      <input type="text" class="form-control" id="generador" value="{{$generador->razonsocial}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="negocio"><i class="fas fa-signature"></i> Nombre del Establecimiento</label>
                      <input type="text" class="form-control" id="negocio" value="{{$negocio->negocio}}" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                    
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="giro"><i class="fas fa-store"></i> Giro del Establecimiento</label>
                      <input type="text" class="form-control" id="tiponegocio" value="{{$negocio->giro}}" readonly>
                      
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cantidad"><i class="fa fa-list-ol"></i> <span id="unidades"> {{$negocio->unidades}}</span></label>
                      <input type="text" name="cantidad" id="cantidad" class="form-control"  value="{{$negocio->cantidad}}" readonly>
                      
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="estimado"><i class="fas fa-trash-alt"></i> Estimación (Generación Diaria) </label>
                      <input type="number" step="0.01" name="estimado" class="form-control" id="estimado" placeholder="0.0" value="{{$negocio->estimado}}" readonly>
                    </div>
                  </div>
                </div>

               

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="calle"><i class="fas fa-road"></i> Calle</label>
                      <input type="text" class="form-control" id="calle" value="{{$negocio->calle}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="numeroext"><i class="fas fa-home"></i> Número Ext.</label>
                      <input type="text" class="form-control" id="numeroext" value="{{$negocio->numeroext}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="numeroint"><i class="fas fa-home"></i> Número Int.</label>
                      <input type="text" class="form-control" id="numeroint" value="{{$negocio->numeroint}}" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="colonia"><i class="fas fa-map-marker-alt"></i> Colonia</label>
                      <input type="text" class="form-control" id="colonia" value="{{$negocio->colonia}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cp"><i class="fas fa-map-pin"></i> C.P.</label>
                      <input type="text" class="form-control" id="cp" value="{{$negocio->cp}}" readonly>
                    </div>
                  </div>
                  
                </div>

                <div class="row">
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="entidad"><i class="fas fa-flag"></i> Entidad Federativa</label>
                      <input type="text" class="form-control" id="entidad" value="{{$negocio->entidad}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="municipio"><i class="fas fa-city"></i> Alcaldía/Municipio</label>
                      <input type="text" class="form-control" id="municipio" value="{{$negocio->municipio}}" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <label for="map"><i class="fas fa-map-marked-alt"></i> Ubicación del Establecimiento</label>
                    <div id="map" style="height: 350px; width: 100%;"></div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="latitud"><i class="fas fa-latitude"></i> Latitud</label>
                      <input type="text" class="form-control" id="latitud" value="{{$negocio->latitud}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="longitud"><i class="fas fa-longitude"></i> Longitud</label>
                      <input type="text" class="form-control" id="longitud" value="{{$negocio->longitud}}" readonly>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Documentación 
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-file-pdf"></i> Documentación</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="plan"><i class="fas fa-file-upload"></i> Plan de manejo (pdf)</label>
                      <iframe id="inlineFrameExample"
                        title="Plan de manejo"
                        width="100%"
                        height="200"
                        src="{{asset('documentos/clientes/negocios/plan').'/'.$negocio->id.'.pdf'.'?ver='.rand(0,10000)}}">
                      </iframe>
                      <a target="_blank" class="btn btn-default" href="{{asset('documentos/clientes/negocios/plan').'/'.$negocio->id.'.pdf'.'?ver='.rand(0,10000)}}">Ver</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>-->

            <!-- Datos del Contacto -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-id-card"></i> Datos del Contacto</h3>
              </div>
              <div class="card-body">


                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="contacto"><i class="fas fa-user"></i> Contacto <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="contacto" id="contacto" placeholder="Contacto" value="{{$negocio->contacto}}" readonly>
                    </div>
                  </div>              
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="correo"><i class="fas fa-envelope"></i> Correo Contacto</label>
                      <input type="email" class="form-control" id="correo" value="{{$negocio->correo}}" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="telefono"><i class="fas fa-phone"></i> Teléfono</label>
                      <input type="tel" class="form-control" id="telefono" value="{{$negocio->telefono}}" readonly>
                    </div>
                  </div>
                
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="celular"><i class="fas fa-mobile-alt"></i> Celular</label>
                      <input type="tel" class="form-control" id="celular" value="{{$negocio->celular}}" readonly>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <br>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-trash-alt title-icon" aria-hidden="true"></i> Recolecciones</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <div class="row mb-4">
                  <div class="col-md-12">
                    <div class="card bg-light">
                      <div class="card-body">
                        <h5 class="card-title"><i class="fa fa-file-excel text-success"></i> Exportar a Excel</h5>
                        <form action="{{ url('EstadoCuentaMesCliente') }}/{{$negocio->id}}" method="GET" target="_blank" class="form-inline">
                          <div class="form-group mr-3">
                            <label for="anio" class="mr-2">Año:</label>
                            <select class="form-control" id="anio" name="anio" required>
                              @php
                                $currentYear = date('Y');
                                $startYear = 2021;
                              @endphp
                              @for($year = $currentYear; $year >= $startYear; $year--)
                                <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>
                                  {{ $year }}
                                </option>
                              @endfor
                            </select>
                          </div>
                          <div class="form-group mr-3">
                            <label for="mes" class="mr-2">Mes:</label>
                            <select class="form-control" id="mes" name="mes" required>
                              @php
                                $currentMonth = date('n');
                                $months = [
                                  1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                                  5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                                  9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                                ];
                              @endphp
                              @foreach($months as $key => $month)
                                <option value="{{ $key }}" {{ $key == $currentMonth ? 'selected' : '' }}>
                                  {{ $month }}
                                </option>
                              @endforeach
                            </select>
                          </div>
                          <button type="submit" class="btn btn-success">
                            <i class="fa fa-download"></i> Exportar
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                
                <div class="row">
                  <div class="col-md-12">
                    @if(count($recolecciones))
                    <div class="table-responsive">
                      <table class="table table-hover text-nowrap">
                        <thead class="thead-light">
                          <tr>
                            <th>Establecimientos</th>
                            <th>Fecha Recolección</th>
                            <th>Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($recolecciones as $recoleccion)
                          <tr>
                            <td>{{$recoleccion->negocio}}</td>
                            <td>{{FechaFormateada($recoleccion->created_at)}}</td>
                            <td>
                              <a href="Manifiesto/{{$recoleccion->id}}" target="_blank" class="btn btn-theme-info">
                                <i class="fa fa-download"></i> Manifiesto
                              </a>
                            </td>
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
      </div>
    </section>
  </div>


</div>

<!-- Scripts -->
<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>
<script>
    var markers = [];
    function initMap() {
        const myLatlng = { lat: {{$negocio->latitud}}, lng: {{$negocio->longitud}} };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 15,
          center: myLatlng,
        });
        const marker = new google.maps.Marker({
          position: myLatlng,
          map,
          title: "{{$negocio->negocio}}"
        });
    }
</script>

@include('MapsApi')
@include('cliente.footer')

</body>
</html>