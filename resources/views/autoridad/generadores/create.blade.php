<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>Recitur | Generadores</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
  @include('cliente.navbars.navbar')
  <!-- /.navbar -->

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
        <form method="POST" action="{{url('generadores')}}" id="formgenerador" enctype="multipart/form-data">
            @csrf
            
            <div class="card card-primary" id="fiscales">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-id-card-alt mr-2"></i>Datos de Contacto</h3>            
                </div>

                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-2"></i> Los campos marcados con <span class="text-danger">*</span> son obligatorios.
                    </div>

                    <div class="form-group">
                        <label for="razonsocial"><i class="fas fa-building mr-2"></i>Denominación/Razon social <span class="text-danger">*</span></label>
                        <input type="text" name="razonsocial" class="form-control" id="razonsocial" placeholder="Ej: Empresa S.A. de C.V." maxlength="250" aria-invalid="false" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fisicaomoral"><i class="fas fa-user-tie mr-2"></i>Persona </label>
                                <select data-invalido="true" name="fisicaomoral" class="form-control" id="fisicaomoral" aria-invalid="false" maxlength="50">
                                    <option value="">Seleccione el tipo de persona</option>
                                    <optgroup>
                                    <option value="Moral">Persona Moral</option>
                                    <option value="Física">Persona Física</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rfc"><i class="fas fa-id-card mr-2"></i>RFC </label>
                                <input data-invalido="true" type="text" name="rfc" class="form-control" id="rfc" placeholder="Ej: XAXX010101000 (Persona Física) o MECE910711ABC (Moral)" maxlength="250" aria-invalid="false">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="calle"><i class="fas fa-road mr-2"></i>Calle <span class="text-danger">*</span></label>
                                <input type="text" name="calle" class="form-control" id="calle" placeholder="Ej: Av. Juárez" maxlength="500" aria-invalid="false" required>
                            </div>
                        </div>

                        <div class="col-md-3">                                    
                            <div class="form-group">
                                <label for="numeroext"><i class="fas fa-home mr-2"></i>Número ext. <span class="text-danger">*</span></label>
                                <input type="text" name="numeroext" class="form-control" id="numeroext" placeholder="Ej: 123" maxlength="20" aria-invalid="false" required>
                            </div>
                        </div>
                        <div class="col-md-3"> 
                            <div class="form-group">
                                <label for="numeroint"><i class="fas fa-home mr-2"></i>Número int.</label>
                                <input data-invalido="true" type="text" name="numeroint" class="form-control" id="numeroint" placeholder="Opcional" maxlength="20" aria-invalid="false">
                            </div>
                        </div>
                    </div>                            

                    <div class="form-group">
                        <label for="colonia"><i class="fas fa-map-marker-alt mr-2"></i>Colonia <span class="text-danger">*</span></label>
                        <input type="text" name="colonia" class="form-control" id="colonia" placeholder="Ej: Centro" aria-invalid="false" maxlength="250" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="entidad"><i class="fas fa-map mr-2"></i>Entidad federativa <span class="text-danger">*</span></label>
                                <select name="entidad" class="form-control" id="entidad" onchange="MunicipiosApi(this,2);" required>
                                    <option value="">Seleccione un estado</option>
                                    @foreach($entidades as $entidad)
                                        <option value="{{$entidad->id}}">{{$entidad->entidad}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="municipio"><i class="fas fa-city mr-2"></i>Municipio/Alcaldía <span class="text-danger">*</span></label>
                                <select name="municipio" class="form-control" id="municipio" aria-invalid="false" data-mun="municipio" required>
                                    <option value="">Seleccione primero un estado</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cp"><i class="fas fa-mail-bulk mr-2"></i>C.P. <span class="text-danger">*</span></label>
                                <input type="text" name="cp" class="form-control" id="cp" placeholder="Ej: 01000" aria-invalid="false" maxlength="20" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono"><i class="fas fa-phone mr-2"></i>Teléfono <span class="text-danger">*</span></label>
                                <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Ej: 5551234567" aria-invalid="false" maxlength="50" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="celular"><i class="fas fa-mobile-alt mr-2"></i>Celular</label>
                                <input type="text" name="celular" class="form-control" id="celular" placeholder="Ej: 5559876543" aria-invalid="false" maxlength="50">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mail"><i class="fas fa-envelope mr-2"></i>Correo (De preferencia diferente al de registro) <span class="text-danger">*</span></label>
                                <input type="text" name="mail" class="form-control" id="mail" placeholder="Ej: contacto@empresa.com" aria-invalid="false" maxlength="150" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        <div style="margin-top:30px;">
            <button onclick="RecorreFormularioAtras();" class="btn btn-theme-primary float-left" style="display:none;" id="anterior"> los no obligatorios tienen esto : data-invalido="true"
                <i class="fas fa-chevron-left mr-2"></i>Anterior
            </button>
            <button onclick="RecorreFormularioAdelante();" class="btn btn-theme-primary float-right" style="display:none;" id="siguiente">
                Siguiente<i class="fas fa-chevron-right ml-2"></i>
            </button>
            <button type="submit" id="guardar" class="btn btn-theme-primary float-right" onclick="GuardarGenerador();">
                <i class="fas fa-save mr-2"></i>Guardar
            </button>
        </div>
        <br><br><br><br>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @include('cliente.footer')
</div>

<script>
  // Función para validar si un archivo es PDF
  function validarPDF(input) {
    if (input.files && input.files[0]) {
      const file = input.files[0];
      const fileType = file.type;

      // Verificar si el archivo es un PDF
      if (fileType !== "application/pdf") {
        alert("Por favor, selecciona un archivo en formato PDF.");
        input.value = ""; // Limpiar el input
        return false;
      }
    }
    return true;
  }

  // Asignar la validación a los inputs de tipo file
  document.addEventListener("DOMContentLoaded", function () {
    const inputsPDF = document.querySelectorAll('input[type="file"]');

    inputsPDF.forEach((input) => {
      input.addEventListener("change", function () {
        validarPDF(this);
      });
    });
  });
</script>
</body>
</html>