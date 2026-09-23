<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Constancia de Gestión Responsable de RCD</title>
    <style>
    @page {
        margin: 0;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10.5px;
        line-height: 1.5;
        margin: 0;
        padding: 0;
        color: #2f2f2f;
        background: #ffffff;
    }

    .page {
        padding: 30px 55px 40px 55px;
    }

    /* ===== TABLA MAESTRA: una sola columna que separa todo ===== */
    .layout {
        width: 100%;
        border-collapse: collapse;
    }

    .layout > tbody > tr > td {
        padding: 0;
    }

    /* Separadores verticales entre bloques */
    .sep-sm  { height: 10px; line-height: 10px; font-size: 1px; }
    .sep-md  { height: 16px; line-height: 16px; font-size: 1px; }
    .sep-lg  { height: 22px; line-height: 22px; font-size: 1px; }

    /* Encabezado */
    .top-header {
        width: 100%;
        border-collapse: collapse;
    }

    .top-header td {
        vertical-align: top;
    }

    .logo-cell {
        width: 25%;
        text-align: left;
    }

    .folio-cell {
        width: 50%;
        text-align: center;
        padding-top: 3px;
    }

    .amr-cell {
        width: 25%;
        text-align: right;
    }

    .logo {
        width: 112px;
        height: auto;
    }

    .folio {
        font-size: 10px;
        font-weight: bold;
        color: #111111;
        line-height: 1.35;
    }

    .amr-logo {
        display: inline-block;
        text-align: center;
        line-height: 1;
        color: #222222;
        font-size: 24px;
        font-weight: normal;
    }

    .amr-logo .amr-small {
        font-size: 8px;
        letter-spacing: 1px;
        color: #006b2d;
        font-weight: bold;
    }

    .amr-mark {
        margin-top: 2px;
        margin-left: auto;
        width: 48px;
        height: 42px;
        border-radius: 4px 4px 12px 4px;
        background: #0b8f4a;
        position: relative;
    }

    .amr-mark:after {
        content: "";
        position: absolute;
        left: 8px;
        top: 21px;
        width: 31px;
        height: 11px;
        border-top: 2px solid #ffffff;
        border-radius: 50%;
        transform: rotate(-25deg);
    }

    /* Títulos */
    .title-block {
        text-align: center;
    }

    .title {
        font-size: 32px;
        line-height: 1.1;
        font-weight: bold;
        color: #38679f;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .subtitle {
        font-size: 16px;
        line-height: 1.2;
        font-weight: bold;
        color: #075d2b;
        margin: 6px 0 0 0;
    }

    /* Intro empresa */
    .company-intro {
        text-align: center;
        font-size: 10.5px;
        line-height: 1.5;
    }

    /* Negocio */
    .negocio-box {
        text-align: center;
        color: #00a94f;
        font-size: 13px;
        line-height: 1.4;
        font-weight: bold;
        padding: 0 5px;
    }

    .negocio-description {
        text-align: center;
        font-size: 10.5px;
        line-height: 1.55;
        padding: 0 15px;
    }

    /* Datos generales */
    .info-grid {
        width: 100%;
        border-collapse: collapse;
    }

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

    .info-grid .value {
        width: 84%;
        text-align: left;
    }

    /* Párrafo legal superior */
    .legal-top {
        text-align: center;
        font-size: 10px;
        line-height: 1.55;
        padding: 0 15px;
    }

    /* Panel de indicadores */
    .cards-wrapper {
        width: 78%;
        margin: 0 auto;
    }

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
        padding: 14px 15px;
        vertical-align: middle;
        text-align: left;
        background: transparent;
    }

    .metric {
        width: 100%;
        border-collapse: collapse;
    }

    .metric td {
        padding: 0;
        vertical-align: middle;
    }

    .metric-icon {
        width: 34px;
        text-align: center;
        padding-right: 6px !important;
        vertical-align: middle;
    }

    .metric-icon img {
        width: 22px;
        height: 22px;
        display: block;
        margin: 0 auto;
    }

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

    /* Texto legal */
    .legal-text {
        font-size: 10px;
        text-align: center;
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

    /* ===== FIRMA CENTRADA ===== */
    .signature-table {
        width: 100%;
        border-collapse: collapse;
    }

    .signature-table > tbody > tr > td {
        vertical-align: bottom;
        text-align: center;
    }

    /* La firma ahora ocupa el 100% y se centra */
    .firma-cell {
        width: 100%;
        text-align: center;
        padding-top: 6px;
    }

    /* La imagen de firma se centra */
    .firma-img {
        display: block;
        height: 54px;
        width: auto;
        margin: 0 auto 12px auto;
    }

    /* La línea se centra */
    .firma-linea {
        border-top: 1px solid #333;
        width: 245px;
        margin: 2px auto 12px auto;
    }

    /* Los datos de la firma se centran */
    .firma-datos {
        width: 100%;
        border-collapse: collapse;
    }

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

    /* Barra inferior */
    .bottom-bar {
        width: 100%;
        background: #075d0f;
        color: #ffffff;
        font-size: 9px;
        font-weight: bold;
        border-collapse: collapse;
    }

    .bottom-bar td {
        width: 33.33%;
        text-align: center;
        padding: 6px 0;
    }
</style>
</head>

<body>
    <div class="page">

        <!-- ========== TABLA MAESTRA ========== -->
        <table class="layout">

            <!-- ENCABEZADO -->
            <tr>
                <td>
                    <table class="top-header">
                        <tr>
                            <td class="logo-cell">
                                <img src="{{ public_path('images/generales/l1.png') }}" class="logo" alt="Recitrack">
                            </td>
                            <td class="folio-cell">
                                <div class="folio">
                                    FOLIO DE CONSTANCIA<br>
                                    {{ $folio ?? 'CONS-GRRCD/2026-008' }}
                                </div>
                            </td>
                            <td class="amr-cell">
                                <div class="amr-logo">
                                    AMR<br>
                                    <span class="amr-small">CD</span>
                                    <div class="amr-mark"></div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr><td class="sep-md"></td></tr>

            <!-- TÍTULOS -->
            <tr>
                <td class="title-block">
                    <div class="title">CONSTANCIA</div>
                    <div class="subtitle">DE GESTIÓN RESPONSABLE DE RCD</div>
                </td>
            </tr>

            <tr><td class="sep-md"></td></tr>

            <!-- INTRO EMPRESA -->
            <tr>
                <td class="company-intro">
                    <strong>RECITRACK GESTIÓN DE RESIDUOS S.A.P.I. DE C.V.</strong><br>
                    hace constar que el negocio:
                </td>
            </tr>

            <tr><td class="sep-md"></td></tr>

            <!-- NOMBRE DEL NEGOCIO -->
            <tr>
                <td class="negocio-box">
                    {{ $negocio->negocio }}
                </td>
            </tr>

            <tr><td class="sep-sm"></td></tr>

            <!-- DESCRIPCIÓN -->
            <tr>
                <td class="negocio-description">
                    Realizó la gestión de sus Residuos de la Construcción y Demolición (RCD) a través de RECITRACK,<br>
                    garantizando la trazabilidad desde el punto de generación hasta su destino final autorizado,<br>
                    cumpliendo con la LGEC y demás normatividad ambiental aplicable.
                </td>
            </tr>

            <tr><td class="sep-lg"></td></tr>

            <!-- DATOS GENERALES -->
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

            <!-- LEGAL SUPERIOR -->
            <tr>
                <td class="legal-top">
                    El presente documento acredita que el negocio mencionado gestionó sus Residuos de la Construcción y<br>
                    Demolición (RCD) dando cumplimiento a la Legislación y Normatividad en materia de Economía Circular,<br>
                    Medio Ambiente y Obras en la Ciudad de México.
                </td>
            </tr>

            <tr><td class="sep-lg"></td></tr>

            <!-- INDICADORES -->
            <tr>
                <td>
                    <div class="cards-wrapper">
                        <table class="cards">
                            <tr>
                                <td>
                                    <table class="metric">
                                        <tr>
                                            <td class="metric-icon">
                                                <img src="{{ public_path('images/iconos/negocio.fw.png') }}" alt="Giro">
                                            </td>
                                            <td>
                                                <div class="card-label">Giro del Negocio:</div>
                                                <div class="card-value">{{ $negocio->giro ?? 'Comercio' }}</div>
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
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>

            <tr><td class="sep-lg"></td></tr>

            <!-- LEGAL INFERIOR -->
            <tr>
                <td class="legal-text">
                    Se expide la presente constancia con respaldo de la <strong>Asociación Mexicana de Reciclaje de Residuos de la<br>
                    Construcción y Demolición S.A. de C.V.</strong> para los fines que al interesado convengan, sin que esto se considere<br>
                    como un Manifiesto Global o sustituya a los Manifiestos Individuales por viaje que marca la Norma Ambiental.
                </td>
            </tr>

            <tr><td class="sep-md"></td></tr>

            <!-- FECHA -->
            <tr>
                <td class="fecha-expedicion">
                    Ciudad de México, a {{ $fechaExpedicion }}
                </td>
            </tr>

            <tr><td class="sep-md"><br><br><br><br><br><br></td></tr>

            <!-- FIRMA CENTRADA -->
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

            <!-- BARRA INFERIOR -->
            <tr>
                <td>
                    <table class="bottom-bar">
                        <tr>
                            <td>TRAZABILIDAD</td>
                            <td>TRANSPARENCIA</td>
                            <td>SUSTENTABILIDAD</td>
                        </tr>
                    </table>
                </td>
            </tr>

        </table>
        <!-- ========== FIN TABLA MAESTRA ========== -->

    </div>
</body>
</html>