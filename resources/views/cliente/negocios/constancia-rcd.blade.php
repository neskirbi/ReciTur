<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Constancia Anual de Gestión y Trazabilidad de RSU</title>
    <style>
    @page { margin: 0; }
    html, body { margin: 0; padding: 0; width: 100%; }

    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10.5px;
        line-height: 1.5;
        color: #2f2f2f;
        background: #ffffff;
    }

    .page { padding: 30px 55px 0 55px; }

    .layout { width: 100%; border-collapse: collapse; }
    .layout > tbody > tr > td { padding: 0; }

    .sep-sm { height: 10px; line-height: 10px; font-size: 1px; }
    .sep-md { height: 16px; line-height: 16px; font-size: 1px; }
    .sep-lg { height: 22px; line-height: 22px; font-size: 1px; }

    /* Encabezado */
    .top-header { width: 100%; border-collapse: collapse; }
    .top-header td { vertical-align: top; }
    .logo-cell { width: 25%; text-align: left; }
    .folio-cell { width: 50%; text-align: center; padding-top: 3px; }
    .amr-cell { width: 25%; text-align: right; }
    .logo { width: 112px; height: auto; }

    /* Títulos */
    .title-block { text-align: center; }
    .title {
        font-size: 22px;
        line-height: 1.15;
        font-weight: bold;
        color: #38679f;
        letter-spacing: 0.3px;
        margin: 0;
    }
    .subtitle {
        font-size: 13px;
        line-height: 1.25;
        font-weight: bold;
        color: #075d2b;
        margin: 6px 0 0 0;
    }
    .folio {
        font-size: 11px;
        font-weight: bold;
        color: #222;
        margin-top: 6px;
        text-align: right;
    }

    .company-intro {
        text-align: center;
        font-size: 10.5px;
        line-height: 1.5;
    }

    .negocio-box {
        text-align: center;
        color: #00a94f;
        font-size: 13px;
        line-height: 1.4;
        font-weight: bold;
        padding: 0 5px;
    }

    .negocio-description {
        text-align: justify;
        font-size: 10.5px;
        line-height: 1.55;
        padding: 0 15px;
    }

    /* Datos generales */
    .info-grid { width: 100%; border-collapse: collapse; }
    .info-grid td {
        padding: 4px 0;
        vertical-align: top;
        font-size: 10px;
        line-height: 1.4;
    }
    .info-grid .label {
        font-size: 10.5px;
        font-weight: bold;
        width: 16%;
        text-align: right;
        padding-right: 8px;
        color: #333333;
    }
    .info-grid .value { width: 84%; text-align: left; }

    /* Panel de indicadores (recuadro verde) */
    .cards-wrapper { width: 88%; margin: 0 auto; }

    .cards {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: #d8e6d4;
        border: 3px solid #126524;
        border-radius: 23px;
    }
    .cards td {
        width: 50%;
        padding: 12px 15px;
        vertical-align: middle;
        text-align: left;
        background: transparent;
    }

    .metric { width: 100%; border-collapse: collapse; }
    .metric td { padding: 0; vertical-align: middle; }

    .metric-icon {
        width: 34px;
        text-align: center;
        padding-right: 6px !important;
        vertical-align: middle;
    }
    .metric-icon img { width: 22px; height: 22px; display: block; margin: 0 auto; }

    .card-label {
        font-size: 9.5px;
        font-weight: bold;
        color: #222222;
        line-height: 1.3;
        margin-bottom: 4px;
    }
    .card-value {
        font-size: 10.5px;
        font-weight: normal;
        color: #111111;
        line-height: 1.4;
    }

    /* Desglose por tipo de residuos (dentro del recuadro verde) */
    .desglose-title {
        text-align: center;
        font-weight: bold;
        font-size: 10px;
        color: #111;
        padding-top: 6px;
        padding-bottom: 4px;
        border-top: 1px dashed #126524;
    }
    .desglose-item {
        text-align: center;
        font-size: 9.5px;
        line-height: 1.35;
        color: #111;
        padding: 2px 0;
    }
    .desglose-item .nombre { font-weight: bold; }
    .desglose-item .volumen { color: #333; }

    .legal-text {
        font-size: 10px;
        text-align: justify;
        color: #3d3d3d;
        line-height: 1.55;
        padding: 0 15px;
    }

    .fecha-expedicion {
        text-align: center;
        font-size: 10.5px;
        font-weight: bold;
        color: #222222;
    }

    /* Firma */
    .signature-table { width: 100%; border-collapse: collapse; }
    .signature-table > tbody > tr > td {
        vertical-align: bottom;
        text-align: center;
    }
    .firma-cell { width: 100%; text-align: center; padding-top: 6px; }
    .firma-linea {
        border-top: 1px solid #333;
        width: 245px;
        margin: 2px auto 12px auto;
    }
    .firma-datos { width: 100%; border-collapse: collapse; }
    .firma-datos td {
        padding: 0;
        line-height: 1.45;
        text-align: center;
    }
    .firma-datos .firma-nombre {
        font-size: 10.5px;
        font-weight: bold;
        color: #222222;
        padding-top: 8px !important;
        padding-bottom: 4px !important;
        text-align: center;
    }
    .firma-datos .firma-cargo {
        font-size: 9.5px;
        color: #333333;
        padding: 1px 0 !important;
        text-align: center;
    }

    /* Imagen inferior full width */
    .bottom-image-full {
        width: 100%;
        margin: 0; padding: 0;
        display: block;
        line-height: 0; font-size: 0;
    }
    .bottom-image-full img {
        width: 100%; height: auto;
        display: block; margin: 0; padding: 0; border: 0;
    }
</style>
</head>

<body>
<div class="page">

    <table class="layout">

        <!-- ENCABEZADO -->
        <tr>
            <td>
                <table class="top-header">
                    <tr>
                        <td class="logo-cell">
                            <img src="{{ public_path('images/GOBM.png') }}" class="logo" alt="Gobierno">
                        </td>
                        <td class="folio-cell">
                            <img src="{{ public_path('images/acapulco.png') }}" class="logo" alt="Acapulco">
                        </td>
                        <td class="amr-cell">
                            <img src="{{ public_path('images/reciturlogo1.png') }}" class="logo" alt="Recitur">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr><td class="sep-md"></td></tr>

        <!-- TÍTULO -->
        <tr>
            <td class="title-block">
                <div class="title">CONSTANCIA ANUAL DE GESTIÓN Y TRAZABILIDAD</div>
                <div class="subtitle">DE RESIDUOS SÓLIDOS URBANOS</div>
                <div class="folio">FOLIO: {{ $folio ?? '_______________' }}</div>
            </td>
        </tr>

        <tr><td class="sep-md"></td></tr>

        <tr>
            <td class="company-intro">
                <strong>RECITRACK GESTIÓN DE RESIDUOS S.A.P.I. DE C.V.</strong><br>
                En el marco del programa de trazabilidad de Residuos Sólidos Urbanos implementado mediante la plataforma RECITUR, se hace constar que el negocio:
            </td>
        </tr>

        <tr><td class="sep-md"></td></tr>

        <tr>
            <td class="negocio-box">{{ $negocio->negocio }}</td>
        </tr>

        <tr><td class="sep-sm"></td></tr>

        <tr>
            <td class="negocio-description">
                Gestionó sus Residuos Sólidos Urbanos dando cumplimiento a la Legislación y Normatividad en materia de Economía Circular y Medio Ambiente en la República Mexicana y el Estado de Guerrero, de tal suerte que registró las operaciones de entrega asociadas al establecimiento, generándose los correspondientes Manifiestos de Entrega – Transporte - Recepción, cuyos datos consolidados son los siguientes:
            </td>
        </tr>

        <tr><td class="sep-lg"></td></tr>

        <!-- RECUADRO VERDE DE INDICADORES + DESGLOSE -->
        <tr>
            <td>
                <div class="cards-wrapper">
                    <table class="cards">

                        <!-- Fila 1: Giro | Período -->
                        <tr>
                            <td>
                                <table class="metric">
                                    <tr>
                                        <td class="metric-icon">
                                            <img src="{{ public_path('images/iconos/negocio.fw.png') }}" alt="Giro">
                                        </td>
                                        <td>
                                            <div class="card-label">Giro del Negocio:</div>
                                            <div class="card-value">{{ $negocio->giro ?? 'HOTEL' }}</div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="metric">
                                    <tr>
                                        <td class="metric-icon">
                                            <img src="{{ public_path('images/iconos/periodo.fw.png') }}" alt="Periodo">
                                        </td>
                                        <td>
                                            <div class="card-label">Periodo de Ejecución:</div>
                                            <div class="card-value">{{ $periodoInicio }} al {{ $periodoFin }}</div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- Fila 2: Volumen Total | Número de Manifiestos -->
                        <tr>
                            <td>
                                <table class="metric">
                                    <tr>
                                        <td class="metric-icon">
                                            <img src="{{ public_path('images/iconos/reciclado.fw.png') }}" alt="Volumen">
                                        </td>
                                        <td>
                                            <div class="card-label">Volumen Total Gestionado:</div>
                                            <div class="card-value">{{ number_format($volumenTotal, 2) }} m³</div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="metric">
                                    <tr>
                                        <td class="metric-icon">
                                            
                                        </td>
                                        <td>
                                            <div class="card-label">Número de Manifiestos:</div>
                                            <div class="card-value">{{ $numeroManifiestos ?? 0 }}</div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- DESGLOSE POR TIPO DE RESIDUOS -->
                        <tr>
                            <td colspan="2">
                                <div class="desglose-title">Desglose por tipo de Residuos</div>

                                @forelse($desgloseResiduos as $item)
                                    <div class="desglose-item">
                                        <span class="nombre">{{ $item['nombre'] }}</span><br>
                                        <span class="volumen">{{ number_format($item['volumen'], 2) }} m³</span>
                                    </div>
                                @empty
                                    <div class="desglose-item">
                                        <span class="nombre">[NOMBRE DEL RESIDUO]</span><br>
                                        <span class="volumen">Volumen</span>
                                    </div>
                                @endforelse
                            </td>
                        </tr>

                    </table>
                </div>
            </td>
        </tr>

        <tr><td class="sep-lg"></td></tr>

        <!-- UBICACIÓN / GENERADOR / RFC -->
        <tr>
            <td>
                <table class="info-grid">
                    <tr>
                        <td class="label">Ubicación:</td>
                        <td class="value">
                            {{ $negocio->calle }} {{ $negocio->numeroext }}@if($negocio->numeroint), NÚMERO INT. {{ $negocio->numeroint }}@endif,
                            COL. {{ $negocio->colonia }}, {{ $negocio->municipio }}, C.P. {{ $negocio->cp }}, {{ $negocio->entidad }}
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Generador:</td>
                        <td class="value">{{ $generador->razonsocial ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="label">R.F.C.:</td>
                        <td class="value">{{ $generador->rfc ?? 'N/A' }}</td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr><td class="sep-lg"></td></tr>

        <!-- TEXTO LEGAL -->
        <tr>
            <td class="legal-text">
                Este documento se expide para su presentación ante <strong>FONATUR Infraestructura</strong> y, en su caso, ante las autoridades administrativas que determinen su procedencia como documentación soporte para los trámites correspondientes al establecimiento. La presente constancia no sustituye los Manifiestos de Entrega – Transporte - Recepción individuales.
            </td>
        </tr>

        <tr><td class="sep-md"></td></tr>

        <tr>
            <td class="fecha-expedicion">
                Acapulco de Juárez, Guerrero, a {{ $fechaExpedicion }}
            </td>
        </tr>

        <tr><td class="sep-md"><br><br><br><br></td></tr>

        <!-- FIRMA -->
        <tr>
            <td>
                <table class="signature-table">
                    <tr>
                        <td class="firma-cell">
                            <div class="firma-linea"></div>
                            <table class="firma-datos">
                                <tr>
                                    <td class="firma-nombre">LIC. EMILIANO ROJAS PACHECO</td>
                                </tr>
                                <tr>
                                    <td class="firma-cargo">Dirección General</td>
                                </tr>
                                <tr>
                                    <td class="firma-cargo">Recitrack Gestión de Residuos</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr><td class="sep-lg"></td></tr>

    </table>
</div>

<!-- IMAGEN INFERIOR FULL WIDTH -->
<div class="bottom-image-full">
    <img src="{{ public_path('images/GOBMF.png') }}" alt="Gobierno de México">
</div>

</body>
</html>