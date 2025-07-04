<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manifiesto</title>
    <style>
    .bordes{
        border: 2px solid #000;
    }
    
    .probable100{
        width:100%;
    }
    
    td{
        font-size:9px;
    }
    </style>
</head>
<body>

<center>MANIFIESTO DE ENTREGA,TRANSPORTE Y RECEPCIÓN DE <br> RESIDUOS DE MANEJO ESPECIAL</center>

    
<div><font  style="float:right;"><b>Folio: {{$recoleccion->folio}}</b></font></div>
<br><br>

<center>
    <table style="border-collapse: collapse; width:100%;">
        <tr>
            <td class="bordes"><center><img style="width:15px; padding:10px;" src="{{public_path('images/formatos/manifiesto/generador.png')}}" alt="Generador"></center></td>
            <td class="bordes">
                NÚM. DE REGISTRO (Resolutivo de Impacto Ambiental, Plan de Manejo): <b>{{$recoleccion->nautorizacion}}</b>
               <br><br>
                RAZÓN SOCIAL DE LA PERSONA:  <b>{{$recoleccion->razonsocial}}</b>
                <br><br>                
                <table class="probable100">
                    
                    <tr>
                        <td>DOMICILIO:</td>
                        <td>&nbsp;&nbsp;<b>{{$recoleccion->calle}} Col. {{$recoleccion->colonia}}</b></td>
                        <td>COLONIA:</td>
                        <td>&nbsp;&nbsp;<b>{{$recoleccion->colonia}}</b></td>
                    </tr>

                    <tr>
                        <td>C.P:</td>
                        <td>&nbsp;&nbsp;<b>{{$recoleccion->cp}}</b></td>
                        <td>ENTIDAD:</td>
                        <td>&nbsp;&nbsp;<b>{{$recoleccion->entidad}}</b></td>
                    </tr>
                    <tr>
                        <td>TELÉFONO:</td>
                        <td>&nbsp;&nbsp;<b>{{$recoleccion->telefono}}</b></td>
                        <td></td>
                        <td></td>
                    </tr>

                    
                </table>
                
                
                <hr>
             
               
                <br> DESCRIPCIÓN RESIDUO
                <table border="0" style="border-collapse: collapse;" class="probable100">                   

                    <tr>
                        <td>RESIDUO</td>
                        <td>CANTIDAD CONTENEDOR </td>
                        <td>TOTAL</td>
                        <td>FECHA</td>
                        
                    </tr>
                              
                    <tr>
                        <td><b>{{$recoleccion->residuo}}</b></td>
                        <td>{{$recoleccion->cantidad.' '.$recoleccion->contenedor}}</td>
                        <td><b>{{$recoleccion->total}} Kg</b></td>
                        <td><b>{{FechaFormateada($recoleccion->created_at)}}</b></td>
                        
                    </tr>
                    
                    
                </table>

                <br>
               
                
                INSTRUCCIONES ESPECIOALES E INFORMACION ADICIONAL PARA EL MANEJO SEGURO:<br><br>
                
              <hr>

                DECLARACIÓN DEL GENERADOR:<br>
                DECLARO QUE EL CONTENIDO DE ESTE LOTE ESTA TOTAL Y CORRECTAMENTE DESCRITO MEDIANTE EL NOMBRE DEL RESIDUO, 
                BIEN EMPACADO, MARCADO Y ROTULADO, Y QUE SE HAN PREVISTO LAS CONDICIONES DE SEGURIDAD PARA SU TRANSPORTE 
                POR VIA TERRESTRE DE ACUERDO A LA LEGISLACIÓN VIGENTE.<br><br><br>

                NOMBRE Y FIRMA DEL RESPONSABLE: <b>{{$recoleccion->nombres}} {{$recoleccion->apellidos}}</b> <img src="{{$recoleccion->firmacliente}}" width="70px" alt="">
                <br> 
                
                
               
                <br>
            </td>
        </tr>
        <tr>
            <td class="bordes"><center><img style="width:15px; padding:10px;" src="{{public_path('images/formatos/manifiesto/transporte.png')}}" alt="Transporte"></center></td>
            <td class="bordes">
                
                <table style="border-collapse: collapse;" class="probable100" cellpadding="3px">
                    <tr>
                        <td>
                        NOMBRE DE LA EMPRESA TRANSPORTISTA: <b>{{$recoleccion->transportista}}</b>
                        </td>
                        <td>
                            
                        </td>
                    </tr>

                    <tr>
                        <td>
                            DOMICILIO FISCAL: <b>{{$recoleccion->domiciliot}}</b>
                        </td>
                        <td>
                            TELÉFONO: <b>{{$recoleccion->telefonot}}</b>
                        </td>
                    </tr>
              
                    <tr>
                        <td>
                            AUTORIZACIÓN RAMIR: <b></b>
                        </td>
                        <td>
                            NO. DE REGISTRO S.C.T. <b>{{$recoleccion->regsct}}</b>
                        </td>
                    </tr>
                   
                </table>
                <br>
                <hr>
                 RECIBÍ LOS RESIDUOS DESCRITOS EN EL MANIFIESTO PARA SU TRANSPORTE.
                <table style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>NOMBRE:</td>
                        <td><b>{{$recoleccion->recolector}}</b></td>
                        <td>FIRMA: </td>
                        <td><img src="{{$recoleccion->firmat}}" width="70px" alt=""></td>
                    </tr>
                    <tr>
                        <td>CARGO:</td>
                        <td><b>Recolector</b></td>
                        <td>FECHA DE EMBARQUE:</td>
                        <td><b>{{FechaFormateada($recoleccion->created_at)}}</b></td>
                    </tr>
                </table>
                <hr>
                 10.-Ruta de la empresa generadora hasta su entrega: <br><b>{{$configuracion->ruta}}</b>
                <br>
                <hr>
                <table style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>TIPO DE VEHÍCULO: </td>
                        <td><b>{{$recoleccion->vehiculo}}</b></td>
                        <td>No. DE MATRÍCULA:</td>
                        <td><b>{{$recoleccion->matriculat}}</b></td>
                    </tr>
                   
                </table>
                
               
                
            </td>
        </tr>
        <tr>
            <td class="bordes"><center><img style="width:15px; padding:20px;" src="{{public_path('images/formatos/manifiesto/destino.png')}}" alt="Destino"></center></td>
            <td class="bordes">
            <table style="border-collapse: collapse;" class="probable100" cellpadding="3px">
                    <tr>
                        <td>
                        NOMBRE DE LA EMPRESA DESTINATARIA: <b>{{$configuracion->razonsocial}}</b>
                        </td>
                        <td>
                            
                        </td>
                    </tr>
              
                    <tr>
                        <td>
                            AUTORIZACIÓN RAMIR: <b></b>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            DOMICILIO FISCAL: <b></b>
                        </td>
                        <td>
                            TELÉFONO: <b>{{$configuracion->telefono}}</b>
                        </td>
                    </tr>
                   
                </table>

                <hr>

                RECIBÍ LOS RESIDUOS DESCRITOS EN EL MANIFIESTO.
                <table style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>NOMBRE:</td>
                        <td><b></b></td>
                        <td>FIRMA: </td>
                        <td><img src="" width="70px" alt=""></td>
                    </tr>
                    <tr>
                        <td>CARGO:</td>
                        <td>Recepcion</td>
                        <td>FECHA DE EMBARQUE:</td>
                        <td><b>{{FechaFormateada($recoleccion->created_at)}}</b></td>
                    </tr>
                </table>
                
                
            </td>

            
        </tr>      

    </table>
</center>
    
    
</body> 
</script> 
</html>