<?php
require_once "main.php";

# Almacenando datos del usuario
$boleta = $_POST['boleta'];
$nombre = $_POST['usuario_nombre'];
$apellido = $_POST['usuario_apellido'];
$telefono = $_POST['numtel'];
$correo = $_POST['ucorreo'];
$id_carrera = $_POST['carrera_id'];

# Guardar datos de la tesis
$ttitulo = $_POST['tesis_titulo'];
$tasesor = $_POST['tesis_asesor'];
$fecha = $_POST['fecha'];
$tpc = $_POST['palabras_clave'];
$tresumen = $_POST['tesis_resumen'];

# Conexión y guardado de datos
$conexion = conexion();

# Ejecutando la consulta para guardar el autor
$guardar_datosU=$conexion->query("INSERT INTO autor (boleta, nombre, apellidos, correo, telefono, Id_carrera) 
VALUES ('$boleta', '$nombre', '$apellido', '$correo', '$telefono', '$id_carrera')");

# Ejecutando la consulta para guardar la tesis
$guardar_datosT=$conexion->query("INSERT INTO tesiss (Titulo, Resumen, Fecha_Publicacion, Palabras_Clave, Id_Carrera, Asesor) 
VALUES ('$ttitulo', '$tresumen', '$fecha', '$tpc', '$id_carrera', '$tasesor')");




#TODAVIA NO JALA LA CONSULTA DEL ID DE TESIS PARA PODER PONERLO#
$tesis_id = $conexion->query("SELECT Id_Tesis from tesiss ");  // Obtener el Id_Tesis generado

# Ejecutando la consulta para guardar el autor
$guardar_datosA=$conexion->query("INSERT INTO tesis_autor (Id_Tesis, boleta) 
VALUES ('$tesis_id', '$boleta')");
# Cerrar la conexión
$conexion->close();

