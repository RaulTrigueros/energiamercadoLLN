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
          <i class="nav-icon fa fa-handshake-o"></i>Gestion de Combustible</a>
        <ul class="nav-dropdown-items">
          <li class="nav-item">
            <a class="nav-link" @click="menu=1" href="#">
              <i class="nav-icon fa fa-handshake-o"></i>Combustible</a>
          </li>
       
        </ul>
      </li>
  
  </nav>
  <button class="sidebar-minimizer brand-minimizer" type="button"> </button>
</div>