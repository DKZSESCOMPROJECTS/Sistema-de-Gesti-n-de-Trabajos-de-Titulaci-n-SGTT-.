
<div class="container is-fluid mb-6 custom-background">
    <h1 class="title custom-title">Repositorio de tesis de ESCOM</h1>
    <h2 class="subtitle custom-subtitle">Formulario para subir una tesis</h2>
</div>
<div class="container pb-6 pt-6">
    <div class="form-rest mb-6 mt-6"></div>

    <form action="./php/tesis_guardar.php" method="POST" class="FormularioAjax" autocomplete="off">

        <!-- Sección de Datos del Usuario -->
        <div class="box">
            <h2 class="title is-4">Datos del Usuario</h2>
            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Numero de boleta</label>
                        <input class="input" type="text" name="boleta" pattern="[0-9]{10}" maxlength="10" required >
                    </div>
                </div>
                </div>
            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Nombres</label>
                        <input class="input" type="text" name="T_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Apellidos</label>
                        <input class="input" type="text" name="T_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Telefono</label>
                        <input class="input" type="tel" name="numtel" pattern="[0-9]{10}" maxlength="10">
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Correo</label>
                        <input class="input" type="email" name="ucorreo" maxlength="70" required>
                    </div>
                </div>
            </div>
            <div class="field">
                <label class="label">Carrera</label>
                <div class="control">
                    <div class="select">
                        <select name="carrera_id" required>
                            <option value="">Seleccione una opción</option>
                            <option value="1">Ingeniería en Sistemas Computacionales</option>
                            <option value="2">Ingeniería en Inteligencia Artificial</option>
                            <option value="3">Licenciatura en Ciencia de Datos</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Información de Tesis -->
        <div class="box">
            <h2 class="title is-4">Información de Tesis</h2>
            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Título de Tesis</label>
                        <input class="input" type="text" name="tesis_titulo" maxlength="100" required>
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Asesor</label>
                        <input class="input" type="text" name="tesis_asesor" maxlength="100">
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Fecha de Publicacion</label>
                        <input class="input" type="date" name="fecha" required>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Palabras clave</label>
                        <input class="input" type="text" name="palabras_clave" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,50}" maxlength="50" required>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Resumen</label>
                        <textarea class="textarea" name="tesis_resumen" rows="4" maxlength="500"></textarea>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Tesis PDF</label>
                    <input class="input" type="file" name="tesis_pdf" accept=".pdf" >
                </div>
            </div>
        </div>

        <!-- Botón Guardar -->
        <p class="has-text-centered">
            <button type="submit" class="button is-info is-rounded">Guardar</button>
        </p>
    </form>
</div>
