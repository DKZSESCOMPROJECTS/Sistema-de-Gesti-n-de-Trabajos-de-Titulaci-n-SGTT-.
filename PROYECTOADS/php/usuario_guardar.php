<?php 
    
    #en este archivo tenemos que almacenar los datos del usuario para crear el login#
    require_once "main.php";
    #Almacenando datos#
        $nombre=limpiar_cadena($_POST['usuario_nombre']);