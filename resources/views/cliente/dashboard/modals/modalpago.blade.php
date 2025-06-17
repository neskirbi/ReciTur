<!-- ModalRegistro -->
<div class="modal fade" id="modalpago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
           
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-university" aria-hidden="true"></i> Tranferencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form action="PagoCliente" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div> 
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                        <div class="boxpago" style="">
                            <div><h4>Transferencia Bancaria</h4></div>
                            <p>Se le generara una referencia y las instrucciones de pago. </p>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" onblur="FormatNumber(this)" id="monto" name="monto" class="form-control" placeholder="Monto">
                            <div class="input-group-append">
                            </div>
                            </div>
                        </div>
                        
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label for="obra">Obra</label>
                                <select class="form-control" name="obra" id="obra" aria-invalid="false" onchange="GetGeneradorDatos(this);">
                                    <option value="0">--Obra--</option>
                                    @foreach($obras as $obra)
                                    <option value="{{$obra->id}}">{{$obra->obra}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="planta">Planta</label>
                            <select required type="text" name="planta" class="form-control" id="planta" aria-invalid="false" @if(count($plantas)==1) readonly @endif >
                            @if(count($plantas)>1)                        
                            <option value="">--Seleccionar planta--</option>
                            @endif
                            @foreach($plantas as $planta)
                            <option value="{{$planta->id}}">{{$planta->planta}}</option>
                            @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre Completo" value="" required>
                            <div class="input-group-append">
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-map" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Dirección" required>
                            <div class="input-group-append">
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                        <div class="form-group">
                            <label for="entidad">C.P.</label>
                            <input type="text" id="cp" name="cp" class="form-control" placeholder="Código Postal" required>
                        </div> 
                        </div>
                        <div class="col-md-5">
                        <div class="form-group">
                            <label for="municipio">Alcaldía/Municipio</label>
                            <input type="text" id="municipio" name="municipio" class="form-control" placeholder="Alcaldía/Municipio" required>
                        </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                        <div class="form-group">
                            <label for="entidad">Entidad federativa</label>
                            <!--<input  type="text" name="entidad" class="form-control" id="entidad" placeholder="Entidad federativa" aria-invalid="false" >-->
                            <select required name="entidad" class="form-control" id="entidad" aria-invalid="false" >
                            <option value="">--Entidad Federativa--</option>
                            <option value="Aguascalientes">Aguascalientes</option>
                            <option value="Baja California">Baja California</option>
                            <option value="Baja California Sur">Baja California Sur</option>
                            <option value="Campeche">Campeche</option>
                            <option value="Chiapas">Chiapas</option>
                            <option value="Chihuahua">Chihuahua</option>
                            <option value="CDMX">Ciudad de México</option>
                            <option value="Coahuila">Coahuila</option>
                            <option value="Colima">Colima</option>
                            <option value="Durango">Durango</option>
                            <option value="Estado de México">Estado de México</option>
                            <option value="Guanajuato">Guanajuato</option>
                            <option value="Guerrero">Guerrero</option>
                            <option value="Hidalgo">Hidalgo</option>
                            <option value="Jalisco">Jalisco</option>
                            <option value="Michoacán">Michoacán</option>
                            <option value="Morelos">Morelos</option>
                            <option value="Nayarit">Nayarit</option>
                            <option value="Nuevo León">Nuevo León</option>
                            <option value="Oaxaca">Oaxaca</option>
                            <option value="Puebla">Puebla</option>
                            <option value="Querétaro">Querétaro</option>
                            <option value="Quintana Roo">Quintana Roo</option>
                            <option value="San Luis Potosí">San Luis Potosí</option>
                            <option value="Sinaloa">Sinaloa</option>
                            <option value="Sonora">Sonora</option>
                            <option value="Tabasco">Tabasco</option>
                            <option value="Tamaulipas">Tamaulipas</option>
                            <option value="Tlaxcala">Tlaxcala</option>
                            <option value="Veracruz">Veracruz</option>
                            <option value="Yucatán">Yucatán</option>
                            <option value="Zacatecas">Zacatecas</option>
                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submite" class="btn btn-info">
                        Generar
                        </button>
                    
                    </div>
                        
                </form>
                        
                    
            </div>
          
            
        </div>
    </div>
</div>