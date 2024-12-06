<?php
// Primero incluimos el archivo main.php que contiene funciones necesarias
require_once "./php/main.php";
?>

<div class="container is-fluid mb-6">
    <h1 class="title">Repositorio</h1>
    <h2 class="subtitle">Lista de tesis</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
    // Configuración de paginación y búsqueda
    $pagina = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if($pagina <= 1) {
        $pagina = 1;
    }

    // Limpiamos las variables
    $pagina = limpiar_cadena($pagina);
    $url = "index.php?vista=Todo&page=";
    $registros = 5;
    $busqueda = isset($_GET['search']) ? limpiar_cadena($_GET['search']) : '';

    // Incluimos el archivo que genera la lista de tesis
    require_once "./php/tesis_lista_modificar.php";
    ?>
</div>