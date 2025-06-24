<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>Recitur | GM</title>
    
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
