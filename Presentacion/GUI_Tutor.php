<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor</title>
    <!-------------------------- CSS ------------------------------------>
    <link rel = "stylesheet" href = "css/Alta.css?11">

    <!-------------------------JAVASCRIPT--------------------------------->
    <script src = "Javascript/Formulario/FormularioDinamico.js?2"></script>

    <!------------------- LLAMADAS PHP Y LIBRERIAS ----------------------->
    <?php require_once '../Logica/Servicio/GestorTutor.php'; ?>
</head>
<body>

    <div id = "agregar" style = "display: block;">
        
        <form method="post">

            <div id = "tutor">
                <label for="legajo">Legajo:</label>
                <input type="text" name="legajo" required autocomplete = "off"><br>

                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required autocomplete = "off"><br>

                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" required autocomplete = "off"><br>

                <label for="numero_documento">Número de documento:</label>
                <input type="text" name="numero_documento" required autocomplete = "off"><br>

                <label for="tipo_documento">Tipo de documento:</label>
                <input type="text" name="tipo_documento" required autocomplete = "off"><br>

                <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                <input type="date" name="fecha_nacimiento" required><br>

                <label for="genero">Género:</label>
                <select name = "genero" required>
                    <option value = "Masculino">Masculino</option>
                    <option value = "Femenino">Femenino</option>
                </select><br>

                <label for="tipo_tutor">Tipo de tutor:</label>
                <select name="tipo_tutor" id = "tipo_tutor" required  onchange="mostrarDiv()">
                    <option value="Alumno">Alumno</option>
                    <option value="Trabajador">Trabajador</option>
                </select><br>
            </div>

            <div id = "domicilio">
                <label for="provincia">Provincia:</label>
                <input type="text" name="provincia" required autocomplete = "off"><br>

                <label for="localidad">Localidad:</label>
                <input type="text" name="localidad" required autocomplete = "off"><br>

                <label for="codigo">Código postal:</label>
                <input type="text" name="codigo" required autocomplete = "off"><br>

                <label for="barrio">Barrio:</label>
                <input type="text" name="barrio" required autocomplete = "off"><br>

                <label for="calle">Calle:</label>
                <input type="text" name="calle" required autocomplete = "off"><br>

                <label for="numero">Número de casa:</label>
                <input type="text" name="numero" required autocomplete = "off"><br>
            </div>

            <div id = "trabajador" style = "display: none; ">
                <label for="horas">Horas de trabajo:</label>
                <input type="text" name="horas" autocomplete = "off"><br>

                <label for="cargo">Cargo de trabajo:</label>
                <input type="text" name="cargo" autocomplete = "off"><br>

                <label for="tipo_trabador">Tipo de trabajador:</label>
                <select name="tipo_trabajador" required>
                    <option value="Docente">Docente</option>
                    <option value="No-docente">No docente</option>
                </select><br>
            </div>

            <div id = "alumno" style = "display: block; ">
                <label for="codigo_carrera">Carrera:</label>
                <select name="codigo_carrera" required>
                    <option value="16" >016 - Analista de Sistemas</option>
                    <option value="912">912 - Gestion de las Organizaciones</option>
                    <option value="913">913 - Licenciatura en Administración</option>
                    <option value="93" >093 - Licenciatura en Enfermeria</option>
                    <option value="61" >061 - Licenciatura en Turismo</option>
                    <option value="914">914 - Profesorado en Economia</option>
                    <option value="86" >086 - Profesorado en Nivel Inicial</option>
                    <option value="84" >084 - Profesorado en Primaria</option>
                    <option value="71" >071 - Recursos Naturales</option>
                    <option value="916">916 - Seguridad e Higiene</option>
                    <option value="62" >062 - Tecnicatura en Turismo</option>
                    <option value="79" >079 - Tecnicatura en Energia</option>
                    <option value="78" >078 - Tecnicatura en Minas</option>
                    <option value="74" >074 - Trabajo Social</option>
                </select><br>
            </div>

            <button type="submit" name = "btnGuardar" id = "btnGuardar">Registrar</button>
            <button type="submit" name = "btnCancelar" id = "btnCancelar">Cancelar</button>
        </form>
        <?php
        if (isset($_POST['btnGuardar'])) 
        {
            $legajo             = $_POST['legajo'];
            $nombre             = $_POST['nombre'];
            $apellido           = $_POST['apellido'];
            $numero_documento   = $_POST['numero_documento'];
            $tipo_documento     = $_POST['tipo_documento'];
            $fecha_nacimiento   = new DateTime($_POST['fecha_nacimiento']);
            $genero             = $_POST['genero'];
            $tipo_tutor         = $_POST['tipo_tutor'];
            $provincia          = $_POST['provincia'];
            $localidad          = $_POST['localidad'];
            $codigo             = $_POST['codigo'];
            $barrio             = $_POST['barrio'];
            $calle              = $_POST['calle'];
            $numero             = $_POST['numero'];
            $habilitado         = true;
            $codigo_carrera     = $_POST['codigo_carrera'];

            $gestorTutor = new GestorTutor();
            $gestorTutor->darAltaTutorAlumno($legajo, $nombre, $apellido, $genero, $fecha_nacimiento, $numero_documento, $tipo_documento, $habilitado, $tipo_tutor, $provincia, $localidad, $codigo, $barrio, $calle, $numero, $codigo_carrera);
            $carreras = $gestorTutor->cargarAsignaturas($legajo,$codigo_carrera);
        }
        ?>
    </div>
</body>
</html>

