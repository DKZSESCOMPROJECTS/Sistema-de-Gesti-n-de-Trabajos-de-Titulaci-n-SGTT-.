<div class="container is-fluid mb-6 custom-background">
    <h2 class="subtitle custom-subtitle">Formulario para modificar una tesis</h2>
</div>
<?php
require_once "./php/main.php";
include "./inc/btn_back.php";
if ($_SESSION['nombre'] != 'Administrador') {
    header("Location: index.php?vista=sinpermiso");// Redirige a sinpermiso.php
    exit(); // Asegura que el script se detenga después de la redirección
}else{

// Obtener y limpiar el ID de la tesis
$id = (isset($_GET['T_id'])) ? $_GET['T_id'] : 0;
$id = limpiar_cadena($id);

// Conexión a la base de datos
$conexion = conexion();

// Consultar datos de la tesis
$check_tesis = $conexion->query("SELECT * FROM documentot WHERE Id_Tesis = '$id'");
if ($check_tesis->num_rows > 0) {
    $tesis = $check_tesis->fetch_assoc(); // Datos de la tesis
} else {
    header("Location: ./error.php"); // Redirigir si no existe la tesis
    exit();
}

// Consultar boleta del autor relacionada con la tesis
$check_boleta = $conexion->query("SELECT boleta FROM tesis_autor WHERE Id_Tesis = '$id'");
if ($check_boleta->num_rows > 0) {
    $boleta_data = $check_boleta->fetch_assoc();
    $boleta = $boleta_data['boleta'];

    // Consultar datos del autor
    $check_autor = $conexion->query("SELECT * FROM autor WHERE boleta = '$boleta'");
    if ($check_autor->num_rows > 0) {
        $autor = $check_autor->fetch_assoc(); // Datos del autor
    } else {
        $autor = null;
    }
} else {
    $autor = null; // Si no hay autor relacionado
}
?>

<div class="container pb-6 pt-6">
    <form action="./php/tesis_actualizar.php" method="POST" enctype="multipart/form-data" class="form">
            
    
    <!-- Sección para modificar los datos del autor -->
        <h2 class="title">Datos del Autor</h2>
        <?php if ($autor): ?>
            <input type="hidden" name="boleta" value="<?= htmlspecialchars($autor['boleta']) ?>">

            <div class="field">
                <label class="label">Nombre(s)</label>
                <div class="control">
                    <input class="input" type="text" name="nombre" value="<?= htmlspecialchars($autor['nombre']) ?>" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Apellidos</label>
                <div class="control">
                    <input class="input" type="text" name="apellidos" value="<?= htmlspecialchars($autor['apellidos']) ?>" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Correo Electrónico</label>
                <div class="control">
                    <input class="input" type="email" name="correo" value="<?= htmlspecialchars($autor['correo']) ?>" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Número de Teléfono</label>
                <div class="control">
                    <input class="input" type="text" name="telefono" value="<?= htmlspecialchars($autor['telefono']) ?>" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Carrera</label>
                <div class="control">
                    <select class="input" name="Id_carrera" required>
                        <option value="1" <?= ($autor['Id_carrera'] == 1) ? 'selected' : '' ?>>Ingeniería en Sistemas</option>
                        <option value="2" <?= ($autor['Id_carrera'] == 2) ? 'selected' : '' ?>>Ingeniería en Inteligencia Artificial</option>
                        <option value="3" <?= ($autor['Id_carrera'] == 3) ? 'selected' : '' ?>>Licenciatura en Ciencia de Datos</option>
                    </select>
                </div>
            </div>
        <?php else: ?>
            <p class="help is-danger">No se encontraron datos del autor relacionado con esta tesis.</p>
        <?php endif; ?>   
    
    <!-- Sección para modificar los datos de la tesis -->
        <h2 class="title">Datos de la Tesis</h2>
        <input type="hidden" name="Id_Tesis" value="<?= htmlspecialchars($tesis['Id_Tesis']) ?>">

        <div class="field">
            <label class="label">Título</label>
            <div class="control">
                <input class="input" type="text" name="Titulo" value="<?= htmlspecialchars($tesis['Titulo']) ?>" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Resumen</label>
            <div class="control">
                <textarea class="textarea" name="Resumen" required><?= htmlspecialchars($tesis['Resumen']) ?></textarea>
            </div>
        </div>

        <div class="field">
            <label class="label">Fecha de Publicación</label>
            <div class="control">
                <input class="input" type="date" name="Fecha_Publicacion" value="<?= htmlspecialchars($tesis['Fecha_Publicacion']) ?>" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Palabras Clave</label>
            <div class="control">
                <input class="input" type="text" name="Palabras_Clave" value="<?= htmlspecialchars($tesis['Palabras_Clave']) ?>" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Asesor</label>
            <div class="control">
                <input class="input" type="text" name="Asesor" value="<?= htmlspecialchars($tesis['Asesor']) ?>" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Documento PDF</label>
            <div class="control">
                <input class="file-input" type="file" name="Archivo">
                <p class="help">Haz click aqui si quieres modificar el archivo</p>
            </div>
        </div>


        <!-- Botón para guardar cambios -->
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Guardar Cambios</button>
            </div>
        </div>
    </form>
</div>
        
<?php
// Liberar memoria y cerrar la conexión
$check_tesis->free();
if (isset($check_boleta)) $check_boleta->free();
if (isset($check_autor)) $check_autor->free();
$conexion->close();}
?>
