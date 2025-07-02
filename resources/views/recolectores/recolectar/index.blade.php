<!DOCTYPE html>
<html lang="es">
<head>
    @include('recolectores.header')
    <title>Recitur | Recolectar</title>
    <style>
        .cedula-body {
            position: relative;
            width: 100%;
            height: 500px;
            background-image: url('{{ asset('images/cedulas/acapulco/bodycedula.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .qr-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 365px;
            height: 365px;
            transform: translate(-50%, -50%);
            z-index: 2;
        }

        .qr-overlay img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            cursor: pointer;
        }

        .qr-instructions {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1.1rem;
            color: #333;
            font-weight: bold;
            text-align: center;
            z-index: 1;
        }

        #reader {
            position: fixed;
            top: 10%;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 400px;
            z-index: 9999;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
            padding: 1rem;
            display: none;
        }

        #close-reader {
            text-align: right;
            margin-bottom: 10px;
        }

        @media (max-width: 576px) {
            .qr-overlay {
                width: 250px;
                height: 250px;
                top: 45%;
            }

            .qr-instructions {
                font-size: 0.9rem;
            }
        }
    </style>
    <!-- Carga la librería html5-qrcode -->
    <script src="https://unpkg.com/html5-qrcode" defer></script>
</head>
<body>
    @include('toast.toasts')
    @include('recolectores.navbars.navbar')

    <div class="container">
        <div class="row justify-content-center">
            <img src="{{ asset('images/cedulas/acapulco/headercedula.png') }}" alt="" width="100%">

            <div class="cedula-body">
                <div class="qr-overlay">
                    <img src="{{ asset('images/cedulas/qrgeneral.png') }}" alt="Escanear QR" onclick="abrirCamara()" />
                </div>
                <div class="qr-instructions">
                    Toca el código QR para activar tu cámara y escanearlo.
                </div>
                <img src="{{ asset('images/cedulas/acapulco/bodycedula.png') }}" alt="" width="100%" style="visibility: hidden;">
            </div>

            <img src="{{ asset('images/cedulas/acapulco/footercedula.png') }}" alt="" width="100%">
        </div>
    </div>

    <!-- Contenedor del lector QR -->
    <div id="reader">
        <div id="close-reader">
            <button onclick="cerrarCamara()" class="btn btn-sm btn-danger">Cerrar</button>
        </div>
        <div id="qr-reader"></div>
    </div>

    <script>
        let scanner;

function abrirCamara() {
    const readerContainer = document.getElementById("reader");
    readerContainer.style.display = "block";

    scanner = new Html5Qrcode("qr-reader");
    scanner.start(
        { facingMode: "environment" },
        {
            fps: 10,
            qrbox: 250
        },
        qrCodeMessage => {
            cerrarCamara(); // detener cámara

            const instrucciones = document.querySelector(".qr-instructions");
            instrucciones.innerHTML = `
                <a href="{{ url('hacerrecolleccion') }}/${qrCodeMessage}" class="btn btn-theme-primary mt-3">
                    Realizar la recolección
                </a>
            `;
        },
        errorMessage => {
            console.warn("Error escaneando:", errorMessage);
        }
            ).catch(err => {
                alert("Error al acceder a la cámara: " + err);
                cerrarCamara();
            });
        }


        function cerrarCamara() {
            const readerContainer = document.getElementById("reader");
            readerContainer.style.display = "none";

            if (scanner) {
                scanner.stop().then(() => {
                    scanner.clear();
                }).catch(err => {
                    console.error("Error al detener escáner:", err);
                });
            }
        }
    </script>

    
<script>
    // Mostrar/ocultar menú en móvil
    document.getElementById('navbar-toggler').addEventListener('click', function () {
        var navbarCollapse = document.getElementById('navbarSupportedContent');
        navbarCollapse.classList.toggle('active');
    });
</script>
</body>
</html>
