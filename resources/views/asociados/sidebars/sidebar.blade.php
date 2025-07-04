<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('images/logo.png')}}" alt="Reci-Track" class="brand-image elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Reci-Track</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition"><div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer"></div></div><div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 353px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;"><div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!--<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::guard('asociados')->user()->asociado}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form 
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div><div class="sidebar-search-results"><div class="list-group"><a href="#" class="list-group-item"><div class="search-title"><strong class="text-light"></strong>N<strong class="text-light"></strong>o<strong class="text-light"></strong> <strong class="text-light"></strong>e<strong class="text-light"></strong>l<strong class="text-light"></strong>e<strong class="text-light"></strong>m<strong class="text-light"></strong>e<strong class="text-light"></strong>n<strong class="text-light"></strong>t<strong class="text-light"></strong> <strong class="text-light"></strong>f<strong class="text-light"></strong>o<strong class="text-light"></strong>u<strong class="text-light"></strong>n<strong class="text-light"></strong>d<strong class="text-light"></strong>!<strong class="text-light"></strong></div><div class="search-path"></div></a></div></div>
      </div>-->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          
          <li class="nav-header">Asociación</li>
         
          <!--<li class="nav-header">Panel de Control</li>-->
         

         

          

          <li class="nav-item">
            <a href="{{ url('etransporte') }}" class="nav-link">
            <i class="nav-icon fa fa-truck" aria-hidden="true"></i>
              <p>
                E. Transporte
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{ url('recolectores') }}" class="nav-link">
            <i class="nav-icon fa fa-group" aria-hidden="true"></i>
              <p>
                Recolectores
              </p>
            </a>
          </li>




          


          <li class="nav-item">
            <a href="{{ url('generador') }}" class="nav-link">
              <i class="nav-icon fa fa-group" aria-hidden="true"></i>
              <p>
                Generadores
              </p>
            </a>
          </li>
          

         

          


          <li class="nav-item">
            <a href="{{url('logout')}}" class="nav-link">
            <i class="nav-icon fa fa-arrow-left" aria-hidden="true"></i>
              <p>
                Cerrar sesión
              </p>
            </a>
          </li>
          
          
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="height: 26.087%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>
    <!-- /.sidebar -->
  </aside>