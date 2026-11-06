<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>Recitur | Nueva Contraseña</title>
    <style>
        .footer {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        @media (orientation: portrait) {
            .footer {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                z-index: -1;
            }

            .contenedor-imagen {
                position: relative;
                min-height: 100vh;
            }
        }
    </style>
</head>
<body>
    @include('toast.toasts')
    @include('navbar')

    <img src="{{asset('images/GOBM.png')}}" alt="Imagen principal" style="width: 100%; display: block;">

    <div class="login-container">
        <h2>Nueva Contraseña</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <p class="text-muted text-center" style="font-size: 13px; margin-bottom: 15px;">
            La contraseña debe tener exactamente <strong>6 caracteres</strong>.
        </p>

        <form method="POST" action="{{ url('GuardarNuevaPass/'.$tabla.'/'.$id) }}">
            @csrf

            <div class="form-group">
                <label for="pass">Nueva contraseña</label>
                <input type="password" name="pass" id="pass" required minlength="6" maxlength="6"
                       onkeyup="ValidarPass();">
                <small id="helperPass" class="helper-text"></small>
            </div>

            <div class="form-group">
                <label for="pass_confirmation">Confirmar contraseña</label>
                <input type="password" name="pass_confirmation" id="pass_confirmation" required minlength="6" maxlength="6"
                       onkeyup="ValidarPass();">
                <small id="helperConfirm" class="helper-text"></small>
            </div>

            <button type="submit" class="btn btn-theme-primary btn-block" id="btnGuardar" disabled>Guardar Contraseña</button>
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

        .form-group input.is-valid {
            border-color: #176D4A;
            box-shadow: 0 0 0 0.15rem rgba(23, 109, 74, 0.15);
        }

        .form-group input.is-invalid {
            border-color: #4D0F24;
            box-shadow: 0 0 0 0.15rem rgba(77, 15, 36, 0.15);
        }

        .helper-text {
            display: block;
            margin-top: 4px;
            font-size: 12px;
        }

        .helper-text.ok {
            color: #176D4A;
        }

        .helper-text.error {
            color: #4D0F24;
        }
    </style>

    @include('footer')

    <script>
        document.getElementById('navbar-toggler').addEventListener('click', function () {
            var navbarCollapse = document.getElementById('navbarSupportedContent');
            navbarCollapse.classList.toggle('active');
        });

        function ValidarPass(){
            var pass  = document.getElementById('pass');
            var conf  = document.getElementById('pass_confirmation');
            var hPass = document.getElementById('helperPass');
            var hConf = document.getElementById('helperConfirm');
            var btn   = document.getElementById('btnGuardar');

            // Validar campo principal
            if(pass.value.length === 0){
                pass.classList.remove('is-valid', 'is-invalid');
                hPass.textContent = '';
                hPass.className = 'helper-text';
            } else if(pass.value.length === 6){
                pass.classList.remove('is-invalid');
                pass.classList.add('is-valid');
                hPass.textContent = '✓ Correcto';
                hPass.className = 'helper-text ok';
            } else {
                pass.classList.remove('is-valid');
                pass.classList.add('is-invalid');
                hPass.textContent = 'Debe tener exactamente 6 caracteres (' + pass.value.length + '/6)';
                hPass.className = 'helper-text error';
            }

            // Validar confirmación
            if(conf.value.length === 0){
                conf.classList.remove('is-valid', 'is-invalid');
                hConf.textContent = '';
                hConf.className = 'helper-text';
            } else if(conf.value.length === 6 && conf.value === pass.value){
                conf.classList.remove('is-invalid');
                conf.classList.add('is-valid');
                hConf.textContent = '✓ Las contraseñas coinciden';
                hConf.className = 'helper-text ok';
            } else if(conf.value.length !== 6){
                conf.classList.remove('is-valid');
                conf.classList.add('is-invalid');
                hConf.textContent = 'Debe tener exactamente 6 caracteres (' + conf.value.length + '/6)';
                hConf.className = 'helper-text error';
            } else {
                conf.classList.remove('is-valid');
                conf.classList.add('is-invalid');
                hConf.textContent = 'Las contraseñas no coinciden';
                hConf.className = 'helper-text error';
            }

            // Habilitar botón solo si todo está correcto
            btn.disabled = !(pass.value.length === 6 && conf.value.length === 6 && pass.value === conf.value);
        }
    </script>
</body>
</html>