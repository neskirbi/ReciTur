<!DOCTYPE html>
<html lang="es">
<head>
    @include('recolectores.header')
    <title>Recitur | Cédula</title>
    <style>
        @page {
            size: auto;
            margin: 0;
        }
        
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f5f5f5;
        }

        .document-main {
            width: 1602px;
            height: 2027px;
            position: relative;
            margin: 20px;
            background-image: url('{{ asset("images/cedulas/acapulco/acapulcocedula.png") }}');
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }

        
        .content-table {
            width: 100%;
            height: 100%;
            display: table;
        }

        .table-cell {
            display: table-cell;
            vertical-align: middle;
            padding: 250px 0;
        }

        .content-box {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        h2, h4, p {
            color: #000;
            margin: 10px 0;
            word-wrap: break-word;
        }

        h4 {
            font-size: 32px;
            line-height: 1.3;
        }

        h2 {
            font-size: 42px;
            margin: 30px 0;
        }

        p {
            font-size: 24px;
        }

        .qr-container img {
            width: 400px;
            height: 400px;
            margin: 30px auto;
        }

        @media screen and (max-width: 1602px) {
            .document-main {
                width: 100%;
                height: auto;
                aspect-ratio: 1602/2027;
                margin: 10px;
            }
            
            .table-cell {
                padding: 15% 0;
            }
        }

        @media print {
            
            body {
                background: none;
                display: block;
                height: auto;
            }
            
            .document-main {
                width: 100%;
                height: auto;                
                aspect-ratio: 1602/2027;
                margin: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                page-break-after: avoid;
                page-break-inside: avoid;
            }

            
            
            .table-cell {
                padding: 15% 0;
            }
            
            /* Asegurar que el texto sea legible al imprimir */
            h2, h4, p {
                color: black !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

    @include('toast.toasts')

    <div class="document-main">
        <div class="content-table">
            <div class="table-cell">
                <div class="content-box">
                    <h2>Cédula de identificación <br>para Recolección de <br>Residuos Sólidos Urbanos</h2>
                    <h4>{{ $negocio->negocio }}</h4>

                    <div class="qr-container">
                        <img src="{{ asset($url) }}" alt="Código QR" />
                    </div>

                    <p><strong>Nombre del establecimiento:</strong> {{ $negocio->negocio }}</p>
                    <p><strong>Folio de registro:</strong> {{ $negocio->id }}</p>
                    <p><strong>Licencia de funcionamiento:</strong> {{ $negocio->licencia }}</p>
                    <p><strong>ESTE DOCUMENTO DEBERÁ EXHIBIRSE EN UN LUGAR VISIBLE PARA USO DE LA AUTORIDAD</strong></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ajustar para impresión
            window.onbeforeprint = function() {
                $('.table-cell').css('padding', '15% 0');
            };
            
            window.onafterprint = function() {
                $('.table-cell').css('padding', '250px 0');
            };
        });
    </script>
</body>
</html>