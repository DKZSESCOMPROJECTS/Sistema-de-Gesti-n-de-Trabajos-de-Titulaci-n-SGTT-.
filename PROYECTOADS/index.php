<?php require"./inc/session.php";?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include "./inc/head.php";?>
</head>

<body>
    <?php
        if(!isset($_GET['vista'])|| $_GET['vista']==""){
            $_GET['vista']="login";

        }

        #NO JALO SE REEMPLAZA ABAJO este codigo lo puedo usar para impedir que registren una tesis sin estar registrados
        /*if(is_file("./vistas/".$_GET['vista'].".php") && $_GET['vista']!="login" && $_GET['vista']!="404"  &&  $_GET['vista']!="consulta"
        &&  $_GET['vista']!="Basesor" &&  $_GET['vista']!="Buscador_KeyWords" &&  $_GET['vista']!="Buscador_Nombre_E"){
           #cerrar sesion forzado para que no manipulen el url
           if((!isset($_SESSION['id'])|| $_SESSION['id']=="") || (!isset($_SESSION['nombre'])|| $_SESSION['nombre']=="") || $_GET['vista']!="consulta"){
             
                        session_destroy();
                        if (headers_sent()) {
                            echo "<script> window.location.href='index.php?vista=login'; </script>";
                        } else {
                            header("Location: index.php?vista=login");
                        }
           }*/
// Verifica que el archivo exista y que la vista no sea una de las permitidas sin autenticación
            if (is_file("./vistas/" . $_GET['vista'] . ".php") && 
                    !in_array($_GET['vista'], ["login", "404", "consulta", "Basesor", "Buscador_KeyWords", "Buscador_Nombre_E", "Todo", "new_user"])) {

                    // Verifica si el usuario no está autenticado
                    if (!isset($_SESSION['id']) || empty($_SESSION['id']) || 
                        !isset($_SESSION['nombre']) || empty($_SESSION['nombre'])) {
                        
                        // Forzar cierre de sesión y redirigir al login
                        if (session_status() === PHP_SESSION_ACTIVE) {
                            session_destroy();
                        }
                        if (headers_sent()) {
                            echo "<script> window.location.href='index.php?vista=login'; </script>";
                        } else {
                            header("Location: index.php?vista=login");
                        }
                        exit; // Asegúrate de detener el script después de la redirección
                    }        
            include "./inc/navbar.php";
            include "./vistas/".$_GET['vista'].".php";
            include "./inc/script.php";
          
        }else{
                if($_GET['vista']=="login"){
                    include "./inc/navbar2.php"; 
                    include "./vistas/login.php";

                }elseif ($_GET['vista']=="consulta" ){# || $_GET['vista']="Basesor" ||  $_GET['vista']="Buscador_KeyWords" ||  $_GET['vista']="Buscador_Nombre_E" ||  $_GET['vista']="Todo") {
                    include "./inc/navbar2.php"; 
                    include "./vistas/consulta.php";
                    include "./inc/script.php";
                   
                }
                elseif($_GET['vista']=="Todo"){
                    include "./inc/navbar2.php"; 
                    include "./vistas/Todo.php";
                    include "./inc/script.php";
                } 
                elseif($_GET['vista']=="Buscador_Nombre_E"){
                    include "./inc/navbar2.php"; 
                    include "./vistas/Buscador_Nombre_E.php";
                    include "./inc/script.php";
                } 
                elseif($_GET['vista']=="Buscador_KeyWords"){
                    include "./inc/navbar2.php"; 
                    include "./vistas/Buscador_KeyWords.php";
                    include "./inc/script.php";
                }    
                elseif($_GET['vista']=="Basesor"){
                    include "./inc/navbar2.php"; 
                    include "./vistas/Basesor.php";
                    include "./inc/script.php";
                }   
                 elseif($_GET['vista']=="new_user"){
                    include "./inc/navbar2.php"; 
                    include "./vistas/new_user.php";
                    include "./inc/script.php";
                }            
                else {
                    include "./vistas/404.php";
                }
            
        }
  
    ?>
</body>
</html>