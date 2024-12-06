<?php
require_once "main.php";

# Obtener y limpiar datos del formulario
$Id_tesis = limpiar_cadena($_POST['Id_Tesis']);
$boleta = limpiar_cadena($_POST['boleta']);
$nombret = limpiar_cadena($_POST['nombre']);
$apellidot = limpiar_cadena($_POST['apellidos']);
$telefono = limpiar_cadena($_POST['telefono']);
$correo = limpiar_cadena($_POST['correo']);
$id_carrera = limpiar_cadena($_POST['Id_carrera']);

$ttitulo = limpiar_cadena($_POST['Titulo']);
$tasesor = limpiar_cadena($_POST['Asesor']);
$fecha = limpiar_cadena($_POST['Fecha_Publicacion']);
$tpc = limpiar_cadena($_POST['Palabras_Clave']);
$tresumen = limpiar_cadena($_POST['Resumen']);

# Manejar la subida del archivo (opcional)
$directorio_subida = '../uploads/';
$archivo_subido = false;
if (isset($_FILES['Archivo']) && $_FILES['Archivo']['size'] > 0) {
    $nombre_archivo_original = $_FILES['Archivo']['name'];
    $extension_archivo = pathinfo($nombre_archivo_original, PATHINFO_EXTENSION); // Extraer la extensión

    # Generar el nuevo nombre del archivo
    $nombre_archivo = preg_replace('/[^A-Za-z0-9_\-]/', '_', $ttitulo) . '.' . $extension_archivo;
    $ruta_archivo = $directorio_subida . $nombre_archivo;

    if (move_uploaded_file($_FILES['Archivo']['tmp_name'], $ruta_archivo)) {
        $ruta_para_bd = "uploads/" . $nombre_archivo; // Ruta relativa para guardar en la base de datos
        $archivo_subido = true;
    } else {
        echo '<div class="notification is-danger is-light"><strong>Error al subir el archivo.</strong></div>';
        exit;
    }
}

# Conexión a la base de datos
$conexion = conexion();

# Actualizar datos del autor
$query_autor = $conexion->query("
    UPDATE autor 
    SET nombre = '$nombret', apellidos = '$apellidot', correo = '$correo', telefono = '$telefono', Id_carrera = '$id_carrera' 
    WHERE boleta = '$boleta'
");

if ($query_autor) {
    echo '
        <div class="notification is-info is-light">
            <strong>AUTOR ACTUALIZADO!</strong><br>
            El autor se actualizó con éxito
        </div>
    ';
} else {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Error inesperado!</strong><br>
            No se pudo actualizar el autor, por favor intente nuevamente
        </div>
    ';
}

# Actualizar datos de la tesis
$update_tesis_query = "
    UPDATE documentot 
    SET Titulo = '$ttitulo', Resumen = '$tresumen', Fecha_Publicacion = '$fecha', Palabras_Clave = '$tpc', 
        Asesor = '$tasesor'";

# Si se subió un nuevo archivo, agregar la ruta al query
if ($archivo_subido) {
    $update_tesis_query .= ", Archivo = '$ruta_para_bd'";
}

$update_tesis_query .= " WHERE Id_Tesis = '$Id_tesis'";

$query_tesis = $conexion->query($update_tesis_query);

if ($query_tesis) {
    echo '
        <div class="notification is-info is-light">
            <strong>TESIS ACTUALIZADA!</strong><br>
            La tesis se actualizó con éxito
        </div>
    ';
} else {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Error inesperado!</strong><br>
            No se pudo actualizar la tesis, por favor intente nuevamente
        </div>
    ';
}

# Cerrar la conexión
$conexion->close();
?>
