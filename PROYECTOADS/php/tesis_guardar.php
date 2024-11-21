<?php
require_once "main.php";
# Almacenando datos del usuario
$boleta = limpiar_cadena($_POST['boleta']);
$nombret = limpiar_cadena($_POST['T_nombre']);
$apellidot = limpiar_cadena($_POST['T_apellido']);
$telefono = limpiar_cadena($_POST['numtel']);
$correo = limpiar_cadena($_POST['ucorreo']);
$id_carrera = limpiar_cadena($_POST['carrera_id']);

# Guardar datos de la tesis
$ttitulo = limpiar_cadena($_POST['tesis_titulo']);
$tasesor = limpiar_cadena($_POST['tesis_asesor']);
$fecha = limpiar_cadena($_POST['fecha']);
$tpc = limpiar_cadena($_POST['palabras_clave']);
$tresumen = limpiar_cadena($_POST['tesis_resumen']);
if (!isset($_POST['boleta'], $_POST['T_nombre'], $_POST['T_apellido'], $_POST['ucorreo'], $_POST['numtel'], $_POST['carrera_id'])) {
    die("Faltan datos obligatorios");
}

# Conexión y guardado de datos
$conexion = conexion();

# Ejecutando la consulta para guardar el autor
$guardar_datosU=$conexion->query("INSERT INTO autor (boleta, nombre, apellidos, correo, telefono, Id_carrera) 
VALUES ('$boleta', '$nombret', '$apellidot', '$correo', '$telefono', '$id_carrera')");

# Ejecutando la consulta para guardar la tesis
$guardar_datosT=$conexion->query("INSERT INTO tesiss (Titulo, Resumen, Fecha_Publicacion, Palabras_Clave, Id_Carrera, Asesor) 
VALUES ('$ttitulo', '$tresumen', '$fecha', '$tpc', '$id_carrera', '$tasesor')");


/*
# Ejecutando la consulta para guardar el autor
$guardar_datosU=$conexion->query("INSERT INTO autor (boleta, nombre, apellidos, correo, telefono, Id_carrera) 
VALUES (cast('$boleta' as int), '$nombret', '$apellidot', '$correo', cast('$telefono' as int), cast('$id_carrera' as int)");

# Ejecutando la consulta para guardar la tesis
$guardar_datosT=$conexion->query("INSERT INTO tesiss (Titulo, Resumen, Fecha_Publicacion, Palabras_Clave, Id_Carrera, Asesor) 
VALUES ('$ttitulo', '$tresumen', cast('$fecha' as date), '$tpc', cast('$id_carrera' as int), '$tasesor')");
*/


/*
#TODAVIA NO JALA LA CONSULTA DEL ID DE TESIS PARA PODER PONERLO#
$tesis_id = $conexion->query("SELECT Id_Tesis from tesiss ");  // Obtener el Id_Tesis generado

# Ejecutando la consulta para guardar el autor
$guardar_datosA=$conexion->query("INSERT INTO tesis_autor (Id_Tesis, boleta) 
VALUES ('$tesis_id', '$boleta')");
# Cerrar la conexión*/
$conexion->close();

