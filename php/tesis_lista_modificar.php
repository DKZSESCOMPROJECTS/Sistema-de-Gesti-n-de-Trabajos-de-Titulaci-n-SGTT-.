<?php
$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
$tabla = "";
$url = "index.php?vista=modificartesis&page=";


    // Consulta general de tesis
    $consulta_datos = "SELECT * FROM documentot ORDER BY Id_Tesis ASC LIMIT $inicio, $registros";
    $consulta_total = "SELECT COUNT(Id_Tesis) FROM documentot";


// Establecer conexión
$conexion = conexion();

// Obtener datos de la consulta
$resultado_datos = $conexion->query($consulta_datos);
$datos = $resultado_datos->fetch_all(MYSQLI_ASSOC);

// Contar el total de registros
$resultado_total = $conexion->query($consulta_total);
$total = (int) $resultado_total->fetch_row()[0];

$Npaginas = ceil($total / $registros);
echo "URL generada: " . $url;

// Construir tabla
$tabla .= '
<div class="table-container">
    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr class="has-text-centered">
                <th>#</th>
                <th>Titulo</th>
                <th>Resumen</th>
                <th>Palabras clave</th>
                <th>Id Carrera</th>
                <th colspan="1">Consultar</th>
            </tr>
        </thead>
        <tbody>
';

if ($total >= 1 && $pagina <= $Npaginas) {
    $contador = $inicio + 1;
    $pag_inicio = $inicio + 1;
    foreach ($datos as $rows) {
        $tabla .= '
            <tr class="has-text-centered">
                <td>' . $contador . '</td>
                <td>' . $rows['Titulo'] . '</td>
                <td>' . $rows['Resumen'] . '</td>
                <td>' . $rows['Palabras_Clave'] . '</td>
                <td>' . $rows['Id_Carrera'] . '</td>
                <td>
                    <a href="index.php?vista=tesis_update&T_id=' . $rows['Id_Tesis'] . '" 
                        class="button is-success is-rounded is-small">Modificar</a>
                </td>
            </tr>
        ';
        $contador++;
    }
    $pag_final = $contador - 1;
} else {
    if ($total >= 1) {
        $tabla .= '
            <tr class="has-text-centered">
                <td colspan="7">
                    <a href="' . $url . '1" class="button is-link is-rounded is-small mt-4 mb-4">
                        Haga clic acá para recargar el listado
                    </a>
                </td>
            </tr>
        ';
    } else {
        $tabla .= '
            <tr class="has-text-centered">
                <td colspan="7">
                    No hay registros en el sistema
                </td>
            </tr>
        ';
    }
}

$tabla .= '</tbody></table></div>';

if ($total > 0 && $pagina <= $Npaginas) {
    $tabla .= '<p class="has-text-right">Mostrando tesis <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un <strong>total de ' . $total . '</strong></p>';
}

$conexion->close(); // Cerrar conexión
echo $tabla;

if ($total >= 1 && $pagina <= $Npaginas) {
    echo paginador_tablas($pagina, $Npaginas, $url, 7);
}
?>
