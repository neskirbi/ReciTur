<style>
       

        .navbar-custom {
            background-color:rgb(240, 240, 240);
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
        }
    </style>
    
   <!-- NAVBAR BLANCO -->
<div class="navbar-custom" style="display: flex; align-items: center; padding: 0.5rem 1rem;">
  <!-- Logo -->
  <a class="navbar-brand" href="{{url('homec')}}" style="display: flex; align-items: center; margin-right: 0.5rem;">
    <img src="{{asset('images').'/reciturlogo1.png'}}" alt="" height="45px">
  </a>

  <!-- Botón de colapso junto al logo -->
  <button id="sidebarCollapse" class="btn btn-theme-outline-gray btn-sm me-auto">
    <i class="fa fa-bars"></i>
  </button>

  <!-- Navegación -->
  <nav class="navbar navbar-expand-md navbar-light ms-auto">
    <button class="navbar-toggler" id="navbar-toggler">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto extra-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{url('homec')}}">
            <i class="fas fa-home" style="color: #6D1732"></i> Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('logout')}}">
            <i class="fa fa-sign-out" aria-hidden="true"></i> Salir
          </a>
        </li>
      </ul>
    </div>
  </nav>
</div>

