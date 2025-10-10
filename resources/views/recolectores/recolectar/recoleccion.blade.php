<!DOCTYPE html>
<html lang="es">
<head>
    @include('recolectores.header')
    <title>Recitur | Recolección de Residuos</title>
    <style>
        /* Estilos específicos para uso con guantes */
        .guante-friendly .btn-lg {
            padding: 20px 30px;
            font-size: 1.3rem;
            min-height: 70px;
        }
        .guante-friendly .form-control,
        .guante-friendly .form-select {
            padding: 15px;
            font-size: 1.2rem;
            min-height: 60px;
        }
        .guante-friendly .form-check-input {
            width: 30px;
            height: 30px;
        }
        .guante-friendly .card {
            margin-bottom: 20px;
        }
        .guante-friendly .residuo-item {
            padding: 20px;
            margin-bottom: 15px;
            border: 2px solid #dee2e6;
            border-radius: 10px;
        }
        .guante-friendly .touch-target {
            min-height: 60px;
            padding: 15px;
        }
    </style>
</head>
<body class="guante-friendly">
    @include('toast.toasts')
    @include('recolectores.navbars.navbar')

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-6">Recolección de Residuos</h1>
            <div class="badge bg-secondary p-3 fs-5">
                Negocio: <strong>{{ $negocio->negocio }}</strong>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-4">
                        <form id="recoleccionForm" action="{{ url('GuardarRecoleccion') }}" method="POST">
                            @csrf
                            <input type="hidden" name="negocio_id" value="{{ $negocio->id }}">

                            <!-- Solo versión móvil/tablet optimizada para guantes -->
                            <div class="row g-4">
                                @php $categoriaAnterior = null; @endphp
                                @foreach($residuos as $residuo)
                                    @if($residuo->categoria !== $categoriaAnterior)
                                        <div class="col-12">
                                            <div class="bg-primary text-white p-3 rounded touch-target">
                                                <h4 class="mb-0">
                                                    <i class="fas fa-trash-alt me-2"></i>{{ $residuo->categoria }}
                                                </h4>
                                            </div>
                                        </div>
                                        @php $categoriaAnterior = $residuo->categoria; @endphp
                                    @endif

                                    <div class="col-12">
                                        <div class="residuo-item bg-light">
                                            <!-- Fila 1: Checkbox y nombre del residuo -->
                                            <div class="row align-items-center mb-3">
                                                <div class="col-2">
                                                    <div class="form-check">
                                                        <input type="checkbox" 
                                                            id="residuo-{{ $residuo->id }}" 
                                                            name="residuos[{{ $residuo->id }}][seleccionado]" 
                                                            value="1" 
                                                            class="form-check-input residuo-checkbox">
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <label for="residuo-{{ $residuo->id }}" class="form-check-label h5 mb-0">
                                                        {{ $residuo->residuo }}
                                                    </label>
                                                </div>
                                                <div class="col-2 text-end">
                                                    <span class="badge bg-dark fs-6">{{$residuo->unidades}}</span>
                                                </div>
                                            </div>

                                            <!-- Fila 2: Cantidad -->
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <label class="form-label h6 mb-2">CANTIDAD</label>
                                                    <input type="number" 
                                                           name="residuos[{{ $residuo->id }}][cantidad]" 
                                                           class="form-control form-control-lg" 
                                                           min="0" 
                                                           step="0.01"
                                                           placeholder="0.00">
                                                </div>
                                            </div>

                                            <!-- Fila 3: Contenedor -->
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <label class="form-label h6 mb-2">CONTENEDOR</label>
                                                    <select name="residuos[{{ $residuo->id }}][contenedor]" 
                                                            class="form-select form-select-lg contenedor-select"
                                                            data-residuo-id="{{ $residuo->id }}">
                                                        <option value="">--- SELECCIONAR ---</option>
                                                        @foreach($contenedores as $contenedor)
                                                            <option value="{{ $contenedor->id }}" 
                                                                    data-multiplicador="{{ $contenedor->multiplicador }}">
                                                                {{ $contenedor->contenedor }} ({{$contenedor->multiplicador}})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Fila 4: Capacidad -->
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="d-flex justify-content-between align-items-center p-2 bg-white rounded">
                                                        <span class="h6 mb-0 text-muted">CAPACIDAD:</span>
                                                        <span id="capacidad-{{ $residuo->id }}" class="h5 mb-0 fw-bold text-success">-</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Botón de registro extra grande -->
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-success btn-lg w-100 py-4">
                                    <i class="fas fa-save me-3"></i>
                                    <span class="fs-3">REGISTRAR RECOLECCIÓN</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('recolectores.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Manejar cambio en checkboxes
            $('.residuo-checkbox').change(function() {
                const item = $(this).closest('.residuo-item');
                item.find('.form-control, .form-select')
                   .prop('required', this.checked)
                   .toggleClass('border-danger border-3', this.checked);
            });

            // Manejar cambio en selección de contenedor
            $('.contenedor-select').change(function() {
                const selectedOption = $(this).find('option:selected');
                const multiplicador = selectedOption.data('multiplicador');
                const residuoId = $(this).data('residuo-id');
                
                // Actualizar capacidad
                $('#capacidad-' + residuoId).text(multiplicador || '-');
                
                if (multiplicador && multiplicador !== '') {
                    $('#capacidad-' + residuoId).addClass('text-success').removeClass('text-muted');
                } else {
                    $('#capacidad-' + residuoId).addClass('text-muted').removeClass('text-success');
                }
                
                // Auto-marcar el checkbox
                $(this).closest('.residuo-item').find('.residuo-checkbox')
                    .prop('checked', true).trigger('change');
            });

            // Validar formulario
            $('#recoleccionForm').submit(function(e) {
                let isValid = true;
                let firstError = null;
                
                $('.residuo-checkbox:checked').each(function() {
                    const item = $(this).closest('.residuo-item');
                    const cantidad = item.find('.form-control');
                    const contenedor = item.find('.form-select');
                    
                    if (!cantidad.val() || parseFloat(cantidad.val()) <= 0) {
                        cantidad.addClass('border-danger border-3');
                        if (!firstError) firstError = cantidad;
                        isValid = false;
                    }
                    
                    if (!contenedor.val()) {
                        contenedor.addClass('border-danger border-3');
                        if (!firstError) firstError = contenedor;
                        isValid = false;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    $('.toast-error').toast('show')
                        .find('.toast-body').text('Complete los campos requeridos');
                    
                    if (firstError) {
                        $('html, body').animate({
                            scrollTop: firstError.offset().top - 100
                        }, 500);
                    }
                }
            });

            // Auto-marcar checkbox al interactuar
            $('.form-control, .form-select').focus(function() {
                $(this).closest('.residuo-item').find('.residuo-checkbox')
                    .prop('checked', true).trigger('change');
            });

            // Mejorar la usabilidad táctil
            $('.residuo-item').on('click', function(e) {
                if (!$(e.target).is('input, select, label, a, button')) {
                    $(this).find('.residuo-checkbox').prop('checked', true).trigger('change');
                }
            });
        });
    </script>
</body>
</html>