<!DOCTYPE html>
<html lang="es"> <!-- Cambiado a "es" para español -->
<head>
    @include('cliente.header')
    <title>Recitur | GM</title>
    
</head>
<body>
    @include('toast.toasts')
    @include('cliente.navbars.navbar')

    <div class="container"> <!-- Mejor usar container de Bootstrap -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <!-- Tarjeta 1: Generadores -->
                    <div class="col-md-4">
                        <a href="{{ url('generadores') }}" class="text-decoration-none">           
                            <div class="card feature-card">
                                <i class="fa fa-industry card-icon" aria-hidden="true"></i>
                                <p class="card-title" style="color: #333; font-weight: 500;"><b>Generadores</b></p>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Tarjeta 2: Transportistas -->
                    <div class="col-md-4">   
                        <a href="{{ url('negocios') }}" class="text-decoration-none">                   
                            <div class="card feature-card">
                                <i class="fa fa-briefcase card-icon" aria-hidden="true"></i>
                                <p class="card-title" style="color: #333; font-weight: 500;"><b>Negocios</b></p>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Tarjeta 3: Recolecciones -->
                    <div class="col-md-4">         
                        <a href="{{ url('recolecciones') }}" class="text-decoration-none">                     
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

    @include('cliente.footer')
</body>
</html>