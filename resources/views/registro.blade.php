<!DOCTYPE html>
<html lang="es">
<head>
    @include('header')
    <title>AMRCD | Registro</title>
    <style>
        body {
            background-image: url("{{ asset('images/wallreci.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            background-attachment: fixed;
            background-position: center;
            font-family: Arial, sans-serif;
        }

        .card-login {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        .card-login .card-header {
            background: #78AF6C;
            color: #fff;
            border-radius: 10px 10px 0 0;
            padding: 15px;
            text-align: center;
        }

        .card-login .card-footer {
            background: #f8f9fa;
            border-radius: 0 0 10px 10px;
            padding: 15px;
            text-align: right;
        }

        .btn-primary {
            background-color: #78AF6C;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #218838;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .form-group {
            flex: 1;
            min-width: 200px;
        }

        .form-group.full-width {
            flex: 0 0 100%;
        }

        @media only screen and (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    @include('toast.toasts')
    
    <div>
        <div class="card card-login">
            <div class="card-header">
                <h3 class="card-title">Registro</h3>
            </div>
            <form method="post" action="{{ url('Registro') }}">
                @csrf
                <div class="card-body">
                 
                    

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
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
    @include('footer')
</body>
</html>