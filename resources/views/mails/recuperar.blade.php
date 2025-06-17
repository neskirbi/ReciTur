<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>Confirmación</title>
</head>
<body>
<br><br><br>
    <center>
        <img src="{{asset('images/logo.png')}}" alt="" width="200px">
        <h2>Recuperación de su contraseña.</h2>
        <h3>Gracias por elegir Reci-trash.</h3>
        <h5>Por favor, para recuperar la contraseña de {{$mail}} de click en el siguiente enlace.</h5>
        <a href="https://reci-track.mx/Recuperar/{{$id}}" class="btn btn-default  btn-outline-secondary">Recuperar</a>
    </center>
    
</body>
</html>