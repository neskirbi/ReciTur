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
            background-color: #e9ecef;
            font-size: 1.1rem;
        }
        .residuo-row:hover {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
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
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    @include('toast.toasts')
    @include('recolectores.navbars.navbar')

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Recolección de Residuos</h3>
            <div class="badge bg-secondary p-2 fs-6">
                Negocio: <strong>{{ $negocio->negocio }}</strong>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-4">
                        <form id="recoleccionForm" action="{{ url('GuardarRecoleccion') }}" method="POST">
                            @csrf
                            <input type="hidden" name="negocio_id" value="{{ $negocio->id }}">

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%" class="text-center">✓</th>
                                            <th width="35%">Tipo de Residuo</th>
                                            <th width="30%">Cantidad</th>
                                            <th width="30%">Contenedor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $categoriaAnterior = null; @endphp

                                        @foreach($residuos as $residuo)
                                            @if($residuo->categoria !== $categoriaAnterior)
                                                <tr class="category-header">
                                                    <td colspan="4" class="fw-bold text-uppercase">
                                                        <i class="fas fa-trash-alt me-2"></i>{{ $residuo->categoria }}
                                                    </td>
                                                </tr>
                                                @php $categoriaAnterior = $residuo->categoria; @endphp
                                            @endif

                                            <tr class="residuo-row align-middle">
                                                <td class="text-center">
                                                    <div class="form-check">
                                                        <input type="checkbox" 
                                                               id="residuo-{{ $residuo->id }}" 
                                                               name="residuos[{{ $residuo->id }}][seleccionado]" 
                                                               value="1" 
                                                               class="form-check-input residuo-checkbox">
                                                    </div>
                                                </td>
                                                <td>
                                                    <label for="residuo-{{ $residuo->id }}" class="form-check-label">{{ $residuo->residuo }}</label>
                                                </td>
                                                <td>
                                                    <input type="number" 
                                                           name="residuos[{{ $residuo->id }}][cantidad]" 
                                                           class="form-control cantidad-input" 
                                                           min="0" 
                                                           step="0.01"
                                                           placeholder="0.00">
                                                </td>
                                                <td>
                                                    <select name="residuos[{{ $residuo->id }}][contenedor]" class="form-select">
                                                        <option value="">--- Seleccionar ---</option>
                                                        @foreach($contenedores as $contenedor)
                                                            <option value="{{ $contenedor->contenedor }}">{{ $contenedor->contenedor }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-theme-primary btn-lg">
                                    <i class="fas fa-save me-2"></i>Registrar
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
                const row = $(this).closest('tr');
                row.find('.cantidad-input, .form-select')
                   .prop('required', this.checked)
                   .toggleClass('required-field', this.checked);
            });

            // Validar formulario
            $('#recoleccionForm').submit(function(e) {
                let isValid = true;
                $('.residuo-checkbox:checked').each(function() {
                    const row = $(this).closest('tr');
                    const cantidad = row.find('.cantidad-input');
                    const contenedor = row.find('.form-select');
                    
                    if (!cantidad.val() || parseFloat(cantidad.val()) <= 0) {
                        cantidad.addClass('required-field');
                        isValid = false;
                    }
                    
                    if (!contenedor.val()) {
                        contenedor.addClass('required-field');
                        isValid = false;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    $('.toast-error').toast('show')
                        .find('.toast-body').text('Complete los campos requeridos');
                    $('html, body').animate({
                        scrollTop: $('.required-field').first().offset().top - 100
                    }, 500);
                }
            });

            // Auto-marcar checkbox al interactuar
            $('.cantidad-input, .form-select').focus(function() {
                $(this).closest('tr').find('.residuo-checkbox')
                    .prop('checked', true).trigger('change');
            });
        });
    </script>
</body>
</html>