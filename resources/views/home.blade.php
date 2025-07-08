<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>Recitur | GM</title>
    <style>
        .footer {
        /* Estilos generales para la imagen */
        width: 100%;
        height: auto;
        object-fit: cover;
        }

        @media (orientation: portrait) {
        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: -1; /* Opcional: si quieres que esté detrás del contenido */
        }
        
        /* Opcional: para asegurar que el contenedor padre tenga posición relativa */
        .contenedor-imagen {
            position: relative;
            min-height: 100vh; /* Ajusta según necesites */
        }
        }
    </style>
</head>
<body>
    @include('toast.toasts')

     @include('navbar')
    

    <!-- IMAGEN CENTRAL -->
    <img src="{{asset('images/GOBM.png')}}" alt="Imagen principal" style="width: 100%; display: block;">
    

    @include('footer')

    <script>
        // Mostrar/ocultar menú en móvil
        document.getElementById('navbar-toggler').addEventListener('click', function () {
            var navbarCollapse = document.getElementById('navbarSupportedContent');
            navbarCollapse.classList.toggle('active');
        });
    </script>
</body>
</html>
