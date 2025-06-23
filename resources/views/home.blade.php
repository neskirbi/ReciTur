<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>Recitur | GM</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .navbar-custom {
            background-color:rgb(240, 240, 240);
            height: 60px;
            padding: 0 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-toggler {
            display: none;
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

        .navbar-nav .nav-link {
            color: #000;
            margin-right: 15px;
            font-weight: bold;
        }

        .navbar-nav .nav-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .navbar-toggler {
                display: block;
            }
            .navbar-collapse {
                display: none;
                flex-direction: column;
                background: #ffffff;
                padding: 10px;
                border-top: 1px solid #ddd;
            }
            .navbar-collapse.active {
                display: flex;
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
