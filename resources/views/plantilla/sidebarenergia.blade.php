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
              <i class="nav-icon fa fa-handshake-o"></i>Gesti&oacuten de Arrendatarios </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" @click="menu=72" href="#">
              <i class="nav-icon fa fa-handshake-o"></i>Gesti&oacuten de Puestos</a>
          </li>
        </ul>
      </li>

  </nav>
  <button class="sidebar-minimizer brand-minimizer" type="button"> </button>
</div>