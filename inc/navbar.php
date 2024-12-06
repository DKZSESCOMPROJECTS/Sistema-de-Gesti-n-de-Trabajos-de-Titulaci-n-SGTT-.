<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="http://localhost/mi_proyecto/index.php?vista=home">
      <img src="./img/LOGO1.png" width="70" height="40">
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

    <div id="navbarBasicExample" class="navbar-menu">
      <div class="navbar-start">

          <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">ACCIONES</a>

                  <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=nuevatesis">Nueva Tesis </a>
                    <a class="navbar-item" href="index.php?vista=modificartesis">Modificar tesis</a>
            </div>
        </div>
        <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">CONSULTAR POR:</a>

                  <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=Buscador_Nombre_E">Buscador</a>
                    <a class="navbar-item" href="index.php?vista=Todo">Mostrar todas</a>
            </div>
        </div>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary is-rounded">
            MI CUENTA
          </a>
          <a href="index.php?vista=logout" class="button is-link is-rounded">
            SALIR
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>
