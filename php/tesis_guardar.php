<?php 
require_once "main.php";

# Almacenando datos del usuario
$boleta = limpiar_cadena($_POST['boleta']);
$nombret = limpiar_cadena($_POST['T_nombre']);
$apellidot = limpiar_cadena($_POST['T_apellido']);
$telefono =  limpiar_cadena($_POST['numtel']);
$correo = limpiar_cadena($_POST['ucorreo']);
$id_carrera = limpiar_cadena($_POST['carrera_id']);

# Guardar datos de la tesis
$ttitulo = limpiar_cadena($_POST['tesis_titulo']);
$tasesor = limpiar_cadena($_POST['tesis_asesor']);
$fecha = limpiar_cadena($_POST['fecha']);
$tpc = limpiar_cadena($_POST['palabras_clave']);
$tresumen = limpiar_cadena($_POST['tesis_resumen']);

# Manejar la subida del archivo
$directorio_subida = '../uploads/';
$nombre_archivo_original = $_FILES['tesis_pdf']['name'];
$extension_archivo = pathinfo($nombre_archivo_original, PATHINFO_EXTENSION); // Extraer la extensión

# Generar el nuevo nombre del archivo
$tarchivo = preg_replace('/[^A-Za-z0-9_\-]/', '_', limpiar_cadena($_POST['tesis_titulo']));
$nombre_archivo = $ttitulo . '.' . $extension_archivo;
$ruta_archivo = $directorio_subida . $nombre_archivo;



$tarchivo = preg_replace('/[^A-Za-z0-9_\-]/', '_', limpiar_cadena($_POST['tesis_titulo']));
$nombre_archivo = $ttitulo . '.' . $extension_archivo;



# Subir el archivo
if (move_uploaded_file($_FILES['tesis_pdf']['tmp_name'], $ruta_archivo)) {
    // Archivo subido correctamente
    $ruta_para_bd = "uploads/" . $nombre_archivo; // Ruta relativa para guardar en la base de datos
} else {
    // Error al subir el archivo
    echo '<div class="notification is-danger is-light"><strong>Error al subir el archivo.</strong></div>';
    exit;
}

# Conexión a la base de datos

$conexion = conexion();

# Consulta para guardar el autor
$query_autor = $conexion->query("INSERT INTO autor(boleta, nombre, apellidos, correo, telefono, Id_carrera) 
VALUES ('$boleta', '$nombret', '$apellidot', '$correo', '$telefono', '$id_carrera')");

if ($query_autor) {
    echo '
        <div class="notification is-info is-light">
            <strong>AUTOR REGISTRADO!</strong><br>
            El AUTOR se registró con éxito
        </div>
    ';} else {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No se pudo registrar el usuario, por favor intente nuevamente
        </div>
    ';}

// Consulta para guardar la tesis
$query_tesis = $conexion->query("INSERT INTO documentot(Titulo, Resumen, Fecha_Publicacion, Palabras_Clave, Id_Carrera, Asesor, Archivo) 
VALUES ('$ttitulo', '$tresumen', '$fecha', '$tpc', '$id_carrera', '$tasesor', '$ruta_para_bd')");

if ($query_tesis) {
    // Recuperar el último ID autogenerado
    $Id_tesis = $conexion->insert_id;
    echo "$Id_Tesis";

    // Consulta para guardar datos en la tabla de tesis_autor
    $query_TyA = $conexion->query("INSERT INTO tesis_autor(Id_Tesis, boleta) 
    VALUES('$Id_tesis', '$boleta')");

    if ($query_TyA) {
        echo '
            <div class="notification is-info is-light">
                <strong>REGISTRO COMPLETO!</strong><br>
                El trabajo se registraron con éxito
            </div>
        ';
    }
} else {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No se pudo registrar el trabajo, por favor intente nuevamente
        </div>
    ';
}

# Cierre de la conexión
$conexion->close();


