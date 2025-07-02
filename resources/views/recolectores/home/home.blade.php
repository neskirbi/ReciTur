<!DOCTYPE html>
<html lang="es"> <!-- Cambiado a "es" para español -->
<head>
    @include('recolectores.header')
    <title>Recitur | Home</title>
    
</head>
<body>
    @include('toast.toasts')
    @include('recolectores.navbars.navbar')

    <div class="container"> <!-- Mejor usar container de Bootstrap -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <!-- Tarjeta 1: Generadores -->
                    <div class="col-md-6">
                        <a href="{{ url('recolectar') }}" class="text-decoration-none">           
                            <div class="card feature-card">
                                <i class="fa fa-qrcode card-icon" aria-hidden="true"></i>
                                <p class="card-title" style="color: #333; font-weight: 500;"><b>Recolectar</b></p>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Tarjeta 2: Recolecciones -->
                    <div class="col-md-6">         
                        <a href="{{ url('recoleccionesr') }}" class="text-decoration-none">                     
                            <div class="card feature-card">
                                <i class="fa fa-trash-alt card-icon" aria-hidden="true"></i>
                                <p class="card-title" style="color: #333; font-weight: 500;"><b>Recolecciones</b></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('recolectores.footer')
</body>
</html>