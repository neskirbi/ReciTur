<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manifiesto por Fecha</title>
    
</head>
<body>

@foreach($recolecciones as $index => $recoleccion)
    @php
        $detallesRecoleccion = $detallesRecoleccions[$index] ?? [];
    @endphp

    <br><br><br>
    @include('formatos.recolecciones.manifiesto')
    @if(!$loop->last)
        <div class="page-break"></div>
    @endif
@endforeach

</body>
</html>