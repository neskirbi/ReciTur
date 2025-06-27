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
                                <h3 class="card-title">Datos fiscales</h3>            
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="razonsocial">Denominación/Razon social</label>
                                    <input type="text" name="razonsocial" class="form-control" id="razonsocial" placeholder="Denominación/Razon social" maxlength="250" aria-invalid="false" value="{{ app()->environment('local') ? 'Empresa Ejemplo S.A. de C.V.' : '' }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fisicaomoral">Persona</label>
                                            <select  name="fisicaomoral" class="form-control" id="fisicaomoral" aria-invalid="false" maxlength="50">
                                                <option value="">Persona</option>
                                                <optgroup>
                                                <option value="Moral">Moral</option>
                                                <option value="Física">Física</option>
                                                </optgroup>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="rfc">RFC</label>
                                            <input type="text" name="rfc" class="form-control" id="rfc" placeholder="RFC" maxlength="250" aria-invalid="false" value="{{ app()->environment('local') ? 'XCASDFDSF34' : '' }}">
                                        </div>
                                    </div>
              
                                </div>

                              

                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="calle">Calle</label>
                                            <input type="text" name="calle" class="form-control" id="calle" placeholder="Calle" maxlength="500" aria-invalid="false" value="{{ app()->environment('local') ? 'Av. Reforma' : '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">                                    
                                        <div class="form-group">
                                            <label for="numeroext">Número ext.</label>
                                            <input type="text" name="numeroext" class="form-control" id="numeroext" placeholder="Número ext." maxlength="20" aria-invalid="false" value="{{ app()->environment('local') ? '123' : '' }}">
                                        </div>
                            
                                    </div>
                                    <div class="col-md-3"> 
                                        <div class="form-group">
                                            <label for="numeroint">Número int.</label>
                                            <input type="text" name="numeroint" class="form-control" id="numeroint" placeholder="Número int." maxlength="20" aria-invalid="false" value="{{ app()->environment('local') ? 'B' : '' }}">
                                        </div>
                            
                                    </div>
                                </div>                            
                            

                                <div class="form-group">
                                    <label for="colonia">Colonia</label>
                                    <input type="text" name="colonia" class="form-control" id="colonia" placeholder="Colonia" aria-invalid="false" maxlength="250" value="{{ app()->environment('local') ? 'Juárez' : '' }}">
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entidad">Entidad federativa</label>
                                            <!--<input  type="text" name="entidad" class="form-control" id="entidad" placeholder="Entidad federativa" aria-invalid="false" >-->
                                            <select  name="entidad" class="form-control" id="entidad">
                                                <option value="">--Entidad Federativa--</option>
                                                @foreach($entidades as $entidad)
                                                <option value="{{$entidad->entidad}}">{{$entidad->entidad}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="municipio">Municipio/Alcaldía</label>
                                            <input type="text" name="municipio" class="form-control" id="municipio" placeholder="Municipio" aria-invalid="false" maxlength="150" value="{{ app()->environment('local') ? 'Cuauhtémoc' : '' }}">
                                        </div>
                                    </div>

                                
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="cp">CP</label>
                                            <input type="text" name="cp" class="form-control" id="cp" placeholder="CP" aria-invalid="false" maxlength="20" value="{{ app()->environment('local') ? '06600' : '' }}">
                                        </div>
                                    </div>
                                </div>
                            

                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" aria-invalid="false" maxlength="50" value="{{ app()->environment('local') ? '5555123456' : '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estado">Celular</label>
                                            <input type="text" name="celular" class="form-control" id="celular" placeholder="Celular" aria-invalid="false" maxlength="50" value="{{ app()->environment('local') ? '5512345678' : '' }}">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail">Correo</label>
                                            <input type="text" name="mail" class="form-control" id="mail" placeholder="Correo" aria-invalid="false" maxlength="150" value="{{ app()->environment('local') ? 'correo@ejemplo.com' : '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail">Correo</label>
                                            <input type="text" name="mail2" class="form-control" id="mail2" placeholder="Correo" aria-invalid="false" maxlength="150" value="{{ app()->environment('local') ? 'contacto@empresa.com' : '' }}">
                                        </div>
                                    </div>
                                </div>
                
                            </div>
                        </div>

                        
                        <!--Datos del representante legal en caso de ser persona moral-->

                        <div class="card card-primary" style="display:none;" id="representante">
                            <div class="card-header">
                                <h3 class="card-title">Representante legal</h3>            
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombresrepre">Nombre(s)</label>
                                            <input type="text" name="nombresrepre" class="form-control" id="nombresrepre" placeholder="Nombre(s)" aria-invalid="false" maxlength="150" value="{{ app()->environment('local') ? 'Carlos' : '' }}">
                                        </div>
                                        
                                    </div>
                                    

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellidosrepre">Apellidos</label>
                                            <input type="text" name="apellidosrepre" class="form-control" id="apellidosrepre" placeholder="Apellidos" aria-invalid="false" maxlength="150" value="{{ app()->environment('local') ? 'Ramírez Gómez' : '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="rfcrepre">RFC</label>
                                            <input type="text" name="rfcrepre" class="form-control" id="rfcrepre" placeholder="RFC" maxlength="250" aria-invalid="false" value="{{ app()->environment('local') ? 'XCASDFDSF34' : '' }}">
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombresrepre">Número de Teléfono del Representante Legal </label>
                                            <input type="text" name="numrepresent" class="form-control" id="numrepresent" placeholder="Núm. Representante Legal" aria-invalid="false" maxlength="150" value="{{ app()->environment('local') ? '5511122233' : '' }}">
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellidosrepre">Correo Electrónico del Representante Legal</label>
                                            <input type="text" name="correorepresent" class="form-control" id="correorepresent" placeholder="Mail Representante Legal" aria-invalid="false" maxlength="150" value="{{ app()->environment('local') ? 'carlos.ramirez@ejemplo.com' : '' }}">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nacionalidadrepre">Nacionalidad</label>
                                            <input type="text" name="nacionalidadrepre" class="form-control" id="nacionalidadrepre" placeholder="Nacionalidad" aria-invalid="false" maxlength="100" value="{{ app()->environment('local') ? 'Mexicana' : '' }}">
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="identificacionrepre">Identificación</label>
                                            <!--<input  type="text" name="identificacionrepre" class="form-control" id="identificacionrepre" placeholder="Identificación" aria-invalid="false" >-->
                                            <select class="form-control" name="identificacionrepre" id="identificacionrepre"  aria-invalid="false">
                                                <option value="">--Identificación--</option>
                                                <optgroup>
                                                <option value="INE">INE</option>
                                                <option value="Pasaporte">Pasaporte</option>
                                                <option value="Cédula Profesional">Cédula Profesional</option>
                                                </optgroup>
                                            </select>
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--Datos de la empresa en cas ode ser persona moral-->

                        <div class="card card-primary" style="display:none;"  id="empresa">
                            <div class="card-header">
                                <h3 class="card-title">Empresa</h3>            
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fechaconst">Fecha Constitución</label>
                                            <input  type="date" name="fechaconst" class="form-control" id="fechaconst" aria-invalid="false" maxlength="50" >
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numeroactacont">Acta Constitutiva</label>
                                            <input type="text" name="numeroactacont" class="form-control" id="numeroactacont" placeholder="Acta Constitutiva" aria-invalid="false" value="{{ app()->environment('local') ? '45' : '' }}">
                                        </div>
                                    </div>
                                </div>    
                                                     

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="notario">Nombre del notario o corredor público</label>
                                            <input type="text" name="notario" class="form-control" id="notario" placeholder="Nombre del notario o corredor público" aria-invalid="false" maxlength="250" value="{{ app()->environment('local') ? 'Lic. Jorge Mendoza' : '' }}">
                                        </div>
                                    </div>
                                
                                    <!--<div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numeronotario">Número de notario o corredor</label>
                                            <input type="text" name="numeronotario" class="form-control" id="numeronotario" placeholder="Número de notario o corredor" aria-invalid="false" value="{{ app()->environment('local') ? '45' : '' }}">
                                        </div>
                                    </div>-->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numeronotaria">Número de notaría o correduría</label>
                                            <input type="text" name="numeronotaria" class="form-control" id="numeronotaria" placeholder="Número de notaría o correduría" aria-invalid="false" maxlength="150" value="{{ app()->environment('local') ? '123' : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entidadnotaria">Entidad de la notaría</label>
                                            <!--<input  type="text" name="entidad" class="form-control" id="entidad" placeholder="Entidad federativa" aria-invalid="false" >-->
                                            <select  name="entidadnotaria" class="form-control" id="entidadnotaria">
                                                <option value="">--Entidad de la notaría--</option>
                                                  @foreach($entidades as $entidad)
                                                <option value="{{$entidad->entidad}}">{{$entidad->entidad}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--En caso de ser persona fisica-->
                        <div class="card card-primary"  style="display:none;"  id="fisica">
                            <div class="card-header">
                                <h3 class="card-title">Personales</h3>            
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombresfisica">Nombre(s)</label>
                                            <input type="text" name="nombresfisica" class="form-control" id="nombresfisica" placeholder="Nombre(s)" aria-invalid="false" maxlength="150" value="{{ app()->environment('local') ? 'Ana María' : '' }}">
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellidosfisica">Apellidos</label>
                                            <input type="text" name="apellidosfisica" class="form-control" id="apellidosfisica" placeholder="Apellidos" aria-invalid="false" maxlength="150" value="{{ app()->environment('local') ? 'López Pérez' : '' }}">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nacionalidadfisica">Nacionalidad</label>
                                            <input type="text" name="nacionalidadfisica" class="form-control" id="nacionalidadfisica" placeholder="Nacionalidad" aria-invalid="false" maxlength="100" value="{{ app()->environment('local') ? 'Mexicana' : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="identificacionfisica">Identificación</label>
                                            <!--<input  type="text" name="identificacionfisica" class="form-control" id="identificacionfisica" placeholder="Identificación" aria-invalid="false" >-->
                                            <select class="form-control" name="identificacionfisica" id="identificacionfisica"  aria-invalid="false">
                                                <option value="">--Identificación--</option>
                                                <optgroup>
                                                <option value="INE">INE</option>
                                                <option value="Pasaporte">Pasaporte</option>
                                                <option value="Cédula Profesional">Cédula Profesional</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>       
                            </div>
                        </div>
                </form>
                <div style="margin-top:30px; ">
                    <button onclick="RecorreFormularioAtras();" class="btn  btn-theme-primary float-left" style="display:none;" id="anterior"><i class="fa fa-chevron-left" ></i> Anterior</button>
                    <button onclick="RecorreFormularioAdelante();" class="btn  btn-theme-primary float-right" id="siguiente">Siguiente <i class="fa fa-chevron-right" ></i></button>
                    <button type="submit" style="display:none;" id="guardar" class="btn  btn-theme-primary float-right" onclick="GuardarGenerador();">Guardar</button>
                </div>
                <br><br><br><br>
                



        
          
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 @include('cliente.footer')

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



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
