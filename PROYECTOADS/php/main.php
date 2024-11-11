<?php
    //conexion a la base de datos
    //para poder reutilizar ese codigo 
    
    function conexion(){
            $host="localhost";
            $port=3306;
            $socket="";
            $user="root";
            $password="andres";
            $dbname="tesis";
            $pdo = new mysqli($host, $user, $password, $dbname, $port, $socket)
                 or die ('Could not connect to the database server' . mysqli_connect_error());
            return $pdo;
    }

# Verificar datos #
#por ejemplo CARLOS, el filtro seria "[a-zA-Z]{6,10}" al momento de mandar carlos, el programa verifica#
#si carlos contiene letras y son de 6 a 10 caracteress#
function verificar_datos($filtro,$cadena){
    if(preg_match("/^".$filtro."$/", $cadena)){
        return false;
    }else{
        return true;
    }
}

# Funcion renombrar fotos para quitar caracteres#
function renombrar_fotos($nombre){
    $nombre=str_ireplace(" ", "_", $nombre);
    $nombre=str_ireplace("/", "_", $nombre);
    $nombre=str_ireplace("#", "_", $nombre);
    $nombre=str_ireplace("-", "_", $nombre);
    $nombre=str_ireplace("$", "_", $nombre);
    $nombre=str_ireplace(".", "_", $nombre);
    $nombre=str_ireplace(",", "_", $nombre);
    $nombre=$nombre."_".rand(0,100);
    return $nombre;
}

# Limpiar cadenas de texto para evitar inyeccion sql#
function limpiar_cadena($cadena){
    $cadena=trim($cadena);
    $cadena=stripslashes($cadena);
    $cadena=str_ireplace("<script>", "", $cadena);
    $cadena=str_ireplace("</script>", "", $cadena);
    $cadena=str_ireplace("<script src", "", $cadena);
    $cadena=str_ireplace("<script type=", "", $cadena);
    $cadena=str_ireplace("SELECT * FROM", "", $cadena);
    $cadena=str_ireplace("DELETE FROM", "", $cadena);
    $cadena=str_ireplace("INSERT INTO", "", $cadena);
    $cadena=str_ireplace("DROP TABLE", "", $cadena);
    $cadena=str_ireplace("DROP DATABASE", "", $cadena);
    $cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
    $cadena=str_ireplace("SHOW TABLES;", "", $cadena);
    $cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
    $cadena=str_ireplace("<?php", "", $cadena);
    $cadena=str_ireplace("?>", "", $cadena);
    $cadena=str_ireplace("--", "", $cadena);
    $cadena=str_ireplace("^", "", $cadena);
    $cadena=str_ireplace("<", "", $cadena);
    $cadena=str_ireplace("[", "", $cadena);
    $cadena=str_ireplace("]", "", $cadena);
    $cadena=str_ireplace("==", "", $cadena);
    $cadena=str_ireplace(";", "", $cadena);
    $cadena=str_ireplace("::", "", $cadena);
    $cadena=trim($cadena);
    $cadena=stripslashes($cadena);
    return $cadena;
}