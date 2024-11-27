<?php
require_once "./php/main.php";
include "./inc/btn_back.php";

// Obtener y limpiar el ID de la tesis
$id = (isset($_GET['T_id'])) ? $_GET['T_id'] : 0;
$id = limpiar_cadena($id);

// Conexión a la base de datos
$conexion = conexion();

// Consultar datos de la tesis
$check_tesis = $conexion->query("SELECT * FROM documentot WHERE Id_Tesis = '$id'");
$check_boleta = $conexion->query("SELECT boleta FROM tesis_autor WHERE Id_Tesis = '$id'");
if ($check_boleta->num_rows > 0) {
    // Extraer el valor de boleta
    $fila_boleta = $check_boleta->fetch_assoc();
    $boleta = $fila_boleta['boleta'];

    // Usar el número de boleta para obtener los datos del autor
    $check_autor = $conexion->query("SELECT * FROM autor WHERE boleta = '$boleta'");}

?>


<div class="container pb-6 pt-6">


<?php if ($check_tesis->num_rows > 0): ?>
    <section class="section">
        <div class="container">
            <h1 class="title">Tesis</h1>
            <table class="table is-striped is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th>ID Tesis</th>
                        <th>Título</th>
                        <th>Resumen</th>
                        <th>Fecha de Publicación</th>
                        <th>Palabras Clave</th>
                        <th>Asesor</th>
                        <th>Documento PDF</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $check_tesis->fetch_assoc()): ?>
                        <tr>
                            <td><?= $fila['Id_Tesis'] ?></td>
                            <td><?= $fila['Titulo'] ?></td>
                            <td><?= $fila['Resumen'] ?></td>
                            <td><?= $fila['Fecha_Publicacion'] ?></td>
                            <td><?= $fila['Palabras_Clave'] ?></td>
                            <td><?= $fila['Asesor'] ?></td>
                            <td>
                                <a href="<?= $fila['Documento_PDF'] ?>" target="_blank" class="button is-link is-small">
                                    Ver PDF
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="container">
    <h1 class="title">Autores</h1>
    <table class="table is-striped is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th>Boleta</th>
                <th>Nombre(s)</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Número de Teléfono</th>
                <th>Carrera</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = $check_autor->fetch_assoc()): ?>
                <tr>
                    <td><?= $fila['boleta'] ?></td>
                    <td><?= $fila['nombre'] ?></td>
                    <td><?= $fila['apellidos'] ?></td>
                    <td><?= $fila['correo'] ?></td>
                    <td><?= $fila['telefono'] ?></td>
                    <td>
                        <?php 
                            if ($fila['Id_carrera'] == 1) {
                                echo "Ingeniería en Sistemas";
                            } elseif ($fila['Id_carrera'] == 2) {
                                echo "Ingeniería en Inteligencia Artificial";
                            } elseif ($fila['Id_carrera'] == 3) {
                                echo "Licenciatura en Ciencia de Datos";
                            } else {
                                echo "Carrera desconocida";
                            }
                        ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>



    </section>
<?php else: ?>
    <?php include_once "./inc/error.php"; ?>
<?php endif; ?>

<?php
// Liberar memoria y cerrar la conexión
$check_tesis->free();
$check_boleta->free();
$check_autor->free(); 
$conexion->close();
?>
</div>
