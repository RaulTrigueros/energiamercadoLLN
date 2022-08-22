<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Portal web alcaldía municipal de san pablo tacachico">
  <meta name="author" content="">

  <title>Alcaldía SPT</title>

  <!-- Custom fonts for this theme -->
  <link href="css/general.css" rel="stylesheet">
  <link href="css/portal/portal.css" rel="stylesheet">

  <link href="css/stellarnav.css" rel="stylesheet">
  <link href="css/jquery.fancybox.min.css" rel="stylesheet">


  <link href="https://fonts.googleapis.com/css?family=Bitter&display=swap" rel="stylesheet">


  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top  " id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="/"><img src="img/isotipo_blanco.png" alt="logo" width="80px" height="110px"></a>
      <div class=" stellarnav" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
 <!--
          <li class=" ml-auto"><a href="#">Servicios</a>
            <ul>
              <li><a href="/solicitudinsumo">Solicitud de insumo</a></li>
              
              <li><a href="/solicitudPartidaRegistro">Registro Familiar</a></li>
              <li><a href="#">Programas</a>
               <ul>
                  <li><a href="/competencias">Competencias</a></li>
                  <li><a href="/talleres">Talleres</a></li>
                </ul> 
              </li>
              <li><a href="/servicioportal">Catastro Tributario</a></li>
              <li><a href="/servicioportal">Mantenimiento Muncipal</a></li>
              
            </ul>
          </li>
          <li class=" "><a href="#">Noticias</a>
            <ul>
              <li><a href="/anuncioportal">Anuncios</a></li>
              <li><a href="/noticiaportal">Noticias</a></li>
            </ul>-->

          </li>

          <li class=" "><a href="#">Alcaldía</a>
            <ul>
              <!--<li><a href="/organigramaportal">Estructura Organizativa</a></li>-->
              <li><a href="/mision">Misión y Visión</a></li>
            </ul>
          </li>

          <li class="">
            <a class="" href="/login" id="linkL">Iniciar Sesión</a>
          </li>
          
        </ul>
      </div>
    </div>
  </nav>
  <div style="margin-top:80px" id="app">
    @yield('contenido')
  </div>

  <!-- Footer -->
  <footer class="footer text-center mt-5">
    <div class="container">
      <div class="row">

        <!-- Footer Location -->
        <div class="col-lg-4 mb-5 mb-lg-0">
          <h4 class="text-uppercase mb-4">Ubicación</h4>
          <p class="lead mb-0">Av. Vilanova, Barrio El Centro – Alcaldía Municipal de San Pablo Tacachico</p>
        </div>

        <!-- Footer Social Icons -->
        <div class="col-lg-4 mb-5 mb-lg-0">
          <h4 class="text-uppercase mb-4">Alrededor de la Web</h4>
          <a class="btn btn-outline-light btn-social mx-1" href="https://www.facebook.com/amtacachico" target="_black">
            <i class="fa fa-fw fa-facebook-f"></i>
          </a>
          <!-- <a class="btn btn-outline-light btn-social mx-1" href="#">
            <i class="fa fa-fw fa-twitter"></i>
          </a> -->
          <a class="btn btn-outline-light btn-social mx-1" href="https://www.instagram.com/amtacachico/" target="_black">
            <i class="fa fa-fw fa-instagram"></i>
          </a>
          <a class="btn btn-outline-light btn-social mx-1" href="tel:+(503)2445-9800" target="_black">
            <i class="fa fa-phone"></i>
          </a>
        </div>

        <!-- Footer About Text -->
        <div class="col-lg-4">
          <h4 class="text-uppercase mb-4">Acerca de</h4>
          <p class="lead mb-0">Alcaldía Municipal de San Pablo Tacachico

            <a href="https://www.transparencia.gob.sv/institutions/san-pablo-tacachico-la-libertad" target="_black">Ver</a>.</p>

          <p class="lead mb-0">Nuestra misión y visión.

            <a href="/mision" target="_black">Ver</a>.</p>



        </div>

      </div>
    </div>
  </footer>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
  <script src="js/general.js"></script>
  <script src="js/portal/portal.js"></script>
  <script src="js/app.js"></script>

  <script src="js/stellarnav.js"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      jQuery('.stellarnav').stellarNav({
        theme: 'light',
        breakpoint: 960,
        position: 'right',
        phoneBtn: '26505050',
        locationBtn: 'https://www.google.com/maps/place/San+Antonio+Masahuat/@13.5681857,-89.0423226,16z/data=!3m1!4b1!4m5!3m4!1s0x8f634b6a3f1eab65:0x45fdedd891c65c23!8m2!3d13.5671565!4d-89.0376448'
      });
    });
  </script>
  <script src="js/jquery.fancybox.min.js"></script>

</body>

</html>