<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-------------------------- CSS ------------------------------------->
    <link rel = "stylesheet" href = "css/Reporte.css?1">

    <!------------------- LLAMADAS PHP Y LIBRERIAS ----------------------->
    <?php require ("../Logica/Servicio/Reporte.php");?>

    <title>Reporte</title>
</head>
<body>
    <div class = "contenedor">

        <!--Usuario-->
        <div class="usuario">
        <a href="?action=generarReporteUsuario">
        <div class = "galeria">
        <center><img src = "./css/imagen/usuario.png" class = "imagen"></center>
        <label class = "texto">Usuario</label>
        <p>Reporte de usuarios </p>
        </div></a></div>



        <!--Usuario-->
        <div class="usuarioE">
        <div class = "galeria">
        <center><img src = "./css/imagen/usuario.png" class = "imagen"></center>
        <label class = "texto">Usuario</label>
        <input type = "text" class = "campo">
        <button type = "submit"  class = "btnGenerar">Generar</button>
        </div></a></div>

        <!--Sala-->
        <div class="sala">
        <a href="./GUI_Sala.php">
        <div class = "galeria">
        <center><img src = "./css/imagen/sala.png" class = "imagen"></center>
        <label class = "texto">Sala</label>
        <p>Dominio donde los niños y docentes realizaran las actividades del jardin maternal.</p>
        </div></a></div>

        <!--Tutor-->
        <div class="tutor">
        <a href="./GUI_Tutor.php">
        <div class = "galeria">
        <center><img src = "./css/imagen/tutor.png" class = "imagen"></center>
        <label class = "texto">Tutor</label>
        <p>Familiar a cargo del niño con un rol en el entorno universitario.</p>
        </div></a></div>

        <!--Niño-->
        <div class="niño">
        <a href="../GUI/Asistencia.php">
        <div class = "galeria">
        <center><img src = "./css/imagen/niño.png" class = "imagen"></center>
        <label class = "texto">Niño</label>
        <p>Infante que asiste al jardin maternal durante el periodo de cursadas.</p>
        </div></a></div>

        <!--Asistencia-->
        <div class="asistencia">
        <a href="../GUI/Asistencia.php">
        <div class = "galeria">
        <center><img src = "./css/imagen/asistencia.png" class = "imagen"></center>
        <label class = "texto">Asistencia</label>
        <p>Registro de todos los niños y usuarios que asistieron en el dia a dia de sus cursadas.</p>
        </div></a></div>

        <!--Reporte-->
        <div class="reporte">
        <a href="./GUI_Reporte.php">
        <div class = "galeria">
        <center><img src = "./css/imagen/reporte.png" class = "imagen"></center>
        <label class = "texto">Reporte</label>
        <p>Datos recopilados del sistema para su descarga en formato PDF </p>
        </div></a></div>
    </div>
    <?php
        $reporte = new Reporte();
        if (isset($_GET['action'])) 
        {
            $action = $_GET['action'];
            if ($action === 'generarReporteUsuario') 
            {
                $reporte->generarReporteUsuario();
            }
        }
    ?>
</body>
</html>