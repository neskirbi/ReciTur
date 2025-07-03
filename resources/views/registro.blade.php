<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>Recitur | GM</title>
    
</head>
<body>
    @include('toast.toasts')
    @include('navbar')

    
    
    <img src="{{asset('images/GOBM.png')}}" alt="Imagen principal" style="width: 100%; display: block;">
    
    <div class="login-container">
        <h2>Registro</h2>
        <form method="post" action="{{ url('Registro') }}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombres">Nombre(s)</label>
                    <input required type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombre(s)">
                </div>
            </div>
        
            <div class="col-md-6">
                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input required type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
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
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pass">Contraseña</label>
                    <input required onkeyup="ValidarPassRegistro();" type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
                </div>
            </div>
       
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pass2">Confirmar Contraseña</label>
                    <input required onkeyup="ValidarPassRegistro();" type="password" class="form-control" id="pass2" name="pass2" placeholder="Confirmar Contraseña">
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-6">
                
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-theme-primary btn-block">Enviar</button>
            </div>
            
        
                
        </div>
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
    max-width: 650px;
    width: 90%;
    z-index: 1001;
}
@media (max-width: 768px) {
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
