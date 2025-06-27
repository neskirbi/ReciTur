<style>

  #sidebar {
  left: 0; /* para asegurar que está pegado */
  top: 60px;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

  /* Sidebar cerrado: se mueve fuera de la pantalla a la izquierda */
#sidebar.collapsed {
  transform: translateX(-250px);
}

/* Cuando sidebar está abierto, el contenido principal debe tener margen a la izquierda */
.content-wrapper {
  margin-left: 250px;
  transition: margin-left 0.3s ease;
}

/* Cuando sidebar colapsado, contenido se extiende */
.content-wrapper.expanded {
  margin-left: 0;
}

/* Ajuste responsive para pantallas pequeñas */
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

</style>
<!-- Sidebar colapsable -->
<!-- Sidebar colapsable -->
<nav id="sidebar" class="bg-theme-success text-white position-fixed vh-100" style="width: 250px; transition: transform 0.3s ease; z-index: 1050;">
  <div class="sidebar-header p-3">
    <h3>Recitur</h3>
    
  </div>
  <ul class="nav flex-column px-3">
    <li class="nav-item mb-2">
      <a class="nav-link text-white" href="#dashboard"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
    </li>
    <li class="nav-item mb-2">
      <a class="nav-link text-white" href="#perfil"><i class="fa fa-user me-2"></i>Perfil</a>
    </li>
    <li class="nav-item mb-2">
      <a class="nav-link text-white" href="#configuracion"><i class="fa fa-cogs me-2"></i>Configuración</a>
    </li>
    <li class="nav-item mb-2">
      <a class="nav-link text-white" href="#reportes"><i class="fa fa-chart-line me-2"></i>Reportes</a>
    </li>
    <li class="nav-item mt-4">
      <a class="nav-link text-white" href="#logout"><i class="fa fa-sign-out-alt me-2"></i>Cerrar sesión</a>
    </li>
  </ul>
</nav>

