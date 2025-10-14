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
    /* Propiedades para hacerlo scrollable */
    height: calc(100vh - 60px);
    overflow-y: auto;
    overflow-x: hidden;
  }

  /* Personalización de la barra de desplazamiento para navegadores WebKit */
  #sidebar::-webkit-scrollbar {
    width: 6px;
  }

  #sidebar::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 3px;
  }

  #sidebar::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 3px;
  }

  #sidebar::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.5);
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
      <a class="nav-link" href="{{ url('mapa') }}"><i class="fa fa-map me-2"></i>Mapa</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('generadores') }}"><i class="fa fa-building me-2"></i>Generador</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('establecimientos') }}"><i class="fa fa-briefcase me-2"></i>Negocios</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('recoleccion') }}"><i class="fa fa-recycle me-2"></i>Recolecciones</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('recolectores') }}"><i class="fa fa-users me-2"></i>Recolectores</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('residuos') }}"><i class="fa fa-asterisk me-2"></i>Residuos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('contenedores') }}"><i class="fa fa-trash-alt me-2"></i>Contenedores</a>
    </li>    
    <li class="nav-item">
      <a class="nav-link" href="{{ url('configuracion') }}"><i class="fa fa-cogs me-2"></i>Configuración</a>
    </li>

    <div class="nav-section-title">Cuenta</div>
    <li class="nav-item mt-2">
      <a class="nav-link" href="{{url('logout')}}"><i class="fa fa-sign-out-alt me-2"></i>Cerrar sesión</a>
    </li>
  </ul>
</nav>