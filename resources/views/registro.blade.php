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

    <!-- NAVBAR BLANCO -->
    <div class="navbar-custom">
        <a class="navbar-brand" href="#">
            
        </a>
        
        <nav class="navbar navbar-expand-md navbar-light">
            <button class="navbar-toggler" id="navbar-toggler">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto extra-nav">
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

    <!-- IMAGEN CENTRAL -->
    <div class="row">
        
        <div class="col-md-12">
            <div class="card card-login">
                <div class="card-header">
                    <h3 class="card-title">Registro</h3>
                </div>
                
                    @csrf
                    <div class="card-body">
                    
                        <div class="row">
                            <div class="col-md-6">
                                <form method="post" action="{{ url('Registro') }}">
                                <!-- Fila 2: Nombres y Apellidos -->
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="nombres">Nombre(s)</label>
                                        <input required type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombre(s)">
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos</label>
                                        <input required type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos">
                                    </div>
                                </div>

                                <!-- Fila 3: Correo -->
                                <div class="form-row">
                                    <div class="form-group full-width">
                                        <label for="mail">Correo</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                            </div>
                                            <input required type="email" class="form-control" id="mail" name="mail" placeholder="Correo">
                                        </div>
                                    </div>
                                </div>

                                <!-- Fila 4: Contraseña y Confirmar Contraseña -->
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="pass">Contraseña</label>
                                        <input required onkeyup="ValidarPassRegistro();" type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
                                    </div>
                                    <div class="form-group">
                                        <label for="pass2">Confirmar Contraseña</label>
                                        <input required onkeyup="ValidarPassRegistro();" type="password" class="form-control" id="pass2" name="pass2" placeholder="Confirmar Contraseña">
                                    </div>
                                </div>

                                <!-- Fila 5: Términos y Condiciones -->
                                <div class="form-row">
                                    <div class="form-group full-width">
                                        <label for="accept">
                                            <input required type="checkbox" id="accept" name="accept">
                                            Acepto los <a href="terminosycondiciones" target="_blank">Términos y Condiciones</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <center>
                                    <img src="{{asset('images/GOBMV.png')}}" alt="Imagen principal" >
                                </center>
                                
                            </div>
                        </div>

                        
                    </div>
                    
                </form>
            </div>
        
        </div>
        
    </div>
     
    
    





    <img src="{{asset('images/GOBMF.png')}}" alt="Imagen principal" style="width: 100%; display: block;">

    

<style>
.login-container {
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(255, 255, 255, 0.95);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    max-width: 350px;
    width: 90%;
    z-index: 1001;
}

.login-container h2 {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.form-group input {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    border-radius: 6px;
    border: 1px solid #ccc;
}

.btn-login {
    width: 100%;
    padding: 10px;
    background-color: #6D1732;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
}

.btn-login:hover {
    background-color:rgba(109, 23, 50, 0.66);
}
</style>


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
