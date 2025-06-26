<style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

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
                z-index: 100000;
            }
        }
        
      
    </style>
    
    <!-- NAVBAR BLANCO -->
    <div class="navbar-custom">
        <a class="navbar-brand" href="{{url('home')}}">
            <img src="{{asset('images').'/reciturlogo1.png'}}" alt="" height="45px">            
        </a>
        
        <nav class="navbar navbar-expand-md navbar-light">
            <button class="navbar-toggler" id="navbar-toggler">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto extra-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('registropage')}}">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> Registrarse
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('loginpage')}}">
                            <i class="fa fa-user-o" aria-hidden="true"></i> Ingresar
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>