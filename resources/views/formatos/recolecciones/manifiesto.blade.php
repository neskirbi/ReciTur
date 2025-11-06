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
            font-size: 8px;
            line-height: 1.3;
            margin: 0;
            padding: 0;
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
            padding: 2px;
            vertical-align: middle;
        }
        hr {
            border: 0.5px solid #000;
            margin: 3px 0;
        }
        .img-firma {
            width: 60px;
            height: 30px;
            object-fit: contain;
        }
        .img-icono {
            width: 12px;
            padding: 5px;
        }
        .titulo-manifiesto {
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .bolder {
            font-weight: bold;
        }
        .icon-cell {
            vertical-align: middle;
            text-align: center;
            width: 30px;
        }
        
        /* Estilos para la tabla header */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }
        .header-image-cell {
            width: 70%;
            vertical-align: top;
        }
        .qr-cell {
            width: 30%;
            vertical-align: top;
            text-align: right;
        }
        .qr-image {
            max-width: 80px;
            height: auto;
        }
    </style>
</head>
<body>

    <!-- Tabla para header y QR -->
    <table class="header-table">
        <tr>
            <td class="header-image-cell">
                <!-- Imagen del encabezado a la izquierda -->
                <img src="{{ isset($vista) ? asset('images/formatos/manifiesto/headermanifiesto.png') : public_path('images/formatos/manifiesto/headermanifiesto.png') }}" alt="" width="100%">
            </td>
            <td class="qr-cell">
                <!-- QR a la derecha -->
                @if(isset($qr))
                <img class="qr-image" src="{{ isset($vista) ? asset($qr) : public_path($qr) }}" alt="Código QR">
                @endif
            </td>
        </tr>
    </table>

    <div class="titulo-manifiesto">
        MANIFIESTO DE ENTREGA, TRANSPORTE Y RECEPCIÓN DE RESIDUOS SÓLIDOS URBANOS	
        <br>
        Los Generadores de residuos sólidos urbanos deberán de presentar el manifiestos de entrega transporte recpeción de acuerdo al instructivo							
    <div class="text-right"><b>Folio: {{$recoleccion->folio}}</b></div>
    <br>

    <table class="bordes w-100">
        <!-- Sección Generador -->
        <tr>
            <td class="bordes icon-cell"><img class="img-icono" src="{{ isset($vista) ? asset('images/formatos/manifiesto/generador.png') : public_path('images/formatos/manifiesto/generador.png') }}" alt="Generador"></td>
            <td class="bordes">
                NÚM. DE REGISTRO (Resolutivo de Impacto Ambiental, Plan de Manejo): <span class="bolder">{{$recoleccion->nautorizacion ?? 'N/A'}}</span>
                <br>
                
                <table>
                    <tr>
                        <td>
                            RAZÓN SOCIAL DE LA PERSONA: <span class="bolder">{{$recoleccion->razonsocial ?? 'N/A'}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 15%;">DOMICILIO: {{$recoleccion->calle ?? ''}} {{$recoleccion->numeroext ?? ''}} {{$recoleccion->numeroint ? 'Int. '.$recoleccion->numeroint : ''}}</td>
                    </tr>
                    <tr>
                        <td style="width: 15%;">COLONIA: {{$recoleccion->colonia ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td>MUNICIPIO: {{$recoleccion->municipio ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td>ENTIDAD: {{$recoleccion->entidad ?? 'N/A'}}</td>
                    </tr>
                </table>
                
                <hr>
                
                <div class="text-center"><b>DATOS DEL COMERCIO</b></div>

                <table>
                    <tr>
                        <td>
                            RAZÓN SOCIAL DE LA PERSONA: <span class="bolder">{{$recoleccion->razonsocial ?? 'N/A'}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 15%;">DOMICILIO: {{$recoleccion->calle ?? ''}} {{$recoleccion->numeroext ?? ''}} {{$recoleccion->numeroint ? 'Int. '.$recoleccion->numeroint : ''}}</td>
                    </tr>
                    <tr>
                        <td style="width: 15%;">COLONIA: {{$recoleccion->colonia ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td>MUNICIPIO: {{$recoleccion->municipio ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td>ENTIDAD: {{$recoleccion->entidad ?? 'N/A'}}</td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Sección Transportista -->
        <tr>
            <td class="bordes icon-cell"><img class="img-icono" src="{{ isset($vista) ? asset('images/formatos/manifiesto/transporte.png') : public_path('images/formatos/manifiesto/transporte.png') }}" alt="Transporte"></td>
            <td class="bordes">
                <table border="0">
                    <tr>
                        <td style="width: 30%;"><b>RESIDUO</b></td>
                        <td style="width: 20%;"><b>CANTIDAD</b></td> 
                    </tr>
                    @foreach($detallesRecoleccion as $detalle)
                    <tr>
                        <td class="bolder">{{$detalle->residuo ?? 'N/A'}}</td>
                        <td class="bolder">{{$detalle->cantidad ?? '0'}} {{$detalle->contenedor ?? 'N/A'}}</td>
                    </tr>
                    @endforeach
                </table>
                
                <hr>
                
                <div class="text-center">DECLARACIÓN DEL GENERADOR</div>
                <br>
                <div class="text-center"> 
                    DECLARO QUE EL CONTENIDO DE ESTE LOTE ESTA TOTAL Y CORRECTAMENTE DESCRITO MEDIANTE EL NOMBRE DEL RESIDUO, BIEN EMPACADO, MARCADO Y ROTULADO, Y QUE SE HAN PREVISTO LAS CONDICIONES DE SEGURIDAD PARA SU TRANSPORTE POR VÍA TERRESTRE DE ACUERDO A LA LEGISLACIÓN APLICABLE Y VIGENTE			
                </div>
                
                <table>
                    <tr>
                        <td style="width: 15%;">NOMBRE:</td>
                        <td style="width: 35%;" class="bolder">{{$recoleccion->nombres.' '.$recoleccion->apellidos ?? 'N/A'}}</td>
                        <td style="width: 15%;">FIRMA:</td>
                        <td style="width: 35%;">
                            @if($recoleccion->firmat)
                                <img class="img-firma" src="{{ isset($vista) ? asset($recoleccion->firmat) : public_path($recoleccion->firmat) }}" alt="Firma Transportista">
                            @else
                                [SIN FIRMA]
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Sección Destino -->
        <tr>
            <td class="bordes icon-cell"><img class="img-icono" src="{{ isset($vista) ? asset('images/formatos/manifiesto/destino.png') : public_path('images/formatos/manifiesto/destino.png') }}" alt="Destino"></td>
            <td class="bordes">
                <table>
                    <tr>
                        <td style="width: 60%;">NOMBRE DE LA EMPRESA DESTINATARIA:</td>
                        <td style="width: 40%;" class="bolder">{{$centro->nombreEmpresa }}</td>
                    </tr>
                    <tr>
                        <td>AUTORIZACIÓN RAMIR:</td>
                        <td class="bolder">{{$centro->autorizacionRamir }}</td>
                    </tr>
                    <tr>
                        <td>DOMICILIO FISCAL:</td>
                        <td class="bolder">{{$centro->domicilioFiscal  }}</td>
                    </tr>
                    <tr>
                        <td>TELÉFONO:</td>
                        <td class="bolder">{{$centro->telefono }}</td>
                    </tr>
                </table>

                <hr>

                <div class="text-center">RECIBÍ LOS RESIDUOS DESCRITOS EN EL MANIFIESTO.</div>
                <br>
                
                <table>
                    <tr>
                        <td style="width: 15%;">NOMBRE:</td>
                        <td style="width: 35%;" class="bolder">{{$centro->nombreReceptor ?? 'N/A'}}</td>
                        <td style="width: 15%;">FIRMA:</td>
                        <td style="width: 35%;"></td>
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