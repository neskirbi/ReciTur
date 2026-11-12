<!DOCTYPE html>
<html lang="en">
<head>
  @include('autoridad.header')
  <title>Recitur | Recolección</title>
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
                <h3 class="card-title"><i class="fa fa-file-text" aria-hidden="true"></i> Detalle de Recolección</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Responsable</label>
                  <input type="text" class="form-control" value="{{$recoleccion->responsable}}" readonly>
                </div>
                <a href="{{url('Manifiesto')}}/{{$recoleccion->id}}" target="_blank" class="btn btn-theme-primary">
                  <i class="fa fa-download"></i> Ver Manifiesto
                </a>
              </div>
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