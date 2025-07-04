<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manifiesto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.4;
        }
        .bordes {
            border: 2px solid #000;
        }
        .w-100 {
            width: 100%;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .text-left {
            text-align: left;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 3px;
            vertical-align: top;
        }
        hr {
            border: 0.5px solid #000;
            margin: 5px 0;
        }
        .img-firma {
            width: 70px;
            height: 40px;
            object-fit: contain;
        }
        .img-icono {
            width: 15px;
            padding: 10px;
        }
        .titulo-manifiesto {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .bolder {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="text-center titulo-manifiesto">
        MANIFIESTO DE ENTREGA, TRANSPORTE Y RECEPCIÓN DE<br>RESIDUOS DE MANEJO ESPECIAL
    </div>

    <div class="text-right"><b>Folio: {{$recoleccion->folio}}</b></div>
    <br>

    <table class="bordes w-100">
        <!-- Sección Generador -->
        <tr>
            <td class="bordes" style="width: 30px;"><center><img class="img-icono" src="{{public_path('images/formatos/manifiesto/generador.png')}}" alt="Generador"></center></td>
            <td class="bordes">
                NÚM. DE REGISTRO (Resolutivo de Impacto Ambiental, Plan de Manejo): <span class="bolder">{{$recoleccion->nautorizacion ?? 'N/A'}}</span>
                <br><br>
                RAZÓN SOCIAL DE LA PERSONA: <span class="bolder">{{$recoleccion->razonsocial ?? 'N/A'}}</span>
                <br><br>
                
                <table>
                    <tr>
                        <td style="width: 15%;">DOMICILIO:</td>
                        <td style="width: 35%;" class="bolder">{{$recoleccion->calle ?? ''}} {{$recoleccion->numeroext ?? ''}} {{$recoleccion->numeroint ? 'Int. '.$recoleccion->numeroint : ''}}</td>
                        <td style="width: 15%;">COLONIA:</td>
                        <td style="width: 35%;" class="bolder">{{$recoleccion->colonia ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td>C.P:</td>
                        <td class="bolder">{{$recoleccion->cp ?? 'N/A'}}</td>
                        <td>ENTIDAD:</td>
                        <td class="bolder">{{$recoleccion->entidad ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td>TELÉFONO:</td>
                        <td class="bolder">{{$recoleccion->telefono ?? 'N/A'}}</td>
                        <td>MUNICIPIO:</td>
                        <td class="bolder">{{$recoleccion->municipio ?? 'N/A'}}</td>
                    </tr>
                </table>
                
                <hr>
                
                <div class="text-center"><b>DESCRIPCIÓN RESIDUO</b></div>
                
                <table border="0">
                    <tr>
                        <td style="width: 30%;"><b>RESIDUO</b></td>
                        <td style="width: 20%;"><b>CANTIDAD</b></td> 
                    </tr>
                    @foreach($detallesRecoleccion as $detalle)
                    <tr>
                        <td class="bolder">{{$detalle->residuo ?? 'N/A'}}</td>
                        <td class="bolder">{{$detalle->cantidad ?? '0'}} {{$detalle->unidades ?? 'N/A'}}</td>
                    </tr>
                    @endforeach
                </table>

                
                <hr>

                <div class="text-center"><b>DECLARACIÓN DEL GENERADOR:</b></div>
                <div style="text-align: justify;">
                    DECLARO QUE EL CONTENIDO DE ESTE LOTE ESTA TOTAL Y CORRECTAMENTE DESCRITO MEDIANTE EL NOMBRE DEL RESIDUO, 
                    BIEN EMPACADO, MARCADO Y ROTULADO, Y QUE SE HAN PREVISTO LAS CONDICIONES DE SEGURIDAD PARA SU TRANSPORTE 
                    POR VIA TERRESTRE DE ACUERDO A LA LEGISLACIÓN VIGENTE.
                </div>
                <br><br>

                <table>
                    <tr>
                        <td style="width: 40%;">NOMBRE Y FIRMA DEL RESPONSABLE:</td>
                        <td style="width: 30%;" class="bolder">{{$recoleccion->nombres ?? ''}} {{$recoleccion->apellidos ?? ''}}</td>
                        <td style="width: 30%;">
                            @if($recoleccion->firmacliente)
                                <img class="img-firma" src="{{$recoleccion->firmacliente}}" alt="Firma Cliente">
                            @else
                                [SIN FIRMA]
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Sección Transportista -->
        <tr>
            <td class="bordes"><center><img class="img-icono" src="{{public_path('images/formatos/manifiesto/transporte.png')}}" alt="Transporte"></center></td>
            <td class="bordes">
                <table>
                    <tr>
                        <td style="width: 60%;">NOMBRE DE LA EMPRESA TRANSPORTISTA:</td>
                        <td style="width: 40%;" class="bolder">{{$recoleccion->transportista ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td>DOMICILIO FISCAL:</td>
                        <td class="bolder">{{$recoleccion->domiciliot ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td>TELÉFONO:</td>
                        <td class="bolder">{{$recoleccion->telefonot ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td>AUTORIZACIÓN RAMIR:</td>
                        <td class="bolder">{{$recoleccion->autorizacion_ramir ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td>NO. DE REGISTRO S.C.T.:</td>
                        <td class="bolder">{{$recoleccion->regsct ?? 'N/A'}}</td>
                    </tr>
                </table>
                
                <hr>
                
                <div class="text-center">RECIBÍ LOS RESIDUOS DESCRITOS EN EL MANIFIESTO PARA SU TRANSPORTE.</div>
                <br>
                
                <table>
                    <tr>
                        <td style="width: 15%;">NOMBRE:</td>
                        <td style="width: 35%;" class="bolder">{{$recoleccion->nombres.' '.$recoleccion->apellidos ?? 'N/A'}}</td>
                        <td style="width: 15%;">FIRMA:</td>
                        <td style="width: 35%;">
                            @if($recoleccion->firmat)
                                <img class="img-firma" src="{{$recoleccion->firmat}}" alt="Firma Transportista">
                            @else
                                [SIN FIRMA]
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>CARGO:</td>
                        <td class="bolder">Recolector</td>
                        <td>FECHA DE EMBARQUE:</td>
                        <td class="bolder">{{FechaFormateada($recoleccion->created_at)}}</td>
                    </tr>
                </table>
                
                <hr>
                
                <div>10.- Ruta de la empresa generadora hasta su entrega:</div>
                <div class="bolder">{{$configuracion->ruta ?? 'N/A'}}</div>
                <br>
                
                <hr>
                
                <table>
                    <tr>
                        <td style="width: 30%;">TIPO DE VEHÍCULO:</td>
                        <td style="width: 20%;" class="bolder">{{$recoleccion->vehiculo ?? 'N/A'}}</td>
                        <td style="width: 30%;">No. DE MATRÍCULA:</td>
                        <td style="width: 20%;" class="bolder">{{$recoleccion->matriculat ?? 'N/A'}}</td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Sección Destino -->
        <tr>
            <td class="bordes"><center><img class="img-icono" src="{{public_path('images/formatos/manifiesto/destino.png')}}" alt="Destino"></center></td>
            <td class="bordes">
                <table>
                    <tr>
                        <td style="width: 60%;">NOMBRE DE LA EMPRESA DESTINATARIA:</td>
                        <td style="width: 40%;" class="bolder">{{$configuracion->razonsocial ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td>AUTORIZACIÓN RAMIR:</td>
                        <td class="bolder">{{$planta->autorizacion_ramir ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td>DOMICILIO FISCAL:</td>
                        <td class="bolder">{{$planta->domicilio ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td>TELÉFONO:</td>
                        <td class="bolder">{{$configuracion->telefono ?? 'N/A'}}</td>
                    </tr>
                </table>

                <hr>

                <div class="text-center">RECIBÍ LOS RESIDUOS DESCRITOS EN EL MANIFIESTO.</div>
                <br>
                
                <table>
                    <tr>
                        <td style="width: 15%;">NOMBRE:</td>
                        <td style="width: 35%;" class="bolder"></td>
                        <td style="width: 15%;">FIRMA:</td>
                        <td style="width: 35%;">
                           
                        </td>
                    </tr>
                    <tr>
                        <td>CARGO:</td>
                        <td class="bolder">Recepcion</td>
                        <td>FECHA DE RECEPCIÓN:</td>
                        <td class="bolder">{{FechaFormateada($recoleccion->created_at)}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>