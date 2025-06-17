<!DOCTYPE html>
<html lang="es">
<head>
    @include('header')
    <title>AMRCD | Login</title>
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
            padding: 10px;
            max-width: 300px;
            margin: 0 auto;
        }

        .card-login .card-header {
            background:rgb(255, 255, 255);
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

        .btn-outline-secondary {
            border: 1px solid #28a745;
            color: #28a745;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background-color: #28a745;
            color: #fff;
        }

        @media only screen and (max-width: 768px) {
            .card-login {
                width: 90%;
            }

            img {
                width: 150px;
            }
        }
    </style>
</head>
<body>
    @include('toast.toasts')
    
    <div style="text-align: center; margin-top: 20px;">
        <div class="card card-login">
            <div class="card-header">
                <img src="{{ asset('images/logoreci.png') }}" alt="Logo AMRCD" style="width: 100px;">
            </div>
            <form method="post" action="{{ url('Login') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="mail">Correo</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                            </div>
                            <input required type="email" class="form-control" id="mail" name="mail" placeholder="Correo">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass">Contraseña</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></div>
                            </div>
                            <input required type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="passconfirm">¿Olvidaste tu contraseña?</label>
                        <br>
                        <a class="btn btn-outline-secondary" href="PassReset">Recuperar</a>
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