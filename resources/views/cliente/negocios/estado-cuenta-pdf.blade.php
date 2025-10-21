<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Estado de Cuenta - {{ $negocio }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }
        
        .page {
            padding: 20px;
            position: relative;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            padding-top: 80px; /* Espacio para los logos */
        }
        
        .logo-left {
            position: absolute;
            top: 20px;
            left: 20px;
            height: 60px;
            width: auto;
        }
        
        .logo-right {
            position: absolute;
            top: 20px;
            right: 200px;
            height: 60px;
            width: auto;
        }
        
        .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .subtitle {
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .info-section {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        
        .info-label {
            font-weight: bold;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 20px;
        }
        
        th {
            background-color: #343a40;
            color: white;
            border: 1px solid #454d55;
            padding: 8px;
            text-align: left;
            font-weight: bold;
        }
        
        td {
            border: 1px solid #dee2e6;
            padding: 8px;
        }
        
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .total-row {
            background-color: #ffff00 !important;
            font-weight: bold;
        }
        
        .currency {
            text-align: right;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        
        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- Logos en posiciones absolutas -->
        <img src="{{ public_path('images/generales/l1.png') }}" class="logo-left" alt="Logo Izquierdo">
        <img src="{{ public_path('images/generales/l2.png') }}" class="logo-right" alt="Logo Derecho">

        <!-- Header -->
        <div class="header">
            <div class="title">ESTADO DE CUENTA MENSUAL</div>
            <div class="subtitle">MES: {{ strtoupper($mes) }} {{ $anio }}</div>
        </div>

        <!-- Información del generador y negocio -->
        <div class="info-section">
            <div><span class="info-label">GENERADOR:</span> {{ $generador ?: 'HILTON' }}</div>
            <div><span class="info-label">ESTABLECIMIENTO:</span> {{ $negocio }}</div>
            <div><span class="info-label">FECHA DE GENERACIÓN:</span> {{ date('d/m/Y H:i:s') }}</div>
        </div>

        <!-- Tabla de recolecciones -->
        <div>
            <div style="font-weight: bold; margin-bottom: 10px; font-size: 14px;">DETALLE DE RECOLECCIONES</div>
            
            @if(count($data) > 0)
            <table>
                <thead>
                    <tr>
                        <th width="15%">Fecha</th>
                        <th width="25%">Residuos</th>
                        <th width="15%">Contenedor</th>
                        <th width="15%">Cantidad</th>
                        <th width="15%">Precio Unitario</th>
                        <th width="15%">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{ $item['fecha'] }}</td>
                        <td>{{ $item['residuos'] }}</td>
                        <td>{{ $item['contenedor'] }}</td>
                        <td>{{ $item['cantidad_con_unidades'] }}</td>
                        <td class="currency">${{ number_format($item['precio'], 2) }}</td>
                        <td class="currency">${{ number_format($item['subtotal'], 2) }}</td>
                    </tr>
                    @endforeach
                    
                    <!-- Total general -->
                    <tr class="total-row">
                        <td colspan="5" style="text-align: right; font-weight: bold;">TOTAL GENERAL:</td>
                        <td class="currency" style="font-weight: bold;">${{ number_format($totalGeneral, 2) }}</td>
                    </tr>
                </tbody>
            </table>
            @else
            <div class="no-data">
                No hay recolecciones para el período seleccionado
            </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="footer">
            Documento generado automáticamente por el sistema | Página 1 de 1
        </div>
    </div>
</body>
</html>