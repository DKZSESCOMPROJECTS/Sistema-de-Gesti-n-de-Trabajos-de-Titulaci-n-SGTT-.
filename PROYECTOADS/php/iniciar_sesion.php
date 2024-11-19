<?php
/*== Almacenando datos ==*/
$usuario = limpiar_cadena($_POST['login_usuario']);
$clave = limpiar_cadena($_POST['login_clave']);

/*== Verificando campos obligatorios ==*/
if ($usuario == "" || $clave == "") {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No has llenado todos los campos que son obligatorios
        </div>
    ';
    exit();
}

/*== Verificando integridad de los datos ==*/
if (verificar_datos("[a-zA-Z0-9]{4,20}", $usuario)) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El USUARIO no coincide con el formato solicitado
        </div>
    ';
    exit();
}

if (verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave)) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            La CLAVE no coincide con el formato solicitado
        </div>
    ';
    exit();
}

/*== Conectando y verificando usuario en la base de datos ==*/
$conexion = conexion();
$query = "SELECT * FROM usuario WHERE usuario_usuario='$usuario'";
$check_user = $conexion->query($query);

if ($check_user && $check_user->num_rows === 1) {
    $user_data = $check_user->fetch_assoc();

    if ($user_data['usuario_usuario'] == $usuario && password_verify($clave, $user_data['usuario_clave'])) {
        // Iniciar sesión
        $_SESSION['id'] = $user_data['usuario_id'];
        $_SESSION['nombre'] = $user_data['usuario_nombre'];
        $_SESSION['apellido'] = $user_data['usuario_apellido'];
        $_SESSION['usuario'] = $user_data['usuario_usuario'];

        // Redirigir a la página de inicio
        if (headers_sent()) {
            echo "<script> window.location.href='index.php?vista=home'; </script>";
        } else {
            header("Location: index.php?vista=home");
        }
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                Usuario o clave incorrectos
            </div>
        ';
    }
} else {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            Usuario o clave incorrectos
        </div>
    ';
}

/*== Cerrando conexión ==*/
$check_user->free();
$conexion->close();
?>
