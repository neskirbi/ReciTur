<style>
    /* ============================================
       NAVBAR (original) + acciones derecha
       ============================================ */
    .navbar-custom {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1030;
        background-color: rgb(240, 240, 240);
        height: 60px;
        padding: 0 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .navbar-toggler {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
    }

    .navbar-toggler-icon {
        display: inline-block;
        width: 25px;
        height: 3px;
        background-color: #000;
        margin: 4px 0;
    }

    .navbar-nav .nav-link {
        color: #000;
        margin-right: 15px;
        font-weight: bold;
    }

    .navbar-nav .nav-link:hover {
        text-decoration: underline;
    }

    /* ---------- Acciones derecha ---------- */
    .navbar-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-icon-nav {
        position: relative;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: transparent;
        border: none;
        color: #495057;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 1.05rem;
    }
    .btn-icon-nav:hover {
        background: rgba(0, 0, 0, 0.06);
        color: var(--theme-primary);
    }
    .btn-icon-nav .badge-dot {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--theme-danger);
        border: 2px solid rgb(240, 240, 240);
    }

    /* ---------- Botón de perfil ---------- */
    .navbar-user {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 4px 10px 4px 4px;
        border-radius: 999px;
        background: #fff;
        border: 1px solid #e0e0e0;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        color: #212529;
    }
    .navbar-user:hover {
        background: #f8f9fa;
        border-color: #d0d0d0;
        color: #212529;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }
    .navbar-user .avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--theme-primary);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.85rem;
        flex-shrink: 0;
    }
    .navbar-user .user-name {
        font-size: 0.85rem;
        font-weight: 600;
        max-width: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .navbar-user .user-caret {
        font-size: 0.7rem;
        opacity: 0.6;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 768px) {
        .navbar-toggler {
            display: block;
        }
        .navbar-collapse {
            display: none;
            flex-direction: column;
            background: #ffffff;
            padding: 10px;
            border-top: 1px solid #ddd;
        }
        .navbar-collapse.active {
            display: flex;
            z-index: 1000;
        }
        .navbar-user .user-name { display: none; }
        .navbar-user .user-caret { display: none; }
        .navbar-user { padding: 4px; }
    }
</style>

<!-- NAVBAR -->
<div class="navbar-custom">

  <!-- Logo -->
  <a class="navbar-brand" href="{{ url('homec') }}" style="display: flex; align-items: center; margin-right: 0.5rem;">
    <img src="{{ asset('images').'/'.GetLogo() }}" alt="" height="45px">
  </a>

  <!-- Botón de colapso junto al logo -->
  <button id="sidebarCollapse" class="btn btn-outline-theme-gray me-auto">
    <i class="fa fa-bars"></i>
  </button>

  <!-- Acciones derecha -->
  <div class="navbar-actions">

    <!-- Notificaciones -->
    <button class="btn-icon-nav" title="Notificaciones">
      <i class="fa fa-bell"></i>
      <span class="badge-dot"></span>
    </button>

    <!-- Perfil -->
    <div class="dropdown">
      <a class="navbar-user" href="#" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="avatar">
          {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
        </span>
        <span class="user-name">{{ auth()->user()->name ?? 'Admin' }}</span>
        <i class="fa fa-chevron-down user-caret"></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-end shadow">
        <li><a class="dropdown-item" href="{{ url('configuracion') }}"><i class="fa fa-user me-2"></i> Mi perfil</a></li>
        <li><a class="dropdown-item" href="{{ url('configuracion') }}"><i class="fa fa-cog me-2"></i> Configuración</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-danger" href="{{ url('logout') }}"><i class="fa fa-sign-out-alt me-2"></i> Cerrar sesión</a></li>
      </ul>
    </div>

  </div>

</div>