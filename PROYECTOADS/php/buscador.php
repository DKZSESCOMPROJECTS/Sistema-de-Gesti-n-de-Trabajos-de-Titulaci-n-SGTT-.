<?php 
    $modulo_buscador=limpiar_cadena($_POST['modulo_buscador']);

    $modulos=["general", "estudiante", "asesor", "palabras clave"];
    if(in_array($modulo_buscador, $modulos)){
        $modulos_url=[
            "general"=>"Buscador_Nombre_E", # si lo vamos a hacer mas simple, hay que redirigir esta
            "asesor"=>"asesor_search"
            #aqui definimos las categoiris de busqueda
        ];

        $modulos_url=$modulos_url[$modulo_buscador];
        $modulo_buscador="busqueda_".$modulo_buscador;
        //iniciar busqueda
        if(isset($_POST['txt_buscador'])){
            $txt=limpiar_cadena($_POST['txt_buscador']);
            if($txt==""){
                        echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                   Introduce un termino de busqueda
                </div>
            ';

            }else{
                if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}", $txt)){
                            echo '
                        <div class="notification is-danger is-light">
                            <strong>¡Ocurrió un error inesperado!</strong><br>
                        Introduce un termino de busqueda valido
                        </div>
                    ';

                }else{
                    $_SESSION[$modulo_buscador]=$txt;
                    header("Location: index.php?vista=$modulos_url", true, 303);
                    exit(); 
                }

            }

        }

            // eliminar busqueda
        if(isset($_POST['eliminar_buscador'])){
            unset($_SESSION[$modulo_buscador]);
            header("Location: index.php?vista=$modulos_url", true, 303);
                    exit(); 
        }
    }else{
        echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No podemos procesar la solicitud
        </div>
    ';

    }