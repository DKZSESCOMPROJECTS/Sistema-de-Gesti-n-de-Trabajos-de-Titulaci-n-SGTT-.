<?php require"./inc/session.php";?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include "./inc/head.php";?>
</head>

<body>
    <?php
        if(!isset($_GET['vista'])|| $_GET['VISTA']==""){
            $_GET['vista']="login";
            
        }
        include "./inc/navbar.php";
        include "./inc/script.php";
        
    ?>
</body>
</html>