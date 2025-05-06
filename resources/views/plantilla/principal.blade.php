<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Alcaldia SPT</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="css/general.css" rel="stylesheet">
  <link href="css/dashboard/dashboard.css" rel="stylesheet">
  <link href="css/portal/portal.css" rel="stylesheet">
  <link href="css/jquery.fancybox.min.css" rel="stylesheet">

  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
  <div id="app">
    <header class="app-header navbar">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="/main">
        <img class="navbar-brand-full" src="img/logo.png" width="30" height="35" alt="LogoSPT">
        <img class="navbar-brand-minimized" src="img/logo.png" width="30" height="30" alt="LogoSPT">
      </a>
      <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
          <a class="nav-link" href="#">Menu</a>
        </li>
        <!-- <li class="nav-item px-3">
                <a class="nav-link" href="#">Configuraciones</a>
        </li>-->
      </ul>
      <ul class="nav navbar-nav ml-auto">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" style="cursor:pointer">
            <img class="navbar-brand-full" src="img/logo.png" width="30" height="35" alt="sam">
            <span class="d-md-down-none">{{Auth::user()->usuario}} </span>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong>Cuenta</strong>
            </div>
             <a class="dropdown-item" href="{{url('user/password')}}">
              <i class="fa fa-key"> </i> Cambiar Contraseña</a> 
              <a class="dropdown-item" href="/logout">
              <i class="fa fa-lock"></i> Cerrar sesión</a>
          </div>
        </li>

      </ul>


    </header>



    <div class="app-body">
          @if (Auth::check())
              @if(Auth::user()->idrol==1)
                  @include('plantilla.sidebar')
              @elseif(Auth::user()->idrol==2)
                  @include('plantilla.sidebarenergia')
              @elseif(Auth::user()->idrol==3)
                  @include('plantilla.sidebarcombustible')
              @else
              @endif
          @endif
      
      <!-- Contenido Principal -->
      <main class="main">
        <!-- Breadcrumb-->

        @yield('contenido')
      </main>


    </div>
  </div>

  <footer class="app-footer mt-5">
    <div>
      <a href="#">LaLibertadNorte</a>
      <span>&copy; 2024</span>
    </div>
    
  </footer>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js">
  </script>
  <script src="js/app.js"></script>
  <script src="js/general.js"></script>
  <script src="js/dashboard/dashboard.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script src="js/jquery.fancybox.min.js"></script>
</body>

</html>