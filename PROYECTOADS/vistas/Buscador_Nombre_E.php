buscador por nombre del estudiante
<div class="container is-fluid mb-6">
    <h1 class="title">Usuarios</h1>
    <h2 class="subtitle">Buscar por autor</h2>
</div>

<div class="container pb-6 pt-6">
    <?php 
    require_once "./php/main.php";
    if(isset($_POST['modulo_buscador'])){
        require_once "./php/buscador.php";
    }

    if(!isset($_SESSION['busqueda_general']) && empty($_SESSION['busqueda_general'])){ 
    ?>
    <div class="columns">
        <div class="column">
            <form action="" method="POST" autocomplete="off" >
                <input type="hidden" name="modulo_buscador" value="general">   
                <div class="field is-grouped">
                    <p class="control is-expanded">
                        <input class="input is-rounded" type="text" name="txt_buscador" placeholder="¿Qué estas buscando?" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" maxlength="30" >
                    </p>
                    <p class="control">
                        <button class="button is-info" type="submit" >Buscar</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <?php } else {?>
    

    <div class="columns">
        <div class="column">
            <form class="has-text-centered mt-6 mb-6" action="" method="POST" autocomplete="off" >
                <input type="hidden" name="modulo_buscador" value="general"> 
                <input type="hidden" name="eliminar_buscador" value="general">
                <p>Estas buscando <strong>“<?php echo $_SESSION['busqueda_general'];?>"</strong></p>
                <br>
                <button type="submit" class="button is-danger is-rounded">Eliminar busqueda</button>
            </form>
        </div>
    </div>
    <?php 
        $pagina = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if($pagina <= 1) {
            $pagina = 1;
        }
    
        // Limpiamos las variables
        $pagina = limpiar_cadena($pagina);
        $url = "index.php?vista=Buscador_Nombre_E&page=";
        $registros = 5;
        $busqueda = $_SESSION['busqueda_general'];
    
        // Incluimos el archivo que genera la lista de tesis
        require_once "./php/tesis_lista.php";
        }
     ?>
    
</div>
