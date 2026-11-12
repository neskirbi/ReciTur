<!DOCTYPE html>
<html lang="en">
<head>
  @include('autoridad.header')
  <title>Recitur | Recolecciones</title>
  <style>
    .stats-card { border-left: 4px solid var(--theme-primary); transition: all 0.3s ease; }
    .stats-card:hover { transform: translateY(-3px); box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
  </style>
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
        
        <div class="row mb-4">
          <div class="col-md-4">
            <div class="card stats-card">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div>
                    <h5 class="card-title text-theme-primary">Total Recolecciones</h5>
                    <h2 class="mb-0">{{ count($recolecciones) }}</h2>
                  </div>
                  <div class="align-self-center">
                    <i class="fa fa-trash-alt fa-2x text-theme-primary"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">

            <!-- Filtro de fechas -->
            <div class="card">
              <div class="card-header bg-theme-primary text-white">
                <h5 class="card-title mb-0"><i class="fa fa-file"></i> Reporte</h5>
              </div>
              <div class="card-body">
                <form action="{{url('autoridad/recolecciones')}}" method="get" id="dateFilterForm">
                  <div class="form-row align-items-end">
                    <div class="col-md-9">
                      <div class="form-group">
                        <label for="negocio" class="font-weight-bold">Negocio</label>
                        <select class="form-control" id="negocio" name="negocio" >
                          @if(isset($neg->id))
                          <option value="">---Todos--</option>
                          @endif
                          <option selected  value="{{isset($neg->id) ? $neg->id : ''}}">{{isset($neg->id) ? $neg->negocio : "---Todos--"}}</option>
                          @foreach($negocios as $negocio)
                          <option value="{{$negocio->id}}">{{$negocio->negocio}}</option>
                          @endforeach                               
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-row align-items-end">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="fecha_ini" class="font-weight-bold">Fecha inicial</label>
                        <input type="date" class="form-control" id="fecha_ini" name="fecha_ini" 
                               value="{{ request('fecha_ini', date('Y-m-d')) }}" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="fecha_fin" class="font-weight-bold">Fecha final</label>
                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" 
                               value="{{ request('fecha_fin', date('Y-m-d')) }}" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <button type="submite" class="btn btn-theme-primary btn-block" id="revisar">
                          <i class="fa fa-eye"></i> Revisar
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <!-- Lista de recolecciones -->
            <div class="card mt-4">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-list-alt title-icon" aria-hidden="true"></i> Lista de Recolecciones</h3>
                <div class="card-tools">
                  <span class="badge bg-theme-primary">{{ count($recolecciones) }} resultados</span>
                </div>
              </div>
              <div class="card-body p-0">
                @if(count($recolecciones))
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="bg-light">
                        <tr>
                          <th>Establecimiento</th>
                          <th>Tipo</th>
                          <th>Fecha</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($recolecciones as $recoleccion)
                        <tr>
                          <td>
                            <strong>{{$recoleccion->negocio}}</strong>
                          </td>
                          <td>{{$recoleccion->tiponegocio ?? ''}}</td>
                          <td>{{FechaFormateada($recoleccion->created_at)}}</td>
                          <td>
                            <span class="badge bg-theme-success">
                              <i class="fa fa-check" aria-hidden="true"></i> Recolectado
                            </span>
                          </td>
                          <td>
                            <a href="{{url('Manifiesto')}}/{{$recoleccion->id}}" target="_blank" 
                               class="btn btn-sm btn-theme-primary">
                              <i class="fa fa-download" aria-hidden="true"></i> Manifiesto
                            </a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                @else
                  <div class="text-center py-5">
                    <i class="fa fa-inbox fa-3x text-theme-primary mb-3"></i>
                    <h4 class="text-theme-primary">No hay recolecciones</h4>
                    <p class="text-muted">No se encontraron recolecciones para el período seleccionado.</p>
                  </div>
                @endif
              </div>
              @if(count($recolecciones))
              <div class="card-footer clearfix">
                <div class="d-flex justify-content-between align-items-center">
                  <div>Mostrando {{ $recolecciones->count() }} de {{ $recolecciones->total() }} registros</div>
                  <div>
                    {{ $recolecciones->appends($_GET)->links('pagination::bootstrap-4') }}
                  </div>
                </div>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

@include('autoridad.footer')
</body>
</html>