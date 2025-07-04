<!DOCTYPE html>
<html lang="es">
<head>
    @include('recolectores.header')
    <title>Recitur | Recolección de Residuos</title>
    <style>
        .required-field {
            border: 1px solid #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
        .category-header {
            background-color: #e9ecef !important;
            font-size: 1.1rem;
        }
        .residuo-row:hover {
            background-color: #f8f9fa;
        }
        .input-group-text {
            min-width: 80px;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .btn-theme-primary {
            background-color: #28a745;
            border-color: #28a745;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-theme-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
            transform: translateY(-2px);
        }
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
    </style>
</head>
<body>
    @include('toast.toasts')
    @include('recolectores.navbars.navbar')

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Recolección de Residuos</h3>
            <div class="badge badge-primary p-2" style="background-color: #6c757d; font-size: 1rem;">
                Negocio: <strong>{{ $negocio->negocio }}</strong>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body p-4">
                        <form id="recoleccionForm" action="{{ url('GuardarRecoleccion') }}" method="POST">
                            @csrf
                            <input type="hidden" name="negocio_id" value="{{ $negocio->id }}">

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="10%" class="text-center">Selección</th>
                                            <th width="45%">Tipo de Residuo</th>
                                            <th width="45%">Cantidad Recolectada</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $categoriaAnterior = null;
                                        @endphp

                                        @foreach($residuos as $residuo)
                                            @if($residuo->categoria !== $categoriaAnterior)
                                                <tr class="category-header">
                                                    <td colspan="3" class="font-weight-bold text-uppercase">
                                                        <i class="fas fa-trash-alt mr-2"></i>{{ $residuo->categoria }}
                                                    </td>
                                                </tr>
                                                @php
                                                    $categoriaAnterior = $residuo->categoria;
                                                @endphp
                                            @endif

                                            <tr class="residuo-row align-middle">
                                                <td class="text-center align-middle">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" 
                                                               id="residuo-{{ $residuo->id }}" 
                                                               name="residuos[{{ $residuo->id }}][seleccionado]" 
                                                               value="1" 
                                                               class="custom-control-input residuo-checkbox">
                                                        <label class="custom-control-label" for="residuo-{{ $residuo->id }}"></label>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <label for="residuo-{{ $residuo->id }}" class="mb-0">{{ $residuo->residuo }}</label>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" 
                                                               name="residuos[{{ $residuo->id }}][cantidad]" 
                                                               class="form-control cantidad-input" 
                                                               min="0" 
                                                               step="0.01"
                                                               placeholder="0.00">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">{{ $residuo->unidades }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-theme-primary btn-lg">
                                    <i class="fas fa-save mr-2"></i>Registrar Recolección
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
            // Manejar el cambio en los checkboxes
            $('.residuo-checkbox').change(function() {
                const $cantidadInput = $(this).closest('tr').find('.cantidad-input');
                if ($(this).is(':checked')) {
                    $cantidadInput.prop('required', true)
                                .addClass('required-field')
                                .focus();
                } else {
                    $cantidadInput.prop('required', false)
                                .removeClass('required-field');
                }
            });

            // Validar antes de enviar el formulario
            $('#recoleccionForm').submit(function(e) {
                let isValid = true;
                $('.residuo-checkbox:checked').each(function() {
                    const $cantidadInput = $(this).closest('tr').find('.cantidad-input');
                    if (!$cantidadInput.val() || parseFloat($cantidadInput.val()) <= 0) {
                        $cantidadInput.addClass('required-field');
                        isValid = false;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    // Mostrar toast de error en lugar de alert
                    $('.toast-error').toast('show').find('.toast-body').text('Por favor, ingresa la cantidad para los residuos seleccionados.');
                    $('html, body').animate({
                        scrollTop: $('.required-field').first().offset().top - 100
                    }, 500);
                }
            });

            // Mejorar la experiencia de usuario
            $('.cantidad-input').focus(function() {
                $(this).closest('tr').find('.residuo-checkbox').prop('checked', true).trigger('change');
            });
        });
    </script>
</body>
</html>