<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>Recitur | GM</title>
    
</head>
<body>
    @include('toast.toasts')
    @include('navbar')
    
    <div class="row">
        
        <div class="col-md-12">
            <div class="card">
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
                                    <button type="submit" class="btn btn-info2 btn-block">Enviar</button>
                                </div>
                                </form>
                            </div>
                           
                        </div>

                        
                    </div>
                    
                </form>
            </div>
        
        </div>
        
    </div>
     
    
    




    

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
