<!DOCTYPE html>
<html lang="es">
<head>
    @include('recolectores.header')
    <title>Recitur | Cedula</title>
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
            bottom: -20px;
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
                bottom: 5px;
            }
        }
    </style>
    <!-- Carga la librería html5-qrcode -->
</head>
<body>
    @include('toast.toasts')

    <div class="container">
        <div class="row justify-content-center">
            <img src="{{ asset('images/cedulas/acapulco/headercedula.png') }}" alt="" style="margin-top: 50px;" width="100%">
            <center>
                <h4>Cedula de identificación <br>para Recolección de <br>Residuos Sólidos Urbanos</h4>
                <h2>{{$negocio->negocio}}</h2>
            </center>

            <div class="cedula-body" style="margin-top: 50px;">
                <div class="qr-overlay">
                    <img src="{{asset($url)}}" alt="Escanear QR" onclick="abrirCamara()" />
                </div>
                <div class="qr-instructions">
                    <p>
                        <center>ESTE DOCUMENTO DEBERÁ EXHIBIRSE<center>
                        <center>EN UN LUGAR VISIBLE PARA USO DE LA AUTORIDAD<center>
                    </p>
                </div>
                <img src="{{ asset('images/cedulas/acapulco/bodycedula.png') }}" alt="" width="100%" style="visibility: hidden;">
            </div>

            <img src="{{ asset('images/cedulas/acapulco/footercedula.png') }}" style="margin-top: 50px;" alt="" width="100%">
        </div>
    </div>

    <!-- Contenedor del lector QR -->
    <div id="reader">
        <div id="close-reader">
            <button onclick="cerrarCamara()" class="btn btn-sm btn-danger">Cerrar</button>
        </div>
        <div id="qr-reader"></div>
    </div>

  

    

</body>
</html>
