<style>
  #sidebar {
    left: 0;
    top: 60px;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    transition: transform 0.3s ease;
    width: 250px;
    z-index: 1050;
    background-color: var(--theme-primary);
  }

  #sidebar.collapsed {
    transform: translateX(-250px);
  }

  .content-wrapper {
    margin-left: 250px;
    transition: margin-left 0.3s ease;
  }

  .content-wrapper.expanded {
    margin-left: 0;
  }

  @media (max-width: 768px) {
    #sidebar {
      transform: translateX(-250px);
      position: fixed;
    }

    #sidebar.show {
      transform: translateX(0);
    }

    .content-wrapper {
      margin-left: 0 !important;
    }
  }

  /* NUEVOS ESTILOS DE DISEÑO */

  .nav-section-title {
    font-size: 0.75rem;
    text-transform: uppercase;
    margin: 20px 0 10px;
    color: var(--theme-info);
    padding-left: 0.75rem;
  }

  .nav-link {
    color: var(--theme-gray);
    padding: 10px 15px;
    border-radius: 6px;
    transition: background-color 0.2s ease, color 0.2s ease;
  }

  .nav-link:hover {
    background-color: var(--theme-info);
    color: white;
    cursor: pointer;
  }

  .nav-item + .nav-item {
    margin-top: 6px;
  }
</style>

<!-- Sidebar colapsable -->
<nav id="sidebar" class="position-fixed vh-100 text-white">
  <div class="sidebar-header p-3">
    
    <!--<h4 class="mb-0" style="color: var(--theme-success);">Recitur</h4>-->
  </div>

  <ul class="nav flex-column px-3">
    <!--<div class="nav-section-title">General</div>
    <li class="nav-item">
      <a class="nav-link" href="#dashboard"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#perfil"><i class="fa fa-user me-2"></i>Perfil</a>
    </li>-->

    <div class="nav-section-title">Administración</div>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('establecimientos') }}"><i class="fa fa-briefcase me-2"></i>Negocios</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('recoleccion') }}"><i class="fa fa-trash-alt me-2"></i>Recolecciones</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('recolectores') }}"><i class="fa fa-users me-2"></i>Recolectores</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('residuos') }}"><i class="fa fa-pump-soap me-2"></i>Residuos</a>
    </li>

    <div class="nav-section-title">Cuenta</div>
    <li class="nav-item mt-2">
      <a class="nav-link" href="{{url('logout')}}"><i class="fa fa-sign-out-alt me-2"></i>Cerrar sesión</a>
    </li>
  </ul>
</nav>
