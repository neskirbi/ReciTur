<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>Hoplbox | RSU</title>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background: #78AF6C;
    }
    .full-width-container {
        margin-top: 50px;
        width: 100%;
        padding: 0px;
        box-sizing: border-box;
        background-color: #ECEADB;
        text-align: center;
        border-radius: 30px 30px 0px 0px;
    }
    .full-width-container img {
        width: 100%;
        height: auto;
        display: inline-block;
    }
    .navbar-toggler {
        display: none; /* Ocultar el botón por defecto */
        background: none;
        border: none;
        cursor: pointer;
    }
    .navbar-toggler-icon {
        display: inline-block;
        width: 25px;
        height: 3px;
        background-color: #000;
        margin: 4px 0;
    }
    @media (max-width: 768px) {
        .navbar-toggler {
            display: block; /* Mostrar el botón en dispositivos móviles */
        }
        .navbar-collapse {
            display: none; /* Ocultar el menú por defecto en móviles */
        }
        .navbar-collapse.active {
            display: block; /* Mostrar el menú cuando esté activo */
        }
    }
</style>
<body>
    @include('toast.toasts')

    <!-- Div que abarca el 100% del ancho -->
    <div class="full-width-container">
        <div class="bg-light" style="height:60px; margin-right:10px; margin-left:10px;">
            <a class="navbar-brand float-left" href="#">
                <img src="{{asset('images/logoreci.png')}}" class="d-inline-block float-left" alt="">
            </a>
            <div class="float-right">
                <nav class="navbar navbar-expand-md navbar-light navbar-loght">
                    <!-- Botón de hamburguesa para móviles -->
                    <button class="navbar-toggler" id="navbar-toggler">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto extra-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('registropage')}}">Registrarse</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('loginpage')}}">
                                    <i class="fa fa-user-o" aria-hidden="true"></i> Ingresar
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Imagen centrada -->
        <img src="{{asset('images/wallreci.png')}}" alt="">
    </div>

    @include('footer')

    <script>
        // JavaScript para manejar el clic en el botón de hamburguesa
        document.getElementById('navbar-toggler').addEventListener('click', function() {
            var navbarCollapse = document.getElementById('navbarSupportedContent');
            navbarCollapse.classList.toggle('active');
        });
    </script>
</body>
</html>