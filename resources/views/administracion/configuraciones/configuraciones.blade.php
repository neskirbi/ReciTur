<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>CSMX | Configuración</title>

  
</head>
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

      <div class="row">
          <div class="col-md-12">
            <div class="callout callout-info">
              <h5>Configuración de la Planta</h5>
            </div>

          </div>
         
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="card card-danger card-outline">
              <div class="card-header">
              <h3 class="card-title">Configuraciones</h3>

              
              </div>
              <div class="card-body p-0">
                  <input type="hidden" name="id_municipio" id="id_municipio" value="{{Auth::guard('administradores')->user()->id_municipio}}">
                  <ul class="nav nav-pills flex-column">                 

                    <li class="nav-item ">
                        <a class="nav-link active" onclick="VentanasTitulos(this,'titulo');" data-text="Planta"  data-toggle="pill" href="#planta" role="tab">
                            <i class="fa fa-recycle" aria-hidden="true"></i> Planta
                            <!--<span class="badge bg-primary float-right">12</span>-->
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" onclick="VentanasTitulos(this,'titulo');" data-text="Cuenta"  data-toggle="pill" href="#cuenta" role="tab">
                            <i class="fa fa-user" aria-hidden="true"></i> Cuenta
                            <!--<span class="badge bg-primary float-right">12</span>-->
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" onclick="VentanasTitulos(this,'titulo');" data-text="Representante"  data-toggle="pill" href="#representante" role="tab">
                            <i class="fa fa-user" aria-hidden="true"></i> Representante
                            <!--<span class="badge bg-primary float-right">12</span>-->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="VentanasTitulos(this,'titulo');" data-text="Contraseña"  data-toggle="pill" href="#contrasenia" role="tab">
                            <i class="fa fa-lock" aria-hidden="true"></i> Contraseña
                            <!--<span class="badge bg-primary float-right">12</span>-->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="VentanasTitulos(this,'titulo');" data-text="Banco"  data-toggle="pill" href="#banco" role="tab">
                            <i class="fa fa-dollar" aria-hidden="true"></i> Banco
                            <!--<span class="badge bg-primary float-right">12</span>-->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="VentanasTitulos(this,'titulo');" data-text="Boletas"  data-toggle="pill" href="#boleta" role="tab">
                          <i class="fa fa-file-text" aria-hidden="true"></i> Boletas
                            <!--<span class="badge bg-primary float-right">12</span>-->
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" onclick="VentanasTitulos(this,'titulo');" data-text="Horarios"  data-toggle="pill" href="#horarios" role="tab">
                          <i class="fa fa-calendar" aria-hidden="true"></i> Horarios
                            <!--<span class="badge bg-primary float-right">12</span>-->
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" onclick="VentanasTitulos(this,'titulo');" data-text="Transporte"  data-toggle="pill" href="#transporte" role="tab">
                          <i class="fa fa-truck" aria-hidden="true"></i> Transporte
                            <!--<span class="badge bg-primary float-right">12</span>-->
                        </a>
                    </li>
                  </ul>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="col-md-9">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title" id="titulo">Planta</h3>
              </div>
              <div class="card-body">
                <div class="col-md-12">                   
                    <div class="row">
                        <div class="tab-content" id="custom-tabs-four-tabContent" style="width:100%;"> 
                        

                        <div class="tab-pane fade active show" id="planta" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                          <div class="row">
                            <div class="col-12">
                                <form action="{{url('GuardarDatosPlanta').'/'.$planta->id}}" id="{{$planta->id}}" method="post">
                                @csrf
                                @method('PUT')                              

                                  
                                  <div class="row">
                                      <div class="col-sm-12">
                                          <div class='form-group'>
                                              <label for="planta">Planta</label>
                                              <input required type="text" class="form-control" id="planta" name="planta" value="{{$planta->planta}}">
                                          </div>
                                      </div>
                                      
                                    </div>

                                    <div class="row">
                                      
                                    
                                      <div class="col-sm-4">
                                        <div class='form-group'>
                                          <label for="telefono">Teléfono</label>
                                          <input required type="text" class="form-control" id="telefono" name="telefono" value="{{$configuraciones->telefono}}">
                                        </div>
                                      </div>

                                      
                                    
                                      <div class="col-sm-8">
                                        <div class='form-group'>
                                          <label for="ruta">Ruta</label>
                                          <input required type="text" class="form-control" id="ruta" name="ruta" value="{{$configuraciones->ruta}}">
                                        </div>
                                      </div>

                                    </div>


                                    <div class="row"> 
                                      <div class="col-sm-6">
                                          <div class='form-group'>
                                              <label for="cst"># Registro S.C.T</label>
                                              <input required type="text" class="form-control" id="sct" name="sct" value="{{$configuraciones->sct}}" >
                                          </div>
                                      </div>
                                    </div>

                                    <div class="row"> 
                                      
                                      <div class="col-sm-6">
                                          <div class='form-group'>
                                              <label for="plantaauto">Autorización</label>
                                              <input required type="text" class="form-control" id="plantaauto" name="plantaauto" value="{{$planta->plantaauto}}">
                                          </div>
                                      </div>
                                        
                                      <div class="col-sm-6">
                                        <div class='form-group'>
                                          <label for="codigo">C&oacute;digo</label>
                                          <input required type="text" class="form-control" id="codigo" name="codigo" value="{{$planta->codigo}}">
                                        </div>
                                      </div> 
                                  </div>

                                  <div class="row">
                                    <div class="col-sm-12">
                                        <div class='form-group'>
                                            <label for="razonsocial">Razón Social</label>
                                            <input required type="text" class="form-control" id="razonsocial" name="razonsocial" value="{{$configuraciones->razonsocial}}">
                                        </div>
                                    </div>
                                  
                                </div>
                                <div class="row">                            
                                    <div class="col-sm-12">
                                        <div class='form-group'>
                                            <label for="direccion">Dirección</label>
                                            <input required type="text" class="form-control" id="direccion" name="direccion" value="{{$planta->direccion}}">
                                        </div>
                                    </div>
                                </div>
                                @if(Auth::guard('administradores')->user()->principal==1) 
                                <div class="card-footer">
                                    <button type="submit" class='btn btn-info float-right' data-texto="¿Todos los datos son correctos?">Guardar</button>
                                </div>
                                @endif    
                                
                                </form> 

                            </div>
                        </div>
                            
                          </div>
                        

                          <div class="tab-pane fade " id="cuenta" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                              <form action="configuracioncuenta" method="post" id="cuentaform">
                                @csrf
                                <div class="row">
                                  <div class="col-md-12">
                                     
                                    <div class='form-group'>
                                        <label for="administrador">Administrador</label>
                                        <input type="text" class="form-control" id="administrador" name="administrador" value="{{$administrador->administrador}}">
                                    </div>

                                  </div>
                                </div>

                                <div class="row">                            
                                  <div class="col-sm-7">
                                    <div class='form-group'>
                                      <label for="cargo">Cargo</label>
                                      <input type="text" class="form-control" id="cargo" name="cargo" value="{{$administrador->cargo}}">
                                    </div>
                                  </div>
                                  <div class="col-sm-5">
                                    <div class='form-group'>
                                      <label for="mail">Correo</label>
                                      <input type="text" class="form-control" id="mail" name="mail" value="{{$administrador->mail}}">
                                    </div>
                                  </div>                                        
                                </div>

                                <div class="row">                            
                                  <div class="col-sm-7">
                                    <div class="form-group">   
                                      <label for="firma">Firma</label> 
                                      <br> 
                                      @if($administrador->firma!='')   
                                      <img src="{{$administrador->firma}}" alt="" width="340px" height="200px" id="imgfirma"> 
                                      <canvas  id="draw-canvas" width="340px" height="200px" style="display:none;"></canvas>          
                                      @else
                                      <canvas  id="draw-canvas" width="340px" height="200px"></canvas>                     
                                      @endif
                                      <textarea data-invalido="true" id="draw-dataUrl" class="form-control" rows="5" name="firma" style="display:none;">{{$administrador->firma}}</textarea>
                                      <br>
                                      <button type="button" class="btn btn-default" id="draw-clearBtn">Limpiar</button> 
                                    </div>
                                  </div>
                                </div>                                                                      
                              </form>
                              <button class="btn btn-info float-right" id="draw-submitBtn" data-texto="¿Guardar los datos de administrador?">Guardar</button>
                              
                          </div>


                          <div class="tab-pane fade " id="representante" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                              <form action="ConfiguracionRepresentante" method="post" id="repreform">
                                @csrf
                                <div class="row">
                                  <div class="col-md-12">
                                     
                                    <div class='form-group'>
                                        <label for="representante">Representante Legal</label>
                                        <input type="text" class="form-control" id="representante" name="representante" value="{{$configuraciones->representante}}">
                                    </div>

                                  </div>
                                </div>

                                <div class="row">                            
                                  <div class="col-sm-7">
                                    <div class='form-group'>
                                      <label for="cargo">Cargo</label>
                                      <input type="text" class="form-control" id="cargo" name="cargo" value="{{$configuraciones->cargo}}">
                                    </div>
                                  </div>
                                  <div class="col-sm-5">
                                    <div class='form-group'>
                                      <label for="mail">Correo</label>
                                      <input type="text" class="form-control" id="mail" name="mail" value="{{$configuraciones->mail}}">
                                    </div>
                                  </div>                                        
                                </div>

                                <div class="row">                            
                                  <div class="col-sm-7">
                                    <div class="form-group">   
                                      <label for="firma">Firma</label> 
                                      <br> 
                                      @if($configuraciones->firma_repre!='')   
                                      <img src="{{$configuraciones->firma_repre}}" alt="" width="340px" height="200px" id="imgfirmar"> 
                                      <canvas class="draw-canvas" id="draw-canvasr" width="340px" height="200px" style="display:none;"></canvas>          
                                      @else
                                      <canvas class="draw-canvas" id="draw-canvasr" width="340px" height="200px"></canvas>                     
                                      @endif
                                      <textarea data-invalido="true" id="draw-dataUrlr" class="form-control" rows="5" name="firma" style="display:none;">{{$configuraciones->firma_repre}}</textarea>
                                      <br>
                                      <button type="button" class="btn btn-default" id="draw-clearBtnr">Limpiar</button> 
                                    </div>
                                  </div>
                                </div>                                                                      
                              </form>
                              <button class="btn btn-info float-right" id="draw-submitBtnr" data-texto="¿Guardar los datos de representante?">Guardar</button>
                              <div class="row">
                                <div class="col-md-12">  
                                  <div class='form-group'>
                                    <label style="color:#999;">Nota:Estos datos se verán reflejados en el manifiesto.</label>
                                  </div>                 
                                
                                </div>
                              </div>
                          </div>

                          <div class="tab-pane fade" id="contrasenia" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                            <form action="{{url('CambioPass')}}/{{$administrador->id}}" method="POST">
                              @csrf
                            <div class="row">
                              <div class="col-md-12">
                                <div class='form-group'>
                                    <label for="pass">Nueva Contraseña</label>
                                    <input required type="password" class="form-control" id="pass" name="pass" placeholder="Nueva Contraseña" minlength="4" maxlength="10" onkeyup="ValidarPassRegistro();">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class='form-group'>
                                    <label for="pass">Confirmar Contraseña</label>
                                    <input required type="password" class="form-control" id="pass2" name="pass2" placeholder="Nueva Contraseña" minlength="4" maxlength="10" onkeyup="ValidarPassRegistro();">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <button type="submit" class="btn btn-primary float-right">Guardar</button>
                              </div>
                            </div>
                            </form>
                            <div class="row">
                              <div class="col-md-12">  
                                <div class='form-group'>
                                  <label style="color:#999;">Nota:Al actualizar los datos se cerrara la sesión.</label>
                                </div>                 
                              
                              </div>
                            </div>

                            
                            </form>
                            
                          </div>
                          
                          <div class="tab-pane fade" id="banco" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                              <form action="configuracionbanco" method="post" id="bancoform">
                                @csrf
                                  <div class="row">
                                    <div class="col-md-8">
                                          <div class="form-group">
                                              <label for="banco">Banco</label>
                                              <input maxlength="50" require type="text" class="form-control" id="banco" name="banco" value="{{$configuraciones->banco}}">
                                          </div>
                                      </div> 
                                    <div class="col-md-1">
                                        
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="referencia">Inicio de Referencia</label>
                                            <input require type="text" class="form-control" id="referencia" name="referencia" value="{{$configuraciones->referencia}}">
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row"> 
                                    
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="cuenta">CLABE</label>
                                              <input maxlength="20" require type="text" class="form-control" id="clabe" name="clabe" value="{{$configuraciones->clabe}}">
                                          </div>
                                      </div> 
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="cuenta">Cuenta</label>
                                              <input maxlength="20" require type="text" class="form-control" id="cuenta" name="cuenta" value="{{$configuraciones->cuenta}}">
                                          </div>
                                      </div>
                                      <div class="col-md-1">
                                          
                                      </div>
                                      <div class="col-md-2">                                         
                                        <div class="form-group">
                                          <label for="cuenta">Iva</label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="number" min="0" step="0.01" name="iva" id="iva" class="form-control" aria-invalid="false" value="{{$configuraciones->iva}}">
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                                                    
                              </form>
                              <button class="btn btn-info float-right" onclick="Submite('bancoform',this);" data-texto="¿Guardar los datos del banco?">Guardar</button>
                          </div>


                          <div class="tab-pane fade" id="boleta" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                              <form action="configuracionboleta" method="post" id="boletaform">
                                @csrf
                                  <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="folio">Folio</label>
                                            <input require type="text" class="form-control" id="folio" name="folio" value="{{$configuraciones->folio}}">
                                        </div>
                                    </div>
                                  </div>                                                                      
                              </form>
                              <button class="btn btn-info float-right" onclick="Submite('boletaform',this);" data-texto="¿Guardar los datos?">Guardar</button>
                          </div>

                          <div class="tab-pane fade" id="horarios" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                            <form action="{{url('Horarios')}}/{{$planta->id}}" method="POST">
                              @csrf   
                              <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="folio">Intervalo</label>
                                    <div class="input-group">
                                      <input type="number" step="1" min="1" class="form-control" id="intervalo" name="intervalo" value="{{$planta->intervalo}}">
                                      <div class="input-group-append">
                                        <span class="input-group-text">min</span>
                                      </div>
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>  
                              <table>
                                <tr>
                                  <td>
                                
                                    <div class="form-group">
                                        <label for="domingoi">Domingo</label>
                                        <input require type="text" class="form-control" id="domingoi" name="domingoi" value="{{$planta->domingoi}}">
                                    </div>
                                  </td>
                                  <td>
                                
                                    <div class="form-group">
                                        <label for="lunesi">Lunes</label>
                                        <input require type="text" class="form-control" id="lunesi" name="lunesi" value="{{$planta->lunesi}}">
                                    </div>
                                  </td>
                                  <td>
                                
                                    <div class="form-group">
                                        <label for="martesi">Martes</label>
                                        <input require type="text" class="form-control" id="martesi" name="martesi" value="{{$planta->martesi}}">
                                    </div>
                                  </td>
                                  <td>
                                
                                    <div class="form-group">
                                        <label for="miercolesi">Miércoles</label>
                                        <input require type="text" class="form-control" id="miercolesi" name="miercolesi" value="{{$planta->miercolesi}}">
                                    </div>
                                  </td>
                                  <td>
                                
                                    <div class="form-group">
                                        <label for="juevesi">Jueves</label>
                                        <input require type="text" class="form-control" id="juevesi" name="juevesi" value="{{$planta->juevesi}}">
                                    </div>
                                  </td>
                                  <td>
                                
                                    <div class="form-group">
                                        <label for="viernesi">Viernes</label>
                                        <input require type="text" class="form-control" id="viernesi" name="viernesi" value="{{$planta->viernesi}}">
                                    </div>
                                  </td>
                                  <td>
                                
                                    <div class="form-group">
                                        <label for="sabadoi">Sabados</label>
                                        <input require type="text" class="form-control" id="sabadoi" name="sabadoi" value="{{$planta->sabadoi}}">
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                
                                    <div class="form-group">
                                        <label for="domingof">Domingo</label>
                                        <input require type="text" class="form-control" id="domingof" name="domingof" value="{{$planta->domingof}}">
                                    </div>
                                  </td>
                                  <td>
                                
                                    <div class="form-group">
                                        <label for="lunesf">Lunes</label>
                                        <input require type="text" class="form-control" id="lunesf" name="lunesf" value="{{$planta->lunesf}}">
                                    </div>
                                  </td>
                                  <td>
                                
                                    <div class="form-group">
                                        <label for="martesf">Martes</label>
                                        <input require type="text" class="form-control" id="martesf" name="martesf" value="{{$planta->martesf}}">
                                    </div>
                                  </td>
                                  <td>
                                
                                    <div class="form-group">
                                        <label for="miercolesf">Miércoles</label>
                                        <input require type="text" class="form-control" id="miercolesf" name="miercolesf" value="{{$planta->miercolesf}}">
                                    </div>
                                  </td>
                                  <td>
                                
                                    <div class="form-group">
                                        <label for="juevesf">Jueves</label>
                                        <input require type="text" class="form-control" id="juevesf" name="juevesf" value="{{$planta->juevesf}}">
                                    </div>
                                  </td>
                                  <td>
                                
                                    <div class="form-group">
                                        <label for="viernesf">Viernes</label>
                                        <input require type="text" class="form-control" id="viernesf" name="viernesf" value="{{$planta->viernesf}}">
                                    </div>
                                  </td>
                                  <td>
                                
                                    <div class="form-group">
                                        <label for="sabadof">Sabado</label>
                                        <input require type="text" class="form-control" id="sabadof" name="sabadof" value="{{$planta->sabadof}}">
                                    </div>
                                  </td>
                                </tr>
                              </table>  
                              <div class="row">
                                <div class="col-md-12">  
                                  <div class='form-group'>
                                    <label style="color:#999;">Nota:El formato de fecha es de 24 horas, solo horas y minutos Ej. 15:30 .</label>
                                  </div>                 
                                
                                </div>
                              </div>
                              <div class='row'>
                                <div class='col-md-12'>
                                  <button type="submit" class="btn btn-info float-right">Guardar</button>
                                </div>
                              </div>                                                          
                            </form>
                          </div>

                          <div class="tab-pane fade" id="transporte" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                            <form action="{{url('GuardarEmpresaTransporte')}}" method="post" >
                            @csrf
                              <div class="form-group">
                                <label for="razonsocial">Razón social</label>
                                <input required type="text" name="razonsocial" class="form-control" id="razonsocial" placeholder="Razón Social" maxlength="250" aria-invalid="false" value="{{$empresa->razonsocial}}">
                              </div>


                              <div class = "row">
                                <div class="col-md-4"> 
                                  <div class="form-group">
                                    <label for="razonsocial">Ramir</label>
                                    <input required type="text" name="ramir" class="form-control" id="ramir" placeholder="Ramir" maxlength="100" aria-invalid="false" value="{{$empresa->ramir}}">
                                  </div>                      
                                </div>


                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="giro">Giro</label>
                                    <input required type="text" name="giro" class="form-control" id="giro" placeholder="Giro" maxlength="250" aria-invalid="false" value="{{$empresa->giro}}">
                                  </div>
                                </div>  
                                  
                                <div class="col-md-4">  
                                  <div class="form-group">
                                    <label for="regsct">Registro SCT</label>
                                    <input required type="text" name="regsct" class="form-control" id="regsct" placeholder="Registro SCT" maxlength="100" aria-invalid="false" value="{{$empresa->regsct}}">
                                  </div>
                                </div>
                              </div>
                    
                                                      
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="domicilio">Domicilio</label>
                                    <textarea required class="form-control" name="domicilio" rows="3" cols="90">{{$empresa->domicilio}}</textarea>
                                  </div>
                                </div>  
                              </div>
                            
                                                      
                                    
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input required type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" aria-invalid="false" maxlength="50" value="{{$empresa->telefono}}">
                                  </div>
                                </div>  
                              
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="mail">Correo</label>
                                    <input required type="text" name="mail" class="form-control" id="mail" placeholder="Correo" aria-invalid="false" maxlength="50" value= "{{$empresa->correo}}">
                                  </div>
                                </div>
                              </div>
                              <button required="" type="submit" id="guardar" class="btn  btn-info float-right">Guardar</button>
                            </form>

                          </div>
                          
                        </div>
                      </div>           
                        
                    </div>
                
                </div>
                
              </div>
              <!-- /.card-body -->
            </div>
            
           
          </div>
          
        </div>
        <!-- /.row -->       

        <div class="row">
          <div class="col-md-12">
            <div class="callout callout-info">
              <h5>Configuración de la App</h5>
            </div>

          </div>
         
        </div>

        <div class="row">
          <div class="col-md-3">
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title">App</h3>
              </div>
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item ">
                    <a class="nav-link active" onclick="VentanasTitulos(this,'titulo2');" data-text="Residuos"  data-toggle="pill" href="#residuos" role="tab">
                      <i class="fa fa-th" aria-hidden="true"></i> Residuos
                      <!--<span class="badge bg-primary float-right">12</span>-->
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link" onclick="VentanasTitulos(this,'titulo2');" data-text="Contenedores"  data-toggle="pill" href="#contenedores" role="tab">
                      <i class="fa fa-trash" aria-hidden="true"></i> Contenedores
                      <!--<span class="badge bg-primary float-right">12</span>-->
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
          </div>


          <div class="col-md-9">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title" id="titulo">Residuos</h3>
              </div>
              <div class="card-body">
                <div class="col-md-12">                   
                  <div class="row">
                    <div class="tab-content" id="custom-tabs-four-tabContent" style="width:100%;">                            
                      <div class="tab-pane fade active show" id="residuos" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                        <div class="p-2">
                          <a class="btn btn-info" data-toggle="modal" data-target="#mresiduo">
                          <i class="fa fa-plus" aria-hidden="true"></i> Residuo                    
                        </a> 
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                          <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                    <th>Residuo</th>
                                    <th>Precio</th>
                                    <th>Unidades</th> 
                                    <th>Opción</th> 
                                    <th></th>   
                                    </tr>
                                </thead>
                            <tbody>
                            @foreach($residuos as $residuo)
                            <tr>
                              <td>{{$residuo->residuo}}</td>
                              <td>${{$residuo->precio}}</td>
                              <td>{{$residuo->unidades}}</td>
                              <td>{{$residuo->opcion}}</td>
                              <td><form action="{{url('BorrarResiduo')}}/{{$residuo->id}}" method="post">
                                @csrf
                                <button class="btn btn-danger btn-sm confirmarclick" data-texto="Eliminar el residuo del catálogo?"><i class="fa fa-times" aria-hidden="true"></i></button>
                              </form></td>
                            </tr>
                              
                            @endforeach                   
                                
                            </tbody>
                            </table>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="contenedores" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                        <div class="p-2">
                          <a class="btn btn-info" data-toggle="modal" data-target="#mcontenedor">
                          <i class="fa fa-plus" aria-hidden="true"></i> Contenedores                    
                        </a> 
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                          <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                    <th>Contenedor</th>
                                    <th>Cantidad</th> 
                                    <th>Opción</th> 
                                    <th></th>   
                                    </tr>
                                </thead>
                            <tbody>
                            @foreach($contenedores as $contenedor)
                            <tr>
                              <td>{{$contenedor->contenedor}}</td>
                              <td>{{$contenedor->cantidad}}</td>
                              <td>{{$contenedor->opcion}}</td>
                              <td><form action="{{url('BorrarContenedor')}}/{{$contenedor->id}}" method="post">
                                @csrf
                                <button class="btn btn-danger btn-sm confirmarclick" data-texto="Eliminar el residuo del catálogo?"><i class="fa fa-times" aria-hidden="true"></i></button>
                              </form></td>
                            </tr>
                              
                            @endforeach                   
                                
                            </tbody>
                            </table>
                          </div>
                        </div>
                      </div>

                      

                    </div> 
                    
                    <div class="tab-content" id="custom-tabs-four-tabContent" style="width:100%;">                            
                      
                    </div>
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
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="dist/js/adminlte.js"></script>
@include('administracion.configuraciones.modals.modalresiduo')
@include('administracion.configuraciones.modals.modalcontenedor')
@include('administracion.footer')

<script>
  var si=0;
function IniciarFirmar(variante,form) { // Comenzamos una funcion auto-ejecutable

    // Obtenenemos un intervalo regular(Tiempo) en la pamtalla
    window.requestAnimFrame = (function (callback) {
    return window.requestAnimationFrame ||
    window.webkitRequestAnimationFrame ||
    window.mozRequestAnimationFrame ||
    window.oRequestAnimationFrame ||
    window.msRequestAnimaitonFrame ||
    function (callback) {
      window.setTimeout(callback, 1000/60);
      // Retrasa la ejecucion de la funcion para mejorar la experiencia
    };
  })();

  // Traemos el canvas mediante el id del elemento html
  var canvas = document.getElementById("draw-canvas"+variante);
  var ctx = canvas.getContext("2d");


  // Mandamos llamar a los Elemetos interactivos de la Interfaz HTML
  var drawText = document.getElementById("draw-dataUrl"+variante);
  var clearBtn = document.getElementById("draw-clearBtn"+variante);
  var submitBtn = document.getElementById("draw-submitBtn"+variante);
  
  clearBtn.addEventListener("click", function (e) {
    // Definimos que pasa cuando el boton draw-clearBtn es pulsado
    clearCanvas();
  }, false);

  // Definimos que pasa cuando el boton draw-submitBtn es pulsado
  submitBtn.addEventListener("click", function (e) {
    var dataUrl = canvas.toDataURL();
    if(si)
      drawText.innerHTML = dataUrl;
    Submite(form,this);
  }, false);

  // Activamos MouseEvent para nuestra pagina
  var drawing = false;
  var mousePos = { x:0, y:0 };
  var lastPos = mousePos;
  canvas.addEventListener("mousedown", function (e){
    /*
      Mas alla de solo llamar a una funcion, usamos function (e){...}
      para mas versatilidad cuando ocurre un evento
    */
    var tint = '#000000';
    
    console.log(tint);
    si=1;
    var punta = 3;
    console.log(e);
    drawing = true;
    lastPos = getMousePos(canvas, e);
  }, false);
  canvas.addEventListener("mouseup", function (e){
      drawing = false;
  }, false);
  canvas.addEventListener("mousemove", function (e){
      mousePos = getMousePos(canvas, e);
  }, false);

  // Activamos touchEvent para nuestra pagina
  canvas.addEventListener("touchstart", function (e){
    mousePos = getTouchPos(canvas, e);
    e.preventDefault(); 
    // Prevent scrolling when touching the canvas
    var touch = e.touches[0];
    var mouseEvent = new MouseEvent("mousedown", {
        clientX: touch.clientX,
        clientY: touch.clientY
    });
    canvas.dispatchEvent(mouseEvent);
  }, false);

  canvas.addEventListener("touchend", function (e) {
    e.preventDefault(); // Prevent scrolling when touching the canvas
    var mouseEvent = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(mouseEvent);
  }, false);

  canvas.addEventListener("touchleave", function (e) {
    // Realiza el mismo proceso que touchend en caso de que el dedo se deslice fuera del canvas
    e.preventDefault(); // Prevent scrolling when touching the canvas
    var mouseEvent = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(mouseEvent);
  }, false);

  canvas.addEventListener("touchmove", function (e) {
    e.preventDefault(); // Prevent scrolling when touching the canvas
    var touch = e.touches[0];
    var mouseEvent = new MouseEvent("mousemove", {
        clientX: touch.clientX,
        clientY: touch.clientY
    });  
    canvas.dispatchEvent(mouseEvent);
  }, false);

  // Get the position of the mouse relative to the canvas
  function getMousePos(canvasDom, mouseEvent) {
    var rect = canvasDom.getBoundingClientRect();
    /*
      Devuelve el tamaño de un elemento y su posición relativa respecto
      a la ventana de visualización (viewport).
    */
    return {
        x: mouseEvent.clientX - rect.left,
        y: mouseEvent.clientY - rect.top
    };
  }

  // Get the position of a touch relative to the canvas
  function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    console.log(touchEvent);
    /*
    Devuelve el tamaño de un elemento y su posición relativa respecto
    a la ventana de visualización (viewport).
    */
    return {
        x: touchEvent.touches[0].clientX - rect.left, // Popiedad de todo evento Touch
        y: touchEvent.touches[0].clientY - rect.top
    };
  }

  // Draw to the canvas
  function renderCanvas() {
    if (drawing) {
      var tint = '#000000';
      var punta = 3;
      ctx.strokeStyle = tint;
      ctx.beginPath();
      ctx.moveTo(lastPos.x, lastPos.y);
      ctx.lineTo(mousePos.x, mousePos.y);
      //Tamaño del puntero
      ctx.lineWidth = punta;
      ctx.stroke();
      ctx.closePath();
      lastPos = mousePos;
    }
  }

  function clearCanvas() {
    si=0;
    $('#draw-canvas'+variante).show();
    $('#imgfirma'+variante).hide();
    drawText.innerHTML = '';
    canvas.width = canvas.width;
  }

  // Allow for animation
  (function drawLoop () {
    requestAnimFrame(drawLoop);
    renderCanvas();
  })();

}

IniciarFirmar('','cuentaform');
IniciarFirmar('r','repreform');
</script>


</body>
</html>
