<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="http://localhost/mi_proyecto/index.php?vista=consulta">
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
            <a class="navbar-link">CONSULTAR POR:</a>

                  <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=Buscador_Nombre_E">Nombre del estudiante</a>
                    <a class="navbar-item" href="index.php?vista=Buscador_KeyWords">Palabras clave</a>
                    <a class="navbar-item" href="index.php?vista=Basesor">Asesor</a>
                    <a class="navbar-item" href="index.php?vista=Todo">Mostrar todas</a>
            </div>
        </div>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
            <a href="index.php?vista=login" class="button is-link is-rounded">
            Mi cuenta
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>
