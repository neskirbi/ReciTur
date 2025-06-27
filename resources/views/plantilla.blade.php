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
    <div class="row">
        
        <div class="col-md-12">
            
        
        </div>
        
    </div>

    


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
