<div class="sidebar">
  <nav class="sidebar-nav">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="#" @click="menu=0">
          <i class="nav-icon fa fa-dashboard"></i> MENU
          <!-- <span class="badge badge-info">NEW</span-->
        </a>
      </li>
      <!-- <li class="nav-title">Mantenimiento</li>-->
      <li class="nav-item">
            <a class="nav-link" @click="menu=1" href="#">
              <i class="nav-icon fa fa-handshake-o"></i>Gesti&oacuten Combustible</a>
          </li>
  
      <li class="nav-item nav-dropdown" >
        <a class="nav-link nav-dropdown-toggle" href="#">
          <i class="nav-icon fa fa-handshake-o"></i>Consumo de Energ&iacutea</a>
        <ul class="nav-dropdown-items">
          <li class="nav-item">
            <a class="nav-link" @click="menu=70" href="#">
              <i class="nav-icon fa fa-handshake-o"></i>Gesti&oacuten de Energ&iacutea</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" @click="menu=71" href="#">
              <i class="nav-icon fa fa-handshake-o"></i>Gesti&oacuten de Arrendatarios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" @click="menu=72" href="#">
              <i class="nav-icon fa fa-handshake-o"></i>Gesti&oacuten de Puestos</a>
          </li>
        </ul>
      </li>

    <!--  <li class="nav-item">
        <a class="nav-link" href="/portal" target="_blank">
          <i class="nav-icon fa fa-newspaper-o"></i> Portal</a>
      </li>
    
      <li class="nav-title">ACCESO</li>-->

      <li class="nav-item nav-dropdown" >  <!--id="nav-admin" -->
        <a class="nav-link nav-dropdown-toggle" href="#">
          <i class="nav-icon fa fa-user"></i> Usuario</a>
        <ul class="nav-dropdown-items">

          <li class="nav-item">
            <a class="nav-link" @click="menu=3" href="#">
              <i class="nav-icon fa fa-user"></i>Usuarios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" @click="menu=4" href="#">
              <i class="nav-icon fa fa-user"></i>Roles</a>
          </li>

        </ul>
      </li>
   
      
  <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
          <i class="nav-icon fa fa-book"></i>Bitacora</a>
        <ul class="nav-dropdown-items">
          <li class="nav-item">
            <a class="nav-link" @click="menu=50" href="#">
              <i class="nav-icon fa fa-book"></i>Bitacora</a>
          </li>
        </ul>
      </li>

 <!--

      <li class="nav-item">
        <a class="nav-link" @click="menu=5" href="#">
          <i class="fa fa-file-pdf-o nav-icon"></i>
          Transparencia</a>
      </li>
      <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
          <i class="nav-icon fa fa-envelope-open"></i>Solicitudes</a>
        <ul class="nav-dropdown-items">
          <li class="nav-item">
            <a class="nav-link" @click="menu=8" href="#">
              <i class="nav-icon fa fa-envelope-open-o"></i>Solicitud documentos</a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link" @click="menu=9" href="#">
              <i class="nav-icon fa fa-envelope-open-o"></i>Solicitud partidas</a>
          </li>
         
        </ul>
      </li>
      
      <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
          <i class="nav-icon fa fa-handshake-o"></i>servicios</a>
        <ul class="nav-dropdown-items">
          <li class="nav-item">
            <a class="nav-link" @click="menu=10" href="#">
              <i class="nav-icon fa fa-handshake-o"></i>Servicios municipales</a>
          </li>
        </ul>
      </li>
      
      <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
          <i class="nav-icon fa fa-handshake-o"></i>Partidas</a>
        <ul class="nav-dropdown-items">
          <li class="nav-item">
            <a class="nav-link" @click="menu=11" href="#">
              <i class="nav-icon fa fa-handshake-o"></i>Partidas de Nacimiento</a>
          </li>
        </ul>
        <ul class="nav-dropdown-items">
          <li class="nav-item">
            <a class="nav-link" @click="menu=12" href="#">
              <i class="nav-icon fa fa-handshake-o"></i>Partidas de Defunción</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" @click="menu=16" href="#">
              <i class="nav-icon fa fa-handshake-o"></i>Partidas de matrimonio</a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link" @click="menu=23" href="#">
          <i class="fa fa-file-text nav-icon"></i>
          Manuales</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" @click="menu=30" href="#">
          <i class="nav-icon fa fa-image"></i> Carrusel / Slider</a>
      </li>

      <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
          <i class="nav-icon fa fa-book"></i>Bitacora</a>
        <ul class="nav-dropdown-items">
          <li class="nav-item">
            <a class="nav-link" @click="menu=50" href="#">
              <i class="nav-icon fa fa-book"></i>Bitacora</a>
          </li>
        </ul>
      </li>

      <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
          <i class="nav-icon fa fa-book"></i>Contactos</a>
        <ul class="nav-dropdown-items">
          <li class="nav-item">
            <a class="nav-link" @click="menu=60" href="#">
              <i class="nav-icon fa fa-book"></i>Contactos</a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link" @click="menu=61" href="#">
          <i class="nav-icon fa fa-newspaper-o"></i> Preguntas frecuentes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" @click="menu=62" href="#">
          <i class="nav-icon fa fa-sitemap"></i>Organigramas</a>
      </li>
    </ul>
  -->
  </nav>
  <button class="sidebar-minimizer brand-minimizer" type="button"> </button>
</div>