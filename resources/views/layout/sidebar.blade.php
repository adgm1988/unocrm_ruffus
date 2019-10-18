 <!-- Sidebar -->
    <ul class="sidebar navbar-nav static-top" >

      <li class="nav-item">
        <a class="nav-link" href="/dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Tablero</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/calendar">
          <i class="fas fa-calendar-alt"></i>
          <span>Calendario</span>
        </a>
      </li>
  
    
      @if(auth::user()->vendedor !=1)
      <li class="nav-item">
        <a class="nav-link" href="/reportes">
          <i class="fas fa-fw fa-signal"></i>
          <span>Reportes</span>
        </a>
      </li>
      @endif
      <!--
      @if(auth::user()->vendedor ==1)
      <li class="nav-item">
        <a class="nav-link" href="/reportes">
          <i class="fas fa-fw fa-signal"></i>
          <span>Reportes vendedor</span>
        </a>
      </li>
      @endif
    -->
      <li class="nav-item">
        <a class="nav-link" href="/prospectos">
          <i class="fas fa-fw fa-users"></i>
          <span>Prospectos</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/clientes">
          <i class="fas fa-fw fa-user-check"></i>
          <span>Clientes</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/perdidos">
          <i class="fas fa-fw fa-user-times"></i>
          <span>Perdidos</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/ventas">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Ventas</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/actividades">
          <i class="fas fa-fw fa-tasks"></i>
          <span>Actividades</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/bitacoras">
          <i class="fas fa-archive"></i>
          <span>Bitácoras</span>
        </a>
      </li>

      @if(!auth::user()->vendedor ==1)
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Catálogos</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <!--
          <h6 class="dropdown-header">Login Screens:</h6>
          <a class="dropdown-item" href="login.html">Login</a>
          <a class="dropdown-item" href="register.html">Register</a>
          <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
          <div class="dropdown-divider"></div>

          <h6 class="dropdown-header">Other Pages:</h6>
          <a class="dropdown-item" href="404.html">404 Page</a>
          <a class="dropdown-item" href="blank.html">Blank Page</a>
          -->
          <a class="dropdown-item" href="/users">Usuarios</a>

          @if(auth::user()->admin ==1 || auth::user()->consultor ==1)
            <a class="dropdown-item" href="/etapas">Etapas</a>
            <a class="dropdown-item" href="/tipoacts">Tipos de actividad</a>
            <a class="dropdown-item" href="/procedencias">Procedencias</a>
            <a class="dropdown-item" href="/industrias">Industrias</a>
            <a class="dropdown-item" href="/motivos">Motivos rechazo</a>
          @endif

        </div>
      </li>
      @endif
      <!--
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li>
    -->
    </ul>