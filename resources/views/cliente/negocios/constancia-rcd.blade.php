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
        line-height: 1.35;
        margin: 0;
        padding: 0;
        color: #2f2f2f;
        background: #ffffff;
    }

    .page {
        padding: 28px 62px 42px 62px;
        position: relative;
    }

    /* Encabezado */
    .top-header {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 12px;
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
    .header-title {
        text-align: center;
        margin: 0 0 12px 0;
    }

    .title {
        font-size: 34px;
        line-height: 1;
        font-weight: bold;
        color: #38679f;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .subtitle {
        font-size: 17px;
        line-height: 1.1;
        font-weight: bold;
        color: #075d2b;
        margin: 7px 0 10px 0;
    }

    .company-intro {
        text-align: center;
        font-size: 10.5px;
        line-height: 1.35;
        margin-bottom: 18px;
    }

    /* Obra */
    .obra-box {
        text-align: center;
        color: #00a94f;
        font-size: 13px;
        line-height: 1.3;
        font-weight: bold;
        padding: 0 5px;
        margin: 0 0 16px 0;
    }

    .obra-description {
        text-align: center;
        font-size: 10.5px;
        line-height: 1.35;
        margin: 0 8px 17px 8px;
    }

    /* Datos generales */
    .info-grid {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 13px;
    }

    .info-grid td {
        padding: 3px 0;
        vertical-align: top;
        font-size: 10px;
        line-height: 1.3;
    }

    .info-grid .label {
        font-size: 10.5px;
        font-weight: bold;
        width: 16%;
        text-align: right;
        padding-right: 7px;
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
        line-height: 1.35;
        margin: 13px 8px 13px 8px;
    }

    /* Panel de indicadores */
    .cards {
        width: 78%;
        margin: 0 auto 18px auto;
        border-collapse: separate;
        border-spacing: 0;
        background: #d8e6d4;
        border: 3px solid #126524;
        border-radius: 23px;
    }

    .cards td {
        width: 50%;
        padding: 10px 13px;
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
    }

    .metric-icon svg {
        width: 22px;
        height: 22px;
    }

    .card-label {
        font-size: 9.5px;
        font-weight: bold;
        color: #222222;
        line-height: 1.2;
        margin-bottom: 3px;
    }

    .card-value {
        font-size: 10.5px;
        font-weight: normal;
        color: #111111;
        line-height: 1.25;
    }

    /* Texto legal */
    .legal-text {
        font-size: 10px;
        text-align: center;
        color: #3d3d3d;
        margin: 0 8px 15px 8px;
        line-height: 1.4;
    }

    .fecha-expedicion {
        text-align: center;
        font-size: 10.5px;
        margin: 10px 0 6px 0;
        font-weight: bold;
        color: #222222;
    }

    /* Firma y verificación */
    .signature-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 13px;
    }

    .signature-table td {
        vertical-align: bottom;
    }

    .firma-cell {
        width: 62%;
        text-align: left;
        padding-left: 25px;
    }

    .codigo-cell {
        width: 38%;
        text-align: center;
        vertical-align: bottom !important;
    }

    .firma-img {
        height: 54px;
        width: auto;
        margin-left: 45px;
    }

    .firma-linea {
        border-top: 1px solid #333;
        width: 245px;
        margin: 1px 0 5px 20px;
    }

    .firma-nombre {
        font-size: 10.5px;
        font-weight: bold;
        margin: 0 0 2px 0;
    }

    .firma-cargo {
        font-size: 9.5px;
        color: #333333;
        margin: 1px 0;
    }

    .codigo-verificacion {
        font-size: 9.5px;
        color: #222222;
        font-weight: normal;
        text-align: center;
        margin-top: 0;
    }

    /* Barra inferior */
    .bottom-bar {
        width: 100%;
        margin-top: 13px;
        background: #075d0f;
        color: #ffffff;
        font-size: 9px;
        font-weight: bold;
        border-collapse: collapse;
    }

    .bottom-bar td {
        width: 33.33%;
        text-align: center;
        padding: 3px 0;
    }
</style>
</head>
<body>
    <div class="page">

        <!-- Encabezado -->
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

        <div class="header-title">
            <div class="title">CONSTANCIA</div>
            <div class="subtitle">DE GESTIÓN RESPONSABLE DE RCD</div>
        </div>

        <div class="company-intro">
            <strong>RECITRACK GESTIÓN DE RESIDUOS S.A.P.I. DE C.V.</strong><br>
            hace constar que la obra:
        </div>

        <!-- Obra -->
        <div class="obra-box">
            {{ $negocio->negocio }}
        </div>

        <div class="obra-description">
            Realizó la gestión de sus Residuos de la Construcción y Demolición (RCD) a través de RECITRACK,<br>
            garantizando la trazabilidad desde el punto de generación hasta su destino final autorizado,<br>
            cumpliendo con la LGEC y demás normatividad ambiental aplicable.
        </div>

        <!-- Ubicación, generador y RFC -->
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

        <div class="legal-top">
            El presente documento acredita que la obra mencionada gestionó sus Residuos de la Construcción y<br>
            Demolición (RCD dando cumplimiento a la Legislación y Normatividad en materia de Economía Circular,<br>
            Medio Ambiente y Obras en la Ciudad de México.
        </div>

        <!-- Indicadores -->
        <table class="cards">
            <tr>
                <td>
                    <table class="metric">
                        <tr>
                            <td class="metric-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#00a94f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 21h18"/>
                                    <path d="M5 21V7l7-4 7 4v14"/>
                                    <path d="M9 9h.01"/>
                                    <path d="M9 12h.01"/>
                                    <path d="M9 15h.01"/>
                                    <path d="M9 18h.01"/>
                                    <path d="M15 9h.01"/>
                                    <path d="M15 12h.01"/>
                                    <path d="M15 15h.01"/>
                                    <path d="M15 18h.01"/>
                                </svg>
                            </td>
                            <td>
                                <div class="card-label">Tipo de Obra:</div>
                                <div class="card-value">{{ $negocio->giro ?? 'Construcción' }}</div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="metric">
                        <tr>
                            <td class="metric-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#00a94f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="7" width="20" height="10" rx="1"/>
                                    <path d="M6 7v3"/>
                                    <path d="M10 7v3"/>
                                    <path d="M14 7v3"/>
                                    <path d="M18 7v3"/>
                                </svg>
                            </td>
                            <td>
                                <div class="card-label">Área de Intervención:</div>
                                <div class="card-value">{{ $negocio->cantidad ?? 'N/A' }} {{ $negocio->unidades ?? 'm²' }}</div>
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
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#00a94f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                            </td>
                            <td>
                                <div class="card-label">Periodo de Ejecución:</div>
                                <div class="card-value">{{ $periodoInicio }} al {{ $periodoFin }}</div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="metric">
                        <tr>
                            <td class="metric-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#00a94f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="1" y="6" width="13" height="10" rx="1"/>
                                    <path d="M14 9h4l3 3v4h-7V9z"/>
                                    <circle cx="6" cy="18" r="2"/>
                                    <circle cx="17" cy="18" r="2"/>
                                </svg>
                            </td>
                            <td>
                                <div class="card-label">Volumen Total Gestionado:</div>
                                <div class="card-value">{{ number_format($volumenTotal, 2) }} m³</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Texto legal -->
        <div class="legal-text">
            Se expide la presente constancia con respaldo de la <strong>Asociación Mexicana de Reciclaje de Residuos de la<br>
            Construcción y Demolición S.A. de C.V.</strong> para los fines que al interesado convengan, sin que esto se considere<br>
            como un Manifiesto Global o sustituya a los Manifiestos Individuales por viaje que marca la Norma Ambiental.
        </div>

        <div class="fecha-expedicion">
            Ciudad de México, a {{ $fechaExpedicion }}
        </div>

        <!-- Firma / código -->
        <table class="signature-table">
            <tr>
                <td class="firma-cell">
                    <img src="{{ public_path('images/generales/firma.png') }}" class="firma-img" alt="Firma">
                    <div class="firma-linea"></div>
                    <div class="firma-nombre">LIC. EMILIANO ROJAS PACHECO</div>
                    <div class="firma-cargo">Dirección General</div>
                    <div class="firma-cargo">Recitrack Gestión de Residuos</div>
                </td>
                <td class="codigo-cell">
                    <div class="codigo-verificacion">
                        CÓDIGO DE VERIFICACIÓN
                    </div>
                    <div class="codigo-verificacion">
                        {{ strtoupper(substr(md5($negocio->id . $fechaExpedicion), 0, 16)) }}
                    </div>
                </td>
            </tr>
        </table>

        <!-- Barra inferior -->
        <table class="bottom-bar">
            <tr>
                <td>TRAZABILIDAD</td>
                <td>TRANSPARENCIA</td>
                <td>SUSTENTABILIDAD</td>
            </tr>
        </table>

    </div>
</body>
</html>