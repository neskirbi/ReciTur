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
            background: #78AF6C;
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
    <img src="{{asset('images/home.jpeg')}}" alt="Imagen principal" style="width: 100%; display: block;">

    <div class="login-container">
    <h2>Iniciar Sesión</h2>
    <form method="POST" action="{{ url('Login') }}">
        @csrf
        <div class="form-group">
            <label for="mail">Correo electrónico</label>
            <input type="email" name="mail" id="mail" required>
        </div>
        <div class="form-group">
            <label for="pass">Contraseña</label>
            <input type="password" name="pass" id="pass" required>
        </div>
        <button type="submit" class="btn-login">Entrar</button>
    </form>
</div>

<style>
.login-container {
    position: absolute;
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
    background-color: #78AF6C;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
}

.btn-login:hover {
    background-color: #68985E;
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
