<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>Recitur | Catálogo</title>

  <style>
    .residuo-card {
      background: #fff;
      border-radius: 14px;
      border: 1px solid #ececec;
      overflow: hidden;
      transition: transform .25s ease, box-shadow .25s ease;
      display: flex;
      flex-direction: column;
      box-shadow: 0 2px 6px rgba(0,0,0,.04);
      height: 100%;
    }
    .residuo-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 24px rgba(105,25,50,.15);
      border-color: rgba(105,25,50,.25);
    }

    .residuo-card__header {
      background: linear-gradient(135deg, var(--theme-primary) 0%, var(--theme-danger) 100%);
      padding: 20px 16px 16px;
      display: flex;
      align-items: center;
      gap: 12px;
      color: #fff;
    }
    .residuo-card__icon {
      width: 46px;
      height: 46px;
      border-radius: 12px;
      background: rgba(255,255,255,.15);
      border: 2px solid rgba(255,255,255,.6);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      flex-shrink: 0;
      backdrop-filter: blur(4px);
    }
    .residuo-card__title {
      font-size: 15px;
      font-weight: 700;
      margin: 0;
      line-height: 1.2;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      flex: 1;
    }

    .residuo-card__body {
      padding: 14px 16px;
      flex: 1 1 auto;
    }

    .residuo-info {
      display: flex;
      justify-content: space-between;
      gap: 10px;
    }
    .residuo-info .item {
      text-align: center;
      flex: 1;
    }
    .residuo-info .item .label {
      font-size: 10px;
      text-transform: uppercase;
      letter-spacing: .5px;
      color: #9aaba6;
      font-weight: 600;
      display: block;
      margin-bottom: 2px;
    }
    .residuo-info .item .value {
      font-size: 14px;
      font-weight: 700;
      color: var(--theme-primary);
    }
    .residuo-info .item .value.price {
      color: var(--theme-success);
    }

    .residuo-edit {
      display: none;
    }
    .residuo-card.editing .residuo-info { display: none; }
    .residuo-card.editing .residuo-edit { display: block; animation: fadeSlide .2s ease; }
    @keyframes fadeSlide {
      from { opacity: 0; transform: translateY(-4px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .residuo-edit .form-label {
      font-size: 10px;
      text-transform: uppercase;
      letter-spacing: .5px;
      color: #9aaba6;
      font-weight: 600;
      margin-bottom: 2px;
    }
    .residuo-edit .form-control-sm {
      font-size: 12px;
      border-radius: 6px;
      border: 1px solid #e3e8e7;
    }
    .residuo-edit .form-control-sm:focus {
      border-color: var(--theme-info);
      box-shadow: 0 0 0 2px rgba(182,66,95,.15);
    }

    .residuo-card__actions {
      display: flex;
      gap: 8px;
      padding: 10px 16px 14px;
      border-top: 1px solid #f1f1f1;
      margin-top: auto;
    }
    .residuo-card__btn {
      flex: 1 1 0;
      font-size: 12px;
      font-weight: 600;
      padding: 7px 8px;
      border-radius: 8px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      line-height: 1.2;
    }

    .category-heading {
      display: flex;
      align-items: center;
      gap: 10px;
      margin: 26px 0 14px;
    }
    .category-heading .pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--theme-primary);
      color: #fff;
      padding: 7px 16px;
      border-radius: 30px;
      font-weight: 600;
      font-size: .9rem;
    }
    .category-heading .pill .count {
      background: rgba(255,255,255,.25);
      border-radius: 20px;
      padding: 1px 9px;
      font-size: .75rem;
    }
    .category-heading .line {
      flex: 1;
      height: 2px;
      background: linear-gradient(90deg, var(--theme-primary), transparent);
      border-radius: 2px;
    }

    .empty-state {
      text-align: center;
      padding: 60px 20px;
      color: var(--theme-gray);
    }
    .empty-state i {
      font-size: 3.5rem;
      margin-bottom: 16px;
      color: #e0d5d8;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')
@include('administracion.navbars.navbar')
<div class="wrapper">

  <div class="content-wrapper">
    <div class="content-header">&nbsp;</div>

    <section class="content">
      @include('administracion.sidebar')

      <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
          <h4 class="mb-0 text-theme-primary font-weight-bold">
            <i class="fa fa-recycle title-icon me-2"></i> Catálogo de Residuos
          </h4>
          <button type="button" class="btn btn-theme-primary" data-bs-toggle="modal" data-bs-target="#nuevoResiduoModal">
            <i class="fas fa-plus-circle me-2"></i> Agregar Nuevo Residuo
          </button>
        </div>

        @if(count($residuos))
          @php $agrupados = $residuos->groupBy('categoria'); @endphp

          @foreach($agrupados as $categoria => $items)
            <div class="mb-4">
              <div class="category-heading">
                <span class="pill">
                  <i class="fa fa-tag"></i> {{ $categoria }}
                  <span class="count">{{ $items->count() }}</span>
                </span>
                <span class="line"></span>
              </div>

              <div class="row g-3">
                @foreach($items as $residuo)
                  <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="residuo-card" id="card-{{ $residuo->id }}">

                      <div class="residuo-card__header">
                        <div class="residuo-card__icon">
                          <i class="fas fa-recycle"></i>
                        </div>
                        <p class="residuo-card__title">{{ $residuo->residuo }}</p>
                      </div>

                      <div class="residuo-card__body">
                        <div class="residuo-info">
                          <div class="item">
                            <span class="label">Unidades</span>
                            <span class="value">{{ $residuo->unidades }}</span>
                          </div>
                          <div class="item">
                            <span class="label">Precio</span>
                            <span class="value price">${{ number_format($residuo->precio, 2) }}</span>
                          </div>
                        </div>

                        <form method="POST" action="{{ route('residuos.update', $residuo->id) }}" class="residuo-edit">
                          @csrf
                          @method('PUT')
                          <div class="row g-2">
                            <div class="col-12">
                              <label class="form-label">Categoría</label>
                              <input type="text" name="categoria" value="{{ $residuo->categoria }}" class="form-control form-control-sm">
                            </div>
                            <div class="col-12">
                              <label class="form-label">Nombre</label>
                              <input type="text" name="residuo" value="{{ $residuo->residuo }}" class="form-control form-control-sm">
                            </div>
                            <div class="col-6">
                              <label class="form-label">Unidades</label>
                              <input type="text" name="unidades" maxlength="3" value="{{ $residuo->unidades }}" class="form-control form-control-sm">
                            </div>
                            <div class="col-6">
                              <label class="form-label">Precio</label>
                              <input type="number" step="0.1" min="0" name="precio" value="{{ $residuo->precio }}" class="form-control form-control-sm">
                            </div>
                          </div>
                        </form>
                      </div>

                      <div class="residuo-card__actions">
                        <button type="button" class="btn btn-outline-theme-primary residuo-card__btn btn-edit" onclick="toggleEdit('{{ $residuo->id }}')">
                          <i class="fas fa-pen me-1"></i> Editar
                        </button>
                        <button type="submit" form="form-edit-{{ $residuo->id }}" class="btn btn-theme-success residuo-card__btn btn-save d-none">
                          <i class="fas fa-save me-1"></i> Guardar
                        </button>
                        <button type="button" class="btn btn-outline-theme-danger residuo-card__btn" onclick="confirmarEliminacion('{{ $residuo->id }}')">
                          <i class="fas fa-trash me-1"></i> Eliminar
                        </button>
                      </div>

                      <form id="delete-form-{{ $residuo->id }}" action="{{ route('residuos.destroy', $residuo->id) }}" method="POST" style="display:none;">
                        @csrf
                        @method('DELETE')
                      </form>

                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endforeach

        @else
          <div class="empty-state">
            <i class="fas fa-recycle"></i>
            <h5 class="mb-1">Aún no hay residuos registrados</h5>
            <p class="mb-0">Usa el botón "Agregar Nuevo Residuo" para comenzar.</p>
          </div>
        @endif

      </div>
    </section>
  </div>
</div>

<script>
function toggleEdit(id) {
  const card = document.getElementById('card-' + id);
  const editBtn = card.querySelector('.btn-edit');
  const saveBtn = card.querySelector('.btn-save');
  const form = card.querySelector('.residuo-edit');
  form.id = 'form-edit-' + id;
  const isEditing = card.classList.toggle('editing');
  editBtn.classList.toggle('d-none', isEditing);
  saveBtn.classList.toggle('d-none', !isEditing);
}

function confirmarEliminacion(id) {
  if (confirm('¿Estás seguro que deseas eliminar este residuo?\nEsta acción no se puede deshacer.')) {
    document.getElementById('delete-form-' + id).submit();
  }
}
</script>

<div class="modal fade" id="nuevoResiduoModal" tabindex="-1" aria-labelledby="nuevoResiduoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius:14px; overflow:hidden;">
      <div class="modal-header bg-theme-info text-white">
        <h5 class="modal-title" id="nuevoResiduoModalLabel"><i class="fas fa-plus-circle me-2"></i>Registrar Nuevo Residuo</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="{{ route('residuos.store') }}" id="formNuevoResiduo">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <input type="text" class="form-control" id="categoria" name="categoria" required>
          </div>
          <div class="mb-3">
            <label for="residuo" class="form-label">Nombre del Residuo</label>
            <input type="text" class="form-control" id="residuo" name="residuo" required>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="unidades" class="form-label">Unidades</label>
              <input type="text" class="form-control" id="unidades" name="unidades" maxlength="3" value="Kg" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="precio" class="form-label">Precio</label>
              <input type="number" step="0.1" min="0" class="form-control" id="precio" name="precio" value="0" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-theme-primary">
            <i class="fas fa-save me-2"></i>Guardar Residuo
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

@include('administracion.footer')
</body>
</html>